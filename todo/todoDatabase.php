<?php
// ━━━接続情報━━━
$host="localhost";
$dbname="todo";
$dbuser="root";
$dbpass="";
// ━━━━━━━━━━
$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";
$pdo = new PDO($dsn, $dbuser, $dbpass);