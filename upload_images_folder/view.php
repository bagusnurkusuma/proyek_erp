<!DOCTYPE html>
<html lang="en">
<!-- Script JQuery -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

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
    <input type="file" id="fileInput" accept="image/*" multiple>
    <img id="displayImage" src="" alt="Selected image">
</body>

</html>
<script>
    $(document).ready(function() {
        $('#fileInput').change(function() {
            const file = this.files[0];
            const reader = new FileReader();

            reader.onload = function(event) {
                $('#displayImage').attr('src', event.target.result);
            };

            reader.readAsDataURL(file);
        });
    });
</script>