<?php
include("api.php");
//Action
if (!empty($_POST)) {
   if ($_POST["action_status"] == "select_finance_report_type_data") {
      //Select Warehouse Data
      $input = ['body' => ['data_id' => $_POST['data_id']]];
      echo json_encode(get_finance_report_type($input));
   }
}
