<?php
include("api.php");
if (isset($_GET['asumuk'])) {
    $id = $_GET['asumuk'];

    // $row = getImageById($imageId);

    $input = ['body' => ['data_id' => $id]];
    $hasil = get_images_by_file_id($input);
    if (is_array($hasil) && count($hasil)) {
        foreach ($hasil as $row) :
            header("Content-type: {$row['file_type']}");
            if ($_GET['action'] == 'download') {
                $fileExtension = explode('/', $row['file_type'])[1];
                date_default_timezone_set('Asia/Jakarta');
                $formattedTimestamp = date('Y-m-d H:i:s', time());
                header("Content-Disposition: attachment; filename=image_erp_{$formattedTimestamp}.{$fileExtension}");
            }
            $output = substr($row["file_data"], 2);
            $output = hex2bin($output);
            $output = base64_decode($output);
            echo $output;
            exit;
        endforeach;
    } else {
        echo "Image not found.";
    }
}
