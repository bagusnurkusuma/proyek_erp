<?php
require_once "api.php";
require_once "../asset_default/global_function.php";
if (!empty($_POST)) {
   $_POST = casting_htmlentities_array($_POST);
   $output = '';
   if ($_POST['action_status'] == 'refresh_data_detail') {
      $sum_debet = 0;
      $sum_credit = 0;
      $sum_ending = 0;
      $sum_amount_debet = 0;
      $sum_amount_credit = 0;
      $output .= '
      <table id="datatable" class="table table-striped table-bordered" style="width:100%">
         <thead>
         <tr>
            <th width="2%">No</th>
            <th>Trx Date</th>
            <th>Trx Number</th>
            <th>Batch Number</th>
            <th>Expired Date</th>
            <th>Beginning</th>
            <th>Debet</th>
            <th>Credit</th>
            <th>Ending</th>
            <th>Unit Price</th>
            <th>Ammount Debet</th>
            <th>Ammount Credit</th>
            <th>Warehouse</th>
         </tr>
      </thead>
      <tbody>
      ';
      $input = array("body" =>
      array(
         "start_date" => $_POST["start_date"],
         "end_date" => $_POST["end_date"],
         "inventory_id" => $_POST["inventory_id"],
         "warehouse_id" => $_POST["warehouse_id"],
         "batch_number" => '',
         "unit_id" => $_POST["unit_id"],
         "is_show_unsettled_batch_before_period" => true,
         "sort_mode_id" => $_POST["sort_mode"],
      ));
      $hasil = get_data_detail($input);
      if (is_array($hasil) && count($hasil)) {
         foreach ($hasil as $row) :
            $row = casting_htmlentities_array($row);
            $output .= '
            <tr>  
               <td align ="right">' . $row["no"] . '</td>
               <td class ="jq_format_date_table">' . $row["transaction_date"] . '</td>
               <td>' . $row["transaction_number"] . '</td>
               <td>' . $row["batch_number"] . '</td>
               <td class ="jq_format_date_table">' . $row["expired_date"] . '</td>
               <td class ="jq_format_decimal_table">' . $row["beginning"] . '</td>
               <td class ="jq_format_decimal_table">' . $row["debet"] . '</td>
               <td class ="jq_format_decimal_table">' . $row["credit"] . '</td>
               <td class ="jq_format_decimal_table">' . $row["ending"] . '</td>
               <td class ="jq_format_decimal_table">' . $row["unit_price"] . '</td>
               <td class ="jq_format_decimal_table">' . $row["amount_debet"] . '</td>
               <td class ="jq_format_decimal_table">' . $row["amount_credit"] . '</td>
               <td>' . $row["warehouse_name"] . '</td>
            </tr>
         ';
            $sum_debet = $sum_debet + $row["debet"];
            $sum_credit = $sum_credit + $row["credit"];
            if (!empty($row["ending"])) {
               $sum_ending = $sum_ending + $row["ending"];
            }
            $sum_amount_debet = $sum_amount_debet + $row["amount_debet"];
            $sum_amount_credit = $sum_amount_credit + $row["amount_credit"];
         endforeach;
      }
      if ($_POST["sort_mode"] == '2') {
         $sum_ending = '';
      }
      $output .= '</tbody>
      <tfoot>
            <tr>
                <th colspan = 6></th>
                <th class ="jq_format_decimal_table">' . $sum_debet . '</th>
                <th class ="jq_format_decimal_table">' . $sum_credit . '</th>
                <th class ="jq_format_decimal_table">' . $sum_ending . '</th>
                <th></th>
                <th class ="jq_format_decimal_table">' . $sum_amount_debet . '</th>
                <th class ="jq_format_decimal_table">' . $sum_amount_credit . '</th>
                <th></th>
            </tr>
        </tfoot>
      </table>';
   } elseif ($_POST['action_status'] == 'choose_warehouse_data') {
      $output .= '
      <table id="select_table" class="table table-striped table-bordered" style="width:100%">
         <thead>
         <tr>
            <th width="40%">Warehouse Code</th>
            <th width="40%">Warehouse Name</th>
            <th width="20%">Option</th> 
         </tr>
      </thead>
      <tbody>
      ';
      $input = ['body' => ['id' => null]];
      $hasil = get_data_warehouse($input);
      if (is_array($hasil) && count($hasil)) {
         foreach ($hasil as $row) :
            $row = casting_htmlentities_array($row);
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
   } elseif ($_POST['action_status'] == 'choose_inventory_data') {
      $output .= '
      <table id="select_table" class="table table-striped table-bordered" style="width:100%">
         <thead>
         <tr>
            <th width="40%">Inventory Code</th>
            <th width="40%">Inventory Name</th>
            <th width="40%">Inventory Category</th>
            <th width="20%">Option</th> 
         </tr>
      </thead>
      <tbody>
      ';
      $input = ['body' => ['id' => null]];
      $hasil = get_data_inventory($input);
      if (is_array($hasil) && count($hasil)) {
         foreach ($hasil as $row) :
            $row = casting_htmlentities_array($row);
            $output .= '
            <tr>  
               <td>' . $row["inventory_code"] . '</td>
               <td>' . $row["inventory_name"] . '</td>
               <td>' . $row["inventory_category_name"] . '</td>
               <td><button type="button" name="select" id="' . $row["id"] . '" class="btn btn-warning btn-xs select_inventory_data">Select</button>                                  
               </td>
            </tr>
         ';
         endforeach;
      }
      $output .= '</tbody></table>';
   } elseif ($_POST['action_status'] == 'choose_unit_data') {
      $output .= '
      <table id="select_table" class="table table-striped table-bordered" style="width:100%">
         <thead>
         <tr>
            <th>Unit</th>
            <th>Option</th> 
         </tr>
      </thead>
      <tbody>
      ';
      $input = ['body' => ['id' => $_POST['data_id']]];
      $hasil = get_data_unit($input);
      if (is_array($hasil) && count($hasil)) {
         foreach ($hasil as $row) :
            $row = casting_htmlentities_array($row);
            $output .= '
            <tr>  
               <td>' . $row["unit_name"] . '</td>
               <td><button type="button" name="select" id="' . $row["id"] . '" class="btn btn-warning btn-xs select_unit_data">Select</button>                                  
               </td>
            </tr>
         ';
         endforeach;
      }
      $output .= '</tbody></table>';
   }
   echo $output;
}
