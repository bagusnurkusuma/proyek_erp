<?php
//Mengambil Transaction Number
function get_transaction_number($input_function)
{
    $input = array("body" => array("table_name" => "accounting.general_journal", "transaction_name" => "general_journal", "created_by" => $input_function));
    $input = json_encode($input);
    $query = "SELECT settings.get_new_transaction_number_and_primary_key(:input) as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query, $input);
}

//Mengambil Detail Transaction Detail
function get_transaction_detail($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT accounting.list_general_journal_detail(:input) as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query, $input);
}

//Update Transaction Detail
function update_transaction_detail($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT accounting.set_new_general_journal_detail(:input) as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query, $input);
}

//Remove Transaction Detail
function remove_transaction_detail($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT settings.remove_permanent_data(:input) as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query, $input);
}

//Validate General Journal
function validate_data($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT accounting.validate_general_journal_completed(:input) as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query, $input);
}

// Get Data Supplier
function get_account_data($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT accounting.get_all_child_account(:input) as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query, $input);
}
