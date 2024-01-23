<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>
<style>
    
  .top-product-cards {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    flex-wrap: wrap;
  }

  .card-item {
    width: 100%; /* Adjust the width as needed */
    border: 1px solid #ddd;
    margin: 5px;
    padding: 10px;
    box-sizing: border-box;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .product-name-total {
    text-align: right;
  }

  .product-name-total p {
    margin: 0;
  }

  .product-percentage {
    text-align: left;
    font-weight: bold;
    margin-right: 10px; /* Adjust the margin as needed */
  }
</style>

  </head>

  <?php include "../asset_default/side_bar.php" ?>  

  <body class="nav-md">
    <div class="container body">
        <div class="right_col" role="main">
            <div class="content">
                <div class="page-title"></div>
                <div class="clearfix"></div>

                <!-- page content -->
                <div class="clearfix"></div>

                <div class="row">
                    <div class="calendar1 col-md-8">
                        <div class="x_panel">
                            <div class="x_title d-print-none">
                                <h2>Calendar Events</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li>
                                    <button class="btn btn-default" style="Margin-right:10px;" onclick="printCalendar();"><i class="fa fa-print"></i> Print</button>
                                    </button>
                                    </li>
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div id='calendar'></div>
                            </div>
                        </div>
                    </div>

                    <!-- Pie chart in a card -->
                    <div class="topProduk col-md-4">
                        <div class="x_panel">
                            <div class="x_title d-print-none">
                                <h2>Total Penjualan</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li>
                                    <button class="btn btn-default" style="Margin-right:10px;" onclick="printTopProducts();"><i class="fa fa-print"></i> Print</button>
                                    </button>
                                    </li>
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <p class="text-danger">* Limit 10 Produk</p>
                                <div id="pieChart2" style="height: 300px;"></div>
                                <p id="totalSales" style="font-size: 1.5em; font-weight:bold;"></p>

                                <!-- Display the top 10 products directly inside the chart container -->
                                <div id="topProductCards" class="top-product-cards text-dark">
                                    <!-- The top 10 product cards will be added here dynamically -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Pie chart card -->
                </div>
                <!-- /page content -->
            </div>
        </div>
    </div>


    <!-- calendar modal -->
    <div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">New Calendar Entry</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <div class="modal-body">
            <div id="testmodal" style="padding: 5px 20px;">
              <form id="antoform" class="form-horizontal calender" role="form">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Title</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="title" name="title">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Description</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" style="height:55px;" id="descr" name="descr"></textarea>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary antosubmit">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <div id="CalenderModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel2">Edit Calendar Entry</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <div class="modal-body">

            <div id="testmodal2" style="padding: 5px 20px;">
              <form id="antoform2" class="form-horizontal calender" role="form">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Title</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="title2" name="title2">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Description</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" style="height:55px;" id="descr2" name="descr"></textarea>
                  </div>
                </div>

              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary antosubmit2">Save changes</button>
          </div>
        </div>
      </div>
    </div>

    <div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
    <div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>
    <!-- /calendar modal -->

  </body>

  <script>

function printCalendar() {
    // Hide top products section before printing
    document.getElementsByClassName('topProduk')[0].style.display = 'none';

    // Trigger the print function
    window.print();

    // Show top products section again after printing
    document.getElementsByClassName('topProduk')[0].style.display = 'block';
}

function printTopProducts() {
    // Hide calendar section before printing
    document.getElementsByClassName('calendar1')[0].style.display = 'none';

    // Trigger the print function
    window.print();

    // Show calendar section again after printing
    document.getElementsByClassName('calendar1')[0].style.display = 'block';
}

  // Sample data for the pie chart
  var pieChartData = [
    { value: 523, name: 'Product 1', itemStyle: { color: '#ff0000' } },    // Red
    { value: 142, name: 'Product 2', itemStyle: { color: '#00ff00' } },    // Green
    { value: 463, name: 'Product 3', itemStyle: { color: '#0000ff' } },    // Blue
    { value: 383, name: 'Product 4', itemStyle: { color: '#ffcc00' } },    // Yellow
    { value: 845, name: 'Product 5', itemStyle: { color: '#9933cc' } },    // Purple
    { value: 235, name: 'Product 6', itemStyle: { color: '#ff9900' } },    // Orange
    { value: 547, name: 'Product 7', itemStyle: { color: '#0099cc' } },    // Light Blue
    { value: 124, name: 'Product 8', itemStyle: { color: '#cc66ff' } },    // Light Purple
    { value: 256, name: 'Product 9', itemStyle: { color: '#cc0000' } },    // Dark Red
    { value: 786, name: 'Product 10', itemStyle: { color: '#00cc00' } },   // Dark Green
    // Add more data as needed
  ];

  // Initialize ECharts instance
  var pieChart = echarts.init(document.getElementById('pieChart2'));

  // Pie chart options
  var pieChartOptions = {
    title: {
      text: 'Total Penjualan Produk',
      left: 'center',
    },
    tooltip: {
      trigger: 'item',
      formatter: '{a} <br/>{b}: {c} ({d}%)',
    },
    series: [
      {
        name: 'Penjualan',
        type: 'pie',
        radius: '70%',
        center: ['50%', '50%'],
        data: pieChartData,
      },
    ],
  };

  // Set pie chart options and data
  pieChart.setOption(pieChartOptions);

  // Set total sales text
  var totalSales = 0;
  pieChartData.forEach(function (item) {
    totalSales += item.value;
  });
  document.getElementById('totalSales').innerText = 'Total Penjualan: ' + totalSales;

  // Display the top 10 products directly inside the chart container
  var topProductCardsContainer = document.getElementById('topProductCards');

  // Sort pieChartData by percentage in descending order
  pieChartData.sort((a, b) => b.value / totalSales - a.value / totalSales);

  pieChartData.slice(0, 10).forEach(function (item) {
    var cardItem = document.createElement('div');
    cardItem.className = 'card-item';

    // Product percentage
    var productPercentage = document.createElement('h3');
    productPercentage.className = 'product-percentage';
    productPercentage.innerText = `${((item.value / totalSales) * 100).toFixed(2)}%`;

    // Product name and total
    var productNameAndTotal = document.createElement('div');
    productNameAndTotal.className = 'product-name-total';

    // Product name
    var productName = document.createElement('h5');
    productName.innerText = item.name;

    // Total produk
    var totalProduk = document.createElement('p');
    totalProduk.innerText = `Total Produk: ${item.value} pcs`;

    // Append elements to the card
    productNameAndTotal.appendChild(productName);
    productNameAndTotal.appendChild(totalProduk);

    // Append elements to the card item
    cardItem.appendChild(productPercentage);
    cardItem.appendChild(productNameAndTotal);

    // Append card item to the container
    topProductCardsContainer.appendChild(cardItem);
  });
</script>


</html>