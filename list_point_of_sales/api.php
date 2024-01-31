<?php
function get_data_detail($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT pos.list_point_of_sales(:input) as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query, $input);
}

function get_data_pos_detail($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT pos.list_point_of_sales_detail(:input) as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query, $input);
}
