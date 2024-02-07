<?php
function get_report_sales($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT pos.report_point_of_sales(:input) as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query, $input);
}
