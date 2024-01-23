<?php
include "api.php";
session_start();
if (empty($_SESSION['username'])) {
  header("location:../asset_default/login.html");
}
$penguna = $_SESSION['username'];
$hasil = get_company_profile();
if (is_array($hasil) && count($hasil)) {
  foreach ($hasil as $baris) :
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>
        <?php
        echo $baris["company_name"];
        ?>
      </title>

    <style>
    .content{
        margin-top: 40px;
        margin-bottom: 20px;
    }

  </style>
    <!-- jQuery  -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
    <link href="../asset_design/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../asset_design/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="../asset_design/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>
    <!-- Custom Theme Style -->
    <link href="../asset_design/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="">
            <div class="navbar nav_title" style="border: 0;">
              <a href="../sales_order/form.php" class="site_title"><i class="fa fa-paw"></i> 
              <span>
                <?php
                echo $baris["company_name"];
                endforeach;
                } ?>
                  </span></a>
            </div>

            <div class="clearfix"></div>


              <!-- menu profile quick info -->
              <div class="profile clearfix ">
                  <div class="row">
                      <div class="col-md-12">
                          <div class="profile_pic text-center" style="margin-left: 25px; width: 60%;">
                              <img src="../asset_design/production/images/img.jpg" alt="..." class="img-circle profile_img text-center">
                          </div>
                      </div>
                  </div>
                  <div class="row justify-content-center text-center">
                      <div class="col-md-10">
                          <div class="profile_info" style="margin-left: 20px;">
                              <h2>Admin</h2>
                              <span>admin@gmail.com</span>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                <div class="menu_section">
                    <ul class="nav side-menu">
                      <li><a><i class="fa fa-th-large"></i> Dashboard </a>
                      </li>
                      <li><a><i class=" fa fa-user"></i> Administrator </a>
                      </li>
                      <li><a><i class="fa fa-file-text"></i> Master </a>
                      </li>
                      <li><a><i class="fa fa-money"></i> Proses Transaksi <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="../sales_order/form.php">Sales Order</a></li>
                            <li><a href="../sales_order/content.php">Content</a></li>
                            <li><a href="../sales_order/tabel.php">Tabel</a></li>
                            <li><a href="../sales_order/form_tabel.php">Form Tabel</a></li>
                            <li><a href="../sales_order/input.php">Form Input</a></li>
                        </ul>
                      </li>
                      <li><a href="../sales_order/laporan.php"><i class="fa fa-desktop"></i> Laporan </a>
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

            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav fixed-top">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- footer content -->
        <footer class="footer fixed-bottom">
          <div class="pull-right">
          <?php
              $hasil = get_watermark();
              if (is_array($hasil) && count($hasil)) {
                foreach ($hasil as $baris) :
                  echo $baris["watermark"];
                endforeach;
              }
              ?>
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
    <!-- bootstrap-progressbar -->
    <script src="../asset_design/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <link href="../asset_design/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- iCheck -->
    <script src="../asset_design/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../asset_design/vendors/skycons/skycons.js"></script>
    <!-- DateJS -->
    <script src="../asset_design/vendors/DateJS/build/date.js"></script>
    <!-- Mask -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <!-- jQuery custom content scroller -->
    <script src="../asset_design/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../asset_design/build/js/custom.min.js"></script>

  </body>
</html>
