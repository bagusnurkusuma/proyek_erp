<?php
include("api.php");
//Action
if (!empty($_POST)) {
  if ($_POST["action_status"] == "cancel_transaction") {
    //remove detail
    $input = array("body" =>
    array(
      "id" => $_POST["transaction_id"],
      "table_name" => "inventory.material_conversion_detail",
      "column_name" => "material_conversion_id"
    ));
    remove_transaction_detail($input);
    //remove parent
    $input = array("body" =>
    array(
      "id" => $_POST["transaction_id"],
      "table_name" => "inventory.material_conversion",
      "column_name" => "id"
    ));
    remove_transaction_detail($input);
  } elseif ($_POST["action_status"] == "remove_product") {
    $input = array("body" =>
    array(
      "id" => $_POST["data_id"],
      "table_name" => "inventory.material_conversion_detail",
      "column_name" => "id"
    ));
    remove_transaction_detail($input);
  } elseif ($_POST["action_status"] == "edit_product") {
    $input = array("body" =>
    array(
      "material_conversion_id" => $_POST["transaction_id"],
      "id" => $_POST["id"],
      "unit_id" => $_POST["unit_id"],
      "qty" => $_POST["qty"],
      "inventory_id" => $_POST["inventory_id"],
      "warehouse_id" => $_POST["warehouse_id"],
      "batch_number" => $_POST["batch_number"],
      "expired_date" => $_POST["expired_date"]
    ));
    update_transaction_detail($input);
  } elseif ($_POST["action_status"] == "select_warehouse_data") {
    //Select Warehouse Data
    $input = ["body" => ["data_id" => $_POST["data_id"]]];
    echo json_encode(get_data_warehouse($input));
  } elseif ($_POST["action_status"] == "select_inventory_data") {
    //Select Inventory Data
    $input = ["body" => ["data_id" => $_POST["data_id"]]];
    echo json_encode(get_data_inventory($input));
  } elseif ($_POST["action_status"] == "select_unit_data") {
    //Select Unit Data
    $input = ["body" => ["data_id" => $_POST["data_id"]]];
    echo json_encode(get_data_unit($input));
  } elseif ($_POST["action_status"] == "validate_detail") {
    $input = array(
      "body" =>
      array(
        "transaction_id" => $_POST["transaction_id"],
        "transaction_date" => $_POST["transaction_date"],
        "warehouse_id" => $_POST["warehouse_id"],
        "inventory_id" => $_POST["inventory_id"],
        "qty" => $_POST["qty"],
        "unit_id" => $_POST["unit_id"],
        "batch_number" => $_POST["batch_number"],
        "expired_date" => $_POST["expired_date"]
      )
    );
    echo json_encode(validate_data($input));
  }
}
