<?php
require_once "../asset_default/global_function.php";
check_user_menu_acces("1aaae136-1a61-4d9f-a900-90dcda9e5781");
?>
<div class="container body">
  <!-- page content -->
  <div class="right_col" role="main">
    <div class="content">
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
              <h2 id="jq_process_name"><?php echo $_SESSION["jq_process_name"] ?></h2>
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
        $("table#master_table").data_table_with_export({
          title_name: $("#jq_process_name").text()
        });
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
        $("table#archive_table").data_table();
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
        $("#form_edit").html(data);
        $("table#ratio_unit_table").data_table();
        $("#editModal").modal("show");
      }
    });
  }

  function act_refresh_data_unit(arg_action_variant) {
    $.ajax({
      url: "property.php",
      method: "POST",
      data: {
        action_status: "choose_unit_data",
        action_variant: arg_action_variant
      },
      success: function(data) {
        $("#form_select").html(data);
        $("#select_table").data_table();
      }
    });
  }

  function act_refresh_data_inventory_category() {
    $.ajax({
      url: "property.php",
      method: "POST",
      data: {
        action_status: "choose_inventory_category_data"
      },
      success: function(data) {
        $("#form_select").html(data);
        $("table#select_table").data_table();
      }
    });
  }

  function get_data_ratio_detail_edit(arg_data_id) {
    $.ajax({
      url: "property.php",
      method: "POST",
      data: {
        data_id: arg_data_id,
        action_status: "select_unit_ratio_add",
        inventory_id: $("#jq_id").val()
      },
      success: function(data) {
        $("#form_change_detail").html(data);
        pretty_format_input();
        $("#selectModal").modal("hide");
        $("#changedatadetailModal").modal("show");
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
        $("#jq_get_detail_ratio_tabel").html(data);
        $("table#ratio_unit_table").data_table();
      }
    });

  }

  //FormLoad langsung Refresh Table 
  $(document).ready(function() {
    act_refresh_data_detail();
  })

  $(document).ready(function() {

    //Refresh Table
    $(document).on("click", ".refresh_data", function() {
      act_refresh_data_detail();
    })

    //Add Data
    $(document).on("click", ".add_data", function() {
      get_data_detail_edit(null, "insert_detail");
    });

    //Detail Data
    $(document).on("click", ".view_data", function() {
      var data_id = $(this).attr("id");
      get_data_detail_edit(data_id, "view_detail");
    });

    //Edit Data
    $(document).on("click", ".edit_data", function() {
      var data_id = $(this).attr("id");
      get_data_detail_edit(data_id, "edit_detail");
    });

    //Show Popup Archive Data
    $(document).on("click", ".archive_data", function() {
      var data_id = $(this).attr("id");
      var action_status = "archive_detail";
      $.ajax({
        url: "property.php",
        method: "POST",
        data: {
          data_id: data_id,
          action_status: action_status
        },
        success: function(data) {
          $("#form_archive").html(data);
          $("#archiveModal").modal("show");
        }
      });
    });

    //Archive Detail
    $(document).on("click", ".archive_detail", function() {
      if ($("#jq_archive_reason").val() == "") {
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
          data: $("#archive_form").serialize(),
          beforeSend: function() {
            $("#archive").val("Archiving");
          },
          success: function(data) {
            $("#archive_form")[0].reset();
            $("#archiveModal").modal("hide");
            act_refresh_data_detail();
          }
        });
      }
    });

    //Show Archive Data
    $(document).on("click", ".show_archive", function() {
      act_refresh_data_archive();
      $("#archiveModal").modal("show");
    });

    //Unarchive Data
    $(document).on("click", ".unarchive_data", function() {
      var data_id = $(this).attr("id");
      var action_status = "unarchive_detail";
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
    $(document).on("click", ".refresh_unarchive_data", function() {
      act_refresh_data_archive();
      act_refresh_data_detail();
    });

    //Choose Unit Data
    $(document).on("click", ".choose_unit_data", function() {
      act_refresh_data_unit("select_unit_data");
      $("#selectModal").modal("show");
    });

    //Add Unit Ratio
    $(document).on("click", ".add_data_ratio", function() {
      act_refresh_data_unit("select_unit_ratio_add");
      $("#selectModal").modal("show");
    });

    //Choose Inventory Category Data
    $(document).on("click", ".choose_inventory_category_data", function() {
      act_refresh_data_inventory_category();
      $("#selectModal").modal("show");
    });

    //Select Unit Data
    $(document).on("click", ".select_unit_data", function() {
      var data_id = $(this).attr("id");
      var action_status = "select_unit_data";
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
          $("#selectModal").modal("hide");
        }
      });
    });

    //Select Unit Rasio
    $(document).on("click", ".select_unit_ratio_add", function() {
      var data_id = $(this).attr("id");
      get_data_ratio_detail_edit(data_id, "select_unit_ratio_add");
    });

    //Select Inventory Category Data
    $(document).on("click", ".select_inventory_category_data", function() {
      var data_id = $(this).attr("id");
      var action_status = "select_inventory_category_data";
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
          $("#selectModal").modal("hide");
        }
      });
    });

    //Update Detail
    $(document).on("click", ".update_detail", function() {
      if ($("#jq_inventory_name").val() == "") {
        Swal.fire({
          position: "top",
          title: "Warning",
          text: "Inventory Name Must be Filled !",
          icon: "warning"
        });
      } else if ($("#jq_inventory_code").val() == "") {
        Swal.fire({
          position: "top",
          title: "Warning",
          text: "Inventory Code Must be Filled !",
          icon: "warning"
        });
      } else if ($("#jq_inventory_category_id").val() == "") {
        Swal.fire({
          position: "top",
          title: "Warning",
          text: "Inventory Category Must be Selected !",
          icon: "warning"
        });
      } else if ($("#jq_unit_id").val() == "") {
        Swal.fire({
          position: "top",
          title: "Warning",
          text: "Unit Must be Selected !",
          icon: "warning"
        });
      } else {
        $.ajax({
          url: "action.php",
          method: "POST",
          data: {
            action_status: "validate_detail",
            id: $("#jq_id").val(),
            code: $("#jq_inventory_code").val(),
            name: $("#jq_inventory_name").val()
          },
          success: function(data) {
            var parsedData = $.parseJSON(data);
            var result = parsedData[0].msg;
            if (data == "") {
              $.ajax({
                url: "action.php",
                method: "POST",
                data: $("#update_form").serialize(),
                beforeSend: function() {
                  $("#update").val("Updating");
                },
                success: function(data) {
                  $("#update_form")[0].reset();
                  $("#editModal").modal("hide");
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
    });

    //Update Detail Unit Rasio
    $(document).on("click", ".update_detail_unit_ratio", function() {
      if ($("#jq_unit_name").val() == "") {
        Swal.fire({
          position: "top",
          title: "Warning",
          text: "Unit Must be Selected !",
          icon: "warning"
        });
      } else if ($("#jq_ratio").val() <= 0) {
        Swal.fire({
          position: "top",
          title: "Warning",
          text: "Please fill in the Ratio must be more than 0.00",
          icon: "warning"
        });
      } else {
        $.ajax({
          url: "action.php",
          method: "POST",
          data: $("#form_update_detail_unit_ratio").serialize(),
          beforeSend: function() {
            $("#update").val("Updating");
          },
          success: function(data) {
            $("#form_update_detail_unit_ratio")[0].reset();
            $("#changedatadetailModal").modal("hide");
            act_refresh_data_ratio();
          }
        });

      }
    });

    $(document).on("click", ".refresh_data_ratio", function() {
      act_refresh_data_ratio();
    });

    //Remove Data RAtio
    $(document).on("click", ".delete_data_ratio", function() {
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