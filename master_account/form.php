<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<?php
include "../asset_default/side_bar.php";
include "api.php";
?>

<body class="nav-md">
  <input type="hidden" name="penguna" id="jq_pengguna" value=<?php echo $pengguna; ?> readonly="true">
  <div class="container body">
    <!-- page content -->
    <div class="right_col" role="main">
      <div class="content">
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
              <div class="x_title">
                <h2>Master Account</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><button type="button" name="show_archive" id="jq_show_archive" class="btn btn-primary show_archive"><i class="fa fa-inbox"></i></button></li>
                  <li><button type="button" name="add_data" id="jq_add_data" class="btn btn-warning add_data"><i class="fa fa-plus-circle"></i></button></li>
                  <li><button type="button" name="refresh" id="jq_refresh" class="btn btn-success refresh_data"><i class="fa fa-refresh"></i></button></li>
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
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
</body>

</html>

<!-- Popup Archive-->
<div id="archiveModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Archive Data</h4>
        <div>
          <button type="button" name="refresh_unarchive" id="jq_refresh_unarchive" class="btn btn-success refresh_unarchive_data"><i class="fa fa-refresh"></i></button>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
      </div>
      <div class="modal-body">
        <div class="card-box table-responsive" id="form_archive">
          <!-- Import From Form File -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Pop up Data Detail -->
<div id="editModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Data Detail</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="card-box table-responsive" id="form_edit">
          <!-- Import From Form File -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<!-- Pop up Selected -->
<div id="selectModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Select Data</h4>
        <div align="right">
          <!-- <button type="button" name="refresh_supplier_data" id="jq_refresh_supplier_data" class="btn btn-success refresh_supplier_data"><i class="fa fa-refresh"></i></button> -->
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
      </div>
      <div class="modal-body">
        <div class="card-box table-responsive" id="form_select">
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
  function act_refresh_data_detail() {
    $.ajax({
      url: "property.php",
      method: "POST",
      data: {
        action_status: 'refresh_data_detail'
      },
      success: function(data) {
        $('#data_detail').html(data);
        $("table#master_table").pretty_format_table();
        $('table#master_table').DataTable();
      }
    });
  }

  function act_refresh_data_archive() {
    $.ajax({
      url: "property.php",
      method: "POST",
      data: {
        action_status: 'show_archive_data'
      },
      success: function(data) {
        $('#form_archive').html(data);
        $("table#archive_table").pretty_format_table();
        $('table#archive_table').DataTable();
      }
    });
  }

  function get_data_detail_edit(arg_data_id, arg_action_status) {
    var created_by = $("#jq_pengguna").val();
    $.ajax({
      url: "property.php",
      method: "POST",
      data: {
        data_id: arg_data_id,
        action_status: arg_action_status,
        created_by: created_by
      },
      success: function(data) {
        $('#form_edit').html(data);
        $('#editModal').modal('show');
      }
    });
  }

  function act_update_data() {

    $.ajax({
      url: "action.php",
      method: "POST",
      data: {
        action_status: "validate_data",
        id: $('#jq_id').val(),
        code: $('#jq_account_code').val(),
        name: $('#jq_account_name').val()
      },
      success: function(data) {
        var parsedData = $.parseJSON(data);
        var result = parsedData[0].msg;
        if (result == "") {
          $.ajax({
            url: "action.php",
            method: "POST",
            data: $('#update_form').serialize(),
            beforeSend: function() {
              $('#update').val("Updating");
            },
            success: function(data) {
              $('#update_form')[0].reset();
              $('#editModal').modal('hide');
              act_refresh_data_detail();
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

  //FormLoad langsung Refresh Table 
  $(document).ready(function() {
    act_refresh_data_detail();
  })

  $(document).ready(function() {

    //Refresh Table
    $(document).on('click', '.refresh', function() {
      act_refresh_data_detail();
    })

    //Add Data
    $(document).on('click', '.add_data', function() {
      get_data_detail_edit(null, "insert_detail");
    });

    //Detail Data
    $(document).on('click', '.view_data', function() {
      var data_id = $(this).attr("id");
      get_data_detail_edit(data_id, "view_detail");
    });

    //Edit Data
    $(document).on('click', '.edit_data', function() {
      var data_id = $(this).attr("id");
      get_data_detail_edit(data_id, "edit_detail");
    });

    //Show Popup Archive Data
    $(document).on('click', '.archive_data', function() {
      var data_id = $(this).attr("id");
      var action_status = 'archive_detail';
      var created_by = $("#jq_pengguna").val();
      $.ajax({
        url: "property.php",
        method: "POST",
        data: {
          data_id: data_id,
          action_status: action_status,
          created_by: created_by
        },
        success: function(data) {
          $('#form_archive').html(data);
          $('#archiveModal').modal('show');
        }
      });
    });


    //Archive Detail
    $(document).on('click', '.archive_detail', function() {
      if ($('#jq_archive_reason').val() == '') {
        Swal.fire({
          position: "top",
          title: "Warning",
          text: "Archive Reason Must be Filled !",
          icon: "warning"
        });
      } else {
        $.ajax({
          url: "action.php",
          method: "POST",
          data: $('#archive_form').serialize(),
          beforeSend: function() {
            $('#archive').val("Archiving");
          },
          success: function(data) {
            $('#archive_form')[0].reset();
            $('#archiveModal').modal('hide');
            act_refresh_data_detail();
          }
        });
      }
    });

    //Show Archive Data
    $(document).on('click', '.show_archive', function() {
      act_refresh_data_archive();
      $('#archiveModal').modal('show');
    });

    //Unarchive Data
    $(document).on('click', '.unarchive_data', function() {
      var data_id = $(this).attr("id");
      var action_status = 'unarchive_detail';
      var created_by = $("#jq_pengguna").val();
      $.ajax({
        url: "action.php",
        method: "POST",
        data: {
          data_id: data_id,
          action_status: action_status,
          created_by: created_by
        },
        success: function(data) {
          act_refresh_data_archive();
          act_refresh_data_detail();
        }
      });
    });

    //Refresh Unarchive
    $(document).on('click', '.refresh_unarchive_data', function() {
      act_refresh_data_archive();
      act_refresh_data_detail();
    });


    //Update Detail
    $(document).on('click', '.update_detail', function() {
      if ($('#jq_account_code').val() == "") {
        Swal.fire({
          position: "top",
          title: "Warning",
          text: "Account Code Must be Filled !",
          icon: "warning"
        });
      } else if ($('#jq_account_name').val() == "") {
        Swal.fire({
          position: "top",
          title: "Warning",
          text: "Account Name be Filled !",
          icon: "warning"
        });
      } else if ($('#jq_sub_account_id').val() == "") {
        Swal.fire({
          position: "top",
          title: "Confirmation",
          text: "Are you sure update this ACCOUNT without SUB ACCOUNT ?",
          icon: "question",
          showCancelButton: true,
          confirmButtonText: "Yes",
          cancelButtonText: "No",
          reverseButtons: false
        }).then((result) => {
          if (result.isConfirmed) {
            act_update_data();
          }
        });
      } else {
        act_update_data();
      }
    });

    $(document).on("click", ".choose_sub_account_data", function() {
      var action_status = "choose_sub_account_data";
      $.ajax({
        url: "property.php",
        method: "POST",
        data: {
          action_status: action_status,
          data_id: $(this).attr("id")
        },
        success: function(data) {
          $("#form_select").html(data);
          $("table#select_table").pretty_format_table();
          $("table#select_table").DataTable({
            pageLength: 100,
          });
          $("#selectModal").modal("show");
        }
      });
    });

    //Select Sub Data
    $(document).on("click", ".select_sub_account_data", function() {
      var data_id = $(this).attr("id");
      var action_status = "select_sub_account_data";
      $.ajax({
        url: "action.php",
        method: "POST",
        data: {
          data_id: data_id,
          action_status: action_status
        },
        success: function(data) {
          var parsedData = $.parseJSON(data);
          $("input#jq_sub_account_id").val(parsedData[0].id);
          $("input#jq_sub_account_name").val(parsedData[0].account_name);
          $("#selectModal").modal("hide");
          act_refresh_table();
        }
      });
    });

    //Clear Sub Account Data
    $(document).on("click", ".clear_sub_account_data", function() {
      $("input#jq_sub_account_id").val("");
      $("input#jq_sub_account_name").val("");
      act_refresh_table();
    });
  });

  // $('#datatable').DataTable({
  //   processing: true,
  //   pageLength: 10,
  //   lengthMenu: [
  //     [5, 10, 20, -1],
  //     [5, 10, 20, 'All']
  //   ],
  //   pagingType: "full_numbers"
  // })
</script>