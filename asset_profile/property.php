<?php
require_once "api.php";
require_once "../asset_default/global_function.php";
if (!empty($_POST)) {
   $_POST = casting_htmlentities_array($_POST);
   $output = '';
   if ($_POST['action_status'] == 'view_detail' || $_POST['action_status'] == 'edit_detail') {
      if ($_POST['action_status'] == 'view_detail') {
         $is_readonly = 'readonly = true';
         $is_disable_span = 'hidden';
         $add_button = '';
         $input = ['body' => ['data_id' => $_SESSION["employee_id"]]];
      } elseif ($_POST['action_status'] == 'edit_detail') {
         $is_readonly = '';
         $is_disable_span = '';
         $is_hidden = true;
         $add_button = '<span class="input-group-btn">
           <button type="button" name="update_detail" id="jq_update_detail" class="btn btn-success update_detail">Update</button>
         </span>
         <span class="input-group-btn">
           <button type="button" name="update_cancel" id="jq_update_cancel" class="btn btn-danger update_cancel">Cancel</button>
         </span>';
         $input = ['body' => ['data_id' => $_SESSION["employee_id"]]];
      }

      $hasil = get_data_detail($input);
      if (is_array($hasil) && count($hasil)) {
         foreach ($hasil as $row) :
            $row = casting_htmlentities_array($row);
            $v_id = $_SESSION["employee_id"];
            $v_file_id = $row['file_id'];
            $v_file_location = $row['file_location'];
            $v_employee_nik = $row['employee_nik'];
            $v_employee_name = $row['employee_name'];
            $v_tempat_lahir = $row['tempat_lahir'];
            $v_tanggal_lahir = $row['tanggal_lahir'];
            $v_telepon = $row['telepon'];
            $v_address = $row['address'];
            $v_email = $row['email'];
            $v_decription = $row['description'];
         endforeach;
      } else {
         $v_id = '';
         $v_file_id = '';
         $v_file_location = '';
         $v_employee_nik = '';
         $v_employee_name = '';
         $v_tempat_lahir = '';
         $v_tanggal_lahir = '';
         $v_telepon = '';
         $v_address = '';
         $v_email = '';
         $v_decription = '';
      }

      $output .= '
      <form method="POST" id="update_form" enctype="multipart/form-data">
      <div class="col-md-6 col-sm-12 form-group">
      <table id="datatable" class="table table-striped table-bordered" style="width:100%">
         <tr>
            <td><label>Profile Photo</label></td>
         </tr>
         <tr>
            <td align="center"><img id="jq_display_profile" src="' . $v_file_location . '" alt="' . $v_employee_name . '"  width="300" height="300"  class="img-circle text-center"></td>
         </tr>
      </table>
      <div align="center">
      <span class="input-group-btn" ' . $is_disable_span . '>
           <input type="file" name="upload_profile_img" accept="image/*"  id="jq_upload_profile" class="btn btn-success upload_profile" />
         </span>
      </div>
      </div>
      <div class="col-md-6 col-sm-12 form-group">
         <input type="hidden" name="id" id="jq_id" value="' . $v_id . '"/>
         <input type="hidden" name="file_id" id="jq_file_id" value="' . $v_file_id . '"/>
         <input type="hidden" name="action_status" id="jq_action_status" value="' . $_POST['action_status'] . '"/>
      <table id="datatable" class="table table-striped table-bordered" style="width:100%">
         <tr>
            <td><label>Employee NIK</label></td>
            <td><input type="text" name="employee_nik" id="jq_nik" value="' . $v_employee_nik . '" class="form-control" ' . $is_readonly . '/></td>
         </tr>
         <tr>
            <td><label>Employee Name</label></td>
            <td><input type="text" name="employee_name" id="jq_name" value="' . $v_employee_name . '" class="form-control" ' . $is_readonly . '/></td>
         </tr>
         <tr>
            <td><label>Place of Birth</label></td>
            <td><input type="text" name="tempat_lahir" id="jq_tempat_lahir" value="' . $v_tempat_lahir . '" class="form-control" ' . $is_readonly . '/></td>
         </tr>
         <tr>
            <td><label>Date of Birth</label></td>
            <td><input type="date" name="tanggal_lahir" id="jq_tanggal_lahir" value="' . $v_tanggal_lahir . '" class="form-control" ' . $is_readonly . '/></td>
         </tr>
         <tr>
            <td><label>Phone Number</label></td>
            <td><input type="text" name="telepon" id="jq_telp" value="' . $v_telepon . '" class="form-control" ' . $is_readonly . '/></td>
         </tr>
         <tr>
            <td><label>Email</label></td>
            <td><input type="text" name="email" id="jq_email" value="' . $v_email . '" class="form-control" ' . $is_readonly . '/></td>
         </tr>
         <tr>
            <td><label>Address</label></td>
            <td><textarea name="address" id="jq_address" class="form-control" ' . $is_readonly . '>' . $v_address . '</textarea></td>
         </tr>
         <tr>
            <td><label>Description</label></td>
            <td><textarea name="desc" id="jq_desc" class="form-control" ' . $is_readonly . '>' . $v_decription . '</textarea></td>
         </tr>
      </table>
         ' . $add_button . '
      </form>
      </div>
      ';
   } elseif ($_POST['action_status'] == 'change_password_user') {
      if ($_POST['action_status'] == 'change_password_user') {
         $is_readonly = 'readonly = true';
         $is_disable_span = 'hidden';
         $button_name = 'change_password_data';
         $input = ['body' => ['data_id' => $_SESSION["user_role_id"]]];
      }
      $hasil = get_users_detail($input);
      if (is_array($hasil) && count($hasil)) {
         foreach ($hasil as $row) :
            $row = casting_htmlentities_array($row);
            $v_id = $_SESSION["user_role_id"];
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
   }
   echo $output;
}
