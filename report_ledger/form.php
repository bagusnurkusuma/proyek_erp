<?php
require_once "../asset_default/global_function.php";
check_user_menu_acces("c15f88c8-ac9e-4574-a284-0a98585ef006");
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
                <li><a class="collapse-link"><i class="fa fa-chevron-up justify-content-end"></i></a></li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <br />
              <div class="row">
                <div class="col-md-6 col-sm-12  form-group">
                  <label class="control-label col-md-3">Start Date</label>
                  <div class="col-md-9 input-group">
                    <input type="date" name="start_date" id="jq_start_date" value="" class="form-control" style="margin-bottom: 10px;">
                  </div>
                  <label class="control-label col-md-3">End Date</label>
                  <div class="col-md-9 input-group">
                    <input type="date" name="end_date" id="jq_end_date" value="" class="form-control" style="margin-bottom: 10px;">
                  </div>
                  <label class="control-label col-md-3">Show Sum By Account Parent</label>
                  <div class="col-md-9 input-group">
                    <input type="checkbox" id="checkbox" class="form-control" style="margin-bottom: 10px;">
                  </div>
                  <label class="control-label col-md-3">Account </label>
                  <div class="col-md-9 input-group">
                    <input type="hidden" name="filter_account_id" id="jq_filter_account_id" value="" class="form-control" style="margin-bottom: 10px;" readonly="true">
                    <input type="text" name="filter_account_name" id="jq_filter_account_name" value="" class="form-control" style="margin-bottom: 10px;" readonly="true">
                    <span class="input-group-btn">
                      <button type="button" name="choose_filter_account_data" id="" class="btn btn-warning btn-xs choose_filter_account_data"><i class="fa fa-pencil-square"></i></button>
                    </span>
                    <span class="input-group-btn">
                      <button type="button" name="clear_filter_account_data" id="" class="btn btn-danger btn-xs clear_filter_account_data"><i class="fa fa-close"></i></button>
                    </span>
                  </div>
                </div>
                <div id="structure_table" hidden="hidden"></div>
                <div class=" x_panel">
                  <div class="x_title">
                    <h2>Ledger Detail </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><button type="button" name="refresh" id="jq_refresh" class="btn btn-success refresh_data"><i class="fa fa-refresh"></i></button></li>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                    <div class="card-box table-responsive" id="div_main_table">
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

<!-- Pop up Selected -->
<div id="selectModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Select Data</h4>
        <div align="right">
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
  function act_refresh_main_table() {
    $.ajax({
      url: "property.php",
      method: "POST",
      data: {
        action_status: "refresh_data_main_table",
        start_date: $("input#jq_start_date").val(),
        end_date: $("input#jq_end_date").val(),
        account_id: $("input#jq_filter_account_id").val()
      },
      success: function(data) {
        $("div#div_main_table").html(data);
        $("table#main_table").data_table_with_export({
          title_name: $("#jq_process_name").text
        });
      }
    });
  }

  function act_refresh_structure_table() {
    $.ajax({
      url: "property.php",
      method: "POST",
      data: {
        action_status: "refresh_data_structure_table"
      },
      success: function(data) {
        $("div#structure_table").html(data);
      }
    });
  }

  function get_total_structure(arg_input) {
    var sum_beginning = 0;
    var sum_debet = 0;
    var sum_credit = 0;
    var sum_ending = 0;
    var id = arg_input.attr("id");
    var parent_id = arg_input.attr("class");
    var parent_level = arg_input.data('level');
    var name = arg_input.text();
    var parent = $('tr.' + id);
    var data_beginning = parent.find('td#beginning');
    var data_debet = parent.find('td#debet');
    var data_credit = parent.find('td#credit');
    var data_ending = parent.find('td#ending');
    if (data_ending.length > 0) {
      data_beginning.each(function() {
        // var angka = $(this).text().replace(/\./g, '');
        sum_beginning += parseFloat($(this).text().replace(/\./g, '')) || 0;
        // $(this).text(angka);
        //sum_beginning += parseFloat($(this).text()) || 0;
      });
      data_debet.each(function() {
        sum_debet += parseFloat($(this).text().replace(/\./g, '')) || 0;
        //sum_debet += parseFloat($(this).text()) || 0;
      });
      data_credit.each(function() {
        sum_credit += parseFloat($(this).text().replace(/\./g, '')) || 0;
        //sum_credit += parseFloat($(this).text()) || 0;
      });
      data_ending.each(function() {
        sum_ending += parseFloat($(this).text().replace(/\./g, '')) || 0;
        //sum_ending += parseFloat($(this).text()) || 0;
      });

      // sum_beginning = format_input_decimal(sum_beginning);
      // sum_debet = format_input_decimal(sum_debet);
      // sum_credit = format_input_decimal(sum_credit);
      // sum_ending = format_input_decimal(sum_ending);
    }
    var newRow = '<tr id="' + id + '" class="' + parent_id + '" data-level="' + parent_level + '" data-type="structure"><td></td><td id="structure_name">' + name + '</td><td id="beginning" class ="jq_format_decimal_table">' + sum_beginning + '</td><td id="debet" class ="jq_format_decimal_table">' + sum_debet + '</td><td id="credit" class ="jq_format_decimal_table">' + sum_credit + '</td><td id="ending" class ="jq_format_decimal_table">' + sum_ending + '</td></tr>';
    if (data_ending.length > 0) {
      $('table#main_table tr.' + id + ':last').after(newRow);
    } else {
      $('table#main_table').append(newRow);
    }
  }

  function get_colspan_row(arg_input, maxLevel) {
    var max_colspan = maxLevel;
    var level = arg_input.data("level");
    var type = arg_input.data("type");
    var id = arg_input.attr("id");
    var insert_td = "";
    var colspan = max_colspan - level + 1;
    for (var i = 0; i < level - 1; i++) {
      insert_td = insert_td + "<td></td>";
    }
    //Colspan td Structure Name
    var data = arg_input.find("td#structure_name");
    data.attr('colspan', colspan);
    data.before(insert_td);
    var bold = (maxLevel * 2 - level + 2) * 100;
    if (type == "structure") {
      arg_input.css({
        "font-weight": bold
      })
    }
  }

  function act_refresh_table_ledger_detail(arg_input) {
    //Mencari level paling tinggi
    var isChecked = $('input#checkbox').prop('checked');
    if (isChecked) {
      var maxLevel = get_max_level_main_table() * 2 + 1;
    } else {
      var maxLevel = get_max_level_main_table() + 2;
    }

    var component = arg_input;
    var icon = component.find("i");
    var account_id = $(component).attr("id");
    if (icon.hasClass("fa-chevron-down")) {
      icon.removeClass("fa-chevron-down").addClass("fa-chevron-up");
      $.ajax({
        url: "property.php",
        method: "POST",
        data: {
          action_status: "refresh_data_detail_ledger",
          start_date: $("#jq_start_date").val(),
          end_date: $("#jq_end_date").val(),
          account_id: account_id,
          colspan: maxLevel
        },
        success: function(data) {
          $("tr#" + account_id).after(data);
          $("table#detail_ledger_table" + account_id).data_table();
        }
      });
    } else {
      icon.removeClass("fa-chevron-up").addClass("fa-chevron-down");
      $("tr#" + account_id).next("td").remove();
    }
  }

  function get_max_level_main_table() {
    var tr_structure = $("table#main_table tbody").find("tr");
    //Mencari level paling tinggi
    var maxLevel = 0;
    tr_structure.each(function() {
      var level = parseInt($(this).attr('data-level'));
      if (!isNaN(level) && level > maxLevel) {
        maxLevel = level;
      }
    });

    return maxLevel;
  }

  //FormLoad langsung Refresh Table
  $(document).ready(function() {
    $("input#jq_start_date").val(get_current_first_date());
    $("input#jq_end_date").val(get_current_last_date());
    act_refresh_main_table();
    act_refresh_structure_table();
  });

  $(document).ready(function() {
    $('#checkbox').change(function() {
      // act_refresh_main_table(false);
      if ($(this).is(':checked')) {
        $("#jq_filter_account_id").val("");
        $("#jq_filter_account_name").val("");
        //Sum dan gabungkan Structure Table dengan Main Table
        var tr_structure = $("table#structure_table tbody").find("tr");
        tr_structure.each(function() {
          get_total_structure($(this));
        })
        //Ambil Struktur Main Table
        var tr_structure = $("table#main_table tbody").find("tr");
        //Mencari level paling tinggi
        var maxLevel = get_max_level_main_table();
        //Proses colspan
        var th_structure = $('table#main_table tr th');
        $('table#main_table th#account').attr('colspan', maxLevel);
        th_structure.css("text-align", "center");
        tr_structure.each(function() {
          get_colspan_row($(this), maxLevel);
        });
        $("tfoot#footer_main_table").attr('hidden', 'hidden');
        // Mempercantik Main Table
        $("table#main_table").pretty_format_table();
      } else {
        act_refresh_main_table();
        var th_structure = $('table#main_table tr th');
        th_structure.css("text-align", "center");
      }
    });

    //Refresh Table
    $(document).on("click", ".refresh_data", function() {
      $('#checkbox').prop("checked", false);
      act_refresh_main_table();
    })

    //Refresh Detail Ledger Table
    $(document).on("click", ".show_ledger_detail", function() {
      act_refresh_table_ledger_detail($(this));
    })

    //Show Journal Detail
    $(document).on("click", ".show_journal_detail", function() {
      var action_status = "show_journal_detail";
      $.ajax({
        url: "property.php",
        method: "POST",
        data: {
          data_id: $(this).attr("id"),
          action_status: action_status
        },
        success: function(data) {
          $("#form_select").html(data);
          $("table#select_table").data_table();
          $("#selectModal").modal("show");
        }
      });
    });

    //Choose Filter Account Data
    $(document).on("click", ".choose_filter_account_data", function() {
      var action_status = "choose_filter_account_data";
      $.ajax({
        url: "property.php",
        method: "POST",
        data: {
          action_status: action_status
        },
        success: function(data) {
          $("#form_select").html(data);
          $("table#select_table").data_table();
          $("#selectModal").modal("show");
        }
      });
    });

    //Select Filter Account Data
    $(document).on("click", ".select_filter_account_data", function() {
      var data_id = $(this).attr("id");
      var action_status = "select_filter_account_data";
      $.ajax({
        url: "action.php",
        method: "POST",
        data: {
          data_id: data_id,
          action_status: action_status
        },
        success: function(data) {
          var parsedData = $.parseJSON(data);
          $("#jq_filter_account_id").val(parsedData[0].id);
          $("#jq_filter_account_name").val(parsedData[0].account_concat);
          $("#selectModal").modal("hide");
          $('#checkbox').prop("checked", false);
          act_refresh_main_table();
        }
      });
    });

    //Clear Filter Account Data
    $(document).on("click", ".clear_filter_account_data", function() {
      $("#jq_filter_account_id").val("");
      $("#jq_filter_account_name").val("");
      act_refresh_main_table();
    });
  });
</script>