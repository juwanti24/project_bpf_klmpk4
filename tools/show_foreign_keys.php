<?php
$db = new SQLite3(__DIR__ . '/../database/database.sqlite');
function showFK($db,$table){
    echo "Foreign keys for $table:\n";
    $res = $db->query("PRAGMA foreign_key_list('$table')");
    while($r = $res->fetchArray(SQLITE3_ASSOC)){
        echo json_encode($r)."\n";
    }
}
showFK($db,'pesanan');
showFK($db,'pelanggans');
showFK($db,'menu');
showFK($db,'meja');
