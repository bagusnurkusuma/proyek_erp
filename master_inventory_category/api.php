<?php

function get_data_detail($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT master.list_master_inventory_category(:input) as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query, $input);
}

function set_new_data($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT master.set_new_master_inventory_category(:input) as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query, $input);
}

function get_account_data($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT accounting.get_all_child_account(:input) as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}
