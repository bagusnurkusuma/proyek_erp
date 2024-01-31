<?php
function get_data_detail($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT inventory.list_stock_ledger(:input) as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query, $input);
}
function get_sort_mode()
{
    $query = "SELECT inventory.get_stock_ledger_sort_mode() as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
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

// Get Data Unit
function get_data_unit($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT master.list_master_inventory_detail_ratio(:input) as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query, $input);
}
