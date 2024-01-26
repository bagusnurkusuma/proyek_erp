<?php
//Mengambil Transaction Number
function get_transaction_number($input_function)
{
    $input = array("body" => array("table_name" => "inventory.material_conversion", "transaction_name" => "material_conversion", "created_by" => $input_function));
    $input = json_encode($input);
    $query = "SELECT settings.get_new_transaction_number_and_primary_key('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}

//Mengambil Detail Transaction Detail
function get_transaction_detail($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT inventory.list_material_conversion_detail('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}

//Mengambil Product List
function get_product_for_transaction($input_function)
{
    $input = array("body" => array("material_convertion_id" => $input_function));
    $input = json_encode($input);
    $query = "SELECT inventory.list_inventory_for_material_conversion('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}

//Insert Transaction Detail
function insert_transaction_detail($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT inventory.insert_inventory_for_material_conversion_detail('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}

//Update Transaction Detail
function update_transaction_detail($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT inventory.set_new_material_conversion_detail('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}

//Remove Transaction Detail
function remove_transaction_detail($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT settings.remove_permanent_data('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}

//Validate Material Conversion
function validate_data($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT inventory.validate_material_conversion_completed('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}

// Get Data Warehouse
function get_data_warehouse($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT master.list_master_warehouse('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}

// Get Data Inventory
function get_data_inventory($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT master.list_master_inventory('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}

// Get Data Unit
function get_data_unit($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT master.list_master_inventory_detail_ratio('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}
