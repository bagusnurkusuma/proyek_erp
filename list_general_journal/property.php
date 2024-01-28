<?php
function get_detail_pos_tabel($input_id)
{
    $sum_total_disc = 0;
    $sum_grand_total = 0;
    $output =
        '<td colspan=7>
      <table id="detail_ledger_table' . $input_id . '" class="table table-striped table-bordered mt-2">
      <thead>
         <tr>
            <th>Product Code</th>
            <th>Product Name</th>
            <th>Qty</th>
            <th>Unit Price</th>
            <th>Unit</th>
            <th>Total Disc</th>
            <th>Grand Total</th>
         </tr>     
      </thead>
      <tbody>
      ';
    $input = ['body' => ['point_of_sales_id' => $input_id]];
    $hasil = get_data_pos_detail($input);
    if (is_array($hasil) && count($hasil)) {
        foreach ($hasil as $row) :
            $row = casting_htmlentities_array($row);
            $output .= '
          <tr>
            <td>' . $row["product_code"] . '</td>
            <td>' . $row["product_name"] . '</td>
            <td class ="jq_format_decimal_table">' . $row["qty"] . '</td>
            <td class ="jq_format_decimal_table">' . $row["unit_price"] . '</td>
            <td>' . $row["unit_name"] . '</td>
            <td class ="jq_format_decimal_table">' . $row["total_disc"] . '</td>
            <td class ="jq_format_decimal_table">' . $row["grand_total"] . '</td>
         </tr>';
            $sum_total_disc = $sum_total_disc + $row["total_disc"];
            $sum_grand_total = $sum_grand_total + $row["grand_total"];
        endforeach;
    }
    $output .=
        '</tbody>
      <tfoot>
        <tr>
          <th colspan = 5></th>
          <th class ="jq_format_decimal_table">' . $sum_total_disc . '</th>
          <th id="jq_th_grand_total" class ="jq_format_decimal_table">' . $sum_grand_total . '</th>
        </tr>
      </tfoot></table></td>';
    return $output;
}
include "api.php";
if (!empty($_POST)) {
    $output = '';
    if ($_POST['action_status'] == 'refresh_data_detail') {
        $sum_total_disc = 0;
        $sum_grand_total = 0;
        $output .= '
      <table id="datatable" class="table table-striped table-bordered" style="width:100%">
         <thead>
         <tr>
            <th width="9%">Option</th>
            <th>Trx Number</th>
            <th>Trx Date</th>
            <th>Customer</th>
            <th>Outlet</th>
            <th>Total Disc</th>
            <th>Grand Total</th>
         </tr>
      </thead>
      <tbody>';
        $input = array("body" => array("data_id" => array("start_date" => $_POST['start_date'], "end_date" => $_POST['end_date'])));
        $hasil = get_data_detail($input);
        if (is_array($hasil) && count($hasil)) {
            foreach ($hasil as $row) :
                $row = casting_htmlentities_array($row);
                $output .= '
                <tr id="tr-' . $row["id"] . '"> 
                <td><button name="view" id="' . $row["id"] . '" class="btn btn-round btn-xs btn-info show_pos_detail"><i class="fa fa-chevron-down"></i></button>
                <button type="button" name="view" id="' . $row["id"] . '" class="btn btn-round btn-info btn-xs view_data"><i class="fa fa-eye"></i></button></td>
                <td>' . $row["transaction_number"] . '</td>
                <td class ="jq_format_date_table">' . $row["transaction_date"] . '</td>
                <td>' . $row["customer_name"] . '</td>
                <td>' . $row["outlet_name"] . '</td>
                <td class ="jq_format_decimal_table">' . $row["total_disc"] . '</td>
                <td class ="jq_format_decimal_table">' . $row["grand_total"] . '</td>
                </tr>';
                $sum_total_disc = $sum_total_disc + $row["total_disc"];
                $sum_grand_total = $sum_grand_total + $row["grand_total"];
            endforeach;
        }
        $output .= '</tbody>
      <tfoot>
            <tr>
                <th colspan = 5></th>
                <th class ="jq_format_decimal_table">' . $sum_total_disc . '</th>
                <th class ="jq_format_decimal_table">' . $sum_grand_total . '</th>
            </tr>
        </tfoot>
      </table>';
    } elseif ($_POST['action_status'] == 'refresh_data_detail_pos') {
        $output = get_detail_pos_tabel($_POST['transaction_id']);
    } elseif ($_POST['action_status'] == 'print_receipt') {
        $input = array("body" => array("id" => $_POST['transaction_id']));
        $hasil = get_data_detail($input);
        if (is_array($hasil) && count($hasil)) {
            foreach ($hasil as $row) :
                $row = casting_htmlentities_array($row);
                $trx_number = $row["transaction_number"];
                $trx_date = $row["transaction_date"];
                $customer = $row["customer_name"];
                $outlet = $row["outlet_name"];
                $grand_total = $row["grand_total"];
                $cash_total = $row["total_cash"];
                $change_total = $row["total_changes"];
            endforeach;
        }

        $output = '<html><head><title>POS Receipt</title>';
        $output .= '<style>
        hr {
            display: block;
            margin-top: 0.5em;
            margin-bottom: 0.5em;
            margin-left: auto;
            margin-right: auto;
            border-style: inset;
            border-width: 1px;
        }

        table {
            width: 300px;
            font-size: 15px;
            font-family: calibri;
            border-collapse: collapse;
        }

        .footer_header {
            width: 65%;
            text-align: right;
            font-family: calibri;
            font-size: 15px;
            color: black
        }

        .footer_content {
            width: 35%;
            text-align: right;
            vertical-align: center;
            font-family: calibri;
            font-size: 15px;
            color: black
        }

        .contet_numeric {
            text-align: right;
            vertical-align: center;
            font-family: calibri;
            font-size: 15px;
            color: black
        }

        .contet_text {
            vertical-align: center;
            font-family: calibri;
            font-size: 15px;
            color: black
        }
    </style>';
        $output .= '</head><body>';

        $output .= '<center>
        <table class="tb_header" border="0">
            <td align="center" vertical-align:top>
                <span style="color:black;"><b>' . $_POST['company_name'] . '</b></br>' . $_POST['company_addres'] . '</span></br>
                <span style="font-size:12pt">No .' . $trx_number . ', ' . format_date($trx_date) . '</span></br>
            </td>
        </table>(
        <table id="tb_content" cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td colspan="3">
                    <hr>
                </td>
            </tr>
            <tr>
                <td align="center" width="40%" class="contet_text">Product</td>
                <td align="right" width="25%" class="contet_text">Qty</td>
                <td align="right" width="35%" class="contet_text">Total</td>
            </tr>
            <tr>
                <td colspan="3">
                    <hr>
                </td>
            </tr>';
        $input = ['body' => ['point_of_sales_id' => $_POST['transaction_id']]];
        $hasil = get_data_pos_detail($input);
        if (is_array($hasil) && count($hasil)) {
            foreach ($hasil as $row) :
                $row = casting_htmlentities_array($row);
                $output .= '
                <tr>
                    <td>' . $row["product_name"] . '</td>
                    <td class ="contet_numeric">' . format_decimal($row["qty"]) . '</td>
                    <td class ="contet_numeric">' . format_decimal($row["grand_total"]) . '</td>
                </tr>';
            endforeach;
        }
        $output .= '
            <tr>
                <td colspan="3">
                    <hr>
                </td>
            </tr>
        </table>
        <table id="tb_foter" border="0">
            <tr>
                <td class="footer_header">Grand Total :</td>
                <td class="footer_content">' . format_decimal($grand_total) . '</td>
            </tr>
            <tr>
                <td class="footer_header">Cash :</td>
                <td class="footer_content">' . format_decimal($cash_total) . '</td>
            </tr>
            <tr>
                <td class="footer_header">Change :</td>
                <td class="footer_content">' . format_decimal($change_total) . '</td>
            </tr></br>
            <td colspan="2" align="center">****** THANK YOU ******</br></td>
            </tr>
        </table>\
    </center>
   
   ';

        $output .= '</body></html>';
    }
    echo $output;
}
