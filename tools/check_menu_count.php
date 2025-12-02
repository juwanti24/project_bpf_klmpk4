<?php
$db = new SQLite3(__DIR__ . '/../database/database.sqlite');
$res = $db->querySingle('SELECT count(*) as cnt FROM menu');
echo "Menu count: " . $res . PHP_EOL;