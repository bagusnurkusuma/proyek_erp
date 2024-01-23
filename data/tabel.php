<?php

function get_data_detail($input_function)
{
  include "../asset_default/koneksi.php";
  $input = json_encode($input_function);
  $query = "SELECT * FROM accounting.get_account_balance_sheets(null) as result";
  $result = pg_query($link, $query);
  $row = pg_fetch_array($result);
  $hasil = json_decode($row["result"], true);
  $hasil = $hasil["body"];
  return $hasil;
}

function get_data_structure($input_function)
{
  include "../asset_default/koneksi.php";
  $input = json_encode($input_function);
  $query = "SELECT * FROM accounting.get_finance_report_structure(null) as result";
  $result = pg_query($link, $query);
  $row = pg_fetch_array($result);
  $hasil = json_decode($row["result"], true);
  $hasil = $hasil["body"];
  return $hasil;
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Styled Table Example</title>
  <style>
    /* CSS styles for the table */
    table {
      border-collapse: collapse;
      width: 100%;
      border: 1px solid #dddddd;
    }

    th,
    td {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>

<body>
  <table id="structure_table" hidden="hidden">
    <tbody>
      <?php
      $hasil = get_data_structure(null);
      if (is_array($hasil) && count($hasil)) {
        foreach ($hasil as $row) :
      ?>
          <tr id=<?php echo $row["structure_id"] ?> class=<?php echo $row["parent_id"] ?> data-level=<?php echo $row["level"] ?> data-level=<?php echo $row["level"] ?>>
            <td><?php echo $row["structure_name"] ?> </td>
        <?php endforeach;
      } ?>
          </tr>
    </tbody>
  </table>

  <table id="main_table">
    <thead>
      <tr>
        <th>Balance Sheets</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $hasil = get_data_detail(null);
      if (is_array($hasil) && count($hasil)) {
        foreach ($hasil as $row) : ?>
          <tr id=<?php echo $row["account_id"] ?> class=<?php echo $row["structure_id"] ?> data-level=<?php echo $row["level"] ?>>
            <td id="structure_name"><?php echo $row["account_concat"] ?> </td>
            <td id="total" class="jq_format_decimal_table"><?php echo $row["total"] ?> </td>
        <?php endforeach;
      } ?>
          </tr>
    </tbody>
  </table>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../asset_default/function.js"></script>
<script>
  function get_total_structure(arg_input) {
    var sum = 0;
    var id = arg_input.attr("id");
    var parent_id = arg_input.attr("class");
    var parent_level = arg_input.data('level');
    var name = arg_input.text();
    var parent = $('tr.' + id);
    var data = parent.find('td#total');
    if (data.length > 0) {
      data.each(function() {
        sum += parseFloat($(this).text()) || 0;
      });
    }

    var newRow = '<tr id="' + id + '" class="' + parent_id + '" data-level="' + parent_level + '"><td id="structure_name">' + name + '</td><td id="total" class ="jq_format_decimal_table">' + sum + '</td></tr>';
    if (data.length > 0) {
      $('table#main_table tr.' + id + ':last').after(newRow);
    } else {
      $('table#main_table').append(newRow);
    }
  }

  function get_colspan_row(arg_input, maxLevel) {
    var max_colspan = maxLevel + 1;
    var level = arg_input.data("level");
    var id = arg_input.attr("id");
    console.log(level);
    var insert_td = "";
    for (var i = 0; i < level - 1; i++) {
      insert_td = insert_td + "<td></td>";
    }
    var data = arg_input.find("td#structure_name");
    data.attr('colspan', max_colspan - level);
    data.before(insert_td);

    var data = arg_input.find("td#total");
    data.attr('colspan', max_colspan - level);
    data.after(insert_td);
  }

  $(document).ready(function() {
    var tr_structure = $("table#structure_table tbody").find("tr");
    tr_structure.each(function() {
      get_total_structure($(this));
    })

    var tr_structure = $("table#main_table tbody").find("tr");
    var maxLevel = 0;

    tr_structure.each(function() {
      var level = parseInt($(this).attr('data-level'));
      if (!isNaN(level) && level > maxLevel) {
        maxLevel = level;
      }
    });

    var th_structure = $('table#main_table tr th');
    th_structure.attr('colspan', maxLevel * 2)
    th_structure.css("text-align", "center");
    tr_structure.each(function() {
      get_colspan_row($(this), maxLevel);
    })

    $("table#main_table").pretty_format_table();
  });
</script>

</html>