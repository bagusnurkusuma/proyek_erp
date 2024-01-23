<?php
//Mengambil Transaction Number
function get_transaction_number($input_function)
{
    include "../asset_default/koneksi.php";
    $input = array("body" => array("table_name" => "purchasing.quick_purchase", "transaction_name" => "quick_purchase", "created_by" => $input_function));
    $input = json_encode($input);
    $query = "SELECT settings.get_new_transaction_number_and_primary_key('" . $input . "') as result";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch();
    $results = json_decode($row['result'], true);
    $results = $results['body'];
    return $results;
}

//Mengambil Default
function get_default($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function);
    $query = "SELECT purchasing.get_default_for_quick_purchase('" . $input . "') as result";
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
    $query = "SELECT purchasing.list_quick_purchase_detail('" . $input . "') as result";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch();
    $results = json_decode($row['result'], true);
    $results = $results['body'];
    return $results;
}

//Mengambil Inventory List
function get_inventory_for_transaction($input_function)
{
    include "../asset_default/koneksi.php";
    $input = array("body" => array("quick_purchase_id" => $input_function));
    $input = json_encode($input);
    $query = "SELECT purchasing.list_inventory_for_quick_purchase_detail('" . $input . "') as result";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch();
    $results = json_decode($row['result'], true);
    $results = $results['body'];
    return $results;
}

//Insert Transaction Detail
function insert_transaction_detail($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function);
    $query = "SELECT purchasing.insert_inventory_for_quick_purchase_detail('" . $input . "') as result";
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
    $query = "SELECT purchasing.set_new_quick_purchase_detail('" . $input . "') as result";
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

//Validate Quick Purchase
function validate_data($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function);
    $query = "SELECT purchasing.validate_quick_purchase_completed('" . $input . "') as result";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch();
    $results = json_decode($row['result'], true);
    $results = $results['body'];
    return $results;
}

//Pay Transaction
function pay_transaction($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function);
    $query = "SELECT purchasing.set_new_quick_purchase('" . $input . "') as result";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch();
    $results = json_decode($row['result'], true);
    $results = $results['body'];
    return $results;
}

// Get Data Supplier
function get_data_supplier($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function);
    $query = "SELECT master.list_master_supplier('" . $input . "') as result";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch();
    $results = json_decode($row['result'], true);
    $results = $results['body'];
    return $results;
}

// Get Data Warehouse
function get_data_warehouse($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function);
    $query = "SELECT master.list_master_warehouse('" . $input . "') as result";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch();
    $results = json_decode($row['result'], true);
    $results = $results['body'];
    return $results;
}

//Mengambil Summary Transaction
function get_summary_transaction_detail($input_function)
{
    $hasil = 0;
    $input = array("body" => array("quick_purchase_id" => $input_function));
    $result = get_transaction_detail($input);
    if (is_array($result) && count($result)) {
        foreach ($result as $baris) :
            $hasil = $hasil + $baris["grand_total"];
        endforeach;
    }
    return $hasil;
}
