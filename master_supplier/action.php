<?php
require_once "api.php";
require_once "../asset_default/global_function.php";
if (!empty($_POST)) {
   if ($_POST["action_status"] == "edit_detail") {
      //Edit Data
      $input = array("body" =>
      array(
         "id" => $_POST["id"],
         "created_by" => $_SESSION['user_role_id'],
         "supplier" => $_POST["supplier"],
         "email" => $_POST["email"],
         "telp" => $_POST["telepon"],
         "addres" => $_POST["address"],
         "desc" => $_POST["desc"]
      ));
      set_new_data($input);
   } elseif ($_POST["action_status"] == "insert_detail") {
      //Insert Data
      $input = array("body" =>
      array(
         "created_by" => $_SESSION['user_role_id'],
         "supplier" => $_POST["supplier"],
         "email" => $_POST["email"],
         "telp" => $_POST["telepon"],
         "addres" => $_POST["address"],
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
         "table_name" => "master.supplier",
         "column_name" => "id"
      ));
      archive_master_data($input);
   } elseif ($_POST["action_status"] == "unarchive_detail") {
      //Unarchive Data
      $input = array("body" =>
      array(
         "id" => $_POST["data_id"],
         "created_by" => $_SESSION['user_role_id'],
         "table_name" => "master.supplier",
         "column_name" => "id"
      ));
      unarchive_master_data($input);
   } elseif ($_POST["action_status"] == "validate_detail") {
      //Validate Data
      $input = array(
         "body" =>
         array(
            "table_name" => "master.supplier",
            "id" => $_POST["id"],
            "for_check" => array(
               "supplier" => $_POST["supplier"]
            )
         )
      );
      echo json_encode(validate_master_data($input));
   }
}
