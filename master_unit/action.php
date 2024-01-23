<?php
include("api.php");
//Action
if (!empty($_POST)) {
   if ($_POST["action_status"] == "edit_detail") {
      //Edit Data
      $input = array("body" =>
      array(
         "id" => $_POST["id"],
         "created_by" => $_POST["created_by"],
         "unit_code" => $_POST["code"],
         "unit_name" => $_POST["name"],
         "desc" => $_POST["desc"]
      ));
      set_new_data($input);
   } elseif ($_POST["action_status"] == "insert_detail") {
      //Insert Data
      $input = array("body" =>
      array(
         "created_by" => $_POST["created_by"],
         "unit_code" => $_POST["code"],
         "unit_name" => $_POST["name"],
         "desc" => $_POST["desc"]
      ));
      set_new_data($input);
   } elseif ($_POST["action_status"] == "archive_detail") {
      //Archive Data
      $input = array("body" =>
      array(
         "id" => $_POST["id"],
         "created_by" => $_POST["created_by"],
         "archive_reason" => $_POST["archive_reason"],
         "table_name" => "master.unit",
         "column_name" => "id"
      ));
      archive_data($input);
   } elseif ($_POST["action_status"] == "unarchive_detail") {
      //Unarchive Data
      $input = array("body" =>
      array(
         "id" => $_POST["data_id"],
         "created_by" => $_POST["created_by"],
         "table_name" => "master.unit",
         "column_name" => "id"
      ));
      unarchive_data($input);
   } elseif ($_POST["action_status"] == "validate_detail") {
      //Validate Data
      $input = array(
         "body" =>
         array(
            "table_name" => "master.unit",
            "id" => $_POST["id"],
            "for_check" => array(
               "unit_code" => $_POST["code"],
               "unit_name" => $_POST["name"]
            )
         )
      );
      echo json_encode(validate_data($input));
   }
}
