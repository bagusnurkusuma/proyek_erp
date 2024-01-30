<?php
function get_data_detail($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT master.list_master_employee(:input) as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query, $input);
}

function set_new_data($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT master.set_new_master_employee(:input) as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query, $input);
}

function get_users_detail($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT user_role.list_register_user(:input) as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query, $input);
}

function set_new_users($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT user_role.set_new_user(:input) as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query, $input);
}
