<?php
function get_detail_ratio_tabel($arg_inventory_id)
{
   $output =
      '<table id="ratio_unit_table" class="table table-striped table-bordered mt-2"> <!-- Adjusted margin-top -->
      <thead>
         <tr>
            <th>Ratio</th>
            <th>Unit</th>
            <th>Option</th> 
         </tr>
             
      </thead>
      <tbody>
      ';
   $input = ['body' => ['id' => $arg_inventory_id]];
   $hasil = get_data_detail_ratio($input);
   if (is_array($hasil) && count($hasil)) {
      foreach ($hasil as $row) :
         if ($row["is_default"]) {
            $color = "bgcolor='lightgreen'";
            $button = "Cannot Change Unit Default";
         } else {
            $color = '';
            $button = ' <button type="button" name="edit" id="' . $row["id"] . '" class="btn btn-warning btn-xs edit_data_ratio"><i class="fa fa-pencil-square"></i></button>                                  
                <button type="button" name="remove" id="' . $row["id"] . '" class="btn btn-danger btn-xs delete_data_ratio"><i class="fa fa-trash"></i></button>';
         }

         $output .= '
            <tr>  
               <td class ="jq_format_decimal_table"' . $color . '>' . $row["ratio"] . '</td>
               <td ' . $color . '>' . $row["unit_name"] . '</td>  
               <td ' . $color . '>' . $button . '</td>
            </tr>
         ';
      endforeach;
   }
   $output .= '</tbody></table>';
   return $output;
}

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
            $v_inventory_code = $row['inventory_code'];
            $v_inventory_name = $row['inventory_name'];
            $v_inventory_category_id = $row['inventory_category_id'];
            $v_inventory_category_name = $row['inventory_category_name'];
            $v_unit_id = $row['unit_id'];
            $v_unit_name = $row['unit_name'];
            $v_purchase_price = $row['purchase_price'];
            $v_sales_price = $row['sales_price'];
            $v_decription = $row['description'];
         endforeach;
      } else {
         $v_id = '';
         $v_inventory_code = '';
         $v_inventory_name = '';
         $v_inventory_category_id = '';
         $v_inventory_category_name = '';
         $v_unit_id = '';
         $v_unit_name = '';
         $v_purchase_price = '0';
         $v_sales_price = '0';
         $v_decription = '';
      }

      $output .= '
      <div class="x_content">
      <ul class="nav nav-tabs bar_tabs fixed-top" id="myTab" role="tablist">
          <li class="nav-item">
              <a class="nav-link active" id="master-tab" data-toggle="tab" href="#jq_tab_master" role="tab" aria-controls="master" aria-selected="true">Master Data</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" id="ratio-tab" data-toggle="tab" href="#jq_tab_ratio" role="tab" aria-controls="ratio" aria-selected="false">Ratio Unit</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" id="data-tab" data-toggle="tab" href="#jq_tab_barcode" role="tab" aria-controls="data" aria-selected="false">Data</a>
          </li>
      </ul>

      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="jq_tab_master" role="tabpanel" aria-labelledby="master-tab">
            <form method="POST" id="update_form">
         <input type="hidden" name="id" id="jq_id" value="' . $v_id . '" class="form-control" />
         <input type="hidden" name="action_status" id="jq_action_status" value="' . $_POST['action_status'] . '" class="form-control" />
         <input type="hidden" name="created_by" id="jq_created_by" value="' . $_POST['created_by'] . '" class="form-control" />
      <table id="datatable" class="table table-striped table-bordered" style="width:100%">
         <tr>
            <td><label>Inventory Code</label></td>
            <td><input type="text" name="inventory_code" id="jq_inventory_code" value="' . $v_inventory_code . '" class="form-control" ' . $is_readonly . '/></td>
         </tr>
         <tr>
         <tr>
            <td><label>Inventory Name</label></td>
            <td><input type="text" name="inventory_name" id="jq_inventory_name" value="' . $v_inventory_name . '" class="form-control" ' . $is_readonly . '/></td>
         </tr>
         <tr>
            <td><label>Inventory Category</label></td>
            <td>
               <div class="input-group">
                  <input type="hidden" name="inventory_category_id" id="jq_inventory_category_id" value="' . $v_inventory_category_id . '" class="form-control" readonly=true/>
                  <input type="text" name="inventory_category_name" id="jq_inventory_category_name" value="' . $v_inventory_category_name . '" class="form-control" readonly=true/>
                  <span class="input-group-btn" ' . $is_disable_span . '>
                     <button type="button" name="choose_inventory_category_data" id="jq_choose_inventory_category_data" class="btn btn-warning btn-xs choose_inventory_category_data"><i class="fa fa-hand-o-up"></i></button>
                  </span>
               </div>
            </td>
         </tr>
         <tr>
            <td><label>Unit Default</label></td>
            <td>
               <div class="input-group">
                  <input type="hidden" name="unit_id" id="jq_unit_id" value="' . $v_unit_id . '" class="form-control" readonly=true/>
                  <input type="text" name="unit_name" id="jq_unit_name" value="' . $v_unit_name . '" class="form-control" readonly=true/>
                  <span class="input-group-btn" ' . $is_disable_span . '>
                     <button type="button" name="choose_unit_data" id="jq_choose_unit_data" class="btn btn-warning btn-xs choose_unit_data"><i class="fa fa-hand-o-up"></i></button>
                  </span>
               </div>
            </td>
         </tr>
         <tr>
            <td><label>Purchase Price</label></td>
            <td><input type="number" name="purchase_price" id="jq_purchase_price" value="' . $v_purchase_price . '" class="form-control jq_input_numeric" ' . $is_readonly . '/></td>
         </tr>
          <tr>
            <td><label>Sales Price</label></td>
            <td><input type="number" name="sales_price" id="jq_sales_price" value="' . $v_sales_price . '" class="form-control jq_input_numeric" ' . $is_readonly . '/></td>
         </tr>
          <tr>
            <td><label>Description</label></td>
            <td><textarea name="desc" id="jq_desc" class="form-control" ' . $is_readonly . '>' . $v_decription . '</textarea></td>
         </tr>
      </table>
         <span class="input-group-btn" ' . $is_disable_span .
         '>
           <input type="button" name="update" id="jq_update" value="Update" class="btn btn-success update_detail" />
         </span>
      </form>
        </div>

        <div class="tab-pane fade" id="jq_tab_ratio" role="tabpanel" aria-labelledby="ratio-tab">
        <div align="right">
          <button type="button" name="add_data_ratio" id="jq_add_data_ratio" class="btn btn-warning add_data_ratio"><i class="fa fa-plus-circle">Add Unit Ratio</i></button>
          <button type="button" name="refresh_data_ratio" id="jq_refresh__data_ratio" class="btn btn-success refresh_data_ratio"><i class="fa fa-refresh"></i></button>
        </div>   
        <div id=jq_get_detail_ratio_tabel>
       ' . get_detail_ratio_tabel($v_id) . '
       </div>
        </div>

        <div class="tab-pane fade" id="jq_tab_barcode" role="tabpanel" aria-labelledby="data-tab">
            <table id="barcode_table" class="table table-striped table-bordered mt-2"> <!-- Adjusted margin-top -->
               <thead>
                  <tr>
                     <th>Product Name</th>
                     <th>QTY</th>
                     <th>Unit Price</th>
                     <th>Total Disc</th> 
                     <th>Grand Total</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>Tissue</td>
                     <td>1</td>
                     <td>6000</td>
                     <td>1000</td>
                     <td>5000</td>
                  </tr>                            
                  <tr>
                     <td>Tissue</td>
                     <td>1</td>
                     <td>6000</td>
                     <td>1000</td>
                     <td>5000</td>
                  </tr>                            
                  <tr>
                     <td>Tissue</td>
                     <td>1</td>
                     <td>6000</td>
                     <td>1000</td>
                     <td>5000</td>
                  </tr>
               </tbody>
               </table>
        </div>
      </div>
      ';
   } elseif ($_POST['action_status'] == 'refresh_data_detail') {
      $output .= '
      <table id="master_table" class="table table-striped table-bordered" style="width:100%">
         <thead>
         <tr>
            <th>Inventory Code</th>
            <th>Inventory Name</th>
            <th>Unit Default</th> 
            <th>Purchase Price</th> 
            <th>Sales Price</th> 
            <th>Option</th> 
         </tr>
      </thead>
      <tbody>
      ';
      $input = ['body' => ['id' => null]];
      $hasil = get_data_detail($input);
      if (is_array($hasil) && count($hasil)) {
         foreach ($hasil as $row) :
            $output .= '
            <tr>  
               <td>' . $row["inventory_code"] . '</td>
               <td>' . $row["inventory_name"] . '</td>
               <td>' . $row["unit_name"] . '</td>  
               <td class ="jq_function jq_format_decimal">' . $row["purchase_price"] . '</td> 
               <td class ="jq_function jq_format_decimal">' . $row["sales_price"] . '</td>  
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
            <th>Inventory Code</th>
            <th>Inventory Name</th>
            <th>Description</th> 
            <th>Option</th> 
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
               <td>' . $row["inventory_code"] . '</td>
               <td>' . $row["inventory_name"] . '</td>
               <td>' . $row["description"] . '</td>
               <td>
               <button type="button" name="unarchive" value="Unarchive" id="' . $row["id"] . '" class="btn btn-danger unarchive_data"><i class="fa fa-upload"></i></button>
               </td>
            </tr>
         ';
         endforeach;
      }
      $output .= '</tbody></table>';
   } elseif ($_POST['action_status'] == 'choose_unit_data') {
      $output .= '
      <table id="select_table" class="table table-striped table-bordered" style="width:100%">
         <thead>
         <tr>
            <th width="40%">Unit Code</th>
            <th width="40%">Unit Name</th>
            <th width="20%">Option</th> 
         </tr>
      </thead>
      <tbody>
      ';
      $button_name = ($_POST['action_variant']);
      $input = ['body' => ['id' => null]];
      $hasil = get_data_unit($input);
      if (is_array($hasil) && count($hasil)) {
         foreach ($hasil as $row) :
            $output .= '
            <tr>  
               <td>' . $row["unit_code"] . '</td>
               <td>' . $row["unit_name"] . '</td>
               <td><button type="button" name="select" id="' . $row["id"] . '" class="btn btn-warning btn-xs ' . $button_name . '">Select</button>                                  
               </td>
            </tr>
         ';
         endforeach;
      }
      $output .= '</tbody></table>';
   } elseif ($_POST['action_status'] == 'choose_inventory_category_data') {
      $output .= '
      <table id="select_table" class="table table-striped table-bordered" style="width:100%">
         <thead>
         <tr>
            <th width="40%">Inv Category Code</th>
            <th width="40%">Inv Category Name</th>
            <th width="20%">Option</th> 
         </tr>
      </thead>
      <tbody>
      ';
      $input = ['body' => ['id' => null]];
      $hasil = get_data_inventory_category($input);
      if (is_array($hasil) && count($hasil)) {
         foreach ($hasil as $row) :
            $output .= '
            <tr>  
               <td>' . $row["inventory_category_code"] . '</td>
               <td>' . $row["inventory_category_name"] . '</td>
               <td><button type="button" name="select" id="' . $row["id"] . '" class="btn btn-warning btn-xs select_inventory_category_data">Select</button>                                  
               </td>
            </tr>
         ';
         endforeach;
      }
      $output .= '</tbody></table>';
   } elseif ($_POST["action_status"] == "select_unit_ratio_add" || $_POST["action_status"] == "select_unit_ratio_edit") {
      if ($_POST["action_status"] == "select_unit_ratio_add") {
         $input = array("body" => array("unit_id" => $_POST["data_id"], "inventory_id" => $_POST["inventory_id"], "created_by" => $_POST["created_by"]));
         $hasil = set_new_data_detail_ratio($input);
         $is_read_only = '';
         $is_disable_span = '';
         if (is_array($hasil) && count($hasil)) {
            foreach ($hasil as $baris) :
               $input = $baris["id"];
            endforeach;
         }
         $input = array("body" => array("data_id" => $input));
      } elseif ($_POST["action_status"] == "select_unit_ratio_edit") {
         $input = array("body" => array("data_id" => $_POST["data_id"]));
         $action_status = $_POST["action_status"];
         $is_read_only = '';
         $is_disable_span = '';
      }
      $hasil = get_data_detail_ratio($input);
      if (is_array($hasil) && count($hasil)) {
         foreach ($hasil as $baris) :
            $output .= '
      <form method="post" id="form_update_detail_unit_ratio">
        <input type="hidden" name="inventory_id" id="jq_inventory_id" value="' . $_POST["inventory_id"] . '" class="form-control col-md-7 col-xs-12" readonly="true">
        <input type="hidden" name="action_status" id="jq_action_status" value="set_new_detail_ratio" class="form-control col-md-7 col-xs-12" readonly="true">
        <input type="hidden" name="id" id="jq_id" value="' . $baris["id"] . '" class="form-control" readonly=true/>
        <input type="hidden" name="created_by" id="jq_created_by" value="' . $_POST["created_by"] . '" class="form-control" readonly=true/>
        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
          <tr>
            <td><label>Ratio</label></td>
            <td> <input  type="number" name="ratio" id="jq_ratio" value="' . $baris["ratio"] . '"onmouseover="this.focus();" class="form-control jq_input_numeric"' . $is_read_only . '/></td>
          </tr>
          <tr>
            <td><label>Unit Ratio</label></td>
            <td>
            <input type="hidden" name="unit_id" id="jq_unit_id" value="' . $baris["unit_id"] . '" class="form-control" readonly=true/>
            <input type="text" name="unit_name" id="jq_unit_name" value="' . $baris["unit_name"] . '" class="form-control" readonly=true/></td>
          </tr>
          <tr>
            <td><label>Description</label></td>
            <td><textarea name="description" id="jq_description" class="form-control" ' . $is_read_only . '>' . $baris["description"] . '</textarea></</td>
          </tr>
      </table>
         <span class="input-group-btn" ' . $is_disable_span . '>
           <input type="button" name="update_detail_unit_ratio" id="jq_update_detail_unit_ratio" value="Update" class="btn btn-success update_detail_unit_ratio" />
         </span>
    </form>
      ';
         endforeach;
      } else {
         $output .= '<h3 style="color:red" class="error">Data has been entered</h3>';
      }
   } elseif ($_POST["action_status"] == "refresh_data_ratio") {
      $output = get_detail_ratio_tabel($_POST["data_id"]);
   }

   echo $output;
}
