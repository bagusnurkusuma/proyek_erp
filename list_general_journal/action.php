<?php
require_once "api.php";
require_once "../asset_default/global_function.php";
if (!empty($_POST)) {
   $_POST = casting_htmlentities_array($_POST);
   if ($_POST["action_status"] == "select_warehouse_data") {
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
