<?php
session_start();
require_once "api.php";
//Action
if (!empty($_POST)) {
  if ($_POST["action_status"] == "cancel_transaction") {
    //remove detail
    $input = array("body" =>
    array(
      "id" => $_POST["transaction_id"],
      "table_name" => "pos.point_of_sales_detail",
      "column_name" => "point_of_sales_id"
    ));
    remove_transaction_detail($input);
    //remove parent
    $input = array("body" =>
    array(
      "id" => $_POST["transaction_id"],
      "table_name" => "pos.point_of_sales",
      "column_name" => "id"
    ));
    remove_transaction_detail($input);
  } elseif ($_POST["action_status"] == "remove_product") {
    $input = array("body" =>
    array(
      "id" => $_POST["data_id"],
      "table_name" => "pos.point_of_sales_detail",
      "column_name" => "id"
    ));
    remove_transaction_detail($input);
  } elseif ($_POST["action_status"] == "edit_product") {
    $input = array("body" =>
    array(
      "point_of_sales_id" => $_POST["transaction_id"],
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
      "product_code" => $_POST["data_id"],
      "qty" => $_POST["qty"],
      "point_of_sales_id" => $_POST["transaction_id"]
    ));
    insert_transaction_detail($input);
  } elseif ($_POST["action_status"] == "pay_transaction") {
    $input = array("body" =>
    array(
      "id" => $_POST["transaction_id"],
      "transaction_date" => $_POST["transaction_date"],
      "outlet_id" => $_POST["outlet_id"],
      "customer_id" => $_POST["customer_id"],
      "grand_total" => $_POST["grand_total"],
      "total_cash" => $_POST["total_cash"],
      "total_changes" => $_POST["total_changes"]
    ));
    pay_transaction($input);
  } elseif ($_POST["action_status"] == "select_customer_data") {
    //Select Customer Data
    $input = ['body' => ['data_id' => $_POST['data_id']]];
    echo json_encode(get_data_customer($input));
  } elseif ($_POST["action_status"] == "add_customer_data") {
    //Insert Data
    $input = array(
      "body" =>
      array(
        "created_by" => $_SESSION['user_role_id'],
        "customer_name" => $_POST["customer_nama"],
        "telp" => $_POST["customer_telp"],
        "email" => $_POST["customer_email"],
        "addres" => $_POST["customer_addres"],
        "desc" => $_POST["customer_desc"]
      )
    );
    echo json_encode(set_new_customer_data($input));
  } elseif ($_POST["action_status"] == "validate_detail") {
    //Validasi Point of Sales
    $input = array(
      "body" =>
      array(
        "transaction_id" => $_POST["transaction_id"],
        "transaction_date" => $_POST["transaction_date"],
        "outlet_id" => $_POST["outlet_id"]
      )
    );
    echo json_encode(validate_data($input));
  }
}
