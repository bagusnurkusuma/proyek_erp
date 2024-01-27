<?php
// if (isset($_GET['file_name_replaced'])) {
//     $filename = $_GET['file_name_replaced'];
$filename = "2231314b-2a9f-4220-9187-276615b75a96.jpg";
header("Content-type: image/jpeg");
$filepath = '../asset_file/file/' . $filename;
// echo "<img src='$filepath' alt='Preview' width='500'>";
// echo $filepath;
// }

// Path to the original image
$originalImagePath = $filepath;

// Load the original image
$originalImage = imagecreatefromjpeg($originalImagePath);

// Get the original image dimensions
$originalWidth = imagesx($originalImage);
$originalHeight = imagesy($originalImage);

// Calculate the dimensions for the preview (e.g., half the size)
$previewWidth = $originalWidth / 2;
$previewHeight = $originalHeight / 2;

// Create a new image for the preview
$previewImage = imagecreatetruecolor($previewWidth, $previewHeight);

// Resize and copy the original image to the preview image
imagecopyresampled(
    $previewImage,
    $originalImage,
    0,
    0,
    0,
    0,
    $previewWidth,
    $previewHeight,
    $originalWidth,
    $originalHeight
);

// Set the content type header for a JPEG image
header("Content-type: image/jpeg");

// Output the preview image to the browser
imagejpeg($previewImage);

// Free up memory by destroying the images
imagedestroy($originalImage);
imagedestroy($previewImage);
