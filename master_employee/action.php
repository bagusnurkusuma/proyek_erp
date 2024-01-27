<?php
session_start();
require_once "api.php";
//Action
if (!empty($_POST)) {
   //If Edit dan insert
   if (($_POST["action_status"] == "edit_detail" || $_POST["action_status"] == "insert_detail")) {
      $file = $_FILES['upload_profile_img'];
      $file_name = $file['name'];
      if (!empty($file_name)) {
         $file_tmp_name = $file['tmp_name'];
         $file_size = $file['size'];
         $file_error = $file['error'];
         $file_type = $file['type'];

         $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

         require_once "../asset_default/uuid_function.php";
         $file_name_baru = get_uuid() . "." . $file_extension;
         $file_destination = $_SESSION['file_default_location'] . $file_name_baru;

         move_uploaded_file($file_tmp_name, $file_destination);
      } else {
         $file_name = null;
         $file_type = null;
         $file_name_baru = null;
      }
   }
   if ($_POST["action_status"] == "edit_detail") {
      //Edit Data
      $input = array(
         "body" =>
         array(
            "id" => $_POST["id"],
            "created_by" => $_SESSION['user_role_id'],
            "employee_nik" => $_POST["employee_nik"],
            "employee_name" => $_POST["employee_name"],
            "tempat_lahir" => $_POST["tempat_lahir"],
            "tanggal_lahir" => $_POST["tanggal_lahir"],
            "telepon" => $_POST["telepon"],
            "address" => $_POST["address"],
            "email" => $_POST["email"],
            "desc" => $_POST["desc"],
            "file_name" => $file_name,
            "file_type" => $file_type,
            "file_name_replaced" => $file_name_baru
         )
      );
      set_new_data($input);
      echo json_encode(null);
   } elseif ($_POST["action_status"] == "insert_detail") {
      //Insert Data
      $input = array("body" =>
      array(
         "created_by" => $_SESSION['user_role_id'],
         "employee_nik" => $_POST["employee_nik"],
         "employee_name" => $_POST["employee_name"],
         "tempat_lahir" => $_POST["tempat_lahir"],
         "tanggal_lahir" => $_POST["tanggal_lahir"],
         "telepon" => $_POST["telepon"],
         "address" => $_POST["address"],
         "email" => $_POST["email"],
         "desc" => $_POST["desc"],
         "file_name" => $file_name,
         "file_type" => $file_type,
         "file_name_replaced" => $file_name_baru
      ));
      set_new_data($input);
      echo json_encode(null);
   } elseif ($_POST["action_status"] == "archive_detail") {
      //Archive Data
      $input = array("body" =>
      array(
         "id" => $_POST["id"],
         "created_by" => $_SESSION['user_role_id'],
         "archive_reason" => $_POST["archive_reason"],
         "table_name" => "master.employee",
         "column_name" => "id"
      ));
      archive_data($input);
   } elseif ($_POST["action_status"] == "unarchive_detail") {
      //Unarchive Data
      $input = array("body" =>
      array(
         "id" => $_POST["data_id"],
         "created_by" => $_SESSION['user_role_id'],
         "table_name" => "master.employee",
         "column_name" => "id"
      ));
      unarchive_data($input);
   } elseif ($_POST["action_status"] == "validate_detail") {
      //Validasi
      $input = array(
         "body" =>
         array(
            "table_name" => "master.employee",
            "id" => $_POST["id"],
            "for_check" => array(
               "employee_nik" => $_POST["code"],
               "employee_name" => $_POST["name"]
            )
         )
      );
      echo json_encode(validate_data($input));
   }
}
