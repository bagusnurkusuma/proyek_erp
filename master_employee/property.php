<?php
require_once "api.php";
require_once "../asset_default/global_function.php";
if (!empty($_POST)) {
   $_POST = casting_htmlentities_array($_POST);
   $output = '';
   if ($_POST['action_status'] == 'view_detail' | $_POST['action_status'] == 'edit_detail' | $_POST['action_status'] == 'insert_detail') {
      if ($_POST['action_status'] == 'view_detail') {
         $is_readonly = 'readonly = true';
         $is_disable_span = 'hidden';
         $input = ['body' => ['data_id' => $_POST['data_id']]];
      } elseif ($_POST['action_status'] == 'edit_detail') {
         $is_readonly = '';
         $is_disable_span = '';
         $input = ['body' => ['data_id' => $_POST['data_id']]];
      } elseif ($_POST['action_status'] == 'insert_detail') {
         $is_readonly = '';
         $is_disable_span = '';
         $input = ['body' => ['data_id' => '']];
      }

      $hasil = get_data_detail($input);
      if (is_array($hasil) && count($hasil)) {
         foreach ($hasil as $row) :
            $row = casting_htmlentities_array($row);
            $v_id = $_POST['data_id'];
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
         <span class="input-group-btn" ' . $is_disable_span . '>
           <button type="button" name="update_detail" id="jq_update" class="btn btn-success update_detail">Update</button>
         </span>
      </form>
      </div>
      ';
   } elseif ($_POST['action_status'] == 'refresh_data_detail') {
      $output .= '
      <table id="master_table" class="table table-striped table-bordered" style="width:100%">
         <thead>
         <tr>
            <th width="100">Photo Profile</th>
            <th>NIK</th>
            <th>Employee</th> 
            <th>Email</th> 
            <th>Telepon</th> 
            <th>Option</th> 
         </tr>
      </thead>
      <tbody>
      ';
      $input = ['body' => ['id' => '']];
      $hasil = get_data_detail($input);
      if (is_array($hasil) && count($hasil)) {
         foreach ($hasil as $row) :
            $row = casting_htmlentities_array($row);
            $output .= '
            <tr>  
               <td align="center"><img src="' . $row['file_location'] . '" alt="' . $row["employee_name"] . '"  width="100" height="100" class="img-circle text-center"></td>
               <td>' . $row["employee_nik"] . '</td>
               <td>' . $row["employee_name"] . '</td>
               <td>' . $row["email"] . '</td>
               <td>' . $row["telepon"] . '</td>
               <td>
               <button type="button" name="view" value="" id="' . $row["id"] . '" class="btn btn-info view_data"><i class="fa fa-eye"></i></button>   
               <button type="button" name="edit" id="' . $row["id"] . '" class="btn btn-warning edit_data"><i class="fa fa-pencil-square"></i></button>                                    
               <button type="button" name="archive" id="' . $row["id"] . '" class="btn btn-danger archive_data"><i class="fa fa-archive"></i></button>
               </td>
            </tr>
         ';
         endforeach;
      }
      $output .= '</tbody></table>';
   } elseif ($_POST['action_status'] == 'archive_detail') {
      $output = '
      <form method="post" id="archive_form">
        <input type="hidden" name="id" id="jq_id" value="' . $_POST['data_id']  . '"/>
         <input type="hidden" name="action_status" id="jq_action_status" value="' . $_POST['action_status'] . '"/>
      <table class="table table-striped">
          <td><label>Archive Reason ?</label></td>
            <td><textarea name="archive_reason" id="jq_archive_reason" class="form-control" ></textarea></td>
      </table>
         <input type="button" name="archive" id="archive" value="Archive" class="btn btn-success archive_detail" />
      </form>';
   } elseif ($_POST['action_status'] == 'show_archive_data') {
      $output .= '
      <table id="archive_table" class="table table-striped table-bordered" style="width:100%">
         <thead>
         <tr>
            <th width="20%">NIK</th>
            <th width="20%">Karyawan</th> 
            <th width="20%">Description</th> 
            <th width="20%">Option</th> 
         </tr>
      </thead>
      <tbody>
      ';
      $input = ['body' => ['is_archive' => '']];
      $hasil = get_data_detail($input);
      if (is_array($hasil) && count($hasil)) {
         foreach ($hasil as $row) :
            $row = casting_htmlentities_array($row);
            $output .= '
            <tr>  
               <td>' . $row["employee_nik"] . '</td>
               <td>' . $row["employee_name"] . '</td>
               <td>' . $row["description"] . '</td>
               <td>
               <button type="button" name="unarchive" value="Unarchive" id="' . $row["id"] . '" class="btn btn-danger unarchive_data"><i class="fa fa-upload"></i></button>
               </td>
            </tr>
         ';
         endforeach;
      }
      $output .= '</tbody></table>';
   }
   echo $output;
}
