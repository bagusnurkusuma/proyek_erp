<script>
   //Show Password New
   $(function() {
      $('#jq_new_password_eye').click(function() {
         if ($(this).hasClass('fa-eye-slash')) {
            $(this).removeClass('fa-eye-slash');
            $(this).addClass('fa-eye');
            $('#jq_new_password').attr('type', 'text');
         } else {
            $(this).removeClass('fa-eye');
            $(this).addClass('fa-eye-slash');
            $('#jq_new_password').attr('type', 'password');
         }
      });
   });

   //Show Password Re Enter
   $(function() {
      $('#jq_re_enter_password_eye').click(function() {
         if ($(this).hasClass('fa-eye-slash')) {
            $(this).removeClass('fa-eye-slash');
            $(this).addClass('fa-eye');
            $('#jq_re_enter_password').attr('type', 'text');
         } else {
            $(this).removeClass('fa-eye');
            $(this).addClass('fa-eye-slash');
            $('#jq_re_enter_password').attr('type', 'password');
         }
      });
   });
</script>

<?php
include "api.php";
if (!empty($_POST)) {
   $output = '';
   if ($_POST['action_status'] == 'refresh_data_detail') {

      $output .= '
      <table id="list_user_register" class="table table-striped table-bordered" style="width:100%">
         <thead>
         <tr style="text-align: center;">
            <th>Employee</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Username</th>
            <th>Activation</th>
            <th>Option</th> 
         </tr>
      </thead>
      <tbody>
      ';
      $input = ['body' => ['id' => '']];
      $hasil = get_data_detail($input);
      if (is_array($hasil) && count($hasil)) {
         foreach ($hasil as $row) :
            $output .= '
            <tr>  
               <td>' . $row["employee_name"] . '</td>
               <td>' . $row["email"] . '</td>
               <td>' . $row["telepon"] . '</td>
               <td>' . $row["username"] . '</td>
               <td>' . $row["active_status"] . '</td>
               <td style="text-align: center;">
                  <button type="button" title="Change Password" name="change" id="' . $row["id"] . '" class="btn btn-info btn-xs change_password_user"><i class="fa fa-key"></i></button>
                  <button type="button" title="Change User Activation" name="active" id="' . $row["id"] . '" class="btn btn-warning btn-xs change_active_user"><i class="';

            if ($row["is_active_status"]) {
               $output .= 'fa fa-check';
            } else {
               $output .= 'fa fa-times';
            }
            $output .= '"></i></button>
                  <button type="button" title="Change User Roles" name="manage" id="' . $row["id"] . '" class="btn btn-danger btn-xs change_role_user" ><i class="fa fa-gear"></i></button></td>
               </tr>';
         endforeach;
      }
      $output .= '</tbody></table>';
   } elseif ($_POST['action_status'] == 'change_password_user' || $_POST['action_status'] == 'add_user') {
      if ($_POST['action_status'] == 'change_password_user') {
         $is_readonly = 'readonly = true';
         $is_disable_span = 'hidden';
         $button_name = 'change_password_data';
         $input = ['body' => ['data_id' => $_POST['data_id']]];
      } elseif ($_POST['action_status'] == 'add_user') {
         $is_readonly = '';
         $is_disable_span = '';
         $button_name = 'set_add_data_user';
         $input = ['body' => ['data_id' => null]];
      }
      $hasil = get_data_detail($input);
      if (is_array($hasil) && count($hasil)) {
         foreach ($hasil as $row) :
            $v_id = $_POST['data_id'];
            $v_username = $row['username'];
            $v_employee_id = $row['employee_id'];
            $v_employee_name = $row['employee_name'];
         endforeach;
      } else {
         $v_id = '';
         $v_username = '';
         $v_employee_id = '';
         $v_employee_name = '';
      }

      $output .= '
      <form method="POST" id="change_form">
      <input type="hidden" name="id" id="jq_id" value="' . $v_id . '"/>
      <input type="hidden" name="action_status" id="jq_action_status" value="' . $_POST['action_status'] . '"/>
      <input type="hidden" name="created_by" id="jq_created_by" value="' . $_POST['created_by'] . '"/>
      <table id="datatable" class="table table-striped table-bordered" style="width:100%">
         <tr>
            <td><label>Employee</label></td>
            <td>
               <div class="input-group">
                  <input type="hidden" name="employee_id" id="jq_employee_id" value="' . $v_employee_id . '" readonly=true/>
                  <input type="text" name="employee_name" id="jq_employee_name" value="' . $v_employee_name . '" class="form-control" readonly=true/>
                  <span class="input-group-btn" ' . $is_disable_span . '>
                     <button type="button" name="choose_employee_data" id="" class="btn btn-warning btn-xs choose_employee_data"><i class="fa fa-hand-o-up"></i></button>
                  </span>
               </div>
            </td>
         </tr>
         <tr>
            <td><label>Username</label></td>
            <td><input type="text" name="username" id="jq_username" value="' . $v_username . '" class="form-control" ' . $is_readonly . '/></td>
         </tr>
         <tr>
            <td><label>New Password</label></td>
            <td>
            <div class="input-group mb-3">
                <input type="password" class="form-control" name="new_password" id="jq_new_password" >
                <span class="input-group-text"><i class="fa fa-eye-slash" id="jq_new_password_eye"></i></span>
            </div>
            </td>
         </tr>
         <tr>
            <td><label>Re Enter New Password</label></td>
            <td>
            <div class="input-group mb-3">
                <input type="password" class="form-control" name="re_enter_password"  id="jq_re_enter_password">
                <span class="input-group-text"><i class="fa fa-eye-slash" id="jq_re_enter_password_eye"></i></span>
            </div>
            </td>
         </tr>
      </table>
        <span class="input-group-btn">
           <button type="button" name="change" id="jq_change" class="btn btn-success ' . $button_name . '">Confirm</button>
         </span>
      </form>';
   } elseif ($_POST['action_status'] == 'change_role_user') {

      $output = '';
      $output .= '
      <input type="hidden" name="user_role_id" id="jq_user_role_id" value="' . $_POST['data_id'] . '" class="form-control" />
      <table id="change_role_user_table" class="table table-striped table-bordered" style="width:100%">
         <thead>
         <tr style="text-align: center;">
            <th width="30%">Process</th>
            <th width="22%">Option</th> 
         </tr>
      </thead>
      <tbody>
      ';
      $input = ['body' => ['user_role_id' => $_POST['data_id']]];
      $hasil = get_user_acces($input);
      if (is_array($hasil) && count($hasil)) {
         foreach ($hasil as $row) :
            $output .= '
            <tr>  
               <td>' . $row["menu_name"] . '</td>
               <td style="text-align: center;">
               <button type="button" title="Remove" name="remove_hak" id="' . $row["id"] . '" class="btn btn-danger btn-xs remove_hak_data" ><i class="fa fa-trash"></i></button></td>
            </tr>
         ';
         endforeach;
      }
      $output .= '</tbody></table>';
   } elseif ($_POST['action_status'] == 'add_user_role') {
      $output = '';
      $output .= '
      <input type="hidden" name="user_role_id" id="jq_user_role_id" value="' . $_POST['data_id'] . '" class="form-control" />
      </div>
      <table id="add_user_role_table" class="table table-striped table-bordered" style="width:100%">
         <thead>
         <tr style="text-align: center;">
            <th width="30%">Process</th>
            <th width="22%">Option</th> 
         </tr>
      </thead>
      <tbody>
      ';
      $input = ['body' => ['user_role_id' => $_POST['data_id']]];
      $hasil = get_user_menu_proces($input);
      if (is_array($hasil) && count($hasil)) {
         foreach ($hasil as $row) :
            $output .= '
            <tr>  
               <td>' . $row["menu_name"] . '</td>
               <td style="text-align: center;">
               <button type="button" name="select_menu_process" id="' . $row["id"] . '" class="btn btn-warning btn-xs select_menu_process"><i class="fa fa-hand-o-up"></i></button></td>
            </tr>
         ';
         endforeach;
      }
      $output .= '</tbody></table>';
   } elseif ($_POST['action_status'] == 'list_employee') {
      $output = '';
      $output .= '
      <table id="list_employee_table" class="table table-striped table-bordered" style="width:100%">
         <thead>
         <tr>
            <th>Employee</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Option</th> 
         </tr>
      </thead>
      <tbody>
      ';
      $input = ['body' => ['id' => null]];
      $hasil = get_list_employee($input);
      if (is_array($hasil) && count($hasil)) {
         foreach ($hasil as $row) :
            $output .= '
            <tr>
               <td>' . $row["employee_name"] . '</td>
               <td>' . $row["email"] . '</td>
               <td>' . $row["telepon"] . '</td>
               <td><button type="button" name="select" id="' . $row["id"] . '" class="btn btn-warning btn-xs select_employee_data"><i class="fa fa-hand-o-up"></i></button>                                  
               </td>
            </tr>
         ';
         endforeach;
      }
      $output .= '</tbody></table>';
   }
   echo $output;
}
?>