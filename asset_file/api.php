<?php
function get_images_by_file_id($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT file.get_file_images('" . $input . "') as result";
    require_once "db_function.php";
    return get_execute_query($query);
}
