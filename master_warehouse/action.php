<?php
session_start();
require_once "api.php";
//Action
if (!empty($_POST)) {
   if ($_POST["action_status"] == "edit_detail") {
      //Edit Data
      $input = array("body" =>
      array(
         "id" => $_POST["id"],
         "created_by" => $_SESSION['user_role_id'],
         "code" => $_POST["code"],
         "name" => $_POST["name"],
         "desc" => $_POST["desc"]
      ));
      set_new_data($input);
   } elseif ($_POST["action_status"] == "insert_detail") {
      //Insert Data
      $input = array("body" =>
      array(
         "created_by" => $_SESSION['user_role_id'],
         "code" => $_POST["code"],
         "name" => $_POST["name"],
         "desc" => $_POST["desc"]
      ));
      set_new_data($input);
   } elseif ($_POST["action_status"] == "archive_detail") {
      //Archive Data
      $input = array("body" =>
      array(
         "id" => $_POST["id"],
         "created_by" => $_SESSION['user_role_id'],
         "archive_reason" => $_POST["archive_reason"],
         "table_name" => "master.warehouse",
         "column_name" => "id"
      ));
      archive_data($input);
   } elseif ($_POST["action_status"] == "unarchive_data") {
      //Unarchive Data
      $input = array("body" =>
      array(
         "id" => $_POST["data_id"],
         "created_by" => $_SESSION['user_role_id'],
         "table_name" => "master.warehouse",
         "column_name" => "id"
      ));
      unarchive_data($input);
   } elseif ($_POST["action_status"] == "validate_data") {
      //Validate Data
      $input = array(
         "body" =>
         array(
            "table_name" => "master.warehouse",
            "id" => $_POST["id"],
            "for_check" => array(
               "warehouse_code" => $_POST["code"],
               "warehouse_name" => $_POST["name"]
            )
         )
      );
      echo json_encode(validate_data($input));
   }
}
