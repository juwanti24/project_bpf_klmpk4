<?php
$dbPath = __DIR__ . '/../database/database.sqlite';
if (!file_exists($dbPath)) {
    echo "database file missing: $dbPath\n";
    exit(1);
}
$db = new SQLite3($dbPath);

echo "-- pesanan schema --\n";
$cols = $db->query("PRAGMA table_info('pesanan')");
while ($row = $cols->fetchArray(SQLITE3_ASSOC)) {
    echo $row['cid'] . ': ' . $row['name'] . ' (' . $row['type'] . ')' . PHP_EOL;
}

// show sample rows counts
$tables = ['menu','pelanggans','meja','pesanan'];
foreach ($tables as $t) {
    $res = $db->querySingle("SELECT count(*) FROM sqlite_master WHERE type='table' AND name='$t'");
    if ($res) {
        $cnt = $db->querySingle("SELECT count(*) FROM $t");
        echo "table $t rows: $cnt\n";
    } else {
        echo "table $t missing\n";
    }
}

// Try to insert a test pesanan if possible
$menuId = $db->querySingle("SELECT menu_id FROM menu LIMIT 1");
$pelangganId = $db->querySingle("SELECT pelanggan_id FROM pelanggans LIMIT 1");
$mejaId = $db->querySingle("SELECT meja_id FROM meja LIMIT 1");

if (!$menuId) {
    echo "no menu to insert\n";
    exit(0);
}
if (!$mejaId) {
    // create meja 1
    $db->exec("INSERT INTO meja (nomor_meja, created_at, updated_at) VALUES ('1', datetime('now'), datetime('now'))");
    $mejaId = $db->lastInsertRowID();
    echo "created meja id $mejaId\n";
}

if (!$pelangganId) {
    // create a guest pelanggan
    $db->exec("INSERT INTO pelanggans (nama, no_hp, created_at, updated_at) VALUES ('Tamu','', datetime('now'), datetime('now'))");
    $pelangganId = $db->lastInsertRowID();
    echo "created pelanggan id $pelangganId\n";
}

// Build insert based on available columns
$colsInfo = [];
$cols = $db->query("PRAGMA table_info('pesanan')");
while ($row = $cols->fetchArray(SQLITE3_ASSOC)) {
    $colsInfo[] = $row['name'];
}

$now = date('Y-m-d H:i:s');
$fields = [];
$values = [];
function qv($v) { return "'" . SQLite3::escapeString($v) . "'"; }

if (in_array('user_id', $colsInfo)) { $fields[]='user_id'; $values[]=$pelangganId; }
if (in_array('pelanggan_id', $colsInfo)) { $fields[]='pelanggan_id'; $values[]=$pelangganId; }
if (in_array('meja_id', $colsInfo)) { $fields[]='meja_id'; $values[]=$mejaId; }
if (in_array('menu_id', $colsInfo)) { $fields[]='menu_id'; $values[]=$menuId; }
if (in_array('jumlah', $colsInfo)) { $fields[]='jumlah'; $values[]=3; }
if (in_array('total_harga', $colsInfo)) { $fields[]='total_harga'; $values[]=75000; }
if (in_array('tanggal_pesanan', $colsInfo)) { $fields[]='tanggal_pesanan'; $values[]=date('Y-m-d'); }
if (in_array('nama_pelanggan', $colsInfo)) { $fields[]='nama_pelanggan'; $values[]='Tamu'; }
if (in_array('no_hp', $colsInfo)) { $fields[]='no_hp'; $values[]=''; }
if (in_array('catatan', $colsInfo)) { $fields[]='catatan'; $values[]='Test insert'; }
if (in_array('status', $colsInfo)) { $fields[]='status'; $values[]='Menunggu'; }
if (in_array('created_at', $colsInfo)) { $fields[]='created_at'; $values[]=$now; }
if (in_array('updated_at', $colsInfo)) { $fields[]='updated_at'; $values[]=$now; }

if (empty($fields)) { echo "no known columns to insert\n"; exit(0); }

$sql = 'INSERT INTO pesanan (' . implode(',', $fields) . ') VALUES (' . implode(',', array_map('qv', $values)) . ')';

echo "Inserting: $sql\n";
$ok = $db->exec($sql);
if ($ok) {
    echo "insert ok, new id: " . $db->lastInsertRowID() . "\n";
    $cnt = $db->querySingle('SELECT count(*) FROM pesanan');
    echo "pesanan count now: $cnt\n";
} else {
    echo "insert failed: " . $db->lastErrorMsg() . "\n";
}
