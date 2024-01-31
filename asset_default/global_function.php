<?php
session_start();
function check_user_menu_acces($input_function)
{
    if (!empty($_SESSION["user_role_id"])) {
        $hasil = $_SESSION["menu_proces"];
        $is_allow_menu_acces = false;
        if (is_array($hasil) && count($hasil)) {
            foreach ($hasil as $row) :
                if ($row["id"] == $input_function) {
                    $is_allow_menu_acces = true;
                    $_SESSION["jq_process_name"] = $row["menu_name"];
                    break;
                }
            endforeach;
        }
        if ($is_allow_menu_acces == true) {
            include_once "../asset_default/side_bar.php";
            return $is_allow_menu_acces;
        } else {
            header($_SESSION["go_to_home_pages"]);
            exit;
        }
    } else {
        header("location:../asset_default/login.html");
        exit;
    }
}

function casting_htmlentities_array($array)
{
    foreach ($array as $key => $value) {
        $array[$key] = htmlspecialchars($value);
    }
    return $array;
}

function archive_master_data($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT settings.archive_data(:input) as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query, $input);
}

function unarchive_master_data($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT settings.unarchive_data(:input) as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query, $input);
}

function validate_master_data($input_function)
{
    $input = json_encode($input_function);
    $query = "SELECT settings.validate_data(:input) as result";
    require_once "../asset_default/db_function.php";
    return get_execute_query($query, $input);
}

function format_decimal($input_function)
{
    return number_format($input_function, 2, ',', '.');
}

function format_date($input_function)
{
    return date("d M Y", strtotime($input_function));
}
