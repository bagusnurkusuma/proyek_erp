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
         "outlet_code" => $_POST["outlet_code"],
         "outlet_name" => $_POST["outlet_name"],
         "warehouse_id" => $_POST["warehouse_id"],
         "desc" => $_POST["desc"]
      ));
      set_new_data($input);
   } elseif ($_POST["action_status"] == "insert_detail") {
      //Insert Data
      $input = array("body" =>
      array(
         "created_by" => $_POST["created_by"],
         "outlet_code" => $_POST["outlet_code"],
         "outlet_name" => $_POST["outlet_name"],
         "warehouse_id" => $_POST["warehouse_id"],
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
         "table_name" => "master.outlet",
         "column_name" => "id"
      ));
      archive_data($input);
   } elseif ($_POST["action_status"] == "unarchive_detail") {
      //Unarchive Data
      $input = array("body" =>
      array(
         "id" => $_POST["data_id"],
         "created_by" => $_POST["created_by"],
         "table_name" => "master.outlet",
         "column_name" => "id"
      ));
      unarchive_data($input);
   } elseif ($_POST["action_status"] == "validate_detail") {
      //Validate Data
      $input = array(
         "body" =>
         array(
            "table_name" => "master.outlet",
            "id" => $_POST["id"],
            "for_check" => array(
               "outlet_code" => $_POST["code"],
               "outlet_name" => $_POST["name"]
            )
         )
      );
      echo json_encode(validate_data($input));
   } elseif ($_POST["action_status"] == "select_warehouse_data") {
      //Select Warehouse Data
      $input = ['body' => ['data_id' => $_POST['data_id']]];
      echo json_encode(get_data_warehouse($input));
   }
}
