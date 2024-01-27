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
         "inventory_code" => $_POST["inventory_code"],
         "inventory_name" => $_POST["inventory_name"],
         "inventory_category_id" => $_POST["inventory_category_id"],
         "unit_id" => $_POST["unit_id"],
         "purchase_price" => $_POST["purchase_price"],
         "sales_price" => $_POST["sales_price"],
         "desc" => $_POST["desc"]
      ));
      set_new_data($input);
   } elseif ($_POST["action_status"] == "insert_detail") {
      //Insert Data
      $input = array("body" =>
      array(
         "created_by" => $_SESSION['user_role_id'],
         "inventory_code" => $_POST["inventory_code"],
         "inventory_name" => $_POST["inventory_name"],
         "inventory_category_id" => $_POST["inventory_category_id"],
         "unit_id" => $_POST["unit_id"],
         "purchase_price" => $_POST["purchase_price"],
         "sales_price" => $_POST["sales_price"],
         "desc" => $_POST["desc"]
      ));
      set_new_data($input);
   } elseif ($_POST["action_status"] == "set_new_detail_ratio") {
      //Set New Detail Ratio Data
      $input = array("body" =>
      array(
         "id" => $_POST["id"],
         "created_by" => $_SESSION['user_role_id'],
         "inventory_id" => $_POST["inventory_id"],
         "ratio" => $_POST["ratio"],
         "unit_id" => $_POST["unit_id"],
         "desc" => $_POST["desc"]
      ));
      set_new_data_detail_ratio($input);
   } elseif ($_POST["action_status"] == "archive_detail") {
      //Archive Data
      $input = array("body" =>
      array(
         "id" => $_POST["id"],
         "created_by" => $_SESSION['user_role_id'],
         "archive_reason" => $_POST["archive_reason"],
         "table_name" => "master.inventory",
         "column_name" => "id"
      ));
      archive_data($input);
   } elseif ($_POST["action_status"] == "unarchive_detail") {
      //Unarchive Data
      $input = array("body" =>
      array(
         "id" => $_POST["data_id"],
         "created_by" => $_SESSION['user_role_id'],
         "table_name" => "master.inventory",
         "column_name" => "id"
      ));
      unarchive_data($input);
   } elseif ($_POST["action_status"] == "validate_detail") {
      //Validate Data
      $input = array(
         "body" =>
         array(
            "table_name" => "master.inventory",
            "id" => $_POST["id"],
            "for_check" => array(
               "inventory_code" => $_POST["code"],
               "inventory_name" => $_POST["name"]
            )
         )
      );
      $hasil = validate_data($input);
      $output = '';
      if (
         is_array($hasil) && count($hasil)
      ) {
         foreach ($hasil as $row) :
            $output .=  $row["msg"];
         endforeach;
      }
      echo $output;
   } elseif ($_POST["action_status"] == "select_unit_data") {
      //Select Unit Data
      $input = ['body' => ['data_id' => $_POST['data_id']]];
      echo json_encode(get_data_unit($input));
   } elseif ($_POST["action_status"] == "select_inventory_category_data") {
      //Select Inventory Category Data
      $input = ['body' => ['data_id' => $_POST['data_id']]];
      echo json_encode(get_data_inventory_category($input));
   } elseif ($_POST["action_status"] == "delete_data_ratio") {
      //Remove Detail Ratio
      $input = array("body" =>
      array(
         "id" => $_POST["data_id"],
         "table_name" => "master.inventory_detail_ratio",
         "column_name" => "id"
      ));
      remove_detail($input);
   }
}
