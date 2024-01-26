<?php

function get_data_detail($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT master.list_master_inventory('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}

function get_data_detail_ratio($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT master.list_master_inventory_detail_ratio('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}

function set_new_data($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT master.set_new_master_inventory('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}

function set_new_data_detail_ratio($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT master.set_new_master_inventory_detail_ratio('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}
function archive_data($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT settings.archive_data('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}
function unarchive_data($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT settings.unarchive_data('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}

function validate_data($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT settings.validate_data('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}

function get_data_unit($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT master.list_master_unit('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}

function get_data_inventory_category($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT master.list_master_inventory_category('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}

//Remove Detail
function remove_detail($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT settings.remove_permanent_data('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}
