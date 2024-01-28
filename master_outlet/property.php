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
            $v_outlet_code = $row['outlet_code'];
            $v_outlet_name = $row['outlet_name'];
            $v_warehouse_id = $row['warehouse_id'];
            $v_warehouse_name = $row['warehouse_name'];
            $v_decription = $row['description'];
         endforeach;
      } else {
         $v_id = '';
         $v_outlet_code = '';
         $v_outlet_name = '';
         $v_warehouse_id = '';
         $v_warehouse_name = '';
         $v_decription = '';
      }

      $output .= '
      <form method="POST" id="update_form">
         <input type="hidden" name="id" id="jq_id" value="' . $v_id . '"/>
         <input type="hidden" name="action_status" id="jq_action_status" value="' . $_POST['action_status'] . '"/>
      <table id="datatable" class="table table-striped table-bordered" style="width:100%">
         <tr>
            <td><label>Outlet Code</label></td>
            <td><input type="text" name="outlet_code" id="jq_outlet_code" value="' . $v_outlet_code . '" class="form-control" ' . $is_readonly . '/></td>
         </tr>
         <tr>
         <tr>
            <td><label>Outlet Name</label></td>
            <td><input type="text" name="outlet_name" id="jq_outlet_name" value="' . $v_outlet_name . '" class="form-control" ' . $is_readonly . '/></td>
         </tr>
         <tr>
            <td><label>Warehouse</label></td>
            <td>
               <div class="input-group">
                  <input type="hidden" name="warehouse_id" id="jq_warehouse_id" value="' . $v_warehouse_id . '" class="form-control" readonly=true/>
                  <input type="text" name="warehouse_name" id="jq_warehouse_name" value="' . $v_warehouse_name . '" class="form-control" readonly=true/>
                  <span class="input-group-btn" ' . $is_disable_span . '>
                     <button type="button" name="choose_warehouse_data" id="" class="btn btn-warning btn-xs choose_warehouse_data"><i class="fa fa-hand-o-up"></i></button>
                  </span>
               </div>
            </td>
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
            <th width="27%">Outlet Code</th>
            <th width="27%">Outlet Name</th>
            <th width="26%">Warehouse</th>
            <th width="20%">Option</th> 
         </tr>
      </thead>
      <tbody>
      ';
      $input = ['body' => ['id' => null]];
      $hasil = get_data_detail($input);
      if (is_array($hasil) && count($hasil)) {
         foreach ($hasil as $row) :
            $row = casting_htmlentities_array($row);
            $output .= '
            <tr>  
               <td>' . $row["outlet_code"] . '</td>
               <td>' . $row["outlet_name"] . '</td>
               <td>' . $row["warehouse_name"] . '</td>
               <td>
                  <button type="button" name="view" id="' . $row["id"] . '" class="btn btn-info btn-xs view_data"><i class="fa fa-eye"></i></button>
                  <button type="button" name="edit" id="' . $row["id"] . '" class="btn btn-warning btn-xs edit_data"><i class="fa fa-pencil-square"></i></button>                                  
                  <button type="button" name="archive" id="' . $row["id"] . '" class="btn btn-danger btn-xs archive_data"><i class="fa fa-archive"></i></button>
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
            <th width="20%">Outlet Code</th>
            <th width="20%">Outlet Name</th>
            <th width="20%">Warehouse</th>
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
               <td>' . $row["outlet_code"] . '</td>
               <td>' . $row["outlet_name"] . '</td>
               <td>' . $row["warehouse_name"] . '</td>
               <td>' . $row["description"] . '</td>
               <td>
               <button type="button" name="unarchive" value="Unarchive" id="' . $row["id"] . '" class="btn btn-danger unarchive_data"><i class="fa fa-upload"></i></button>
               </td>
            </tr>
         ';
         endforeach;
      }
      $output .= '</tbody></table>';
   } elseif ($_POST['action_status'] == 'choose_warehouse_data') {
      $output .= '
      <table id="select_table" class="table table-striped table-bordered" style="width:100%">
         <thead>
         <tr>
            <th width="40%">Warehouse Code</th>
            <th width="40%">Warehouse Name</th>
            <th width="20%">Option</th> 
         </tr>
      </thead>
      <tbody>
      ';
      $input = ['body' => ['id' => null]];
      $hasil = get_data_warehouse($input);
      if (is_array($hasil) && count($hasil)) {
         foreach ($hasil as $row) :
            $row = casting_htmlentities_array($row);
            $output .= '
            <tr>  
               <td>' . $row["warehouse_code"] . '</td>
               <td>' . $row["warehouse_name"] . '</td>
               <td><button type="button" name="select" id="' . $row["id"] . '" class="btn btn-warning btn-xs select_warehouse_data"><i class="fa fa-hand-o-up"></i></button>                                  
               </td>
            </tr>
         ';
         endforeach;
      }
      $output .= '</tbody></table>';
   }
   echo $output;
}
