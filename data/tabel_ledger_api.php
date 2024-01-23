<?php

function get_data_detail($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function, true);
    $query = "SELECT * FROM accounting.list_ledger('" . $input . "') as result";
    $result = pg_query($link, $query);
    $row = pg_fetch_array($result);
    $hasil = json_decode($row["result"], true);
    $hasil = $hasil["body"];
    return $hasil;
}

function get_data_structure($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function);
    $query = "SELECT * FROM accounting.get_all_parent_account(null) as result";
    $result = pg_query($link, $query);
    $row = pg_fetch_array($result);
    $hasil = json_decode($row["result"], true);
    $hasil = $hasil["body"];
    return $hasil;
}

function get_data_ledger_detail($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function);
    $query = "SELECT accounting.list_ledger_detail('" . $input . "') as result";
    $result = pg_query($link, $query);
    $row = pg_fetch_array($result);
    $hasil = json_decode($row["result"], true);
    $hasil = $hasil["body"];
    return $hasil;
}

// Get Data Warehouse
function get_data_journal($input_function)
{
    include "../asset_default/koneksi.php";
    $input = json_encode($input_function);
    $query = "SELECT accounting.list_journal_ledger('" . $input . "') as result";
    $result = pg_query($link, $query);
    $row = pg_fetch_array($result);
    $hasil = json_decode($row["result"], true);
    $hasil = $hasil["body"];
    return $hasil;
}
