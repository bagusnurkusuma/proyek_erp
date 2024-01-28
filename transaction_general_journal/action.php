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
      "table_name" => "accounting.general_journal_detail",
      "column_name" => "general_journal_id"
    ));
    remove_transaction_detail($input);
    //remove parent
    $input = array("body" =>
    array(
      "id" => $_POST["transaction_id"],
      "table_name" => "accounting.general_journal",
      "column_name" => "id"
    ));
    remove_transaction_detail($input);
    $input = "";
  } elseif ($_POST["action_status"] == "remove_data") {
    $input = array("body" =>
    array(
      "id" => $_POST["data_id"],
      "table_name" => "accounting.general_journal_detail",
      "column_name" => "id"
    ));
    remove_transaction_detail($input);
    $input = "";
  } elseif ($_POST["action_status"] == "add_data") {
    $input = array("body" =>
    array(
      "general_journal_id" => $_POST["transaction_id"],
      "account_id" => $_POST["account_id"],
      "debet" => $_POST["debet"],
      "credit" => $_POST["credit"],
      "created_by" => $_SESSION['user_role_id'],
      "description" => $_POST["description"]
    ));
    update_transaction_detail($input);
  } elseif ($_POST["action_status"] == "edit_data") {
    $input = array("body" =>
    array(
      "general_journal_id" => $_POST["transaction_id"],
      "id" => $_POST["id"],
      "account_id" => $_POST["account_id"],
      "debet" => $_POST["debet"],
      "credit" => $_POST["credit"],
      "created_by" => $_SESSION['user_role_id'],
      "description" => $_POST["description"]
    ));
    update_transaction_detail($input);
  } elseif ($_POST["action_status"] == "select_account_data") {
    //Select Account Data
    $input = ["body" => ["data_id" => $_POST["data_id"]]];
    echo json_encode(get_account_data($input));
  } elseif ($_POST["action_status"] == "validate_detail") {
    $input = array(
      "body" =>
      array(
        "transaction_id" => $_POST["transaction_id"],
        "transaction_date" => $_POST["transaction_date"],
        "reference_number" => $_POST["reference_number"],
        "description" => $_POST["description"]
      )
    );
    echo json_encode(validate_data($input));
  }
}
