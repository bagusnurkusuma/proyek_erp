<?php
function get_data_detail($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function);
    $query = "SELECT pos.list_point_of_sales('" . $input . "') as result";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch();
    $results = json_decode($row['result'], true);
    $results = $results['body'];
    return $results;
}

function get_data_pos_detail($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function);
    $query = "SELECT pos.list_point_of_sales_detail('" . $input . "') as result";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch();
    $results = json_decode($row['result'], true);
    $results = $results['body'];
    return $results;
}

function format_decimal($input_function)
{
    return number_format($input_function, 2, ',', '.');
}

function format_date($input_function)
{
    return date("d M Y", strtotime($input_function));
}
