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
            $v_inventory_category_code = $row['inventory_category_code'];
            $v_inventory_category_name = $row['inventory_category_name'];
            $v_inventory_account_id = $row['inventory_account_id'];
            $v_inventory_account_name = $row['inventory_account_name'];
            $v_sales_account_id = $row['sales_account_id'];
            $v_sales_account_name = $row['sales_account_name'];
            $v_expenses_account_id = $row['expenses_account_id'];
            $v_expenses_account_name = $row['expenses_account_name'];
            $v_decription = $row['description'];
         endforeach;
      } else {
         $v_id = '';
         $v_inventory_category_code = '';
         $v_inventory_category_name = '';
         $v_inventory_account_id = '';
         $v_inventory_account_name = '';
         $v_sales_account_id = '';
         $v_sales_account_name = '';
         $v_expenses_account_id = '';
         $v_expenses_account_name = '';
         $v_decription = '';
      }

      $output .= '
      <form method="POST" id="update_form">
         <input type="hidden" name="id" id="jq_id" value="' . $v_id . '" class="form-control" />
         <input type="hidden" name="action_status" id="jq_action_status" value="' . $_POST['action_status'] . '" class="form-control" />
         <input type="hidden" name="created_by" id="jq_created_by" value="' . $_POST['created_by'] . '" class="form-control" />
      <table id="datatable" class="table table-striped table-bordered" style="width:100%">
         <tr>
            <td><label>Inv Category Code</label></td>
            <td><input type="text" name="code" id="jq_code" value="' . $v_inventory_category_code . '" class="form-control" ' . $is_readonly . '/></td>
         <tr>
            <td><label>Inv Category Name</label></td>
            <td><input type="text" name="name" id="jq_name" value="' . $v_inventory_category_name . '" class="form-control" ' . $is_readonly . '/></td>
         </tr>
         <tr>
            <td><label>Inventory Account</label></td>
            <td>
               <div class="input-group">
                  <input type="hidden" name="inventory_account_id" id="jq_inventory_account_id" value="' . $v_inventory_account_id . '" class="form-control" readonly=true/>
                  <input type="text" name="inventory_account_name" id="jq_inventory_account_name" value="' . $v_inventory_account_name . '" class="form-control" readonly=true/>
                  <span class="input-group-btn" ' . $is_disable_span . '>
                     <button type="button" name="choose_inventory_account_data" id="jq_choose_inventory_account_data" class="btn btn-warning btn-xs choose_inventory_account_data"><i class="fa fa-hand-o-up"></i></button>
                  </span>
               </div>
            </td>
         </tr>
         <tr>
            <td><label>Sales Account</label></td>
            <td>
               <div class="input-group">
                  <input type="hidden" name="sales_account_id" id="jq_sales_account_id" value="' . $v_sales_account_id . '" class="form-control" readonly=true/>
                  <input type="text" name="sales_account_name" id="jq_sales_account_name" value="' . $v_sales_account_name . '" class="form-control" readonly=true/>
                  <span class="input-group-btn" ' . $is_disable_span . '>
                     <button type="button" name="choose_sales_account_data" id="jq_choose_sales_account_data" class="btn btn-warning btn-xs choose_sales_account_data"><i class="fa fa-hand-o-up"></i></button>
                  </span>
               </div>
            </td>
         </tr>
         <tr>
            <td><label>Expenses Account</label></td>
            <td>
               <div class="input-group">
                  <input type="hidden" name="expenses_account_id" id="jq_expenses_account_id" value="' . $v_expenses_account_id . '" class="form-control" readonly=true/>
                  <input type="text" name="expenses_account_name" id="jq_expenses_account_name" value="' . $v_expenses_account_name . '" class="form-control" readonly=true/>
                  <span class="input-group-btn" ' . $is_disable_span . '>
                     <button type="button" name="choose_expenses_account_data" id="jq_choose_expenses_account_data" class="btn btn-warning btn-xs choose_expenses_account_data"><i class="fa fa-hand-o-up"></i></button>
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
            <th width="30%">Inv Category Code</th>
            <th width="30%">Inv Category Name</th>
            <th width="22%">Option</th> 
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
               <td>' . $row["inventory_category_code"] . '</td>
               <td>' . $row["inventory_category_name"] . '</td>  
               <td><button type="button" name="view" id="' . $row["id"] . '" class="btn btn-info btn-xs view_data"><i class="fa fa-eye"></i></button>
                   <button type="button" name="edit" id="' . $row["id"] . '" class="btn btn-warning btn-xs edit_data"><i class="fa fa-pencil-square"></i></button>                                  
                   <button type="button" name="archive" id="' . $row["id"] . '" class="btn btn-danger btn-xs archive_data"><i class="fa fa-archive"></i></button></td>
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
            <th width="20%">Inv Category Code</th>
            <th width="20%">Inv Category Name</th> 
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
               <td>' . $row["inventory_category_code"] . '</td>
               <td>' . $row["inventory_category_name"] . '</td>
               <td>' . $row["description"] . '</td>
               <td>
               <button type="button" name="unarchive" value="Unarchive" id="' . $row["id"] . '" class="btn btn-danger unarchive_data"><i class="fa fa-upload"></i></button>
               </td>
            </tr>
         ';
         endforeach;
      }
      $output .= '</tbody></table>';
   } elseif ($_POST['action_status'] == 'choose_account_data') {
      $output .= '
      <table id="select_table" class="table table-striped table-bordered" style="width:100%">
         <thead>
         <tr>
            <th width="40%">Account Code</th>
            <th width="40%">Account Name</th>
            <th width="20%">Option</th> 
         </tr>
      </thead>
      <tbody>
      ';
      $button_name = ($_POST['action_variant']);
      $input = ['body' => ['id' => null]];
      $hasil = get_account_data($input);
      if (is_array($hasil) && count($hasil)) {
         foreach ($hasil as $row) :
            $output .= '
            <tr>  
               <td>' . $row["account_code"] . '</td>
               <td>' . $row["account_name"] . '</td>
               <td><button type="button" name="select" id="' . $row["id"] . '" class="btn btn-warning btn-xs ' . $button_name . '">Select</button>                                  
               </td>
            </tr>
         ';
         endforeach;
      }
      $output .= '</tbody></table>';
   }
   echo $output;
}
