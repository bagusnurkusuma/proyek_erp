<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.ico" type="image/ico" />
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
                <h2>Stock Ending</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up justify-content-end"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <br />
                <div class="row">
                  <div class="col-md-6 col-sm-12  form-group">
                    <label class="control-label col-md-3"> Filter Inventory </label>
                    <div class="col-md-9 input-group">
                      <input type="hidden" name="inventory_id" id="jq_inventory_id" value="" class="form-control" style="margin-bottom: 10px;" readonly="true">
                      <input type="text" name="inventory_name" id="jq_inventory_name" value="" class="form-control" style="margin-bottom: 10px;" readonly="true">
                      <span class="input-group-btn">
                        <button type="button" name="choose_inventory_data" id="" class="btn btn-warning btn-xs choose_inventory_data"><i class="fa fa-pencil-square"></i></button>
                      </span>
                      <span class="input-group-btn">
                        <button type="button" name="clear_inventory_data" id="" class="btn btn-danger btn-xs clear_inventory_data"><i class="fa fa-close"></i></button>
                      </span>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12 form-group">
                    <label class="control-label col-md-3">Filter Warehouse</label>
                    <div class="col-md-9 input-group">
                      <input type="hidden" name="warehouse_id" id="jq_warehouse_id" value="" class="form-control" style="margin-bottom: 10px;" readonly="true">
                      <input type="text" name="warehouse_name" id="jq_warehouse_name" value="" class="form-control" style="margin-bottom: 10px;" readonly="true">
                      <span class="input-group-btn">
                        <button type="button" name="choose_warehouse_data" id="" class="btn btn-warning btn-xs choose_warehouse_data"><i class="fa fa-hand-o-up"></i></button>
                      </span>
                      <span class="input-group-btn">
                        <button type="button" name="clear_warehouse_data" id="" class="btn btn-danger btn-xs clear_warehouse_data"><i class="fa fa-close"></i></button>
                      </span>
                    </div>
                  </div>

                  <div class=" x_panel">
                    <div class="x_title">
                      <h2>Inventory Detail </h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      </ul>
                      <div align="right">
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
          </div>
        </div>
      </div>
      <!--page content -->
    </div>
  </div>
</body>

</html>

<!-- Pop up Selected -->
<div id="selectModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Select Data</h4>
        <div align="right">
          <button type="button" name="refresh_supplier_data" id="jq_refresh_supplier_data" class="btn btn-success refresh_supplier_data"><i class="fa fa-refresh"></i></button>
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
  function act_refresh_table() {
    $.ajax({
      url: "property.php",
      method: "POST",
      data: {
        action_status: "refresh_data_detail",
        inventory_id: $("#jq_inventory_id").val(),
        warehouse_id: $("#jq_warehouse_id").val()
      },
      success: function(data) {
        $("#data_detail").html(data);
        $("table#datatable").pretty_format_table();
        $("table#datatable").DataTable({
          pageLength: "100"
        });
      }
    });
  }

  function act_refresh_table_ending_detail(arg_input) {
    var component = arg_input;
    var icon = component.find("i");
    var concat_id = $(component).attr("id");
    if (icon.hasClass("fa-chevron-down")) {
      icon.removeClass("fa-chevron-down").addClass("fa-chevron-up");
      $.ajax({
        url: "property.php",
        method: "POST",
        data: {
          action_status: "show_ending_detail",
          concat_id: concat_id
        },
        success: function(data) {
          $("tr#" + concat_id).after(data);
          $("table#detail_ending_table" + concat_id).pretty_format_table();
          $("table#detail_ending_table" + concat_id).DataTable({
            pageLength: "100"
          });
        }
      });
    } else {
      icon.removeClass("fa-chevron-up").addClass("fa-chevron-down");
      $("tr#" + concat_id).next("td").remove();
    }
  }

  //FormLoad langsung Refresh Table
  $(document).ready(function() {
    act_refresh_table();
  });

  $(document).ready(function() {

    //Refresh Table
    $(document).on("click", ".refresh_data", function() {
      act_refresh_table();
    })

    //Refresh Detail Ledger Table
    $(document).on("click", ".show_ending_detail", function() {
      act_refresh_table_ending_detail($(this));
    })

    $(document).on("click", ".choose_warehouse_data", function() {
      var action_status = "choose_warehouse_data";
      $.ajax({
        url: "property.php",
        method: "POST",
        data: {
          action_status: action_status
        },
        success: function(data) {
          $("#form_select").html(data);
          $("table#select_table").pretty_format_table();
          $("table#select_table").DataTable();
          $("#selectModal").modal("show");
        }
      });
    });

    //Select Warehouse Data
    $(document).on("click", ".select_warehouse_data", function() {
      var data_id = $(this).attr("id");
      var action_status = "select_warehouse_data";
      $.ajax({
        url: "action.php",
        method: "POST",
        data: {
          data_id: data_id,
          action_status: action_status
        },
        success: function(data) {
          var parsedData = $.parseJSON(data);
          $("#jq_warehouse_id").val(parsedData[0].id);
          $("#jq_warehouse_name").val(parsedData[0].warehouse_name);
          $("#selectModal").modal("hide");
          act_refresh_table();
        }
      });
    });

    //Clear Warehouse Data
    $(document).on("click", ".clear_warehouse_data", function() {
      $("#jq_warehouse_id").val("");
      $("#jq_warehouse_name").val("");
      act_refresh_table();
    });

    //Choose Inventory Data
    $(document).on("click", ".choose_inventory_data", function() {
      var action_status = "choose_inventory_data";
      $.ajax({
        url: "property.php",
        method: "POST",
        data: {
          action_status: action_status
        },
        success: function(data) {
          $("#form_select").html(data);
          $("table#select_table").pretty_format_table();
          $("table#select_table").DataTable();
          $("#selectModal").modal("show");
        }
      });
    });

    //Select Inventory Data
    $(document).on("click", ".select_inventory_data", function() {
      var data_id = $(this).attr("id");
      var action_status = "select_inventory_data";
      $.ajax({
        url: "action.php",
        method: "POST",
        data: {
          data_id: data_id,
          action_status: action_status
        },
        success: function(data) {
          var parsedData = $.parseJSON(data);
          $("#jq_inventory_id").val(parsedData[0].id);
          $("#jq_inventory_name").val(parsedData[0].inventory_name);
          $("#selectModal").modal("hide");
          act_refresh_table();
        }
      });
    });

    //Clear Inventory Data
    $(document).on("click", ".clear_inventory_data", function() {
      $("#jq_inventory_id").val("");
      $("#jq_inventory_name").val("");
      act_refresh_table();
    });
  });
</script>