<?php
include "api.php";


if (!empty($_POST)) {
   $_POST = htmlentities_array($_POST);
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
            $row = htmlentities_array($row);
            $v_id = $_POST['data_id'];
            $v_supplier = $row['supplier_name'];
            $v_email = $row['email'];
            $v_telp = $row['telp'];
            $v_addres = $row['addres'];
            $v_decription = $row['description'];
         endforeach;
      } else {
         $v_id = '';
         $v_supplier = '';
         $v_email = '';
         $v_telp = '';
         $v_addres = '';
         $v_decription = '';
      }

      $output .= '
      <form method="POST" id="update_form">
         <input type="hidden" name="id" id="jq_id" value="' . $v_id . '" class="form-control" />
         <input type="hidden" name="action_status" id="jq_action_status" value="' . $_POST['action_status'] . '" class="form-control" />
         <input type="hidden" name="created_by" id="jq_created_by" value="' . $_POST['created_by'] . '" class="form-control" />
      <table id="datatable" class="table table-striped table-bordered" style="width:100%">
         <tr>
            <td><label>Supplier</label></td>
            <td><input type="text" name="supplier" id="jq_supplier" value="' . $v_supplier . '" class="form-control" ' . $is_readonly . '/></td>
         <tr>
            <td><label>Email</label></td>
            <td><input type="text" name="email" id="jq_email" value="' . $v_email . '" class="form-control" ' . $is_readonly . '/></td>
         </tr>
          <tr>
            <td><label>No Telepon</label></td>
            <td><input type="text" name="telepon" id="jq_telepon" value="' . $v_telp . '" class="form-control" ' . $is_readonly . '/></td>
         </tr>
          <tr>
            <td><label>Alamat</label></td>
            <td><textarea name="address" id="jq_address" class="form-control"  ' . $is_readonly . '>' . $v_addres . '</textarea></td>
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
            <th width="21%">Supplier</th>
            <th width="21%">Email</th>
            <th width="21%">Telepon</th> 
            <th width="21%">Alamat</th> 
            <th width="16%">Option</th> 
         </tr>
      </thead>
      <tbody>
      ';
      $input = ['body' => ['id' => '']];
      $hasil = get_data_detail($input);
      if (is_array($hasil) && count($hasil)) {
         foreach ($hasil as $row) :
            $row = htmlentities_array($row);
            $output .= '
            <tr>  
               <td>' . $row["supplier_name"] . '</td>
               <td>' . $row["email"] . '</td>
               <td>' . $row["telp"] . '</td> 
               <td>' . $row["addres"] . '</td>  
               <td>
                  <button type="button" name="view" id="' . $row["id"] . '" class="btn btn-info btn-xs view_data"><i class="fa fa-eye"></i></button>
                  <button type="button" name="edit" id="' . $row["id"] . '" class="btn btn-warning btn-xs edit_data"><i class="fa fa-pencil-square"></i></button>                                  
                  <button type="button" name="archive" id="' . $row["id"] . '" class="btn btn-danger btn-xs archive_data"><i class="fa fa-archive"></i></button></td>
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
            <th width="20%">Supplier</th>
            <th width="20%">Email</th>
            <th width="20%">Telepon</th> 
            <th width="20%">Alamat</th> 
            <th width="20%">Option</th> 
         </tr>
      </thead>
      <tbody>
      ';
      $input = ['body' => ['is_archive' => '']];
      $hasil = get_data_detail($input);
      if (is_array($hasil) && count($hasil)) {
         foreach ($hasil as $row) :
            $row = htmlentities_array($row);
            $output .= '
            <tr>  
               <td>' . $row["supplier_name"] . '</td>
               <td>' . $row["email"] . '</td>
               <td>' . $row["telp"] . '</td> 
               <td>' . $row["addres"] . '</td>  
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
