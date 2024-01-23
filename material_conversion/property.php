<?php
include("api.php");
if (!empty($_POST)) {
  $output = '';

  // Menampilkan Popup Edit Detail Product
  if ($_POST["action_status"] == "edit_product" || $_POST["action_status"] == "select_product") {
    if ($_POST["action_status"] == "select_product") {
      // $input = array("body" => array("inventory_id" => $_POST["data_id"], "material_conversion_id" => $_POST["transaction_id"]));
      $input = array("body" => array("inventory_id" => $_POST["data_id"], "material_conversion_id" => $_POST["transaction_id"]));
      $hasil = insert_transaction_detail($input);
      $is_read_only = '';
      $is_disable_span = '';
      if (is_array($hasil) && count($hasil)) {
        foreach ($hasil as $row) :
          $input = $row["id"];
        endforeach;
      }
      $input = array("body" => array("id" => $input));
      $action_status = "edit_product";
    } elseif ($_POST["action_status"] == "edit_product") {
      $input = array("body" => array("id" => $_POST["data_id"]));
      $action_status = $_POST["action_status"];
      $is_read_only = '';
      $is_disable_span = '';
    } elseif ($_POST["action_status"] == "detail_product") {
      $input = array("body" => array("id" => $_POST["data_id"]));
      $action_status = $_POST["action_status"];
      $is_read_only = 'readonly=true';
      $is_disable_span = 'hidden';
    }
    $hasil = get_transaction_detail($input);
    if (is_array($hasil) && count($hasil)) {
      foreach ($hasil as $row) :
        $output .= '
          <form method="post" id="update_form">
            <input type="hidden" name="transaction_id" id="jq_transaction_id" value="' . $_POST["transaction_id"] . '" class="form-control col-md-7 col-xs-12" readonly="true">
            <input type="hidden" name="action_status" id="jq_action_status" value="' . $action_status . '" class="form-control col-md-7 col-xs-12" readonly="true">
            <input type="hidden" name="id" id="jq_id" value="' . $row['id'] . '" class="form-control" readonly=true/>
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <tr>
                <td><label>Inventory</label></td>
                <td><input type="hidden" name="inventory_id" id="jq_inventory_id" value="' . $row['inventory_id'] . '" class="form-control" readonly=true/>
                    <input type="text" name="inventory_name" id="jq_inventory_name" value="' . $row['inventory_name'] . '" class="form-control" readonly=true/></td>
              </tr>
              <tr>
                <td><label>Qty</label></td>
                <td> <input type="number" step="0.01" name="qty" id="jq_qty" value="' . $row['qty'] . '" class="form-control" ' . $is_read_only . '/></td>
              </tr>
              <tr>
                <td><label>Unit</label></td>
                  <td>
                    <div class="input-group">
                        <input type="hidden" name="unit_id" id="jq_unit_id" value="' . $row['unit_id'] . '" class="form-control" readonly=true/>
                        <input type="text" name="unit_name" id="jq_unit_name" value="' . $row['unit_name'] . '" class="form-control" readonly=true/>
                        <span class="input-group-btn" ' . $is_disable_span . '>
                          <button type="button" name="choose_unit_detail_data" id="" class="btn btn-warning btn-xs choose_unit_detail_data"><i class="fa fa-hand-o-up"></i></button>
                        </span>
                    </div>
                  </td>
              </tr>
              <tr>
                <td><label>Warehouse</label></td>
                  <td>
                    <div class="input-group">
                        <input type="hidden" name="warehouse_id" id="jq_warehouse_id" value="' . $row['warehouse_id'] . '" class="form-control" readonly=true/>
                        <input type="text" name="warehouse_name" id="jq_warehouse_name" value="' . $row['warehouse_name'] . '" class="form-control" readonly=true/>
                        <span class="input-group-btn" ' . $is_disable_span . '>
                          <button type="button" name="choose_warehouse_detail_data" id="" class="btn btn-warning btn-xs choose_warehouse_detail_data"><i class="fa fa-hand-o-up"></i></button>
                        </span>
                    </div>
                  </td>
              </tr>
              <tr>
                <td><label>Batch Number</label></td>
                <td> <input type="text" name="batch_number" id="jq_batch_number" value="' . $row['batch_number'] . '" class="form-control"  readonly=true/></td>
              </tr>
              <tr>
                <td><label>Expired Date</label></td>
                <td> <input type="date" name="expired_date" id="jq_expired_date" value="' . $row['expired_date'] . '" class="form-control" readonly=true/></td>
              </tr>
            <tr>
              <td><label>Description</label></td>
              <td><textarea name="description" id="jq_description" class="form-control" ' . $is_read_only . '>' . $row["description"] . '</textarea></</td>
            </tr>
          </table>
          <span class="input-group-btn">
            <input type="button" name="update" id="jq_update" value="Update" class="btn btn-success update_detail" />
          </span>
          </form>
          ';
      endforeach;
    } else {
      $output .= '<h3 style="color:red" class="error">Data has been entered</h3>';
    }
    $input = '';
  } elseif ($_POST["action_status"] == "refresh_list_product") {
    $output .= '
      <table id="data_product_table" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr>
            <th>Inventory Code</th>
            <th>Inventory Name</th>
            <th>Qty</th>
            <th>Unit</th>
            <th>Option</th>
          </tr>
        </thead>
        <tbody>
        ';
    $input = array("body" => array("material_conversion_id" => $_POST["transaction_id"]));
    $hasil = get_product_for_transaction($input);
    if (is_array($hasil) && count($hasil)) {
      foreach ($hasil as $row) :
        $output .= '
          <tr>
            <td>' . $row['inventory_code'] . '</td>
            <td>' . $row['inventory_name'] . '</td>
            <td class ="jq_format_decimal_table">' . $row["stock"] . '</td>
            <td>' . $row['unit_name'] . '</td>
            <td><button type="button" name="select" id="' . $row['id'] . '" class="btn btn-warning btn-xs select_data"><i class="fa fa-check-square-o"></i></button></td>  
          </tr>
          ';
      endforeach;
    }
    $output .= '</tbody></table>';
  } elseif ($_POST["action_status"] == "refresh_list_material_conversion_detail") {
    $output .= '
      <table id="data_material_conversion_table" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr>
            <th>Inventory</th>
            <th>Qty</th>
            <th>Unit</th>
            <th>Warehouse</th>
            <th>Batch Number</th>
            <th>Expired Date</th>
            <th>Option</th>
          </tr>
        </thead>
        <tbody>
        ';
    $input = array("body" => array("material_conversion_id" => $_POST["transaction_id"]));
    $hasil = get_transaction_detail($input);
    if (is_array($hasil) && count($hasil)) {
      foreach ($hasil as $row) :
        $output .= '
          <tr>
            <td>' . $row['inventory_name'] . '</td>
            <td class ="jq_format_decimal_table">' . $row['qty'] . '</td>
            <td>' . $row['unit_name'] . '</td>
            <td>' . $row['warehouse_name'] . '</td>
            <td>' . $row['batch_number'] . '</td>
            <td class ="jq_format_date_table">' . $row['expired_date'] . '</td>
            <td><button type="button" name="view" id="' . $row["id"] . '" class="btn btn-info btn-xs view_data"><i class="fa fa-eye"></i></button>
                <button type="button" name="edit" id="' . $row["id"] . '" class="btn btn-warning btn-xs edit_data"><i class="fa fa-pencil-square"></i></button>                                  
                <button type="button" name="remove" id="' . $row["id"] . '" class="btn btn-danger btn-xs delete_data"><i class="fa fa-trash"></i></button></td>
          </tr>
          ';
      endforeach;
    }
    $output .= '</tbody></table>';
    $input = '';
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
        $output .= '
            <tr>  
               <td>' . $row["warehouse_code"] . '</td>
               <td>' . $row["warehouse_name"] . '</td>
               <td><button type="button" name="select" id="' . $row["id"] . '" class="btn btn-warning btn-xs ' . $_POST['add_class'] . '">Select</button>                                  
               </td>
            </tr>
         ';
      endforeach;
    }
    $output .= '</tbody></table>';
  } elseif ($_POST['action_status'] == 'choose_inventory_data') {
    $output .= '
      <table id="select_table" class="table table-striped table-bordered" style="width:100%">
         <thead>
         <tr>
            <th width="40%">Inventory Code</th>
            <th width="40%">Inventory Name</th>
            <th width="40%">Inventory Category</th>
            <th width="20%">Option</th> 
         </tr>
      </thead>
      <tbody>
      ';
    $input = ['body' => ['id' => null]];
    $hasil = get_data_inventory($input);
    if (is_array($hasil) && count($hasil)) {
      foreach ($hasil as $row) :
        $output .= '
            <tr>  
               <td>' . $row["inventory_code"] . '</td>
               <td>' . $row["inventory_name"] . '</td>
               <td>' . $row["inventory_category_name"] . '</td>
               <td><button type="button" name="select" id="' . $row["id"] . '" class="btn btn-warning btn-xs select_inventory_data">Select</button>                                  
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
            <th>Unit</th>
            <th>Option</th> 
         </tr>
      </thead>
      <tbody>
      ';
    $input = ['body' => ['id' => $_POST['data_id']]];
    $hasil = get_data_unit($input);
    if (is_array($hasil) && count($hasil)) {
      foreach ($hasil as $row) :
        $output .= '
            <tr>  
               <td>' . $row["unit_name"] . '</td>
               <td><button type="button" name="select" id="' . $row["id"] . '" class="btn btn-warning btn-xs ' . $_POST['add_class'] . '">Select</button>                                  
               </td>
            </tr>
         ';
      endforeach;
    }
    $output .= '</tbody></table>';
  }
  echo $output;
}
