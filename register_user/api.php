<?php

function set_new_user($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT user_role.set_new_user('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}
function set_new_user_role($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT user_role.set_new_user_role('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}

function get_data_detail($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT user_role.list_register_user('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}

function get_user_acces($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT user_role.get_menu_user_access('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}

function get_user_menu_proces($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT user_role.get_user_menu_process('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}

function set_new_user_acces($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT user_role.set_new_user_access('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}

function remove_transaction_detail($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT settings.remove_permanent_data('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}

function get_list_employee($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT user_role.list_master_employee_for_register_user('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}
