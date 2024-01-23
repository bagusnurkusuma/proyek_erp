<?php
include("api.php");
//Action
if (!empty($_POST)) {
   if ($_POST["action_status"] == "select_filter_account_data") {
      //Select Filter Account Data
      $input = ['body' => ['data_id' => $_POST['data_id']]];
      echo json_encode(get_data_account($input));
   }
}
