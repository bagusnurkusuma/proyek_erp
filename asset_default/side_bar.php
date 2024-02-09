<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (empty($_SESSION["user_role_id"])) {
  header("location:../asset_default/login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../asset_design/datatable/css/bootstrap.min.css">
  <link rel="stylesheet" href="../asset_design/datatable/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../asset_design/datatable/DataTables/Buttons-1.5.6/css/buttons.bootstrap4.min.css">

  <title><?php echo $_SESSION["company_name"] ?></title>
  <link rel="icon" type="image/x-icon" href="<?php echo $_SESSION["file_location"] ?>">
  <style>
    .table-responsive {
      overflow-y: hidden;
    }

    .content {
      margin-top: 60px;
      margin-bottom: 35px;
    }

    thead {
      text-align: center;
    }
  </style>
  <!-- High Chart -->
  <link rel="stylesheet" href="..\asset_design\chart\css\chart.css">
  <!-- Include SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
  <!-- Include SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <!-- Script JQuery -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <!-- Bootstrap -->
  <link href="../asset_design/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../asset_design/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../asset_design/vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="../asset_design/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

  <!-- bootstrap-progressbar -->
  <link href="../asset_design/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
  <!-- JQVMap -->
  <link href="../asset_design/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
  <!-- bootstrap-daterangepicker -->
  <link href="../asset_design/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
  <link href="../asset_design/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet" />
  <!-- Custom Theme Style -->
  <link href="../asset_design/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">

  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col menu_fixed">
        <div class="left_col scroll-view footer">
          <div class="navbar nav_title" style="border: 0;">
            <a href="../dashboard/form.php" class="site_title"><i class="fa fa-building-o"></i>
              <span id="jq_company_name"> <?php echo $_SESSION["company_name"] ?> </span></a>
          </div>

          <div class=" clearfix">
          </div>

          <!-- menu profile quick info -->
          <div class="profile clearfix text-center">
            <div class="row">
              <div class="col-md-12">
                <div class="profile_pic text-center" style="margin-left: 25px; width: 60%;">
                  <img src="<?php echo $_SESSION["file_location"] ?>" alt="<?php echo $_SESSION["employee_name"] ?>" height="100" class="img-circle profile_img text-center">
                </div>
              </div>
            </div>
            <div class="row justify-content-center text-center">
              <div class="col-md-10">
                <div class="profile_info">
                  <h2 style="text-align: center;"><?php echo $_SESSION["employee_name"]; ?></h2>
                  <span><?php echo $_SESSION["email"]; ?></h2></span>
                </div>
              </div>
            </div>
          </div>
          <!-- /menu profile quick info -->

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <ul class="nav side-menu">
                <?php
                $hasil = $_SESSION['menu_parent'];
                if (is_array($hasil) && count($hasil)) {
                  foreach ($hasil as $baris) : ?>
                    <li><a><i class="<?php echo $baris["icon"]; ?>"></i><?php echo $baris["menu_name"]; ?><span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <?php
                        $hasil_proces = $_SESSION['menu_proces'];
                        if (is_array($hasil_proces) && count($hasil_proces)) {
                          foreach ($hasil_proces as $baris_proces) :
                            if ($baris["menu_id"] == $baris_proces["parent_id"]) { ?>
                              <li><a href=<?php echo $baris_proces["location_file"]; ?>><?php echo $baris_proces["menu_name"]; ?></a></li>
                        <?php }
                          endforeach;
                        } ?>
                      </ul>
                    </li>
                <?php endforeach;
                } ?>
              </ul>
            </div>
          </div>
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="../asset_default/logout.php">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Referance" target="_blank" href="../asset_design/production/index.html">
              <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
            </a>
          </div>
          <!-- /menu footer buttons -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav fixed-top">
        <div class="nav_menu">
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
          </div>
          <nav class="nav navbar-nav">
            <ul class="navbar-right">
              <li class="nav-item dropdown open" style="padding-left: 15px;">
                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                  <img src="<?php echo $_SESSION["file_location"] ?>" alt="<?php echo $_SESSION["employee_name"] ?>" height="15px"><?php echo $_SESSION["employee_name"]; ?>
                </a>
                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="../asset_profile/form.php"><i class="fa fa-user pull-right"></i> Profile</a>
                  <a class="dropdown-item" href="../asset_default/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                </div>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->

      <!-- page content -->

      <!-- /page content -->

      <!-- footer content -->
      <footer class="footer fixed-bottom">
        <div class="pull-right">
          <?php echo $_SESSION["watermark"] ?>
        </div>
        <div class="clearfix"></div>
      </footer>
      <!-- /footer content -->
    </div>
  </div>

  <!-- jQuery -->
  <script src="../asset_design/vendors/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../asset_design/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- FastClick -->
  <script src="../asset_design/vendors/fastclick/lib/fastclick.js"></script>
  <!-- NProgress -->
  <script src="../asset_design/vendors/nprogress/nprogress.js"></script>
  <!-- Chart.js -->
  <script src="../asset_design/vendors/Chart.js/dist/Chart.min.js"></script>
  <!-- gauge.js -->
  <script src="../asset_design/vendors/gauge.js/dist/gauge.min.js"></script>
  <!-- iCheck -->
  <script src="../asset_design/vendors/iCheck/icheck.min.js"></script>
  <!-- Skycons -->
  <script src="../asset_design/vendors/skycons/skycons.js"></script>
  <!-- Flot -->
  <script src="../asset_design/vendors/Flot/jquery.flot.js"></script>
  <script src="../asset_design/vendors/Flot/jquery.flot.pie.js"></script>
  <script src="../asset_design/vendors/Flot/jquery.flot.time.js"></script>
  <script src="../asset_design/vendors/Flot/jquery.flot.stack.js"></script>
  <script src="../asset_design/vendors/Flot/jquery.flot.resize.js"></script>
  <!-- Flot plugins -->
  <script src="../asset_design/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
  <script src="../asset_design/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
  <script src="../asset_design/vendors/flot.curvedlines/curvedLines.js"></script>
  <!-- DateJS -->
  <script src="../asset_design/vendors/DateJS/build/date.js"></script>
  <!-- JQVMap -->
  <script src="../asset_design/vendors/jqvmap/dist/jquery.vmap.js"></script>
  <script src="../asset_design/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
  <script src="../asset_design/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
  <!-- bootstrap-daterangepicker -->
  <script src="../asset_design/vendors/moment/min/moment.min.js"></script>
  <script src="../asset_design/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!-- bootstrap-progressbar -->
  <script src="../asset_design/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
  <!-- bootstrap-daterangepicker -->
  <script src="../asset_design/vendors/moment/min/moment.min.js"></script>
  <script src="../asset_design/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!-- bootstrap-wysiwyg -->
  <script src="../asset_design/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
  <script src="../asset_design/vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
  <script src="../asset_design/vendors/google-code-prettify/src/prettify.js"></script>
  <!-- jQuery Tags Input -->
  <script src="../asset_design/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
  <!-- Switchery -->
  <script src="../asset_design/vendors/switchery/dist/switchery.min.js"></script>
  <!-- Select2 -->
  <script src="../asset_design/vendors/select2/dist/js/select2.full.min.js"></script>
  <!-- Parsley -->
  <!-- <script src="../asset_design/vendors/parsleyjs/dist/parsley.min.js"></script> -->
  <!-- Autosize -->
  <script src="../asset_design/vendors/autosize/dist/autosize.min.js"></script>
  <!-- jQuery autocomplete -->
  <script src="../asset_design/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
  <!-- starrr -->
  <script src="../asset_design/vendors/starrr/dist/starrr.js"></script>

  <!-- Datatables -->
  <script src="../asset_design/datatable/js/bootstrap.bundle.min.js"></script>
  <script src="../asset_design/datatable/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
  <script src="../asset_design/datatable/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>
  <script src="../asset_design/datatable/DataTables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
  <script src="../asset_design/datatable/DataTables/Buttons-1.5.6/js/buttons.bootstrap4.min.js"></script>
  <script src="../asset_design/datatable/DataTables/JSZip-2.5.0/jszip.min.js"></script>
  <script src="../asset_design/datatable/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
  <script src="../asset_design/datatable/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
  <script src="../asset_design/datatable/DataTables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
  <script src="../asset_design/datatable/DataTables/Buttons-1.5.6/js/buttons.print.min.js"></script>
  <script src="../asset_design/datatable/DataTables/Buttons-1.5.6/js/buttons.colVis.min.js"></script>
  <!-- jQuery custom content scroller -->
  <script src="../asset_design/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
  <!-- High Chart -->
  <script src="..\asset_design\chart\js\chart.js"></script>
  <script src="..\asset_design\chart\js\exporting.js"></script>
  <script src="..\asset_design\chart\js\export-data.js"></script>
  <script src="../asset_design/build/js/custom.min.js"></script>
  <script type="text/javascript" src="../asset_default/fungsi.js"></script>
</body>

</html>