<?php
function get_data_detail($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function);
    $query = "SELECT inventory.list_stock_ending('" . $input . "') as result";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch();
    $results = json_decode($row['result'], true);
    $results = $results['body'];
    return $results;
}

function get_data_ending_detail($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function);
    $query = "SELECT inventory.list_stock_ending_detail_batch('" . $input . "') as result";
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

// Get Data Inventory
function get_data_inventory($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function);
    $query = "SELECT master.list_master_inventory('" . $input . "') as result";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch();
    $results = json_decode($row['result'], true);
    $results = $results['body'];
    return $results;
}
