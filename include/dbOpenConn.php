<?php
$dir = __DIR__ . '/../database';
if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}
$db = new SQLite3(__DIR__ . '/../database/bioChistera.db');

?>