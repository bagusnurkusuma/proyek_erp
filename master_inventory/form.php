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
?>

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
                <h2>Master Inventory</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                </ul>
                <div align="right">
                  <button type="button" name="show_archive" id="jq_show_archive" class="btn btn-primary show_archive"><i class="fa fa-inbox"></i></button>
                  <button type="button" name="add_data" id="jq_add_data" class="btn btn-warning add_data"><i class="fa fa-plus-circle"></i></button>
                  <button type="button" name="refresh" id="jq_refresh" class="btn btn-success refresh_data"><i class="fa fa-refresh"></i></button>
                </div>
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
        <button type="button" class="close" data-dismiss="modal">&times;</button>
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

<!-- Pop up Change Data Detail -->
<div id="changedatadetailModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Change Data Detail</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="card-box table-responsive" id="form_change_detail">
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
        action_status: "refresh_data_detail"
      },
      success: function(data) {
        $("#data_detail").html(data);
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
        action_status: "show_archive_data"
      },
      success: function(data) {
        $("#form_archive").html(data);
        $("table#archive_table").pretty_format_table();
        $('table#archive_table').DataTable();
      }
    });
  }

  function get_data_detail_edit(arg_data_id, arg_action_status) {
    $.ajax({
      url: "property.php",
      method: "POST",
      data: {
        data_id: arg_data_id,
        action_status: arg_action_status,
      },
      success: function(data) {
        $('#form_edit').html(data);
        $("table#ratio_unit_table").pretty_format_table();
        $('table#ratio_unit_table').DataTable();
        $('#editModal').modal('show');
      }
    });
  }

  function act_refresh_data_unit(arg_action_variant) {
    $.ajax({
      url: "property.php",
      method: "POST",
      data: {
        action_status: 'choose_unit_data',
        action_variant: arg_action_variant
      },
      success: function(data) {
        $('#form_select').html(data);
        $('#select_table').DataTable();
      }
    });
  }

  function act_refresh_data_inventory_category() {
    $.ajax({
      url: "property.php",
      method: "POST",
      data: {
        action_status: 'choose_inventory_category_data'
      },
      success: function(data) {
        $('#form_select').html(data);
        $("table#select_table").pretty_format_table();
        $('table#select_table').DataTable();
      }
    });
  }

  function get_data_ratio_detail_edit(arg_data_id) {
    $.ajax({
      url: "property.php",
      method: "POST",
      data: {
        data_id: arg_data_id,
        action_status: 'select_unit_ratio_add',
        inventory_id: $("#jq_id").val()
      },
      success: function(data) {
        $('#form_change_detail').html(data);
        pretty_format_input();
        $('#selectModal').modal('hide');
        $('#changedatadetailModal').modal('show');
      }
    });

  }

  function act_refresh_data_ratio() {
    var data_id = $("#jq_id").val();
    $.ajax({
      url: "property.php",
      method: "POST",
      data: {
        data_id: data_id,
        action_status: "refresh_data_ratio"
      },
      success: function(data) {
        $('#jq_get_detail_ratio_tabel').html(data);
        $("table#ratio_unit_table").pretty_format_table();
        $('table#ratio_unit_table').DataTable();
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
      $.ajax({
        url: "property.php",
        method: "POST",
        data: {
          data_id: data_id,
          action_status: action_status
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
        alert("Archive Reason Must be Filled");
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
      $.ajax({
        url: "action.php",
        method: "POST",
        data: {
          data_id: data_id,
          action_status: action_status
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

    //Choose Unit Data
    $(document).on('click', '.choose_unit_data', function() {
      act_refresh_data_unit('select_unit_data');
      $('#selectModal').modal('show');
    });

    //Add Unit Ratio
    $(document).on('click', '.add_data_ratio', function() {
      act_refresh_data_unit('select_unit_ratio_add');
      $('#selectModal').modal('show');
    });

    //Choose Inventory Category Data
    $(document).on('click', '.choose_inventory_category_data', function() {
      act_refresh_data_inventory_category();
      $('#selectModal').modal('show');
    });

    //Select Unit Data
    $(document).on('click', '.select_unit_data', function() {
      var data_id = $(this).attr("id");
      var action_status = 'select_unit_data';
      $.ajax({
        url: "action.php",
        method: "POST",
        data: {
          data_id: data_id,
          action_status: action_status
        },
        success: function(data) {
          var parsedData = $.parseJSON(data);
          $("#jq_unit_id").val(parsedData[0].id);
          $("#jq_unit_name").val(parsedData[0].unit_name);
          $('#selectModal').modal('hide');
        }
      });
    });

    //Select Unit Rasio
    $(document).on('click', '.select_unit_ratio_add', function() {
      var data_id = $(this).attr("id");
      get_data_ratio_detail_edit(data_id, "select_unit_ratio_add");
    });

    //Select Inventory Category Data
    $(document).on('click', '.select_inventory_category_data', function() {
      var data_id = $(this).attr("id");
      var action_status = 'select_inventory_category_data';
      $.ajax({
        url: "action.php",
        method: "POST",
        data: {
          data_id: data_id,
          action_status: action_status
        },
        success: function(data) {
          var parsedData = $.parseJSON(data);
          $("#jq_inventory_category_id").val(parsedData[0].id);
          $("#jq_inventory_category_name").val(parsedData[0].inventory_category_name);
          $('#selectModal').modal('hide');
        }
      });
    });

    //Update Detail
    $(document).on('click', '.update_detail', function() {
      if ($('#jq_inventory_name').val() == "") {
        alert("Mohon Isi Inventory Name");
      } else if ($('#jq_inventory_code').val() == '') {
        alert("Mohon Isi Inventory Code");
      } else if ($('#jq_inventory_category_id').val() == '') {
        alert("Mohon Inventory Category dipilih");
      } else if ($('#jq_unit_id').val() == '') {
        alert("Mohon Unit dipilih");
      } else {
        $.ajax({
          url: "action.php",
          method: "POST",
          data: {
            action_status: "validate_detail",
            id: $('#jq_id').val(),
            code: $('#jq_inventory_code').val(),
            name: $('#jq_inventory_name').val()
          },
          success: function(data) {
            if (data == "") {
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
              alert(data);
            }
          }
        });
      }
    });

    //Update Detail Unit Rasio
    $(document).on('click', '.update_detail_unit_ratio', function() {
      if ($('#jq_unit_name').val() == "") {
        alert("Mohon Isi Unit");
      } else if ($('#jq_ratio').val() <= 0) {
        alert("Mohon isi Ratio harus lebih dari 0.00");
      } else {
        $.ajax({
          url: "action.php",
          method: "POST",
          data: $('#form_update_detail_unit_ratio').serialize(),
          beforeSend: function() {
            $('#update').val("Updating");
          },
          success: function(data) {
            $('#form_update_detail_unit_ratio')[0].reset();
            $('#changedatadetailModal').modal('hide');
            act_refresh_data_ratio();
          }
        });

      }
    });

    $(document).on('click', '.refresh_data_ratio', function() {
      act_refresh_data_ratio();
    });

    //Remove Data RAtio
    $(document).on('click', '.delete_data_ratio', function() {
      $.ajax({
        url: "action.php",
        method: "POST",
        data: {
          data_id: $(this).attr("id"),
          action_status: "delete_data_ratio",
        },
        success: function(data) {
          act_refresh_data_ratio();
        }
      });
    });

  });
</script>