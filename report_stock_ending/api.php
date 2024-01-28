<?php
function get_data_detail($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT inventory.list_stock_ending(:input) as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query, $input);
}

function get_data_ending_detail($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT inventory.list_stock_ending_detail_batch(:input) as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query, $input);
}

// Get Data Warehouse
function get_data_warehouse($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT master.list_master_warehouse(:input) as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query, $input);
}

// Get Data Inventory
function get_data_inventory($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT master.list_master_inventory(:input) as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query, $input);
}
