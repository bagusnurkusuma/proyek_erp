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
$input = array("body" => array("is_default" => true));
foreach (get_default($input) as $result) :
  $def_customer_id = $result["customer_id"];
  $def_customer_name = $result["customer_name"];
  $def_outlet_id = $result["outlet_id"];
  $def_outlet_name = $result["outlet_name"];
endforeach;
?>

<body class="nav-md" onload="act_set_focus_barcode()">
  <div class="container body">
    <!-- page content -->
    <div class="right_col" role="main">
      <div class="content">
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
              <div class="x_title">
                <h2>Point of Sales</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><button type="button" name="pay" id="jq_pay" class="btn btn-success pay">Pay</button></li>
                  <li><button type="button" name="cancel" id="jq_cancel" class="btn btn-primary cancel" onclick="act_cancel()">Cancel</button></li>
                  <li><a class="collapse-link"><i class="fa fa-chevron-up justify-content-end"></i></a></li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <br />
                <?php foreach (get_transaction_number($_SESSION['user_role_id']) as $parent) : ?>
                  <input type="hidden" name="transaction_id" id="jq_transaction_id" value=<?php echo $parent["transaction_id"]; ?> class="form-control" readonly="true">
                  <div class="row">
                    <div class="col-md-6 col-sm-12  form-group">
                      <label class="control-label col-md-3">Trx Number</label>
                      <div class="col-md-9 input-group">
                        <input type="text" name="transaction_number" id="jq_transaction_number" value=<?php echo $parent["transaction_number"]; ?> class="form-control" readonly="true" style="margin-bottom: 10px;">
                      </div>
                    <?php endforeach; ?>
                    <label class="control-label col-md-3">Trx Date</label>
                    <div class="col-md-9 input-group">
                      <input type="date" name="transaction_date" id="jq_transaction_date" value="" class="form-control" style="margin-bottom: 10px;">
                    </div>
                    </div>
                    <div class="col-md-6 col-sm-12 form-group">
                      <label class="control-label col-md-3">Outlet </label>
                      <div class="col-md-9 input-group">
                        <input type="hidden" name="outlet_id" id="jq_outlet_id" value="<?php echo $def_outlet_id ?>" class="form-control" style="margin-bottom: 10px;" readonly="true">
                        <input type="text" name="outlet_name" id="jq_outlet_name" value="<?php echo $def_outlet_name ?>" class="form-control" style="margin-bottom: 10px;" readonly="true">
                      </div>
                      <label class="control-label col-md-3">Customer </label>
                      <div class="col-md-9 input-group">
                        <input type="hidden" name="customer_id" id="jq_customer_id" value="<?php echo $def_customer_id ?>" class="form-control" style="margin-bottom: 10px;" readonly="true">
                        <input type="text" name="customer_name" id="jq_customer_name" value="<?php echo $def_customer_name ?>" class="form-control" style="margin-bottom: 10px;" readonly="true">
                        <span class="input-group-btn">
                          <button type="button" name="choose_customer_data" id="" class="btn btn-warning btn-xs choose_customer_data"><i class="fa fa-hand-o-up"></i></button>
                        </span>
                      </div>
                      <label class="control-label col-md-3">Grand Total</label>
                      <div class="col-md-9 input-group">
                        <input type="text" name="input_grand_total" id="jq_input_grand_total" value="" class="form-control" style="margin-bottom: 10px;" readonly="true">
                      </div>
                    </div>
                  </div>

                  <div class=" x_panel">
                    <div class="x_title">
                      <h2>Product Detail </h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><button type="button" name="add_product" id="jq_add_product" class="btn btn-warning add_product"><i class="fa fa-plus-circle"></i></button></li>
                        <li><button type="button" name="refresh" id="jq_refresh" class="btn btn-success refresh_data"><i class="fa fa-refresh"></i></button></li>
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      </ul>
                      <div class="col-md-2 col-sm-12  form-group">
                        <input type="number" value="" placeholder="Input Qty" name="txt_qty_barcode" id="jq_qty_barcode_form" class="form-control" style="margin-bottom: 10px;" onmouseover="this.focus();">
                      </div>
                      <div class="col-md-4 col-sm-12  form-group">
                        <input type="text" value="" placeholder="Input with Barcode" name="txt_barcode" id="jq_barcode_form" class="form-control" style="margin-bottom: 10px;" onmouseover="this.focus();">
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
          <button type="button" name="refresh_product_data" id="jq_refresh_product_data" class="btn btn-success refresh_product_data"><i class="fa fa-refresh"></i></button>
          <button type="button" class="close" data-dismiss="modal" onclick="act_set_focus_barcode()">&times;</button>
        </div>
      </div>
      <div class="modal-body">
        <div class="card-box table-responsive" id="form_list_product">
          <!-- Import From Form File -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="act_set_focus_barcode()">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Popup Payment-->
<div id="payment" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Payment</h4>
        <button type="button" class="close" data-dismiss="modal" onclick="act_set_focus_barcode()">&times;</button>
      </div>
      <div class="modal-body">
        <div class="card-box table-responsive" id="form_payment">
          <!-- Import From Form File -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="act_set_focus_barcode()">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Popup Edit Item  -->
<div id="edit_product" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Product</h4>
        <button type="button" class="close" data-dismiss="modal" onclick="act_set_focus_barcode()">&times;</button>
      </div>
      <div class="modal-body">
        <div class="card-box table-responsive" id="form_edit" onload="act_set_focus_qty()">
          <!-- Import From Form File -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="act_set_focus_barcode()">Close</button>
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
          <button type="button" name="add_customer_data" id="jq_add_customer_data" class="btn btn-warning add_customer_data"><i class="fa fa-plus-circle"></i></button>
          <button type="button" name="refresh_customer_data" id="jq_refresh_customer_data" class="btn btn-success refresh_customer_data"><i class="fa fa-refresh"></i></button>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
      </div>
      <div class="modal-body">
        <div class="card-box table-responsive" id="form_select">
          <!-- Import From Form File -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="act_set_focus_barcode()">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Pop up Data Detail -->
<div id="add_data_Modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Data Detail</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="card-box table-responsive" id="form_add_data">
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
  function act_set_focus_barcode() {
    $("#jq_qty_barcode_form").focus();
  }

  function act_refresh_table_pos() {
    var transaction_id = $("input#jq_transaction_id").val();
    $.ajax({
      url: "property.php",
      method: "POST",
      data: {
        action_status: "refresh_list_point_of_sales_detail",
        transaction_id: transaction_id
      },
      success: function(data) {
        $("#data_detail").html(data);
        $("table#data_point_of_sales_table").pretty_format_table();
        $("table#data_point_of_sales_table").DataTable({
          pageLength: 100
        });
        $("#jq_input_grand_total").val($("#jq_th_grand_total").text());
      }
    });
  }

  function act_refresh_table_list_product() {
    var transaction_id = $("#jq_transaction_id").val();
    var outlet_id = $("#jq_outlet_id").val();
    $.ajax({
      url: "property.php",
      method: "POST",
      data: {
        action_status: "refresh_list_product",
        transaction_id: transaction_id,
        outlet_id: outlet_id
      },
      success: function(data) {
        $("#form_list_product").html(data);
        $("table#data_product_table").pretty_format_table();
        $("table#data_product_table").DataTable();
      }
    });
  }

  function act_refresh_table_list_customer() {
    $.ajax({
      url: "property.php",
      method: "POST",
      data: {
        action_status: "choose_customer_data"
      },
      success: function(data) {
        $("#form_select").html(data);
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
    var transaction_id = $("#jq_transaction_id").val();
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
      }
    });
  }

  //Action Qty
  $(document).ready(function() {
    $("#jq_qty_barcode_form").keyup(function(xx) {
      if (xx.key == "Enter" || xx.keyCode == 13) {
        $("#jq_barcode_form").focus();
      }
    });

  });

  //Action Barcode
  $(document).ready(function() {
    $("#jq_barcode_form").keyup(function(xx) {
      if (xx.key == "Enter" || xx.keyCode == 13) {
        var transaction_id = $("#jq_transaction_id").val();
        $.ajax({
          url: "action.php",
          method: "POST",
          data: {
            action_status: "input_barcode",
            transaction_id: transaction_id,
            qty: $("#jq_qty_barcode_form").val(),
            data_id: $(this).val()
          },
          success: function(data) {
            $("#jq_qty_barcode_form").val("");
            $("#jq_barcode_form").val("");
            act_set_focus_barcode();
            act_refresh_table_pos();
          }
        });
      }
    });

  });

  //FormLoad langsung Refresh Table
  $(document).ready(function() {
    $("input#jq_transaction_date").val(get_current_date());
    act_refresh_table_pos();
  });

  $(document).ready(function() {
    //Refresh Table
    $(document).on("click", ".refresh_data", function() {
      act_refresh_table_pos();
    });

    //Add Product
    $(document).on("click", ".add_product", function() {
      act_refresh_table_list_product();
      $("#add_product").modal("show");
    });

    //Refresh Product
    $(document).on("click", ".refresh_product_data", function() {
      act_refresh_table_list_product();
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

    //Remove Transaction Detail
    $(document).on("click", ".delete_data", function() {
      var data_id = $(this).attr("id");

      $.ajax({
        url: "action.php",
        method: "POST",
        data: {
          data_id: data_id,
          action_status: "remove_product"
        },
        success: function(data) {
          act_refresh_table_pos();
        }
      });
    });

    //Payment Transaction
    $(document).on("click", ".pay", function() {
      var transaction_id = $("#jq_transaction_id").val();
      var transaction_date = $("#jq_transaction_date").val();
      var customer_id = $("#jq_customer_id").val();
      var customer_name = $("#jq_customer_name").val();
      var outlet_id = $("#jq_outlet_id").val();
      var outlet_name = $("#jq_outlet_name").val();

      $.ajax({
        url: "action.php",
        method: "POST",
        data: {
          action_status: "validate_detail",
          transaction_id: transaction_id,
          transaction_date: transaction_date,
          outlet_id: outlet_id
        },
        success: function(data) {
          var parsedData = $.parseJSON(data);
          var result = parsedData[0].msg;
          if (result == "") {
            $.ajax({
              url: "property.php",
              method: "POST",
              data: {
                action_status: "pay_transaction",
                transaction_id: transaction_id,
                transaction_date: transaction_date,
                customer_id: customer_id,
                customer_name: customer_name,
                outlet_id: outlet_id,
                outlet_name: outlet_name
              },
              success: function(data) {
                $("#form_payment").html(data);
                $("#payment").modal("show");
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
    });

    //Btn Pay dan Membayar
    $(document).on("click", ".pay_transaction", function() {
      if ($("input#jq_pay_grand_total").val() <= 0) {
        Swal.fire({
          position: "top",
          title: "Warning",
          text: "Grand Total must be filled more than 0.00 !",
          icon: "warning"
        });
      } else if (Number($("input#jq_pay_grand_total").val()) > Number($("input#jq_pay_total_cash").val())) {
        Swal.fire({
          position: "top",
          title: "Warning",
          text: "Total Cash must be at least the same as Grand Total !",
          icon: "warning"
        });
      } else {
        $.ajax({
          url: "action.php",
          method: "POST",
          data: $("#payment_form").serialize(),
          beforeSend: function() {
            $("#save").val("Saving");
          },
          success: function(data) {
            $.ajax({
              url: "../list_point_of_sales/property.php",
              method: "POST",
              data: {
                action_status: "print_receipt",
                transaction_id: $("input#jq_transaction_id").val(),
                company_name: $("span#jq_company_name").text(),
                company_addres: $("span#jq_company_addres").text()
              },
              success: function(data) {
                $("#payment_form")[0].reset();
                $("#payment").modal("hide");
                var win = window.open("", "Print", "height=400,width=800");
                win.document.write(data);
                win.document.close();
                win.print();
                window.location = "../transaction_point_of_sales/form.php";
              }
            });
          }
        });
      }
    });

    //Choose Customer Data
    $(document).on("click", ".choose_customer_data", function() {
      act_refresh_table_list_customer();
      $("#selectModal").modal("show");
    });

    //Refresh Customer Data
    $(document).on("click", ".refresh_customer_data", function() {
      act_refresh_table_list_customer();
    });

    //Add Customer Data
    $(document).on("click", ".add_customer_data", function() {
      var action_status = "add_customer_data";
      var created_by = $("#jq_pengguna").val();
      $.ajax({
        url: "property.php",
        method: "POST",
        data: {
          action_status: action_status,
          created_by: created_by
        },
        success: function(data) {
          $("#form_add_data").html(data);
          $("#add_data_Modal").modal("show");
        }
      });
    });

    //Select Customer Data
    $(document).on("click", ".select_customer_data", function() {
      var data_id = $(this).attr("id");
      var action_status = "select_customer_data";
      $.ajax({
        url: "action.php",
        method: "POST",
        data: {
          data_id: data_id,
          action_status: action_status
        },
        success: function(data) {
          var parsedData = $.parseJSON(data);
          $("#jq_customer_id").val(parsedData[0].id);
          $("#jq_customer_name").val(parsedData[0].customer_name);
          $("#selectModal").modal("hide");
        }
      });
    });

    //Btn edit dan validasi
    $(document).on("click", ".update_detail", function() {
      if ($("#jq_qty").val() <= 0) {
        Swal.fire({
          position: "top",
          title: "Warning",
          text: "Qty must be filled more than 0.00 !",
          icon: "warning"
        });
      } else if ($("#jq_disc_1_percent").val() < 0 | $("#jq_disc_2_percent").val() < 0 | $("#jq_disc_1_nominal").val() < 0 | $("#jq_disc_2_nominal").val() < 0) {
        Swal.fire({
          position: "top",
          title: "Warning",
          text: "Discount Cannot be filled in Minus !",
          icon: "warning"
        });
      } else if ($("#jq_disc_1_percent").val() > 100 | $("#jq_disc_2_percent").val() > 100) {
        Swal.fire({
          position: "top",
          title: "Warning",
          text: "Discount cannot be filled more than 100% !",
          icon: "warning"
        });
      } else if ($("#jq_vat").val() < 0) {
        Swal.fire({
          position: "top",
          title: "Waning",
          text: "VAT  Cannot be filled in Minus !",
          icon: "warning"
        });
      } else if ($("#jq_vat").val() > 100) {
        Swal.fire({
          position: "top",
          title: "Warning",
          text: "VAT cannot be filled more than 100% !",
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
            act_refresh_table_pos();
          }
        });
      }
    });

    //Btn Add Customer
    $(document).on("click", ".add_customer_data", function() {
      if ($("#jq_customer_nama").val() == "") {
        Swal.fire({
          position: "top",
          title: "Warning",
          text: "Customer Name Must be Filled !",
          icon: "warning"
        });
      } else if ($("#jq_customer_addres").val() == "") {
        Swal.fire({
          position: "top",
          title: "Warning",
          text: "Address Must be Filled !",
          icon: "warning"
        });
      } else {
        $.ajax({
          url: "action.php",
          method: "POST",
          data: $("#add_customer_data").serialize(),
          beforeSend: function() {
            $("#update").val("Updating");
          },
          success: function(data) {
            var parsedData = $.parseJSON(data);
            $("#jq_customer_id").val(parsedData[0].id);
            $("#jq_customer_name").val(parsedData[0].customer_name);
            $("#add_customer_data")[0].reset();
            $("#add_data_Modal").modal("hide");
            $("#selectModal").modal("hide");
          }
        });

      }
    });

  });
</script>