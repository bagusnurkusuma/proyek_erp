<?php
function get_data_detail($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT accounting.list_ledger('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}

function get_data_structure($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT * FROM accounting.get_all_parent_account(null) as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}

function get_data_ledger_detail($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT accounting.list_ledger_detail('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}

function get_data_journal($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT accounting.list_journal_ledger('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}

function get_data_account($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT master.list_master_account('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}
