<?php
session_start();
require_once "api.php";
//Action
if (!empty($_POST)) {
   if ($_POST["action_status"] == "select_finance_report_type_data") {
      //Select Warehouse Data
      $input = ['body' => ['data_id' => $_POST['data_id']]];
      echo json_encode(get_finance_report_type($input));
   } elseif ($_POST["action_status"] == "remove_account") {
      $input = array("body" =>
      array(
         "id" => $_POST["data_id"],
         "table_name" => "config.finance_report_account",
         "column_name" => "id"
      ));
      remove_transaction_detail($input);
      $input = '';
   } elseif ($_POST["action_status"] == "select_account") {
      $input = array("body" =>
      array(
         "structure_id" => $_POST["structure_id"],
         "account_id" => $_POST["account_id"],
         "created_by" => $_SESSION['user_role_id'],
      ));
      set_new_finance_report_account($input);
      $input = '';
   }
}
