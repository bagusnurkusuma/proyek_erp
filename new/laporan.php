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
include "../asset_default/side_bar.php" ;
include "../asset_default/script_laporan.php"
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
              <div class="x_title">
                <h2>Laporan</h2>
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
                
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>Mie Goreng</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>100</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                    <div>
                        <small>Total Pengeluaran</small>
                        <a style="margin-left:30%;">30</a>
                    </div>
                    <br>

                    <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>Mie Goreng</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>100</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                    <div>
                        <small>Total Pengeluaran</small>
                        <a style="margin-left:30%;">30</a>
                    </div>
                    <br>
                  
                    <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>Mie Goreng</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>100</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                    <div>
                        <small>Total Pengeluaran</small>
                        <a style="margin-left:30%;">30</a>
                    </div>
                    <br>

                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>

              <div class="col-md-8 col-sm-4  ">
                <div class="x_panel fixed_height_320">
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
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
                <div class="col-md-8 col-sm-8">
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
                          <div class="col-md-4 col-sm-12 text-center tile_stats_count">
                            <span class="count_top" style="font-size: 20px;">Pendapatan Total</span>
                            <div class="count" style="font-size: 30px;">Rp 5.000.000</div>
                          </div>
                          <div class="col-md-4 col-sm-12 text-center tile_stats_count">
                            <span class="count_top" style="font-size: 20px;">Pengeluaran Total</span>
                            <div class="count" style="font-size: 30px;">Rp 3.000.000</div>
                          </div>
                          <div class="col-md-4 col-sm-12 text-center tile_stats_count">
                            <span class="count_top" style="font-size: 20px;">Laba Bersih</span>
                            <div class="count green" style="font-size: 30px;">Rp 2.000.000</div>
                          </div>
                        </div>
                      </div>
                    </div>
                    </div>
                </div>

                    <div class="col-md-4 col-sm-4  ">
                      <div class="x_panel fixed_height_400">
                          <div class="x_title">
                            <h2 id="monthAndYear"></h2>
                            <ul class="nav navbar-right panel_toolbox justify-content-end">
                              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                              </li>
                            </ul>
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">
                            <div class="" style="width:100%; height:90%;">
                              <table class="table table-bordered table-responsive-sm" id="calendar">
                                <thead>
                                <tr>
                                  <th>Sun</th>
                                  <th>Mon</th>
                                  <th>Tue</th>
                                  <th>Wed</th>
                                  <th>Thu</th>
                                  <th>Fri</th>
                                  <th>Sat</th>
                                </tr>
                                </thead>
                                <tbody id="calendar-body">
                                </tbody>
                              </table>
                              <!-- Prev/next Navigation -->
                              <button id="previous" onclick="previous()">Previous</button>
                              <button id="next" onclick="next()">Next</button>
                              <!-- Jump to -->
                              <label for="month">Jump To: </label>
                              <select name="month" id="month" onchange="jump()">
                                <option value=0>Jan</option>
                                <option value=1>Feb</option>
                                <option value=2>Mar</option>
                                <option value=3>Apr</option>
                                <option value=4>May</option>
                                <option value=5>Jun</option>
                                <option value=6>Jul</option>
                                <option value=7>Aug</option>
                                <option value=8>Sep</option>
                                <option value=9>Oct</option>
                                <option value=10>Nov</option>
                                <option value=11>Dec</option>
                              </select>
                              <label for="year"></label>
                              <select name="year" id="year" onchange="jump()">
                                <option value=1990>1990</option>
                                <option value=1991>1991</option>
                                <option value=1992>1992</option>
                                <option value=1993>1993</option>
                                <option value=1994>1994</option>
                                <option value=1995>1995</option>
                                <option value=1996>1996</option>
                                <option value=1997>1997</option>
                                <option value=1998>1998</option>
                                <option value=1999>1999</option>
                                <option value=2000>2000</option>
                                <option value=2001>2001</option>
                                <option value=2002>2002</option>
                                <option value=2003>2003</option>
                                <option value=2004>2004</option>
                                <option value=2005>2005</option>
                                <option value=2006>2006</option>
                                <option value=2007>2007</option>
                                <option value=2008>2008</option>
                                <option value=2009>2009</option>
                                <option value=2010>2010</option>
                                <option value=2011>2011</option>
                                <option value=2012>2012</option>
                                <option value=2013>2013</option>
                                <option value=2014>2014</option>
                                <option value=2015>2015</option>
                                <option value=2016>2016</option>
                                <option value=2017>2017</option>
                                <option value=2018>2018</option>
                                <option value=2019>2019</option>
                                <option value=2020>2020</option>
                                <option value=2021>2021</option>
                                <option value=2022>2022</option>
                                <option value=2023>2023</option>
                                <option value=2024>2024</option>
                                <option value=2025>2025</option>
                                <option value=2026>2026</option>
                                <option value=2027>2027</option>
                                <option value=2028>2028</option>
                                <option value=2029>2029</option>
                                <option value=2030>2030</option>
                              </select>
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