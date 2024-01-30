<?php
require_once "../asset_default/side_bar.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body class="nav-md">
    <div class="container body">
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="content">
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Profile</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><button type="button" title="Change Password" name="change" id="jq_change_password_user" class="btn btn-info btn-xs change_password_user"><i class="fa fa-key"></i></button></li>
                                    <li><button type="button" title="Edit Profile" name="edit_profile" id="jq_edit_profile" class="btn btn-warning edit_profile"><i class="fa fa-pencil-square"></i></button></li>
                                    <li><button type="button" name="refresh" id="jq_refresh" class="btn btn-success refresh_data"><i class="fa fa-refresh"></i></button></li>
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="card-box table-responsive" id="data_detail">
                                    <!-- Import From Form File -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->
        </div>
    </div>

</html>

<!-- Popup Change Password-->
<div id="changepassModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Change Password</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card-box table-responsive" id="form_change">
                    <!-- Import From Form File -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function get_data_detail_edit(arg_action_status) {
        $("#data_detail").html('');
        $.ajax({
            url: "property.php",
            method: "POST",
            data: {
                action_status: arg_action_status
            },
            success: function(data) {
                $("#data_detail").html(data);
            }
        });
    }

    //FormLoad langsung Refresh Table 
    $(document).ready(function() {
        get_data_detail_edit("view_detail");
        $("button#jq_edit_profile").prop("hidden", "");
    })

    $(document).ready(function() {

        //Refresh Table
        $(document).on("click", ".refresh_data", function() {
            get_data_detail_edit("view_detail");
            $("button#jq_edit_profile").prop("hidden", "");
        })
        //Edit Data
        $(document).on("click", ".edit_profile", function() {
            get_data_detail_edit("edit_detail");
            $("button#jq_edit_profile").prop("hidden", "hidden");
        });

        //Refresh Table
        $(document).on("click", ".update_cancel", function() {
            get_data_detail_edit("view_detail");
            $("button#jq_edit_profile").prop("hidden", "");
        })

        //Upload Images
        $(document).on("change", ".upload_profile", function() {
            const file = this.files[0];
            const reader = new FileReader();
            reader.onload = function(event) {
                $("#jq_display_profile").attr("src", event.target.result);
            };
            reader.readAsDataURL(file);
        });

        //Update Detail
        $(document).on("click", ".update_detail", function() {
            if ($("#jq_nik").val() == "") {
                Swal.fire({
                    position: "top",
                    title: "Warning",
                    text: "NIK Must be Filled !",
                    icon: "warning"
                });
            } else if ($("#jq_name").val() == "") {
                Swal.fire({
                    position: "top",
                    title: "Warning",
                    text: "Name Must be Filled !",
                    icon: "warning"
                });
            } else if ($("#jq_tempat_lahir").val() == "") {
                Swal.fire({
                    position: "top",
                    title: "Warning",
                    text: "Place of birth Must be Filled !",
                    icon: "warning"
                });
            } else if ($("#jq_tanggal_lahir").val() == "") {
                Swal.fire({
                    position: "top",
                    title: "Warning",
                    text: "Date of birth Must be Filled !",
                    icon: "warning"
                });
            } else if ($("#jq_address").val() == "") {
                Swal.fire({
                    position: "top",
                    title: "Warning",
                    text: "Address Must be Filled !",
                    icon: "warning"
                });
            } else if ($("#jq_telp").val() == "") {
                Swal.fire({
                    position: "top",
                    title: "Warning",
                    text: "Phone Number Must be Filled !",
                    icon: "warning"
                });
            } else {
                $.ajax({
                    url: "action.php",
                    method: "POST",
                    data: {
                        action_status: "validate_detail",
                        id: $("#jq_id").val(),
                        code: $("#jq_nik").val(),
                        name: $("#jq_name").val()
                    },
                    success: function(data) {
                        var parsedData = $.parseJSON(data);
                        var result = parsedData[0].msg;
                        if (result == "") {
                            var form_data = new FormData($("#update_form")[0]);
                            $.ajax({
                                url: "action.php",
                                method: "POST",
                                data: form_data,
                                dataType: "json",
                                contentType: false,
                                cache: false,
                                processData: false,
                                beforeSend: function() {
                                    $("button#jq_update_detail").text("Updating");
                                    $("button#jq_update_detail").prop("disabled", true);
                                    $("button#update_cancel").prop("disabled", true);
                                },
                                success: function(data) {
                                    $("#update_form")[0].reset();
                                    $("#editModal").modal("hide");
                                    get_data_detail_edit("view_detail");
                                    $("button#jq_edit_profile").prop("hidden", "");
                                }
                            });
                        } else {
                            Swal.fire({
                                position: "top",
                                title: "Warning",
                                text: result,
                                icon: "warning"
                            });
                        }
                    }

                });
            }
        });

        //Change Password Data
        $(document).on("click", ".change_password_user", function() {
            var action_status = "change_password_user";
            $.ajax({
                url: "property.php",
                method: "POST",
                data: {
                    action_status: action_status
                },
                success: function(data) {
                    $("#form_change").html(data);
                    $("#changepassModal").find(".modal-title").text("Change Password");
                    $("#changepassModal").modal("show");
                }
            });
        });

        //Validate dan Change Password Data
        $(document).on("click", ".change_password_data", function() {
            if ($("#jq_new_password").val() == "") {
                Swal.fire({
                    position: "top",
                    title: "Warning",
                    text: "Please fill a new password !",
                    icon: "warning"
                });
            } else if ($("#jq_re_enter_password").val() == "") {
                Swal.fire({
                    position: "top",
                    title: "Warning",
                    text: "Please fill a new password confirmation !",
                    icon: "warning"
                });
            } else if ($("#jq_new_password").val() !== $("#jq_re_enter_password").val()) {
                Swal.fire({
                    position: "top",
                    title: "Warning",
                    text: "The password and confirmation password are not the same, please check again !",
                    icon: "warning"
                });
            } else {
                $.ajax({
                    url: "action.php",
                    method: "POST",
                    data: $("#change_form").serialize(),
                    success: function(data) {
                        $("#change_form")[0].reset();
                        $("#changepassModal").modal("hide");
                        act_refresh_table_register();
                    }
                });
            }
        });
    });
</script>