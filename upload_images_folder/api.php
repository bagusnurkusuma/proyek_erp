<?php
// $host = '127.0.0.1';
// $port = '5432';
// $db = 'toko_baru';
// $user = 'd_team';
// $password = 'rajajowas111'; // change to your password

// $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db;user=$user;password=$password");

// // Set the PDO error mode to exception
// try {
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     echo "Connection failed: " . $e->getMessage();
// }

// require_once '../asset_default/koneksi.php';
// require_once(__DIR__ . '/../asset_default/koneksi.php');

function uploadImage($filename, $filenamereplaced, $filetype, $id)
{
    include "../asset_default/koneksi.php";
    $query = "INSERT INTO file.file_images (file_name, file_name_replaced, file_type, id) VALUES ('" . $filename . "','" . $filenamereplaced . "','" . $filetype . "','" . $id . "')";
    $stmt = $pdo->prepare($query);
    $result = $stmt->execute();

    return $result;
}


function getImages()
{
    // global $pdo;
    include "../asset_default/koneksi.php";
    $stmt = $pdo->prepare("SELECT id, file_name_replaced, file_name FROM file.file_images WHERE file_name_replaced IS NOT NULL");
    $stmt->execute();
    $images = [];
    while ($row = $stmt->fetch()) {
        $images[] = $row;
    }

    return $images;
}


function getImageById($id)
{
    include "../asset_default/koneksi.php";

    $query = "SELECT file_type, file_name, file_name_replaced as image FROM master.employee WHERE id = '" . $id . "'";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $image = $stmt->fetch(PDO::FETCH_ASSOC);

    return $image;
}
