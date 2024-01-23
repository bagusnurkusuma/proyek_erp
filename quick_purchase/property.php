<script>
  //Menghitung Kembalian
  $("#jq_pay_total_cash").ready(function() {
    $("#jq_pay_total_cash").keyup(function() {
      if ($('#jq_pay_total_cash').is(":focus")) {
        var_changes = Number(-1 * $("#jq_pay_grand_total").val()) + Number($("#jq_pay_total_cash").val());
        $("#jq_pay_total_changes").val(var_changes);
      }
    });
  });

  //Menghitung Detail Product
  $(".jq_input_numeric").ready(function() {
    $(".jq_input_numeric").keyup(function() {
      if ($('#jq_qty').is(":focus") | $('#jq_unit_price').is(":focus") |
        $('#jq_disc_1_percent').is(":focus") | $('#jq_disc_2_percent').is(":focus") |
        $('#jq_disc_1_nominal').is(":focus") | $('#jq_disc_2_nominal').is(":focus") |
        $('#jq_vat').is(":focus")) {

        if ($('#jq_qty').is(":focus") | $('#jq_unit_price').is(":focus") |
          $('#jq_disc_1_percent').is(":focus") | $('#jq_disc_2_percent').is(":focus") |
          $('#jq_vat').is(":focus")) {

          var_total = $("#jq_qty").val() * $("#jq_unit_price").val();
          var_disc_1_nominal = $("#jq_disc_1_percent").val() / 100 * var_total;
          var_disc_2_nominal = $("#jq_disc_2_percent").val() / 100 * (var_total - var_disc_1_nominal);
          var_total_disc = Number(var_disc_1_nominal) + Number(var_disc_2_nominal);
          var_total_dpp = var_total - var_total_disc;
          var_total_vat = $("#jq_vat").val() / 100 * var_total_dpp;
          $("#jq_disc_1_nominal").val(var_disc_1_nominal);
          $("#jq_disc_2_nominal").val(var_disc_2_nominal);
        } else if ($('#jq_disc_1_nominal').is(":focus") | $('#jq_disc_2_nominal').is(":focus")) {
          var_total = $("#jq_total").val();
          if (var_total != 0) {
            var_disc_1_nominal = $("#jq_disc_1_nominal").val();
            var_disc_2_nominal = $("#jq_disc_2_nominal").val();
            var_disc_1_percent = var_disc_1_nominal / var_total * 100;
            var_disc_2_percent = var_disc_2_nominal / (var_total - var_disc_1_nominal) * 100;
            var_total_disc = Number(var_disc_1_nominal) + Number(var_disc_2_nominal);
          } else {
            var_disc_1_percent = 0;
            var_disc_2_percent = 0;
            var_total_disc = 0;
          }
          var_total_dpp = var_total - var_total_disc;
          var_total_vat = $("#jq_total_vat").val();
          $("#jq_disc_1_percent").val(var_disc_1_percent);
          $("#jq_disc_2_percent").val(var_disc_2_percent);
        }

        var_grand_total = Number(var_total_dpp) + Number(var_total_vat);
        $("#jq_total").val(var_total);
        $("#jq_total_disc").val(var_total_disc);
        $("#jq_total_dpp").val(var_total_dpp);
        $("#jq_total_vat").val(var_total_vat);
        $("#jq_grand_total").val(var_grand_total);
      }
    });

  });
</script>

<?php
include "api.php";

if (!empty($_POST)) {
  $output = '';

  // Menampilkan Popup Edit Detail Product
  if (
    $_POST["action_status"] == "edit_product" || $_POST["action_status"] == "select_product" ||
    $_POST["action_status"] == "detail_product"
  ) {
    if ($_POST["action_status"] == "select_product") {
      $input = array("body" => array("inventory_id" => $_POST["data_id"], "quick_purchase_id" => $_POST["transaction_id"]));
      $hasil = insert_transaction_detail($input);
      $is_read_only = '';
      $is_disable_span = '';
      if (is_array($hasil) && count($hasil)) {
        foreach ($hasil as $baris) :
          $input = $baris["id"];
        endforeach;
      }
      $input = array("body" => array("id" => $input));
      $action_status = "edit_product";
    } elseif ($_POST["action_status"] == "edit_product") {
      $input = array("body" => array("id" => $_POST["data_id"]));
      $action_status = $_POST["action_status"];
      $is_read_only = '';
      $is_disable_span = '';
    } elseif ($_POST["action_status"] == "detail_product") {
      $input = array("body" => array("id" => $_POST["data_id"]));
      $action_status = $_POST["action_status"];
      $is_read_only = 'readonly=true';
      $is_disable_span = 'hidden';
    }
    $hasil = get_transaction_detail($input);
    if (is_array($hasil) && count($hasil)) {
      foreach ($hasil as $row) :
        $output .= '
      <form method="post" id="update_form">
        <input type="hidden" name="transaction_id" id="jq_transaction_id" value="' . $_POST["transaction_id"] . '" class="form-control col-md-7 col-xs-12" readonly="true">
        <input type="hidden" name="action_status" id="jq_action_status" value="' . $action_status . '" class="form-control col-md-7 col-xs-12" readonly="true">
        <input type="hidden" name="id" id="jq_id" value="' . $row["id"] . '" class="form-control" readonly=true/>
        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
          <tr>
            <td><label>Inventory</label></td>
            <td> <input type="text" name="product_name" id="jq_product_name" value="' . $row["inventory_name"] . '" class="form-control" readonly=true/></td>
          </tr>
          <tr>
            <td><label>Qty</label></td>
            <td> <input  type="number" name="qty" id="jq_qty" value="' . $row["qty"] . '"onmouseover="this.focus();" class="form-control jq_input_numeric"' . $is_read_only . '/></td>
          </tr>
          <tr>
            <td><label>Unit Price</label></td>
            <td> <input type="number"  name="unit_price" id="jq_unit_price" value="' . $row["unit_price"] . '" class="form-control jq_input_numeric"' . $is_read_only . '/></td>
          </tr>
          <tr>
            <td><label>Unit</label></td>
            <td> <input type="text" name="unit_name" id="jq_unit_name" value="' . $row["unit_name"] . '" class="form-control" readonly=true/></td>
          </tr>
          <tr>
            <td><label>Total</label></td>
            <td> <input type="number"  name="total" id="jq_total" value="' . $row["total"] . '" class="form-control jq_input_numeric" readonly=true/></td>
          </tr>
          <tr>
            <td><label>Disc 1 (%)</label></td>
            <td> <input type="number" name="disc_1_percent" id="jq_disc_1_percent" value="' . $row["disc_1_percent"] . '" class="form-control jq_input_numeric" ' . $is_read_only . '/></td>
          </tr>
          <tr>
            <td><label>Disc 1 (Rp)</label></td>
            <td> <input type="number" step="0.01" name="disc_1_nominal" id="jq_disc_1_nominal" value="' . $row["disc_1_nominal"] . '" class="form-control jq_input_numeric" ' . $is_read_only . '/></td>
          </tr>
          <tr>
            <td><label>Disc 2 (%)</label></td>
            <td> <input type="number" name="disc_2_percent" id="jq_disc_2_percent" value="' . $row["disc_2_percent"] . '" class="form-control jq_input_numeric" ' . $is_read_only . '/></td>
          </tr>
          <tr>
            <td><label>Disc 2 (Rp)</label></td>
            <td> <input type="number" name="disc_2_nominal" id="jq_disc_2_nominal" value="' . $row["disc_2_nominal"] . '" class="form-control jq_input_numeric" ' . $is_read_only . '/></td>
          </tr>
          <tr>
            <td><label>Total Disc</label></td>
            <td> <input type="number" name="total_disc" id="jq_total_disc" value="' . $row["total_disc"] . '" class="form-control jq_input_numeric" readonly=true/></td>
          </tr>
          <tr>
            <td><label>Total DPP</label></td>
            <td> <input type="number" name="total_dpp" id="jq_total_dpp" value="' . $row["total_dpp"] . '" class="form-control jq_input_numeric" readonly=true/></td>
          </tr>
          <tr>
            <td><label>Vat</label></td>
            <td> <input type="number" name="vat" id="jq_vat" value="' . $row["vat"] . '" class="form-control jq_input_numeric" ' . $is_read_only . '/></td>
          </tr>
          <tr>
            <td><label>Total Vat</label></td>
            <td> <input type="number" name="total_vat" id="jq_total_vat" value="' . $row["total_vat"] . '" class="form-control jq_input_numeric" readonly=true/></td>
          </tr>
          <tr>
            <td><label>Grand Total</label></td>
            <td> <input type="number"  name="grand_total" id="jq_grand_total" value="' . $row["grand_total"] . '" class="form-control jq_input_numeric" readonly=true/></td>
          </tr>
          <tr>
            <td><label>Description</label></td>
            <td><textarea name="description" id="jq_description" class="form-control" ' . $is_read_only . '>' . $row["description"] . '</textarea></</td>
          </tr>
      </table>
         <span class="input-group-btn" ' . $is_disable_span . '>
           <input type="button" name="update" id="jq_update" value="Update" class="btn btn-success update_detail" />
         </span>
    </form>
      ';
      endforeach;
    } else {
      $output .= '<h3 style="color:red" class="error">Data has been entered / The barcode does not exist</h3>';
    }
    $input = '';
  } elseif ($_POST["action_status"] == "refresh_list_product") {
    $output .= '
      <table id="data_product_table" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr>
            <th>Inventory Code</th>
            <th>Inventory Name</th>
            <th>Unit Price</th>
            <th>Unit</th>
            <th>Option</th>
          </tr>
        </thead>
        <tbody>
        ';
    $hasil = get_inventory_for_transaction($_POST["transaction_id"]);
    if (is_array($hasil) && count($hasil)) {
      foreach ($hasil as $baris) :
        $output .= '
          <tr>
            <td>' . $baris["inventory_code"] . '</td>
            <td>' . $baris["inventory_name"] . '</td>
            <td class ="jq_format_decimal_table">' . $baris["unit_price"] . '</td>
            <td>' . $baris["unit_name"] . '</td>
            <td><button type="button" name="Select" value="Select" id="' . $baris["id"] . '" class="btn btn-warning btn-xs select_data"><i class="fa fa-check-square-o"></i></button></td> 
          </tr>
          ';
      endforeach;
    }
    $output .= '</tbody></table>';
  } elseif ($_POST["action_status"] == "refresh_list_quick_purchase_detail") {
    $sum_total_disc = 0;
    $sum_grand_total = 0;
    $output .= '
      <table id="data_quick_purchase_table" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr>
            <th>Inventory Code</th>
            <th>Inventory Name</th>
            <th>Qty</th>
            <th>Unit Price</th>
            <th>Unit</th>
            <th>Total Disc</th>
            <th>Grand Total</th>
            <th>Option</th>
          </tr>
        </thead>
        <tbody>
      ';
    $input = array("body" => array("quick_purchase_id" => $_POST["transaction_id"]));
    $hasil = get_transaction_detail($input);
    if (is_array($hasil) && count($hasil)) {
      foreach ($hasil as $baris) :
        $output .= '
          <tr>
            <td>' . $baris["inventory_code"] . '</td>
            <td>' . $baris["inventory_name"] . '</td>
            <td class ="jq_format_decimal_table">' . $baris["qty"] . '</td>
            <td class ="jq_format_decimal_table">' . $baris["unit_price"] . '</td>
            <td>' . $baris["unit_name"] . '</td>
            <td class ="jq_format_decimal_table">' . $baris["total_disc"] . '</td>
            <td class ="jq_format_decimal_table">' . $baris["grand_total"] . '</td>
            <td><button type="button" name="view" id="' . $baris["id"] . '" class="btn btn-info btn-xs view_data"><i class="fa fa-eye"></i></button>
                <button type="button" name="edit" id="' . $baris["id"] . '" class="btn btn-warning btn-xs edit_data"><i class="fa fa-pencil-square"></i></button>                                  
                <button type="button" name="remove" id="' . $baris["id"] . '" class="btn btn-danger btn-xs delete_data"><i class="fa fa-trash"></i></button></td>
            </tr>
        ';
        $sum_total_disc = $sum_total_disc + $baris["total_disc"];
        $sum_grand_total = $sum_grand_total + $baris["grand_total"];
      endforeach;
    }
    $output .=
      '</tbody>
      <tfoot>
        <tr>
          <th colspan = 5></th>
          <th class ="jq_format_decimal_table">' . $sum_total_disc . '</th>
          <th id="jq_th_grand_total" class ="jq_format_decimal_table">' . $sum_grand_total . '</th>
          <th></th>
        </tr>
      </tfoot></table>';
  } elseif ($_POST['action_status'] == 'summary_grand_total') {
    $hasil = get_summary_transaction_detail($_POST["transaction_id"]);
    $output = '<input type="text" value= "' . $hasil . '" class="form-control jq_input_numeric" style="margin-bottom: 10px;" readonly="true">';
  } elseif ($_POST['action_status'] == 'pay_transaction') {
    $action_status = $_POST["action_status"];
    $hasil = get_summary_transaction_detail($_POST["transaction_id"]);
    $output = '
    <form method="post" id="payment_form">
        <input type="hidden" name="transaction_id" id="jq_transaction_id" value="' . $_POST["transaction_id"] . '" class="form-control col-md-7 col-xs-12" readonly="true">
        <input type="hidden" name="transaction_date" id="jq_transaction_date" value="' . $_POST["transaction_date"] . '" class="form-control col-md-7 col-xs-12" readonly="true">
        <input type="hidden" name="supplier_id" id="jq_supplier_id" value="' . $_POST["supplier_id"] . '" class="form-control col-md-7 col-xs-12" readonly="true">
        <input type="hidden" name="warehouse_id" id="jq_warehouse_id" value="' . $_POST["warehouse_id"] . '" class="form-control col-md-7 col-xs-12" readonly="true">
        <input type="hidden" name="action_status" id="jq_action_status" value="' . $action_status . '" class="form-control col-md-7 col-xs-12" readonly="true">
        <table class="table table-striped">
          <tr>
            <td><label>Grand Total</label></td>
            <td> <input type="number" step="0.01" name="grand_total" id="jq_pay_grand_total" value="' . $hasil . '" class="form-control" readonly=true/></td>
          </tr>
          <tr>
            <td><label>Cash</label></td>
            <td> <input type="number" step="0.01" name="total_cash" id="jq_pay_total_cash" value="0" class="form-control" onmouseover="this.focus();"/></td>
          </tr>
          <tr>
            <td><label>Changes</label></td>
            <td> <input type="text" name="total_changes" id="jq_pay_total_changes" value="' . $hasil * -1 . '" class="form-control" readonly=true/></td>
          </tr>
      </table>
        <span class="input-group-btn">
          <input type="button" name="pay_transaction" id="jq_pay_transaction" value="Pay" class="btn btn-success pay_transaction" />
        </span>
    </form>';
  } elseif ($_POST['action_status'] == 'choose_supplier_data') {
    $output .= '
      <table id="select_table" class="table table-striped table-bordered" style="width:100%">
         <thead>
         <tr>
            <th>Supplier Name</th>
            <th>Telp</th>
            <th>Addres</th>
            <th>Option</th> 
         </tr>
      </thead>
      <tbody>
      ';
    $input = ['body' => ['id' => null]];
    $hasil = get_data_supplier($input);
    if (is_array($hasil) && count($hasil)) {
      foreach ($hasil as $row) :
        $output .= '
            <tr>  
               <td>' . $row["supplier_name"] . '</td>
               <td>' . $row["telp"] . '</td>
               <td>' . $row["addres"] . '</td>
               <td><button type="button" name="select" id="' . $row["id"] . '" class="btn btn-warning btn-xs select_supplier_data">Select</button>                                  
               </td>
            </tr>
         ';
      endforeach;
    }
    $output .= '</tbody></table>';
  } elseif ($_POST['action_status'] == 'choose_warehouse_data') {
    $output .= '
      <table id="select_table" class="table table-striped table-bordered" style="width:100%">
         <thead>
         <tr>
            <th width="30%">Warehouse Code</th>
            <th width="20%">Warehouse Name</th>
            <th width="10%">Option</th> 
         </tr>
      </thead>
      <tbody>
      ';
    $input = ['body' => ['id' => null]];
    $hasil = get_data_warehouse($input);
    if (is_array($hasil) && count($hasil)) {
      foreach ($hasil as $row) :
        $output .= '
            <tr>  
               <td>' . $row["warehouse_code"] . '</td>
               <td>' . $row["warehouse_name"] . '</td>
               <td><button type="button" name="select" id="' . $row["id"] . '" class="btn btn-warning btn-xs select_warehouse_data">Select</button>                                  
               </td>
            </tr>
         ';
      endforeach;
    }
    $output .= '</tbody></table>';
  }
  echo $output;
}
?>