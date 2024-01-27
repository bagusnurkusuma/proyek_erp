<?php
// Database connection code here

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
            $file_name_baru = get_uuid() . "." . $file_extension;
            $file_destination = '../file/' . $file_name_baru;

            move_uploaded_file($file_tmp_name, $file_destination);

            // Insert image information into the database
            // $sql = "INSERT INTO images (filename, description) VALUES ('$file_name_baru', '$description')";
            // Execute the query using your database connection

            echo "Image uploaded successfully.";
        } else {
            echo "Error uploading the file.";
        }
    } else {
        echo "Invalid file type. Allowed types: jpg, jpeg, png, gif";
    }
}
