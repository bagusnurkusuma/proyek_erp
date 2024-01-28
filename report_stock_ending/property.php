<?php
require_once "api.php";
require_once "../asset_default/global_function.php";

function get_detail_ending_tabel($arg_concat_id)
{
   $sum_amount = 0;
   $sum_qty_available = 0;
   $output =
      '<td colspan = 8>
      <table id="detail_ending_table' . $arg_concat_id . '" class="table table-striped table-bordered mt-2">
      <thead>
         <tr>
            <th>Batch Number</th>
            <th>Expired Date</th>
            <th>Qty Available</th>
            <th>Unit Price</th>
            <th>Amount</th>
         </tr>     
      </thead>
      <tbody>
      ';
   $input = ['body' => ['concat_id' => $arg_concat_id]];
   $hasil = get_data_ending_detail($input);
   if (is_array($hasil) && count($hasil)) {
      foreach ($hasil as $row) :
         $row = casting_htmlentities_array($row);
         $output .= '
            <tr>
               <td>' . $row["batch_number"] . '</td>
               <td class =" jq_format_date_table">' . $row["expired_date"] . '</td>
               <td class ="jq_format_decimal_table">' . $row["qty_available"] . '</td>
               <td class ="jq_format_decimal_table">' . $row["unit_price"] . '</td>
               <td class ="jq_format_decimal_table">' . $row["amount"] . '</td>
            </tr>';
         $sum_qty_available = $sum_qty_available + $row["qty_available"];
         $sum_amount = $sum_amount + $row["amount"];
      endforeach;
   }
   $output .=
      '</tbody>
      <tfoot>
            <tr>
               <th colspan = 2></th>
               <th class ="jq_format_decimal_table">' . $sum_qty_available . '</th>
               <th></th>
               <th class ="jq_format_decimal_table">' . $sum_amount . '</th>
            </tr>
        </tfoot>
      </table></td>';
   return $output;
}

if (!empty($_POST)) {
   $_POST = casting_htmlentities_array($_POST);
   $output = '';
   if ($_POST['action_status'] == 'refresh_data_detail') {
      $sum_amount = 0;
      $output .= '
      <table id="datatable" class="table table-striped table-bordered" style="width:100%">
         <thead>
         <tr>
            <th width="2%">Option</th>
            <th>Inventory Code</th>
            <th>Inventory Name</th>
            <th>Qty Available</th>
            <th>Unit</th>
            <th>Warehouse</th>
            <th>Avg Unit Price</th>
            <th>Amount</th>
         </tr>
      </thead>
      <tbody>
      ';
      $input = array("body" =>
      array(
         "inventory_id" => $_POST["inventory_id"],
         "warehouse_id" => $_POST["warehouse_id"]
      ));
      $hasil = get_data_detail($input);
      if (is_array($hasil) && count($hasil)) {
         foreach ($hasil as $row) :
            $row = casting_htmlentities_array($row);
            $output .= '
            <tr id="' . $row["concat_id"] . '">  
               <td><button name="view" id="' . $row["concat_id"] . '" class="btn btn-round btn-xs btn-info show_ending_detail"><i class="fa fa-chevron-down"></i></button></td>
               <td>' . $row["inventory_code"] . '</td>
               <td>' . $row["inventory_name"] . '</td>
               <td class ="jq_format_decimal_table">' . $row["qty_available"] . '</td>
               <td>' . $row["unit_name"] . '</td>
               <td>' . $row["warehouse_name"] . '</td>
               <td class ="jq_format_decimal_table">' . $row["avg_unit_price"] . '</td>
               <td class ="jq_format_decimal_table">' . $row["amount"] . '</td>
            </tr>
         ';
            $sum_amount = $sum_amount + $row["amount"];
         endforeach;
      }
      $output .= '</tbody>
      <tfoot>
            <tr>
                <th colspan = 7></th>
                <th class ="jq_format_decimal_table">' . $sum_amount . '</th>
            </tr>
        </tfoot>
      </table>';
   } elseif ($_POST['action_status'] == 'show_ending_detail') {
      $output = get_detail_ending_tabel($_POST['concat_id']);
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
   }
   echo $output;
}
