<?php
require_once "api.php";
require_once "../asset_default/global_function.php";
if (!empty($_POST)) {
  $_POST = casting_htmlentities_array($_POST);
  $output = '';

  // Menampilkan Popup Edit Detail Product
  if ($_POST["action_status"] == "add_data" || $_POST["action_status"] == "edit_data" || $_POST["action_status"] == "view_data") {
    if ($_POST["action_status"] == "add_data" || $_POST["action_status"] == "edit_data") {
      $input = array("body" => array("id" => $_POST["data_id"]));
      $action_status = $_POST["action_status"];
      $is_read_only = '';
      $is_disable_span = '';
    } elseif ($_POST["action_status"] == "view_data") {
      $input = array("body" => array("id" => $_POST["data_id"]));
      $action_status = $_POST["action_status"];
      $is_read_only = 'readonly=true';
      $is_disable_span = 'hidden';
    }
    $hasil = get_transaction_detail($input);
    if (is_array($hasil) && count($hasil)) {
      foreach ($hasil as $row) :
        $hasil = insert_transaction_detail($input);
        $v_id = $row['id'];
        $v_account_id = $row['account_id'];
        $v_account_name = $row['account_name'];
        $v_debet = $row['debet'];
        $v_credit = $row['credit'];
        $v_decription = $row['description'];
      endforeach;
    } else {
      $v_id = '';
      $v_account_id = '';
      $v_account_name = '';
      $v_debet = 0;
      $v_credit = 0;
      $v_decription = '';
    }
    $output .= '
      <form method="post" id="update_form">
        <input type="hidden" name="transaction_id" id="jq_transaction_id" value="' . $_POST["transaction_id"] . '" readonly="true">
        <input type="hidden" name="action_status" id="jq_action_status" value="' . $action_status . '" readonly="true">
        <input type="hidden" name="id" id="jq_id" value="' . $v_id . '" readonly=true/>
        <table id="input_data" class="table table-striped table-bordered" style="width:100%">
          <tr>
            <td><label>Description</label></td>
            <td><textarea name="description" id="jq_description" class="form-control" ' . $is_read_only . '>' . $v_decription . '</textarea></</td>
          </tr>
          <tr>
            <td><label>Account*</label></td>
            <td>
               <div class="input-group">
                  <input type="hidden" name="account_id" id="jq_account_id" value="' . $v_account_id . '" class="form-control" readonly=true/>
                  <input type="text" name="account_name" id="jq_account_name" value="' . $v_account_name . '" class="form-control" readonly=true/>
                  <span class="input-group-btn" ' . $is_disable_span . '>
                     <button type="button" name="choose_account_data" id="jq_choose_account_data" class="btn btn-warning btn-xs choose_account_data"><i class="fa fa-hand-o-up"></i></button>
                  </span>
               </div>
            </td>
         </tr>
          <tr>
            <td><label>Debet*</label></td>
            <td> <input type="number" name="debet" id="jq_debet" value="' . $v_debet . '" class="form-control jq_input_numeric"/></td>
          </tr>
          <tr>
            <td><label>Credit*</label></td>
            <td> <input type="number"  name="credit" id="jq_credit" value="' . $v_credit . '" class="form-control jq_input_numeric" /></td>
          </tr>
      </table>
         <span class="input-group-btn" ' . $is_disable_span . '>
           <input type="button" name="update" id="jq_update" value="Update" class="btn btn-success update_detail" />
         </span>
    </form>
      ';
  } elseif ($_POST["action_status"] == "refresh_list_general_journal_detail") {
    $sum_debet = 0;
    $sum_credit = 0;
    $output .= '
      <table id="data_general_journal_table" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr>
            <th>Description</th>
            <th>Account</th>
            <th>Debet</th>
            <th>Credit</th>
            <th>Option</th>
          </tr>
        </thead>
        <tbody>
      ';
    $input = array("body" => array("general_journal_id" => $_POST["transaction_id"]));
    $hasil = get_transaction_detail($input);
    if (is_array($hasil) && count($hasil)) {
      foreach ($hasil as $row) :
        $hasil = insert_transaction_detail($input);
        $output .= '
          <tr>
            <td>' . $row["description"] . '</td>
            <td>' . $row["account_name"] . '</td>
            <td class ="jq_format_decimal_table">' . $row["debet"] . '</td>
            <td class ="jq_format_decimal_table">' . $row["credit"] . '</td>
            <td><button type="button" name="view" id="' . $row["id"] . '" class="btn btn-info btn-xs view_data"><i class="fa fa-eye"></i></button>
                <button type="button" name="edit" id="' . $row["id"] . '" class="btn btn-warning btn-xs edit_data"><i class="fa fa-pencil-square"></i></button>                                  
                <button type="button" name="remove" id="' . $row["id"] . '" class="btn btn-danger btn-xs delete_data"><i class="fa fa-trash"></i></button></td>
            </tr>
        ';
        $sum_debet = $sum_debet + $row["debet"];
        $sum_credit = $sum_credit + $row["credit"];
      endforeach;
    }
    $output .=
      '</tbody>
      <tfoot>
        <tr>
          <th colspan = 2></th>
          <th id="jq_th_debet" class ="jq_format_decimal_table">' . $sum_debet . '</th>
          <th id="jq_th_credit" class ="jq_format_decimal_table">' . $sum_credit . '</th>
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
  } elseif ($_POST['action_status'] == 'choose_account_data') {
    $output .= '
      <table id="select_table" class="table table-striped table-bordered" style="width:100%">
         <thead>
         <tr>
            <th width="40%">Account Code</th>
            <th width="40%">Account Name</th>
            <th width="20%">Option</th> 
         </tr>
      </thead>
      <tbody>
      ';
    $input = ['body' => ['id' => null]];
    $hasil = get_account_data($input);
    if (is_array($hasil) && count($hasil)) {
      foreach ($hasil as $row) :
        $hasil = insert_transaction_detail($input);
        $output .= '
            <tr>  
               <td>' . $row["account_code"] . '</td>
               <td>' . $row["account_name"] . '</td>
               <td><button type="button" name="select" id="' . $row["id"] . '" class="btn btn-warning btn-xs select_account_data">Select</button>                                  
               </td>
            </tr>
         ';
      endforeach;
    }
    $output .= '</tbody></table>';
  }
  echo $output;
}
