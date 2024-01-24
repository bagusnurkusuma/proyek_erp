<?php
require_once 'api.php';

if (isset($_GET['id'])) {
    $imageId = $_GET['id'];

    $row = getImageById($imageId);
    if ($row) {
        header("Content-type: {$row['file_type']}");
        if ($_GET['action'] == 'download') {
            $fileExtension = explode('/', $row['file_type'])[1];
            date_default_timezone_set('Asia/Jakarta');
            $formattedTimestamp = date('Y-m-d H:i:s', time());
            header("Content-Disposition: attachment; filename=image_erp_{$formattedTimestamp}.{$fileExtension}");
        }
        $hasil = substr($row["image"], 2);
        $hasil = hex2bin($hasil);
        $hasil = base64_decode($hasil);
        echo $hasil;
        exit;
    } else {
        echo "Image not found.";
    }
}

if (isset($_POST['upload'])) {
    $file = $_FILES['image'];

    $filename = $file['name'];
    $filetype = $file['type'];
    $filedata = file_get_contents($file['tmp_name']);

    $result = uploadImage($filename, $filetype, $filedata);

    if ($result) {
        echo '<script>alert("Image uploaded successfully.");</script>';
        header("location: index.php");
    } else {
        echo "Error uploading image.";
    }
}
