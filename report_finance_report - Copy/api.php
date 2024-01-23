<?php
function get_data_detail($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function);
    $query = "SELECT config.list_finance_report_structure('" . $input . "') as result";
    $result = pg_query($link, $query);
    $row = pg_fetch_array($result);
    $hasil = json_decode($row["result"], true);
    $hasil = $hasil["body"];
    return $hasil;
}

function get_data_pos_detail($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function);
    $query = "SELECT pos.list_point_of_sales_detail('" . $input . "') as result";
    $result = pg_query($link, $query);
    $row = pg_fetch_array($result);
    $hasil = json_decode($row["result"], true);
    $hasil = $hasil["body"];
    return $hasil;
}

function get_finance_report_type($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function);
    $query = "SELECT config.get_all_finance_report('" . $input . "') as result";
    $result = pg_query($link, $query);
    $row = pg_fetch_array($result);
    $hasil = json_decode($row["result"], true);
    $hasil = $hasil["body"];
    return $hasil;
}

function format_decimal($input_function)
{
    return number_format($input_function, 2, ',', '.');
}

function format_date($input_function)
{
    return date("d M Y", strtotime($input_function));
}
