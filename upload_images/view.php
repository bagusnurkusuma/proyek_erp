<?php
// replace with your database information

$dbHost = '127.0.0.1';
$dbName = 'toko_baru';
$dbUser = 'd_team';
$dbPass = 'rajajowas111';

// connect to the database
try {
    $conn = new PDO("pgsql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// retrieve the image from the database
try {
    // $sql = "SELECT convert_from(file_data, 'UTF8') as image FROM master.employee WHERE id = 'abfc3e01-b253-4c74-bcf8-b1da06c7d3e6'";
    $sql = "SELECT file_type,file_data::TEXT as image FROM master.employee WHERE id = 'abfc3e01-b253-4c74-bcf8-b1da06c7d3e6'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $images = $row["image"];
    $hasil = substr($images, 2);
    $hasil = hex2bin($hasil);
    header("Content-type: {$row['file_type']}");
    echo base64_decode($hasil);
    exit;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// close the database connection
$conn = null;


// $host = '127.0.0.1';
// $port = '5432';
// $db = 'toko_baru';
// $user = 'd_team';
// $password = 'rajajowas111'; // change to your password

// $link = pg_connect("host=$host port=$port dbname=$db user=$user password=$password") or die(pg_close());
// $query = "SELECT file_data as image FROM master.employee WHERE id='c9545168-22a9-4536-b32c-793f9b45a901'";
// $result = pg_query($link, $query);
// $hasil = pg_fetch_array($result);
// $images = $hasil["image"];
// $hasil = substr($images, 2);
// $hasil = hex2bin($hasil);
// header("Content-Type: image/jpeg");
// echo base64_decode($hasil);
// exit;