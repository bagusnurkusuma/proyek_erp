<?php
require_once "api.php";
require_once "../asset_default/global_function.php";
if (!empty($_POST)) {
  $_POST = casting_htmlentities_array($_POST);
  if ($_POST["action_status"] == "cancel_transaction") {
    //remove detail
    $input = array("body" =>
    array(
      "id" => $_POST["transaction_id"],
      "table_name" => "purchasing.quick_purchase_detail",
      "column_name" => "quick_purchase_id"
    ));
    remove_transaction_detail($input);
    //remove parent
    $input = array("body" =>
    array(
      "id" => $_POST["transaction_id"],
      "table_name" => "purchasing.quick_purchase",
      "column_name" => "id"
    ));
    remove_transaction_detail($input);
  } elseif ($_POST["action_status"] == "remove_product") {
    $input = array("body" =>
    array(
      "id" => $_POST["data_id"],
      "table_name" => "purchasing.quick_purchase_detail",
      "column_name" => "id"
    ));
    remove_transaction_detail($input);
  } elseif ($_POST["action_status"] == "edit_product") {
    $input = array("body" =>
    array(
      "quick_purchase_id" => $_POST["transaction_id"],
      "id" => $_POST["id"],
      "qty" => $_POST["qty"],
      "unit_price" => $_POST["unit_price"],
      "total" => $_POST["total"],
      "disc_1_percent" => $_POST["disc_1_percent"],
      "disc_1_nominal" => $_POST["disc_1_nominal"],
      "disc_2_percent" => $_POST["disc_2_percent"],
      "disc_2_nominal" => $_POST["disc_2_nominal"],
      "total_disc" => $_POST["total_disc"],
      "total_dpp" => $_POST["total_dpp"],
      "vat" => $_POST["vat"],
      "total_vat" => $_POST["total_vat"],
      "grand_total" => $_POST["grand_total"],
      "description" => $_POST['description']
    ));
    update_transaction_detail($input);
  } elseif ($_POST["action_status"] == "input_barcode") {
    $input = array("body" =>
    array(
      "inventory_code" => $_POST["data_id"],
      "qty" => $_POST["qty"],
      "quick_purchase_id" => $_POST["transaction_id"]
    ));
    insert_transaction_detail($input);
  } elseif ($_POST["action_status"] == "pay_transaction") {
    $input = array("body" =>
    array(
      "id" => $_POST["transaction_id"],
      "transaction_date" => $_POST["transaction_date"],
      "supplier_id" => $_POST["supplier_id"],
      "warehouse_id" => $_POST["warehouse_id"],
      "grand_total" => $_POST["grand_total"],
      "total_cash" => $_POST["total_cash"],
      "total_changes" => $_POST["total_changes"]
    ));
    pay_transaction($input);
  } elseif ($_POST["action_status"] == "select_supplier_data") {
    //Select Supplier Data
    $input = ['body' => ['data_id' => $_POST['data_id']]];
    echo json_encode(get_data_supplier($input));
  } elseif ($_POST["action_status"] == "select_warehouse_data") {
    //Select Warehouse Data
    $input = ['body' => ['data_id' => $_POST['data_id']]];
    echo json_encode(get_data_warehouse($input));
  } elseif ($_POST["action_status"] == "validate_detail") {
    $input = array(
      "body" =>
      array(
        "transaction_id" => $_POST["transaction_id"],
        "transaction_date" => $_POST["transaction_date"],
        "supplier_id" => $_POST["supplier_id"],
        "warehouse_id" => $_POST["warehouse_id"]
      )
    );
    echo json_encode(validate_data($input));
  }
}
