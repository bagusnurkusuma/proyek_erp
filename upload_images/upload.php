<?php
require_once 'api.php';

if (isset($_POST['upload'])) {
    $file = $_FILES['image'];

    $filename = $file['name'];
    $filetype = $file['type'];
    $filedata = file_get_contents($file['tmp_name']);

    $result = uploadImage($filename, $filetype, $filedata);

    if ($result) {
        echo "Image uploaded successfully.";
    } else {
        echo "Error uploading image.";
    }
}
