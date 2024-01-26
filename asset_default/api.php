<?php

function get_company_profile()
{
    $query = "SELECT company.get_company_profile() as result";
    require_once "db_function.php";
    return get_execute_query($query);
}

function get_watermark()
{
    $query = "SELECT company.get_watermark() as result";
    require_once "db_function.php";
    return get_execute_query($query);
}

function get_menu_proces($input_function)
{
    $input = array("body" => array("created_by" => $input_function));
    $input = json_encode($input);
    $query = "SELECT user_role.get_user_menu_proces_by_user('" . $input . "') as result";
    require_once "db_function.php";
    return get_execute_query($query);
}

function get_images_by_file_id($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT file.get_file_images('" . $input . "') as result";
    require_once "db_function.php";
    return get_execute_query($query);
}
