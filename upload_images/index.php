<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload, Preview, and Download</title>
    <style>
        img {
            max-width: 300px;
            max-height: 300px;
        }
    </style>
</head>

<body>
    <h2>Upload Image</h2>
    <form action="action.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*" required>
        <button type="submit" name="upload">Upload</button>
    </form>

    <h2>Image Preview</h2>
    <ul>
        <?php
        include "api.php";
        $images = getImages();
        foreach ($images as $image) :
            echo "<li><img src='action.php?id={$image['id']}&action=preview' alt='{$image['file_name']}'></li>";
        endforeach;
        ?>
    </ul>

    <h2>Download Image</h2>
    <ul>
        <?php
        foreach ($images as $image) {
            echo "<li><a href='action.php?id={$image['id']}&action=download'>{$image['file_name']}</a></li>";
        }
        ?>
    </ul>
</body>

</html>