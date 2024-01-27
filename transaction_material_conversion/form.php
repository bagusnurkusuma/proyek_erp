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
include "api.php";
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
                <h2>Material Conversion</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><button type="button" name="pay" id="jq_pay" class="btn btn-success save_transaction">Save</button></li>
                  <li><button type="button" name="cancel" id="jq_cancel" class="btn btn-primary cancel_transaction" onclick="act_cancel()">Cancel</button></li>
                  <li><a class="collapse-link"><i class="fa fa-chevron-up justify-content-end"></i></a></li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <br />
                <?php foreach (get_transaction_number($_SESSION['user_role_id']) as $parent) : ?>
                  <div class="row">
                    <div class="col-md-6 col-sm-12 form-group">
                      <label class="control-label col-md-3">Trx Number</label>
                      <div class="col-md-9 input-group">
                        <input type="hidden" name="transaction_id" id="jq_transaction_id" value=<?php echo $parent["transaction_id"]; ?> class="form-control" readonly="true">
                        <input type="text" name="transaction_number" id="jq_transaction_number" value=<?php echo $parent["transaction_number"]; ?> class="form-control" readonly="true" style="margin-bottom: 10px;">
                      </div>
                    <?php endforeach; ?>
                    <label class="control-label col-md-3">Trx Date</label>
                    <div class="col-md-9 input-group">
                      <input type="date" name="transaction_date" id="jq_transaction_date" value="" class="form-control" style="margin-bottom: 10px;">
                    </div>
                    <label class="control-label col-md-3">Warehouse </label>
                    <div class="col-md-9 input-group">
                      <div class="input-group">
                        <input type="hidden" name="warehouse_result_id" id="jq_warehouse_result_id" value="" class="form-control" style="margin-bottom: 10px;" readonly="true">
                        <input type="text" name="warehouse_result_name" id="jq_warehouse_result_name" value="" class="form-control" style="margin-bottom: 10px;" readonly="true">
                        <span class="input-group-btn">
                          <button type="button" name="choose_warehouse_data" id="" class="btn btn-warning btn-xs choose_warehouse_result_data"><i class="fa fa-hand-o-up"></i></button>
                        </span>
                      </div>
                    </div>
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                      <label class="control-label col-md-3">Inventory </label>
                      <div class="col-md-9 input-group">
                        <input type="hidden" name="inventory_result_id" id="jq_inventory_result_id" value="" readonly="true">
                        <input type="text" name="inventory_result_name" id="jq_inventory_result_name" value="" class="form-control" readonly="true">
                        <span class="input-group-btn">
                          <button type="button" name="choose_supplier_data" id="" class="btn btn-warning btn-xs choose_inventory_data"><i class="fa fa-hand-o-up"></i></button>
                        </span>
                      </div>
                      <label class="control-label col-md-3">Qty / Unit : </label>
                      <div class="col-md-9 input-group">
                        <input type="number" name="qty_result" id="jq_qty_result" value="0.00" class="form-control" style="margin-bottom: 10px;">
                        <input type="hidden" name="unit_result_id" id="jq_unit_result_id" value="" class="form-control" style="margin-bottom: 10px;" readonly="true">
                        <input type="text" name="unit_result_name" id="jq_unit_result_name" value="" class="form-control" style="margin-bottom: 10px;" readonly="true">
                        <span class="input-group-btn">
                          <button type="button" name="choose_supplier_data" id="" class="btn btn-warning btn-xs choose_unit_result_data"><i class="fa fa-hand-o-up"></i></button>
                        </span>
                      </div>
                      <label class="control-label col-md-3">Batch Number / Expired Date : </label>
                      <div class="col-md-9 input-group">
                        <input type="text" name="batch_number_result" id="jq_batch_number_result" value="" class="form-control" style="margin-bottom: 10px;">
                        <input type="date" name="expired_date_result" id="jq_expired_date_result" value="" class="form-control" style="margin-bottom: 10px;">
                        <span class="input-group-btn">
                          <button type="button" name="clear_exp_data" id="" class="btn btn-danger btn-xs clear_exp_data"><i class="fa fa-close"></i></button>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class=" x_panel">
                    <div class="x_title">
                      <h2>Inventory Detail </h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><button type="button" name="add_product" id="jq_add_product" class="btn btn-warning add_product"><i class="fa fa-plus-circle"></i></button></li>
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
        </div>
        <!--page content -->
      </div>
    </div>
  </div>
</body>

</html>

<!-- Popup List Product-->
<div id="add_product" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Select Product</h4>
        <div align="right">
          <button type="button" name="refresh_inventory_data" id="jq_refresh_inventory_data" class="btn btn-success refresh_inventory_data"><i class="fa fa-refresh"></i></button>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
      </div>
      <div class="modal-body">
        <div class="card-box table-responsive" id="form_list_product">
          <!-- Import From Form File -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Popup Edit Item  -->
<div id="edit_product" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Inventory</h4>
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
          <!-- <button type="button" name="refresh_supplier_data" id="jq_refresh_select_data" class="btn btn-success"><i class="fa fa-refresh"></i></button> -->
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
      </div>
      <div class=" modal-body">
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
  function act_refresh_table_material_conversion() {
    var transaction_id = $("#jq_transaction_id").val();
    $.ajax({
      url: "property.php",
      method: "POST",
      data: {
        action_status: "refresh_list_material_conversion_detail",
        transaction_id: transaction_id
      },
      success: function(data) {
        $("#data_detail").html(data);
        $("table#data_material_conversion_table").pretty_format_table();
        $("table#data_material_conversion_table").DataTable({
          pageLength: 100
        })
      }
    });
  }

  function act_refresh_table_list_product() {
    var transaction_id = $("#jq_transaction_id").val();
    $.ajax({
      url: "property.php",
      method: "POST",
      data: {
        action_status: "refresh_list_product",
        transaction_id: transaction_id
      },
      success: function(data) {
        $("#form_list_product").html(data);
        $("table#data_product_table").pretty_format_table();
        $("table#data_product_table").DataTable();
      }
    });
  }

  function act_refresh_table_list_warehouse(arg_add_class) {
    var action_status = "choose_warehouse_data";
    $.ajax({
      url: "property.php",
      method: "POST",
      data: {
        action_status: action_status,
        add_class: arg_add_class
      },
      success: function(data) {
        $("#form_select").html(data);
        $("table#data_material_conversion_table").pretty_format_table();
        $("table#select_table").DataTable();
      }
    });
  }

  function act_refresh_table_list_inventory() {
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
      }
    });
  }

  function act_refresh_table_list_unit(arg_inventory_id, arg_add_class) {
    var action_status = "choose_unit_data";
    $.ajax({
      url: "property.php",
      method: "POST",
      data: {
        data_id: arg_inventory_id,
        action_status: action_status,
        add_class: arg_add_class
      },
      success: function(data) {
        $("#form_select").html(data);
        $("table#data_material_conversion_table").pretty_format_table();
        $("table#select_table").DataTable();
      }
    });
  }

  function act_cancel() {
    Swal.fire({
      position: "top",
      title: "Confirmation",
      text: "Are you sure Cancel this Transaction ?",
      icon: "question",
      showCancelButton: true,
      confirmButtonText: "Yes",
      cancelButtonText: "No",
      reverseButtons: false
    }).then((result) => {
      if (result.isConfirmed) {
        var transaction_id = $("#jq_transaction_id").val();

        $.ajax({
          url: "action.php",
          method: "POST",
          data: {
            action_status: "cancel_transaction",
            transaction_id: transaction_id
          },
          success: function(data) {
            go_to_home_pages();
          }
        });
      }
    });
  }

  function get_data_detail_edit(arg_data_id, arg_action_status) {
    var transaction_id = $("input#jq_transaction_id").val();
    $.ajax({
      url: "property.php",
      method: "POST",
      data: {
        data_id: arg_data_id,
        action_status: arg_action_status,
        transaction_id: transaction_id
      },
      success: function(data) {
        $("#form_edit").html(data);
        $("#edit_product").modal("show");
        $("input#jq_qty").focus();
      }
    });
  }

  //FormLoad langsung Refresh Table
  $(document).ready(function() {
    $("input#jq_transaction_date").val(get_current_date());
    act_refresh_table_material_conversion();
  });

  $(document).ready(function() {
    //Refresh Table
    $(document).on("click", ".refresh_data", function() {
      act_refresh_table_material_conversion();
    });

    //Add Product
    $(document).on("click", ".add_product", function() {
      act_refresh_table_list_product();
      $("#add_product").modal("show");
    });

    //Edit Detail
    $(document).on("click", ".edit_data", function() {
      var data_id = $(this).attr("id");
      get_data_detail_edit(data_id, "edit_product");
    });

    //Show Transaction Detail
    $(document).on("click", ".view_data", function() {
      var data_id = $(this).attr("id");
      get_data_detail_edit(data_id, "detail_product");
    });

    //Select Product
    $(document).on("click", ".select_data", function() {
      var data_id = $(this).attr("id");
      get_data_detail_edit(data_id, "select_product");
    });

    // Remove Transaction Detail
    $(document).on("click", ".delete_data", function() {
      var data_id = $(this).attr("id");
      var transaction_id = $("#jq_transaction_id").val();
      $.ajax({
        url: "action.php",
        method: "POST",
        data: {
          data_id: data_id,
          action_status: "remove_product",
          transaction_id: transaction_id
        },
        success: function(data) {
          act_refresh_table_material_conversion();
        }
      });
    });

    //Save Transaction
    $(document).on("click", ".save_transaction", function() {
      if ($("#jq_inventory_result_id").val() == "") {
        Swal.fire({
          position: "top",
          title: "Warning",
          text: "Inventory Must be Selected !",
          icon: "warning"
        });
      } else if ($("#jq_warehouse_result_id").val() == "") {
        Swal.fire({
          position: "top",
          title: "Warning",
          text: "Warehouse Must be Selected !",
          icon: "warning"
        });
      } else if ($("#jq_unit_result_id").val() == "") {
        Swal.fire({
          position: "top",
          title: "Warning",
          text: "Unit Must be Selected !",
          icon: "warning"
        });
      } else if ($("#jq_qty_result").val() <= 0) {
        Swal.fire({
          position: "top",
          title: "Warning",
          text: "Qty must be filled more than 0.00 !",
          icon: "warning"
        });
      } else {
        var transaction_id = $("#jq_transaction_id").val();
        var transaction_date = $("#jq_transaction_date").val();
        var warehouse_id = $("#jq_warehouse_result_id").val();
        var inventory_id = $("#jq_inventory_result_id").val();
        var qty = $("#jq_qty_result").val();
        var unit_id = $("#jq_unit_result_id").val();
        var batch_number = $("#jq_batch_number_result").val();
        var expired_date = $("#jq_expired_date_result").val();
        Swal.fire({
          position: "top",
          title: "Confirmation",
          text: "Are You Sure To Save This Transaction ?",
          icon: "question",
          showCancelButton: true,
          confirmButtonText: "Yes",
          cancelButtonText: "No",
          reverseButtons: false
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: "action.php",
              method: "POST",
              data: {
                action_status: "validate_detail",
                transaction_id: transaction_id,
                transaction_date: transaction_date,
                warehouse_id: warehouse_id,
                inventory_id: inventory_id,
                qty: qty,
                unit_id: unit_id,
                batch_number: batch_number,
                expired_date: expired_date
              },
              success: function(data) {
                var parsedData = $.parseJSON(data);
                var result = parsedData[0].msg;
                if (result == "") {
                  window.location = "../transaction_material_conversion/form.php";
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
      }
    });

    //Choose Warehouse Result Data
    $(document).on("click", ".choose_warehouse_result_data", function() {
      act_refresh_table_list_warehouse("select_warehouse_result_data");
      $("#selectModal").modal("show");
    });

    //Select Warehouse Result Data
    $(document).on("click", ".select_warehouse_result_data", function() {
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
          $("input#jq_warehouse_result_id").val(parsedData[0].id);
          $("input#jq_warehouse_result_name").val(parsedData[0].warehouse_name);
          $("#selectModal").modal("hide");
        }
      });
    });

    //Choose Warehouse Detail Data
    $(document).on("click", ".choose_warehouse_detail_data", function() {
      act_refresh_table_list_warehouse("select_warehouse_detail_data");

      $("#selectModal").modal("show");
    });

    //Select Warehouse Detail Data
    $(document).on("click", ".select_warehouse_detail_data", function() {
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
          $("input#jq_warehouse_id").val(parsedData[0].id);
          $("input#jq_warehouse_name").val(parsedData[0].warehouse_name);
          $("#selectModal").modal("hide");
        }
      });
    });

    //Choose Inventory Data
    $(document).on("click", ".choose_inventory_data", function() {
      act_refresh_table_list_inventory();
      $("#selectModal").modal("show");
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
          $("input#jq_inventory_result_id").val(parsedData[0].id);
          $("input#jq_inventory_result_name").val(parsedData[0].inventory_name);
          $("input#jq_unit_result_id").val(parsedData[0].unit_id);
          $("input#jq_unit_result_name").val(parsedData[0].unit_name);
          $("#selectModal").modal("hide");
        }
      });
    });

    //Choose Unit Result Data
    $(document).on("click", ".choose_unit_result_data", function() {
      var data_id = $("input#jq_inventory_result_id").val();
      act_refresh_table_list_unit(data_id, "select_unit_result_data");
      $("#selectModal").modal("show");
    });

    //Select Unit Result Data
    $(document).on("click", ".select_unit_result_data", function() {
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
          $("input#jq_unit_result_id").val(parsedData[0].unit_id);
          $("input#jq_unit_result_name").val(parsedData[0].unit_name);
          $("#selectModal").modal("hide");
        }
      });
    });

    //Choose Unit Data Data
    $(document).on("click", ".choose_unit_detail_data", function() {
      var data_id = $("input#jq_inventory_id").val();
      act_refresh_table_list_unit(data_id, "select_unit_detail_data");
      $("#selectModal").modal("show");
    });

    //Select Unit Data Data
    $(document).on("click", ".select_unit_detail_data", function() {
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
          $("input#jq_unit_id").val(parsedData[0].unit_id);
          $("input#jq_unit_name").val(parsedData[0].unit_name);
          $("#selectModal").modal("hide");
        }
      });
    });

    //Clear Expired Date
    $(document).on("click", ".clear_exp_data", function() {
      $("#jq_expired_date_result").val("");
    });

    // Btn Edit dan Validasi
    $(document).on("click", ".update_detail", function() {
      if ($("input#jq_qty").val() <= 0) {
        Swal.fire({
          position: "top",
          title: "Warning",
          text: "Qty must be filled more than 0.00 !",
          icon: "warning"
        });
      } else if ($("input#jq_warehouse_id").val() == "") {
        Swal.fire({
          position: "top",
          title: "Warning",
          text: "Warehouse Must be Selected !",
          icon: "warning"
        });
      } else {
        $.ajax({
          url: "action.php",
          method: "POST",
          data: $("#update_form").serialize(),
          beforeSend: function() {
            $("#update").val("Updating");
          },
          success: function(data) {
            $("#update_form")[0].reset();
            $("#edit_product").modal("hide");
            act_refresh_table_list_product();
            act_refresh_table_material_conversion();
          }
        });
      }
    });
  });
</script>