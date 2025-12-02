<?php
$db = new SQLite3(__DIR__ . '/../database/database.sqlite');
$exists = $db->querySingle("SELECT name FROM sqlite_master WHERE type='table' AND name='pesanan'");
if (!$exists) {
    echo "table pesanan missing\n";
    exit;
}
$res = $db->querySingle('SELECT count(*) FROM pesanan');
echo "pesanan count: " . ($res === null ? 0 : $res) . PHP_EOL;