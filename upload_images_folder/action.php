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

    $file_name = $file['name'];
    $file_tmp_name = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];
    $file_type = $file['type'];

    $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");

    if (in_array($file_extension, $allowedExtensions)) {
        if ($file_error === 0) {
            require_once "../asset_default/uuid_function.php";
            $file_id = get_uuid();
            $file_name_replaced = $file_id . "." . $file_extension;
            $file_destination = '../asset_file/file/' . $file_name_replaced;

            move_uploaded_file($file_tmp_name, $file_destination);
            require_once "api.php";
            uploadImage($file_name, $file_name_replaced, $file_type, $file_id);
            header("location: index.php");
            echo "Image uploaded successfully.";
        } else {
            echo "Error uploading the file.";
        }
    } else {
        echo "Invalid file type. Allowed types: jpg, jpeg, png, gif";
    }
}
//------------------------------old--------------------------------------//
// if (isset($_GET['id'])) {
//     $imageId = $_GET['id'];

//     $row = getImageById($imageId);
//     if ($row) {
//         header("Content-type: {$row['file_type']}");
//         if ($_GET['action'] == 'download') {
//             $fileExtension = explode('/', $row['file_type'])[1];
//             date_default_timezone_set('Asia/Jakarta');
//             $formattedTimestamp = date('Y-m-d H:i:s', time());
//             header("Content-Disposition: attachment; filename=image_erp_{$formattedTimestamp}.{$fileExtension}");
//         }
//         $hasil = substr($row["image"], 2);
//         $hasil = hex2bin($hasil);
//         $hasil = base64_decode($hasil);
//         echo $hasil;
//         exit;
//     } else {
//         echo "Image not found.";
//     }
// }

// if (isset($_POST['upload'])) {
//     $file = $_FILES['image'];

//     $filename = $file['name'];
//     $filetype = $file['type'];
//     $filedata = file_get_contents($file['tmp_name']);

//     $result = uploadImage($filename, $filetype, $filedata);

//     if ($result) {
//         echo '<script>alert("Image uploaded successfully.");</script>';
//         header("location: index.php");
//     } else {
//         echo "Error uploading image.";
//     }
// }
