<?php

$host = '127.0.0.1';
$port = '5432';
$db = 'toko_baru';
$user = 'd_team';
$password = 'rajajowas111'; // change to your password

$pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db;user=$user;password=$password");

// Set the PDO error mode to exception
try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
