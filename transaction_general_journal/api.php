<?php
//Mengambil Transaction Number
function get_transaction_number($input_function)
{
    include "../asset_default/koneksi.php";
    $input = array("body" => array("table_name" => "accounting.general_journal", "transaction_name" => "general_journal", "created_by" => $input_function));
    $input = json_encode($input);
    $query = "SELECT settings.get_new_transaction_number_and_primary_key('" . $input . "') as result";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch();
    $results = json_decode($row['result'], true);
    $results = $results['body'];
    return $results;
}

//Mengambil Detail Transaction Detail
function get_transaction_detail($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function);
    $query = "SELECT accounting.list_general_journal_detail('" . $input . "') as result";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch();
    $results = json_decode($row['result'], true);
    $results = $results['body'];
    return $results;
}

//Update Transaction Detail
function update_transaction_detail($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function);
    $query = "SELECT accounting.set_new_general_journal_detail('" . $input . "') as result";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch();
    $results = json_decode($row['result'], true);
    $results = $results['body'];
    return $results;
}

//Remove Transaction Detail
function remove_transaction_detail($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function);
    $query = "SELECT settings.remove_permanent_data('" . $input . "') as result";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch();
    $results = json_decode($row['result'], true);
    $results = $results['body'];
    return $results;
}

//Validate General Journal
function validate_data($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function);
    $query = "SELECT accounting.validate_general_journal_completed('" . $input . "') as result";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch();
    $results = json_decode($row['result'], true);
    $results = $results['body'];
    return $results;
}

// Get Data Supplier
function get_account_data($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function);
    $query = "SELECT accounting.get_all_child_account('" . $input . "') as result";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch();
    $results = json_decode($row['result'], true);
    $results = $results['body'];
    return $results;
}
