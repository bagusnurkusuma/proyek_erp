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
   } elseif ($_POST["action_status"] == "select_warehouse_data") {
      //Select Warehouse Data
      $input = ['body' => ['data_id' => $_POST['data_id']]];
      echo json_encode(get_data_warehouse($input));
   } elseif ($_POST["action_status"] == "select_inventory_data") {
      //Select Invenotry Data
      $input = ['body' => ['data_id' => $_POST['data_id']]];
      echo json_encode(get_data_inventory($input));
   } elseif ($_POST["action_status"] == "select_unit_data") {
      //Select Unit Data
      $input = ['body' => ['data_id' => $_POST['data_id']]];
      echo json_encode(get_data_unit($input));
   }
}
