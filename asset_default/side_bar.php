<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (empty($_SESSION["user_role_id"])) {
  header("location:../asset_default/login.html");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="icon" href="../asset_design/images/favicon.ico" type="image/ico" />
  <title><?php echo $_SESSION["company_name"] ?></title>
  <link rel="icon" type="image/x-icon" href="<?php echo $_SESSION["file_location"] ?>">
  <style>
    .table-responsive {
      overflow-y: hidden;
    }

    .content {
      margin-top: 40px;
      margin-bottom: 20px;
    }

    thead {
      text-align: center;
    }
  </style>
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

  <!-- Datatables -->
  <link href="../asset_design/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="../asset_design/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="../asset_design/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="../asset_design/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="../asset_design/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
  <!-- Custom Theme Style -->
  <link href="../asset_design/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">

  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col menu_fixed">
        <div class="left_col scroll-view footer">
          <div class="navbar nav_title" style="border: 0;">
            <a href="../asset_default/side_bar.php" class="site_title"><i class="fa fa-paw"></i>
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
                <li><a><i class="fa fa-book"></i> Dashboard <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <?php
                    $hasil = $_SESSION['menu_proces'];
                    if (is_array($hasil) && count($hasil)) {
                      foreach ($hasil as $baris) : ?>
                        <li><a href=<?php echo $baris["location_file"]; ?>><?php echo $baris["menu_name"]; ?></a></li>
                    <?php endforeach;
                    } ?>
                  </ul>
                </li>
                <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="../point_of_sales/content.php">Content</a></li>
                    <li><a href="../point_of_sales/tabel.php">Tabel</a></li>
                    <li><a href="../point_of_sales/form_tabel.php">Form Tabel</a></li>
                    <li><a href="../point_of_sales/input.php">Input</a></li>
                  </ul>
                </li>
                <li><a><i class=" fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="../asset_design/production/form.html">General Form</a></li>
                    <li><a href="../asset_design/production/form_advanced.html">Advanced Components</a></li>
                    <li><a href="../asset_design/production/form_validation.html">Form Validation</a></li>
                    <li><a href="../asset_design/production/form_wizards.html">Form Wizard</a></li>
                    <li><a href="../asset_design/production/form_upload.html">Form Upload</a></li>
                    <li><a href="../asset_design/production/form_buttons.html">Form Buttons</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-desktop"></i> UI Elements <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="../asset_design/production/general_elements.html">General Elements</a></li>
                    <li><a href="../asset_design/production/media_gallery.html">Media Gallery</a></li>
                    <li><a href="../asset_design/production/typography.html">Typography</a></li>
                    <li><a href="../asset_design/production/icons.html">Icons</a></li>
                    <li><a href="../asset_design/production/glyphicons.html">Glyphicons</a></li>
                    <li><a href="../asset_design/production/widgets.html">Widgets</a></li>
                    <li><a href="../asset_design/production/invoice.html">Invoice</a></li>
                    <li><a href="../asset_design/production/inbox.html">Inbox</a></li>
                    <li><a href="../asset_design/production/calendar.html">Calendar</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="../asset_design/production/tables.html">Tables</a></li>
                    <li><a href="../asset_design/production/tables_dynamic.html">Table Dynamic</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="../asset_design/production/chartjs.html">Chart JS</a></li>
                    <li><a href="../asset_design/production/chartjs2.html">Chart JS2</a></li>
                    <li><a href="../asset_design/production/morisjs.html">Moris JS</a></li>
                    <li><a href="../asset_design/production/echarts.html">ECharts</a></li>
                    <li><a href="../asset_design/production/other_charts.html">Other Charts</a></li>
                  </ul>
                </li>
                <li>
                  <a data-toggle="tooltip" data-placement="top" title="Logout" href="../asset_default/logout.php">
                    <i class="fa fa-power-off" aria-hidden="true"></i>
                    Log Out
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="../asset_default/logout.php">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
          </div>
          <!-- /menu footer buttons -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
          </div>
          <nav class="nav navbar-nav">
            <ul class=" navbar-right">
              <li class="nav-item dropdown open" style="padding-left: 15px;">
                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                  <img src="<?php echo $_SESSION["file_location"] ?>" alt="<?php echo $_SESSION["employee_name"] ?>"><?php echo $_SESSION["employee_name"]; ?>
                </a>
                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="../asset_profile/form.php"> Profile</a>
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
  <script src="../asset_design/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="../asset_design/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="../asset_design/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../asset_design/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
  <script src="../asset_design/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
  <script src="../asset_design/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="../asset_design/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="../asset_design/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
  <script src="../asset_design/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
  <script src="../asset_design/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../asset_design/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
  <script src="../asset_design/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
  <script src="../asset_design/vendors/jszip/dist/jszip.min.js"></script>
  <script src="../asset_design/vendors/pdfmake/build/pdfmake.min.js"></script>
  <script src="../asset_design/vendors/pdfmake/build/vfs_fonts.js"></script>
  <!-- jQuery custom content scroller -->
  <script src="../asset_design/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
  <!-- Custom Theme Scripts -->
  <script src="../asset_design/build/js/custom.min.js"></script>
  <script type="text/javascript" src="../asset_default/fungsi.js"></script>
</body>

</html>