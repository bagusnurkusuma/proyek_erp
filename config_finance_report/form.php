<?php
require_once "../asset_default/global_function.php";
check_user_menu_acces("7a691d44-bf4b-4548-ac09-2bfcfcc83f2a");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.ico" type="image/ico" />
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
                <h2>Config Finance Report</h2>
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
                    <label class="control-label col-md-3">Finance Report Type</label>
                    <div class="col-md-9 input-group">
                      <input type="hidden" name="finance_report_type_id" id="jq_finance_report_type_id" value="" class="form-control" style="margin-bottom: 10px;" readonly="true">
                      <input type="text" name="finance_report_type_name" id="jq_finance_report_type_name" value="" class="form-control" style="margin-bottom: 10px;" readonly="true">
                      <span class="input-group-btn">
                        <button type="button" name="choose_finance_report_type_data" id="" class="btn btn-warning btn-xs choose_finance_report_type_data"><i class="fa fa-pencil-square"></i></button>
                      </span>
                      <span class="input-group-btn">
                        <button type="button" name="clear_finance_report_type_data" id="" class="btn btn-danger btn-xs clear_finance_report_type_data" onclick="act_print()"><i class="fa fa-close"></i></button>
                      </span>
                    </div>
                  </div>

                  <div class=" x_panel">
                    <div class="x_title">
                      <h2>Finance Report Detail</h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><button type="button" name="refresh" id="jq_refresh" class="btn btn-success refresh_data"><i class="fa fa-refresh"></i></button></li>
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                      <div class="card-box table-responsive" id="data_detail">
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
        data_id: $("input#jq_finance_report_type_id").val()
      },
      success: function(data) {
        $("#data_detail").html(data);
        $("table#structure_table").pretty_format_table();
        // $("table#structure_table").DataTable({
        //   pageLength: "100"
        // });
      }
    });
  }

  function act_refresh_account_table(arg_input) {
    $.ajax({
      url: "property.php",
      method: "POST",
      data: {
        action_status: "refresh_list_account",
        structure_id: arg_input
      },
      success: function(data) {
        $("#form_select").html(data);
        $("table#select_table").pretty_format_table();
        $("table#select_table").DataTable({
          // pageLength: "100"
          processing: true,
          pageLength: -1,
          lengthMenu: [
            [5, 10, 20, -1],
            [5, 10, 20, 'All']
          ],
        });
      }
    });
  }

  function act_refresh_table_pos_detail(arg_input) {
    var component = arg_input;
    var icon = component.find("i");
    var id = $(component).attr("id");
    if (icon.hasClass("fa-chevron-down")) {
      icon.removeClass("fa-chevron-down").addClass("fa-chevron-up");
      $.ajax({
        url: "property.php",
        method: "POST",
        data: {
          action_status: "refresh_data_detail_pos",
          data_id: id
        },
        success: function(data) {
          $("tr#tr-" + id).after(data);
          $("table#detail_ledger_table" + id).pretty_format_table();
          $("table#detail_ledger_table" + id).DataTable({
            pageLength: "100"
          });
        }
      });
    } else {
      icon.removeClass("fa-chevron-up").addClass("fa-chevron-down");
      $("tr#tr-" + id).next("td").remove();
    }
  }

  //FormLoad langsung Refresh Table
  $(document).ready(function() {
    act_refresh_table();
  });


  $(document).ready(function() {
    $(document).on("click", ".view_data", function() {
      var transaction_id = $(this).attr("id");
      $.ajax({
        url: "property.php",
        method: "POST",
        data: {
          action_status: "print_receipt",
          transaction_id: transaction_id,
          company_name: $("span#jq_company_name").text(),
          company_addres: $("span#jq_company_addres").text()
        },
        success: function(data) {
          var win = window.open("", "Print", "height=400,width=800");
          win.document.write(data);
          win.document.close();
          win.print();
          // win.close();
        }
      });
    })

    //Refresh Table
    $(document).on("click", ".refresh_data", function() {
      act_refresh_table();
    })

    //Refresh Detail Ledger Table
    $(document).on("click", ".show_pos_detail", function() {
      act_refresh_table_pos_detail($(this));
    })

    //Choose Finance Report Type Data
    $(document).on("click", ".choose_finance_report_type_data", function() {
      var action_status = "choose_finance_report_type_data";
      $.ajax({
        url: "property.php",
        method: "POST",
        data: {
          action_status: action_status
        },
        success: function(data) {
          $("#form_select").html(data);
          $("table#select_table").pretty_format_table();
          $("table#select_table").DataTable({
            pageLength: "100"
          });
          $("#selectModal").modal("show");
        }
      });
    });

    //Select Finance Report Type Data
    $(document).on("click", ".select_finance_report_type_data", function() {
      var data_id = $(this).attr("id");
      var action_status = "select_finance_report_type_data";
      $.ajax({
        url: "action.php",
        method: "POST",
        data: {
          data_id: data_id,
          action_status: action_status
        },
        success: function(data) {
          var parsedData = $.parseJSON(data);
          $("input#jq_finance_report_type_id").val(parsedData[0].id);
          $("input#jq_finance_report_type_name").val(parsedData[0].structure_name);
          $("#selectModal").modal("hide");
          act_refresh_table();
        }
      });
    });

    //Clear Finance Report Type Data
    $(document).on("click", ".clear_finance_report_type_data", function() {
      $("#jq_finance_report_type_id").val("");
      $("#jq_finance_report_type_name").val("");
      act_refresh_table();
    });

    //Add Account
    $(document).on("click", ".add_account", function() {
      var structure_id = $(this).attr("id");
      act_refresh_account_table(structure_id);
      $("#selectModal").modal("show");
    });

    //Select Account
    $(document).on("click", ".select_account", function() {
      var structure_id = $("input#jq_structure_id").val();

      $.ajax({
        url: "action.php",
        method: "POST",
        data: {
          action_status: "select_account",
          account_id: $(this).attr("id"),
          structure_id: structure_id
        },
        success: function(data) {
          act_refresh_table();
          act_refresh_account_table(structure_id);
        }
      });
    });

    //Remove Account
    $(document).on("click", ".remove_account", function() {
      var data_id = $(this).attr("id");

      $.ajax({
        url: "action.php",
        method: "POST",
        data: {
          data_id: data_id,
          action_status: "remove_account"
        },
        success: function(data) {
          act_refresh_table();
        }
      });
    });
  });
</script>