<?php
require_once "api.php";
require_once "../asset_default/global_function.php";
if (!empty($_POST)) {
    $_POST = casting_htmlentities_array($_POST);
    $output = '';
    if ($_POST['action_status'] == 'refresh_data_detail') {
        $output .= '
          <table id="report_sales_table" class="table table-striped table-bordered" style="width:100%">
             <thead>
             <tr>
                <th>Inventory Category</th>
                <th>Inventory</th>
                <th>Total</th>
                <th>Qty</th>
                <th>Unit</th>
             </tr>
          </thead>
          <tbody>';
        $input = array("body" => array("data_id" => null));
        $hasil = get_report_sales($input);
        if (is_array($hasil) && count($hasil)) {
            foreach ($hasil as $row) :
                $row = casting_htmlentities_array($row);
                //Config Button ditampilkan
                $output .= '
                    <tr>  
                    <td>' . $row["inventory_category_name"] . '</td>
                    <td>' . $row["inventory_name"] . '</td>
                    <td class ="jq_format_decimal_table">' . $row["total"] . '</td>
                    <td class ="jq_format_decimal_table">' . $row["qty"] . '</td>
                    <td>' . $row["unit_name"] . '</td>
                    </tr>';
            endforeach;
        }
        $output .= '</tbody></table>';
    }
    echo $output;
}
