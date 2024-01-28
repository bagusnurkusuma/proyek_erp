<?php
function get_data_detail($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT config.list_finance_report_structure(:input) as result";
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

function get_finance_report_type($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT config.get_all_finance_report(:input) as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query, $input);
}

function set_new_finance_report_account($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT config.set_new_finance_report_account(:input) as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query, $input);
}

function remove_transaction_detail($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT settings.remove_permanent_data(:input) as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query, $input);
}

function get_account_data($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT config.list_account_for_finance_report_structure(:input) as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query, $input);
}

function format_decimal($input_function)
{
    return number_format($input_function, 2, ',', '.');
}

function format_date($input_function)
{
    return date("d M Y", strtotime($input_function));
}
