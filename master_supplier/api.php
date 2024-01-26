<?php
function htmlentities_array($array)
{
    foreach ($array as $key => $value) {
        $array[$key] = htmlentities($value);
    }
    return $array;
}

function get_data_detail($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT master.list_master_supplier('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}

function set_new_data($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT master.set_new_master_supplier('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}

function archive_data($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT settings.archive_data('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}
function unarchive_data($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT settings.unarchive_data('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}

function validate_data($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT settings.validate_data('" . $input . "') as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query);
}
