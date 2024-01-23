<?php
include "api.php";
if (!empty($_POST)) {
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
            $v_id = $_POST['data_id'];
            $v_employee_nik = $row['employee_nik'];
            $v_employee_name = $row['employee_name'];
            $v_tempat_lahir = $row['tempat_lahir'];
            $v_tanggal_lahir = $row['tanggal_lahir'];
            $v_telepon = $row['telepon'];
            $v_address = $row['address'];
            $v_decription = $row['description'];
         endforeach;
      } else {
         $v_id = '';
         $v_employee_nik = '';
         $v_employee_name = '';
         $v_tempat_lahir = '';
         $v_tanggal_lahir = '';
         $v_telepon = '';
         $v_address = '';
         $v_decription = '';
      }

      $output .= '
      <form method="POST" id="update_form">
         <input type="hidden" name="id" id="jq_id" value="' . $v_id . '" class="form-control" />
         <input type="hidden" name="action_status" id="jq_action_status" value="' . $_POST['action_status'] . '" class="form-control" />
         <input type="hidden" name="created_by" id="jq_created_by" value="' . $_POST['created_by'] . '" class="form-control" />
      <table id="datatable" class="table table-striped table-bordered" style="width:100%">
         <tr>
            <td><label>NIK</label></td>
            <td><input type="text" name="employee_nik" id="jq_nik" value="' . $v_employee_nik . '" class="form-control" ' . $is_readonly . '/></td>
         <tr>
            <td><label>Nama Karyawan</label></td>
            <td><input type="text" name="employee_name" id="jq_name" value="' . $v_employee_name . '" class="form-control" ' . $is_readonly . '/></td>
         </tr>
         <tr>
            <td><label>Tempat lahir</label></td>
            <td><input type="text" name="tempat_lahir" id="jq_tempat_lahir" value="' . $v_tempat_lahir . '" class="form-control" ' . $is_readonly . '/></td>
         </tr>
         <tr>
            <td><label>Tanggal Lahir</label></td>
            <td><input type="date" name="tanggal_lahir" id="jq_tanggal_lahir" value="' . $v_tanggal_lahir . '" class="form-control" ' . $is_readonly . '/></td>
         </tr>
         <tr>
            <td><label>No Telepon</label></td>
            <td><input type="text" name="telepon" id="jq_telp" value="' . $v_telepon . '" class="form-control" ' . $is_readonly . '/></td>
         </tr>
         <tr>
            <td><label>Alamat</label></td>
            <td><textarea name="address" id="jq_address" class="form-control" ' . $is_readonly . '>' . $v_address . '</textarea></td>
         </tr>
         <tr>
            <td><label>Description</label></td>
            <td><textarea name="desc" id="jq_desc" class="form-control" ' . $is_readonly . '>' . $v_decription . '</textarea></td>
         </tr>
      </table>
         <span class="input-group-btn" ' . $is_disable_span . '>
           <input type="button" name="update" id="jq_update" value="Update" class="btn btn-success update_detail" />
         </span>
      </form>
      ';
   } elseif ($_POST['action_status'] == 'refresh_data_detail') {
      $output .= '
      <table id="master_table" class="table table-striped table-bordered" style="width:100%">
         <thead>
         <tr>
            <th width="25%">NIK</th>
            <th width="25%">Karyawan</th> 
            <th width="20%">Telepon</th> 
            <th width="30%">Option</th> 
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
               <td>' . $row["employee_nik"] . '</td>
               <td>' . $row["employee_name"] . '</td>
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
        <input type="hidden" name="id" id="jq_id" value="' . $_POST['data_id']  . '" class="form-control" />
         <input type="hidden" name="action_status" id="jq_action_status" value="' . $_POST['action_status'] . '" class="form-control" />
         <input type="hidden" name="created_by" id="jq_created_by" value="' . $_POST['created_by'] . '" class="form-control" />
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
