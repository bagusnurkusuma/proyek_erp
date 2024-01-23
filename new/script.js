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
      radius: '50%',
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
        { value: 500, name: 'Mie Goreng' },
        { value: 300, name: 'Tissue' },
        { value: 300, name: 'Teh' }
      ]
    }
  ]
};

 // Set the doughnut chart options and data
 doughnutChart.setOption(doughnutData);


// Calendar Functionality
let today = new Date();
let currentMonth = today.getMonth();
let currentYear = today.getFullYear();
let selectYear = document.getElementById("year");
let selectMonth = document.getElementById("month");

let months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

let monthAndYear = document.getElementById("monthAndYear");
showCalendar(currentMonth, currentYear);


function next() {
    currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
    currentMonth = (currentMonth + 1) % 12;
    showCalendar(currentMonth, currentYear);
}

function previous() {
    currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
    currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
    showCalendar(currentMonth, currentYear);
}

function jump() {
    currentYear = parseInt(selectYear.value);
    currentMonth = parseInt(selectMonth.value);
    showCalendar(currentMonth, currentYear);
}

function showCalendar(month, year) {

    let firstDay = (new Date(year, month)).getDay();
    let daysInMonth = 32 - new Date(year, month, 32).getDate();

    let tbl = document.getElementById("calendar-body"); // body of the calendar

    // clearing all previous cells
    tbl.innerHTML = "";

    // filing data about month and in the page via DOM.
    monthAndYear.innerHTML = months[month] + " " + year;
    selectYear.value = year;
    selectMonth.value = month;

    // creating all cells
    let date = 1;
    for (let i = 0; i < 6; i++) {
        // creates a table row
        let row = document.createElement("tr");

        //creating individual cells, filing them up with data.
        for (let j = 0; j < 7; j++) {
            if (i === 0 && j < firstDay) {
                let cell = document.createElement("td");
                let cellText = document.createTextNode("");
                cell.appendChild(cellText);
                row.appendChild(cell);
            }
            else if (date > daysInMonth) {
                break;
            }

            else {
                let cell = document.createElement("td");
                let cellText = document.createTextNode(date);
                if (date === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {
                    cell.classList.add("bg-info");
                } // color today's date
                cell.appendChild(cellText);
                row.appendChild(cell);
                date++;
            }


        }

        tbl.appendChild(row); // appending each row into calendar body.
    }

}
});