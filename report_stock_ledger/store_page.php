<!DOCTYPE html>             
<html lang="en">                
                
<head>              
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">             
    <!-- Meta, title, CSS, favicons, etc. -->               
    <meta charset="utf-8">              
    <meta http-equiv="X-UA-Compatible" content="IE=edge">               
    <meta name="viewport" content="width=device-width, initial-scale=1">                
                
    <title>Gentelella Alela! | </title>             
                
</head>             
                
<?php include "../asset_default/side_bar.php" ?>                
                
<body class="nav-md">               
    <div class="container body">                
        <div class="right_col" role="main">             
            <div class="content">               
                <div class="page-title">                
                </div>              
                
                <!-- page content -->               
                <div class="x_panel">               
                    <div class="x_title">               
                        <h2>Form Store Profile</small></h2>             
                        <ul class="nav navbar-right panel_toolbox">             
                            <li>                
                                <button onclick="window.location.href='store_view.php'" class="btn btn-secondary" style="Margin-right:10px;">See Detail</button>                
                            </li>               
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>               
                            </li>               
                        </ul>               
                        <div class="clearfix"></div>                
                    </div>              
                    <div class="x_content">             
                                    
                    <form class="was-validated text-dark font-weight-bold">             
                        <div class="row">               
                            <div class="col-md-6 col-sm-12 form-group">             
                                
                                <label class="form-label" for="validationCustom1">Nama Toko</label>             
                                <input type="text" class="form-control is-invalid" id="validationCustom1" style="margin-bottom: 10px;" required>                
                
                                
                                <label class="form-label" for="validationCustom2">Alamat</label>                
                                <textarea rows="2" id="validationCustom2" class="form-control is-invalid" style="margin-bottom: 10px;" required></textarea>             
                
                                
                                <label class="form-label" for="validationCustom3">Deskripsi </label>                
                                <textarea id="validationCustom3" type="text" class="form-control is-invalid" style="margin-bottom: 10px;" required></textarea>              
                
                                
                                <label class="form-label" for="validationCustom4">Visi </label>             
                                <input type="text" id="validationCustom4" class="form-control is-invalid" style="margin-bottom: 10px;" required>                
                
                                
                                <label class="form-label" for="validationCustom5">Misi </label>             
                                <input type="text" id="validationCustom5" class="form-control is-invalid" style="margin-bottom: 10px;" required>                
                
                                
                                <label class="form-label" for="validationCustom6">Motto </label>                
                                <input type="text" id="validationCustom6" class="form-control is-invalid" style="margin-bottom: 10px;" required>                
                
                                
                                <label class="form-label" for="validationCustom7">Superioritas </label>             
                                <input type="text" id="validationCustom7" class="form-control is-invalid" style="margin-bottom: 10px;" required>                
                

                                <label class="form-label" for="validationCustom8">Tambahkan Foto </label>               
                                <div class="custom-file" style="margin-bottom :10px;">              
                                        <input type="file" id="validationCustom8" class="custom-file-input is-invalid" required>                
                                        <label class="custom-file-label">Choose file</label>                
                                </div>              
                
                                
                                <label class="form-label" for="validationCustom9">Email </label>                
                                <input type="email" id="validationCustom9" class="form-control is-invalid" style="margin-bottom: 10px;" required>               
                
                                
                                <label class="form-label" for="validationCustom10">Website </label>             
                                <input type="text" id="validationCustom10" class="form-control is-invalid" style="margin-bottom: 10px;" required>               
                
                                
                                <label class="form-label" for="validationCustom11">Telepon </label>             
                                <input type="text" id="validationCustom11" class="form-control is-invalid" style="margin-bottom: 10px;"  required>                
                
                                
                                <label class="form-label" for="validationCustom12">Twitter (X) </label>             
                                <input type="text" id="validationCustom12" class="form-control is-invalid" style="margin-bottom: 10px;" required>               
                
                                
                                <label class="form-label" for="validationCustom13">Instagram </label>               
                                <input type="text" id="validationCustom13" class="form-control is-invalid" style="margin-bottom: 10px;"required>     
                                
                                <label class="form-label" for="validationCustom8">Testimoni</label>               
                                <div class="custom-file" style="margin-bottom :10px;">              
                                        <input type="file" id="validationCustom8" class="custom-file-input is-invalid" multiple required>                
                                        <label class="custom-file-label">Choose file</label>                
                                </div> 
                                
                                <button type="submit" class="btn btn-success justify-content-end">Submit</button>        

                            </div>              
                        </div>              
                    </form>             
                
                    </div>              
                </div>              
            </div>           
               
            <!-- page content -->               
        </div>              
    </div>
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog d-flex align-items-center justify-content-center" role="document">
        <div class="modal-content text-center">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="successModalLabel">Notifikasi!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Data Toko Berhasil Disimpan!</h5>
            </div>
            <div class="modal-footer">
                <div class="mr-auto">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="closeMessage()">Close</button>
                </div>
                <div class="ml-auto">
                    <button type="button" class="btn btn-secondary" onclick="redirectToStoreView()">View</button>
                </div>
            </div>
        </div>
    </div>
</div>              
</body>             
                
<script>                
    (function () {
        'use strict';

        var forms = document.querySelectorAll('.was-validated');

        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    } else {
                        // Display the success modal
                        $('#successModal').modal('show');

                        // You can perform additional actions here if needed

                        // Prevent the default form submission
                        event.preventDefault();
                    }

                    form.classList.add('was-validated');
                }, false);
            });

        // Function to close the success modal
        window.closeMessage = function () {
            $('#successModal').modal('hide');
        };

        // Function to redirect to store_view.php
        window.redirectToStoreView = function () {
            window.location.href = 'store_view.php';
        };
    })();         
</script>               
</html>             