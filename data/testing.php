<!-- <!DOCTYPE html>
<html>

<body>

    <?php
    // $data=  file_get_contents("../asset_default/function.js");
    $url = "https://booking.kai.id/api/stations2";
    $data = file_get_contents($url);
    echo $data;
    ?>

</body>

</html> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SweetAlert2 Confirm Example</title>
    <!-- Include SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>

    <!-- Your HTML content -->

    <!-- Include SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <button type="button" id="deleteButton">Delete</button>
    <button type="button" id="paragraphButton">Show Paragraph</button>
    <script>
        $(document).ready(function() {
            // Example function to trigger SweetAlert2 with a paragraph of text
            function showParagraph() {
                Swal.fire({
                    title: 'Custom Paragraph Example',
                    html: String.raw`<p>This is the first line of text.</p><p>This is the second line of text with a newline character.</p>`,
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            }

            // Example: Trigger the SweetAlert2 with a paragraph on a button click
            $('#paragraphButton').click(function() {
                showParagraph();
            });
        });

        $(document).ready(function() {
            // Example function to trigger SweetAlert2 confirmation
            function showConfirmation() {
                Swal.fire({
                    position: "top",
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // User clicked the "Yes, delete it!" button
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );
                        // Add your logic for deletion or any other action here
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        // User clicked the "No, cancel!" button or outside the modal
                        Swal.fire(
                            'Cancelled',
                            'Your file is safe :)',
                            'info'
                        );
                        // Add your logic for cancellation or any other action here
                    }
                });
            }

            // Example: Trigger the confirmation dialog on a button click
            $('#deleteButton').click(function() {
                showConfirmation();
            });
        });
    </script>

</body>

</html>