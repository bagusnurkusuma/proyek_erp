<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Gentelella Alela! | </title>

</head>

<?php
include "../asset_default/side_bar.php";
include "../home_pages/script_homepage.php";
?>

<body class="nav-md">
  <div class="container body">
    <div class="right_col" role="main">
      <div class="content">
        <div class="page-title"></div>

        <!-- page content -->
        <div class="row">
          <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
              <div class="x_title text-dark">
                <h2>Welcome [USER] !</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li>
                    <input class="date" type="text" name="daterange" value="" style="margin-right:10px;" />
                  </li>
                  <li><a class="collapse-link"><i class="fa fa-chevron-up justify-content-end"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>

              <div class="row">
                <div class="col-md-8 col-sm-8">
                  <div class="x_panel tile fixed_height_320 overflow_hidden">
                    <div class="x_title">
                      <h2>Tabel Data</h2>
                      <ul class="nav navbar-right panel_toolbox justify-content-end">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="card-box table-responsive" style="height: 200px; overflow-y: auto;">
                            <h4 class="text-muted font-13 m-b-30">
                              Tabel Data
                            </h4>
                            <table id="" class="table table-striped table-bordered" style="width:100%">
                              <thead>
                                <tr>
                                  <th>Name</th>
                                  <th>Position</th>
                                  <th>Office</th>
                                  <th>Age</th>
                                  <th>Start date</th>
                                  <th>Salary</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>Tiger Nixon</td>
                                  <td>System Architect</td>
                                  <td>Edinburgh</td>
                                  <td>61</td>
                                  <td>2011/04/25</td>
                                  <td>$320,800</td>
                                </tr>
                                <tr>
                                  <td>Donna Snider</td>
                                  <td>Customer Support</td>
                                  <td>New York</td>
                                  <td>27</td>
                                  <td>2011/01/25</td>
                                  <td>$112,000</td>
                                </tr>
                                <tr>
                                  <td>Donna Snider</td>
                                  <td>Customer Support</td>
                                  <td>New York</td>
                                  <td>27</td>
                                  <td>2011/01/25</td>
                                  <td>$112,000</td>
                                </tr>
                                <tr>
                                  <td>Donna Snider</td>
                                  <td>Customer Support</td>
                                  <td>New York</td>
                                  <td>27</td>
                                  <td>2011/01/25</td>
                                  <td>$112,000</td>
                                </tr>
                                <tr>
                                  <td>Donna Snider</td>
                                  <td>Customer Support</td>
                                  <td>New York</td>
                                  <td>27</td>
                                  <td>2011/01/25</td>
                                  <td>$112,000</td>
                                </tr>
                                <tr>
                                  <td>Donna Snider</td>
                                  <td>Customer Support</td>
                                  <td>New York</td>
                                  <td>27</td>
                                  <td>2011/01/25</td>
                                  <td>$112,000</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-4 col-sm-4">
                  <div class="x_panel tile fixed_height_320 overflow_hidden">
                    <div class="x_title">
                      <h2>Produk Terlaris</h2>
                      <ul class="nav navbar-right panel_toolbox justify-content-end">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div id="doughnutChart" style="width: 300px; height: 300px;"></div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4 col-sm-4 ">
                  <div class="x_panel tile fixed_height_320">
                    <div class="x_title">
                      <h2>Pengeluaran Stok</h2>
                      <ul class="nav navbar-right panel_toolbox justify-content-end">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up "></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div id="chart2" style="width: 100%;height:300px;"></div>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                </div>

                <div class="col-md-8 col-sm-4  ">
                  <div class="x_panel fixed_height_320 ">
                    <div class="x_title">
                      <h2>Bar Graph</h2>
                      <ul class="nav navbar-right panel_toolbox justify-content-end">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div id="chart" style="width: 100%;height:300px;"></div>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 col-sm-12">
                  <div class="x_panel fixed_height_300">
                    <div class="x_title">
                      <h2>Laporan Keuangan</h2>
                      <ul class="nav navbar-right panel_toolbox justify-content-end">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div class="row justify-content-center w-100">
                        <div class="flex-grow-1 text-center tile_count">
                          <div class="col-md-3 col-sm-12 text-center tile_stats_count">
                            <span class="count_top" style="font-size: 20px;">Omzet</span>
                            <div class="count blue" style="font-size: 30px;">Rp 20.000.000</div>
                          </div>
                          <div class="col-md-3 col-sm-12 text-center tile_stats_count">
                            <span class="count_top" style="font-size: 20px;">Pengeluaran Total</span>
                            <div class="count red" style="font-size: 30px;">Rp 13.000.000</div>
                          </div>
                          <div class="col-md-3 col-sm-12 text-center tile_stats_count">
                            <span class="count_top" style="font-size: 20px;">Total HPP</span>
                            <div class="count" style="font-size: 30px;">Rp 2.000.000</div>
                          </div>
                          <div class="col-md-3 col-sm-12 text-center tile_stats_count">
                            <span class="count_top" style="font-size: 20px;">Laba Bersih</span>
                            <div class="count green" style="font-size: 30px;">Rp 5.000.000</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <!--page content -->
      </div>
    </div>
  </div>
</body>

</html>