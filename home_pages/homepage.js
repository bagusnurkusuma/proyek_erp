$(function () {
  // Get the start and end dates for the current month
  var startDate = moment().startOf('month');
  var endDate = moment().endOf('month');

  // Format the dates as required (DD/MM/YYYY)
  var dateRange = startDate.format('DD/MM/YYYY') + ' - ' + endDate.format('DD/MM/YYYY');

  // Set the initial value of the date range picker
  $('input[name="daterange"]').daterangepicker({
      "startDate": startDate,
      "endDate": endDate,
      "locale": {
          "format": "DD/MM/YYYY",
          "separator": " - ",
          "applyLabel": "Apply",
          "cancelLabel": "Cancel",
          "fromLabel": "From",
          "toLabel": "To",
          "customRangeLabel": "Custom",
          "weekLabel": "W",
          "daysOfWeek": ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
          "monthNames": ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
          "firstDay": 1
      }
  });

  // Trigger the event to update the input field with the formatted date range
  $('input[name="daterange"]').data('daterangepicker').setStartDate(startDate);
  $('input[name="daterange"]').data('daterangepicker').setEndDate(endDate);



// ECharts Chart Initialization
var myChart = echarts.init(document.getElementById('chart'));

var option = {
    title: {
        text: 'Laporan Penjualan'
    },
    tooltip: {},
    legend: {
        data: ['Pengeluaran Stok', 'Terjual']  // Updated legend data
    },
    xAxis: {
        data: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli','Agustus', 'September', 'Oktober', 'November', 'Desember'],  // Updated xAxis data
        axisLabel: {
          interval: 0, // Show all labels
      },
    },
    yAxis: {},
    series: [
        {
            name: 'Pengeluaran Stok',  // Updated series name
            type: 'bar',
            data: [200, 200, 300, 400, 500, 600, 700, 931, 643, 245, 714, 542]  // Updated series data
        },
        {
            name: 'Terjual',  // New series
            type: 'bar',
            data: [150, 160, 170, 180, 200, 130, 170, 113, 145, 190, 183, 184]  // New series data
        }
    ]
};

myChart.setOption(option);

// ECharts Chart Initialization
var myChart2 = echarts.init(document.getElementById('chart2'));

var option = {
    title: {
        text: 'Laporan Transaksi Penjualan'
    },
    tooltip: {},
    legend: {
        data: ['Penjualan']  // Updated legend data
    },
    xAxis: {
        data: ['1/12/23', '2/12/23', '3/12/23', '4/12/23', '5/12/23', '6/12/23', '7/12/23'],  // Updated xAxis data
        axisLabel:{
        interval:0,
        },
    },
    yAxis: {},
    series: [
        {
            name: 'Transaksi',  // Updated series name
            type: 'bar',
            data: [123, 234, 365, 467, 536, 121, 632]  // Updated series data
        },
    ]
};

myChart2.setOption(option);

// Initialize ECharts instance
var doughnutChart = echarts.init(document.getElementById('doughnutChart'));

// Doughnut chart data
var doughnutData = {
  title: {
    text: 'Produk Ter-Laris',
    left: 'left' // Center the title
  },
  tooltip: {
    trigger: 'item',
    formatter: '{a} <br/>{b}: {c} ({d}%)'
  },
  legend: {
    orient: 'vertical',
    right: '0%', // Adjust the right margin
    top: '20%', // Center the legend vertically
    data: ['Mie Goreng', 'Tissue', 'Teh']
  },
  series: [
    {
      name: 'Sales',
      type: 'pie',
      radius: ['30%', '50%'], // Set the outer and inner radius to create a doughnut
      center: ['30%', '40%'], // Adjust the center to move the chart left
      avoidLabelOverlap: false,
      label: {
        show: false,
        position: 'center'
      },
      emphasis: {
        label: {
          show: true,
          fontSize: '20',
          fontWeight: 'bold'
        }
      },
      labelLine: {
        show: false
      },
      data: [
        { value: 534, name: 'Mie Goreng' },
        { value: 323, name: 'Tissue' },
        { value: 235, name: 'Teh' }
      ]
    }
  ]
};

// Set the doughnut chart options and data
doughnutChart.setOption(doughnutData);
});