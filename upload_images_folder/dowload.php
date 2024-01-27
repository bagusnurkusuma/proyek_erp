<?php
if (isset($_GET['file_name_replaced'])) {
    $filename = $_GET['file_name_replaced'];
    $filepath = '../asset_file/file/' . $filename;
    // file_put_contents($localPath, $imageContent);
    // header('Content-Type: application/octet-stream');
    // header('Content-Disposition: attachment; filename="' . $_GET['file_name'] . '"');
    if (file_exists($filepath)) {

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: 0");
        header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
        header('Content-Length: ' . filesize($filename));
        header('Pragma: public');

        //Clear system output buffer
        flush();
        readfile($filepath);
        exit;
    } else {
        echo "File does not exist.";
    }
}
