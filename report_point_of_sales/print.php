<?php
session_start(); 
if(empty($_SESSION['username'])){
    header("location:login.html");
}
?>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>TOKO VAGANZA</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="home.php" class="site_title"><i class="fa fa-paw"></i> <span>TOKO VAGANZA</span></a>
            </div>
            <div class="clearfix"></div>

            <!-- menu profile quick info -->
          <div class="profile clearfix">
              <div class="profile_pic">

                <?php
                  include"koneksi.php";
                  $gmb=mysqli_query($link,"select * from user where username='$_SESSION[username]'");
                  while($gambar=mysqli_fetch_array($gmb)){

                    $url_gambar = "images/$gambar[gambar]";
                    echo"<img src='$url_gambar' alt='...' class='img-circle profile_img'>";}?>

              </div>
              <div class="profile_info">
                <span>Selamat Datang,</span>
                <h2>

                  <?php echo $_SESSION['username']; ?>
                  
                </h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>MENU</h3>
                    <ul class="nav side-menu">
                       <li><a href="home.php"><i class="fa fa-home"></i> Home </a>
                      <ul class="nav child_menu">
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Input Data<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                       <li><a href="input_barang.php">Input Barang</a></li>
                       <li><a href="input_pembeli.php">Input Pembeli</a></li>
                       <li><a href="input_transaksi.php">Input Transaksi</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i> Laporan<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                       <li><a href="print_barang.php">Print Barang</a></li>
                       <li><a href="print_pembeli.php">Print Pembeli</a></li>
                       <li><a href="print_transaksi.php">Print Transaksi</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-table"></i> Tabel Data<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                      <li><a href="show_barang.php">Data Barang</a></li>
                       <li><a href="show_pembeli.php">Data Pembeli</a></li>
                      <li><a href="show_transaksi.php">Data Transaksi</a></li>
                  </ul>
                  </li>
                    <ul class="nav side-menu">
                      <li><a href="logout.php"><i class="fa fa-power-off"></i> Log Out </a>
                    <ul class="nav child_menu">
              </div>
             </div>
      
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
		<h2><?php echo date('l, d-m-Y'); ?></h2>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Print Laporan Data Barang</h3>
              </div>

              <div class="title_right">
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Cari Data Barang yang Akan Di Print</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table id="datatable" class="table table-striped table-bordered">
                    <form action="show_print_barang.php" method="GET" target="-blank">

  <tr>
    <td width="155"><input type="text" name="s" placeholder="Cari"></td>
    <td width="262" colspan="5"><button type="submit" class="btn btn-success">Print</button></td>
</tr>
</form>
                        <tr>
                          <th>Id Barang</th>
                          <th>Jenis</th>
                          <th>Harga Beli</th>
                          <th>Harga Jual</th>
			  <th>Stok</th>
                        </tr>


                      <tbody>
			<?php
  			include "koneksi.php";
 			$muncul=mysqli_query($link,"select*from barang");
  			while($barang=mysqli_fetch_array($muncul))
  			{  ?><tr>
    			  <td> <?php echo "$barang[0]";  ?></td>
   			  <td> <?php echo "$barang[1]";  ?></td>
   			  <td> <?php echo "$barang[2]";  ?></td>
  			  <td> <?php echo "$barang[3]";  ?></td>
   			  <td> <?php echo "$barang[4]"; }?></td>
                        </tr>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>



        <!-- /page content -->


	<!-- footer content -->
        <footer>
          <div class="pull-right">
           Vaganza - by Bagus Nur Kusuma
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

  </body>
</html>