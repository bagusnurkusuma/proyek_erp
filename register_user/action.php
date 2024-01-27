<?php
session_start();
require_once "api.php";
//Action
if (!empty($_POST)) {
   if ($_POST["action_status"] == "change_password_user") {
      //Change Password
      $input = array(
         "body" =>
         array(
            "id" => $_POST["id"],
            "password" => $_POST["new_password"]
         )
      );
      set_new_user($input);
   } elseif ($_POST["action_status"] == "add_user") {
      //Add User
      $input = array("body" =>
      array(
         "employee_id" => $_POST["employee_id"],
         "created_by" => $_SESSION['user_role_id'],
         "username" => $_POST["username"],
         "password" => $_POST["new_password"],
      ));
      set_new_user_role($input);
   } elseif ($_POST["action_status"] == "change_active_status") {
      //Change Active
      $input = array("body" =>
      array(
         "id" => $_POST["data_id"]
      ));
      set_new_user($input);
   } elseif ($_POST["action_status"] == "remove_hak_detail") {
      $input = array("body" =>
      array(
         "id" => $_POST["data_id"],
         "table_name" => "user_role.user_access",
         "column_name" => "id"
      ));
      remove_transaction_detail($input);
   } elseif ($_POST["action_status"] == "select_menu_process") {
      $input = array("body" =>
      array(
         "menu_proces_id" => $_POST["menu_proces_id"],
         "user_role_id" => $_POST["user_role_id"],
         "created_by" => $_POST["created_by"]
      ));
      set_new_user_acces($input);
   } elseif ($_POST["action_status"] == "select_employee_data") {
      //Select Employee Data
      $input = ['body' => ['data_id' => $_POST['data_id']]];
      echo json_encode(get_list_employee($input));
   }
}
