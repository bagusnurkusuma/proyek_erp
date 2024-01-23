<?php
function get_detail_ledger_tabel($arg_start_date, $arg_end_date, $arg_account_id, $arg_colspan)
{
   $sum_debet = 0;
   $sum_credit = 0;
   $output =
      '<td colspan=' . $arg_colspan . '>
      <table id="detail_ledger_table' . $arg_account_id . '" class="table table-striped table-bordered mt-2">
      <thead>
         <tr>
            <th width="2%">No</th>
            <th width="2%">Option</th>
            <th>Trx Number</th>
            <th>Trx Date</th>
            <th>Trx Name</th>
            <th>Debet</th>
            <th>Credit</th>
            <th>Ending</th>
         </tr>     
      </thead>
      <tbody>
      ';
   $input = ['body' => ['start_date' => $arg_start_date, 'end_date' => $arg_end_date, 'account_id' => $arg_account_id]];
   $hasil = get_data_ledger_detail($input);
   if (is_array($hasil) && count($hasil)) {
      foreach ($hasil as $row) :
         $output .= '
            <tr>
               <td align ="right">' . $row["no"] . '</td>
               <td><button name="view" id="' . $row["id"] . '" class="btn btn-round btn-xs btn-info show_journal_detail"><i class="fa fa-briefcase"></i></button></td>
               <td>' . $row["transaction_number"] . '</td>
               <td class =" jq_format_date_table">' . $row["transaction_date"] . '</td>
               <td>' . $row["transaction_name"] . '</td>
               <td class ="jq_format_decimal_table">' . $row["debet"] . '</td>
               <td class ="jq_format_decimal_table">' . $row["credit"] . '</td>
               <td class ="jq_format_decimal_table">' . $row["ending"] . '</td>
            </tr>';
         $sum_debet = $sum_debet + $row["debet"];
         $sum_credit = $sum_credit + $row["credit"];
      endforeach;
   }
   $output .=
      '</tbody>
      <tfoot>
            <tr>
               <th colspan = 5></th>
               <th class ="jq_format_decimal_table">' . $sum_debet . '</th>
               <th class ="jq_format_decimal_table">' . $sum_credit . '</th>
               <th></th>
            </tr>
        </tfoot>
      </table></td>';
   return $output;
}
include "api.php";
if (!empty($_POST)) {
   $output = '';
   if ($_POST['action_status'] == 'refresh_data_main_table') {
      $output .= '
        <table id="main_table" class="table table-striped table-bordered mt-2">
        <thead>
            <tr>
                <th width="2%">Option</th>
                <th id="account">Account</th>
                <th>Beginning</th>
                <th>Debet</th>
                <th>Credit</th>
                <th>Ending</th>
            </tr>
        </thead>
        <tbody>';
      $sum_beginning = 0;
      $sum_debet = 0;
      $sum_credit = 0;
      $sum_ending = 0;
      $input = array("body" =>
      array(
         "start_date" => $_POST["start_date"],
         "end_date" => $_POST["end_date"],
         "account_id" => $_POST["account_id"]
      ));
      $hasil = get_data_detail($input);
      if (is_array($hasil) && count($hasil)) {
         foreach ($hasil as $row) :
            $output .= '
                <tr id= ' . $row["account_id"] . ' class=' . $row["parent_id"] . ' data-level=' . $row["level"] . ' data-type="account">
                    <td><button name="view" id="' . $row["account_id"] . '" class="btn btn-round btn-xs btn-info show_ledger_detail"><i class="fa fa-chevron-down"></i></button></td>       
                    <td id="structure_name">' . $row["account_concat"] . ' </td>
                    <td id="beginning" class="jq_format_decimal_table">' . $row["beginning"] . '</td>
                    <td id="debet" class="jq_format_decimal_table">' . $row["debet"] . '</td>
                    <td id="credit" class="jq_format_decimal_table">' . $row["credit"] . ' </td>
                    <td id="ending" class="jq_format_decimal_table">' . $row["ending"] . '</td>
                </tr>';
            $sum_beginning = $sum_beginning + $row["beginning"];
            $sum_debet = $sum_debet + $row["debet"];
            $sum_credit = $sum_credit + $row["credit"];
            $sum_ending = $sum_ending + $row["ending"];
         endforeach;
      }
      $output .= '
        </tbody>
        <tfoot id="footer_main_table" class="table table-striped table-bordered mt-2">
            <tr>
                <th colspan="2"></th>
                <th class="jq_format_decimal_table">' . $sum_beginning . '</th>
                <th class="jq_format_decimal_table">' . $sum_debet . ' </th>
                <th class="jq_format_decimal_table">' . $sum_credit . ' </th>
                <th class="jq_format_decimal_table">' . $sum_ending . ' </th>
            </tr>
        </tfoot>
        </table>';
   } elseif ($_POST['action_status'] == 'refresh_data_structure_table') {
      $output .= '<table id="structure_table">';
      $hasil = get_data_structure(null);
      if (is_array($hasil) && count($hasil)) {
         foreach ($hasil as $row) :
            $output .=
               '<tr id=' . $row["account_id"] . ' class=' . $row["parent_id"] . ' data-level=' . $row["level"] . '>
                        <td>' . $row["account_concat"] . '</td>
                 </tr>';
         endforeach;
      }
      $output .= '</tbody></table>';
   } elseif ($_POST['action_status'] == 'refresh_data_detail_ledger') {
      $output = get_detail_ledger_tabel($_POST['start_date'], $_POST['end_date'], $_POST['account_id'], $_POST['colspan']);
   } elseif ($_POST['action_status'] == 'show_journal_detail') {
      $sum_debet = 0;
      $sum_credit = 0;
      $output .= '
      <table id="select_table" class="table table-striped table-bordered" style="width:100%">
         <thead>
         <tr>
            <th width="2%">No</th>
            <th>Account Code</th>
            <th>Account Name</th>
            <th>Debet</th> 
            <th>Credit</th> 
         </tr>
      </thead>
      <tbody>
      ';
      $input = ['body' => ['journal_id' => $_POST['data_id']]];
      $hasil = get_data_journal($input);
      if (is_array($hasil) && count($hasil)) {
         foreach ($hasil as $row) :
            $output .= '
            <tr>  
               <td align ="right">' . $row["no"] . '</td>
               <td>' . $row["account_code"] . '</td>
               <td>' . $row["account_name"] . '</td>
               <td class ="jq_format_decimal_table">' . $row["debet"] . '</td>
               <td class ="jq_format_decimal_table">' . $row["credit"] . '</td>
            </tr>
         ';
            $sum_debet = $sum_debet + $row["debet"];
            $sum_credit = $sum_credit + $row["credit"];
         endforeach;
      }
      $output .= '</tbody>
      <tfoot>
            <tr><th colspan = 3></th>
                <th class ="jq_format_decimal_table">' . $sum_debet . '</th>
                <th class ="jq_format_decimal_table">' . $sum_credit . '</th>
            </tr>
        </tfoot>
      </table>';
   } elseif ($_POST['action_status'] == 'choose_filter_account_data') {
      $output .= '
      <table id="select_table" class="table table-striped table-bordered" style="width:100%">
         <thead>
         <tr>
            <th>Account</th>
            <th>Option</th> 
         </tr>
      </thead>
      <tbody>
      ';
      $input = ['body' => ['id' => null]];
      $hasil = get_data_account($input);
      if (is_array($hasil) && count($hasil)) {
         foreach ($hasil as $row) :
            $output .= '
            <tr>  
               <td>' . $row["account_concat"] . '</td>
               <td><button type="button" name="select" id="' . $row["id"] . '" class="btn btn-warning btn-xs select_filter_account_data">Select</button>                                  
               </td>
            </tr>
         ';
         endforeach;
      }
      $output .= '</tbody></table>';
   }
   echo $output;
}
