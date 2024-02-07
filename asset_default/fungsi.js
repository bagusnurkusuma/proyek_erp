function get_current_time() {
  let today = new Date();
  let hours = String(today.getHours()).padStart(2, "0");
  let minutes = String(today.getMinutes()).padStart(2, "0");
  let seconds = String(today.getSeconds()).padStart(2, "0");
  today = hours + ":" + minutes + ":" + seconds;
  return today;
}

function get_current_date() {
  let today = new Date();
  let dd = String(today.getDate()).padStart(2, "0");
  let mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
  let yyyy = today.getFullYear();

  today = yyyy + "-" + mm + "-" + dd;
  return today;
}

function get_current_timestamp() {
  return get_current_date() + " " + get_current_time();
}

function get_current_first_date() {
  let today = new Date();
  let firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
  let dd = String(firstDay.getDate()).padStart(2, "0");
  let mm = String(firstDay.getMonth() + 1).padStart(2, "0"); //January is 0!
  let yyyy = firstDay.getFullYear();

  firstDay = yyyy + "-" + mm + "-" + dd;
  return firstDay;
}

function get_current_last_date() {
  let today = new Date();
  let lastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);
  let dd = String(lastDay.getDate()).padStart(2, "0");
  let mm = String(lastDay.getMonth() + 1).padStart(2, "0"); //January is 0!
  let yyyy = lastDay.getFullYear();
  lastDay = yyyy + "-" + mm + "-" + dd;
  return lastDay;
}

function pretty_input_decimal(number, decimals, dec_point, thousands_sep) {
  if (number != "") {
    var n = !isFinite(+number) ? 0 : +number,
      prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
      sep = typeof thousands_sep === "undefined" ? "," : thousands_sep,
      dec = typeof dec_point === "undefined" ? "." : dec_point,
      s = "",
      toFixedFix = function (n, prec) {
        var k = Math.pow(10, prec);
        return "" + Math.round(n * k) / k;
      };
    s = (prec ? toFixedFix(n, prec) : "" + Math.round(n)).split(".");
    if (s[0].length > 3) {
      s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || "").length < prec) {
      s[1] = s[1] || "";
      s[1] += new Array(prec - s[1].length + 1).join("0");
    }
    return s.join(dec);
  }
}

function format_input_date(arg_input) {
  if (arg_input != "") {
    var months = [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sep",
      "Oct",
      "Nov",
      "Dec",
    ];
    var dateParts = arg_input.split("-");
    var day = dateParts[2];
    var month = dateParts[1];
    var year = dateParts[0];
    var monthName = months[month - 1];
    var newDateFormat =
      day.toString().padStart(2, "0") + "-" + monthName + "-" + year;
    return newDateFormat;
  }
}

function go_to_home_pages() {
  return (window.location = "../dashboard/form.php");
}

function formatRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);
  if (ribuan) {
    separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }
  rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
  return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}

function format_input_decimal(arg_input) {
  var result = pretty_input_decimal(arg_input, 2, ",", ".");
  return result;
}

$.fn.pretty_format_table = function () {
  var component = $(this).find(
    "th.jq_format_decimal_table,td.jq_format_decimal_table,td.jq_format_date_table,td button.btn"
  );
  component.each(function () {
    if ($(this).hasClass("jq_format_decimal_table")) {
      var number = $(this).text();
      if (number.includes(".") && number.includes(",")) {
      } else {
        $(this).css("text-align", "right");
        $(this).css("width", "75px");
        var result = pretty_input_decimal(number, 2, ",", ".");
        $(this).text(result);
        return this;
      }
    } else if ($(this).hasClass("jq_format_date_table")) {
      $(this).css("text-align", "center");
      $(this).css("width", "100px");
      var date = $(this).text();
      var formattedDate = format_input_date(date);
      $(this).text(formattedDate);
      return this;
    } else if ($(this).hasClass("btn")) {
      var closestTd = $(this).closest("td");
      closestTd.css("text-align", "center");
      var buttonCount = closestTd.find("button").length;
      buttonCount = buttonCount * 50;
      closestTd.css("width", buttonCount + "px");

      var button = $(this).find("i");
      button.each(function () {
        var kelas = button.attr("class");
        var closestbtn = button.closest("button");
        var title_not_exist = closestbtn.attr("title") == undefined;
        if (title_not_exist) {
          closestbtn.attr("data-toggle", "tooltip");
          if (kelas == "fa fa-inbox") {
            closestbtn.attr("title", "Show Archive Data");
          } else if (kelas == "fa fa-plus-circle") {
            closestbtn.attr("title", "Add Data");
          } else if (kelas == "fa fa-refresh") {
            closestbtn.attr("title", "Refresh Data");
          } else if (kelas == "fa fa-eye") {
            closestbtn.attr("title", "View Data");
          } else if (kelas == "fa fa-pencil-square") {
            closestbtn.attr("title", "Edit Data");
          } else if (kelas == "fa fa-archive") {
            closestbtn.attr("title", "Archive Data");
          } else if (kelas == "fa fa-close") {
            closestbtn.attr("title", "Clear Data");
          } else if (kelas == "fa fa-hand-o-up") {
            closestbtn.attr("title", "Select Data");
          } else if (kelas == "fa fa-upload") {
            closestbtn.attr("title", "Unarchive Data");
          } else if (
            kelas == "fa fa-chevron-down" ||
            kelas == "fa fa-chevron-up" ||
            kelas == "fa fa-briefcase"
          ) {
            closestbtn.attr("title", "Show Detail Data");
          }
        }
      });
      return this;
    }
  });
};

$(document).ready(function () {
  var component = $("button").find("i");
  component.each(function () {
    var kelas = $(this).attr("class");
    var closestbtn = $(this).closest("button");
    var title_not_exist = closestbtn.attr("title") == undefined;
    if (title_not_exist) {
      closestbtn.attr("data-toggle", "tooltip");
      if (kelas == "fa fa-inbox") {
        closestbtn.attr("title", "Show Archive Data");
      } else if (kelas == "fa fa-plus-circle") {
        closestbtn.attr("title", "Add Data");
      } else if (kelas == "fa fa-refresh") {
        closestbtn.attr("title", "Refresh Data");
      } else if (kelas == "fa fa-eye") {
        closestbtn.attr("title", "View Data");
      } else if (kelas == "fa fa-pencil-square") {
        closestbtn.attr("title", "Edit Data");
      } else if (kelas == "fa fa-archive") {
        closestbtn.attr("title", "Archive Data");
      } else if (kelas == "fa fa-close") {
        closestbtn.attr("title", "Clear Data");
      } else if (kelas == "fa fa-hand-o-up") {
        closestbtn.attr("title", "Select Data");
      } else if (kelas == "fa fa-upload") {
        closestbtn.attr("title", "Unarchive Data");
      } else if (
        kelas == "fa fa-chevron-down" ||
        kelas == "fa fa-chevron-up" ||
        kelas == "fa fa-briefcase"
      ) {
        closestbtn.attr("title", "Show Detail Data");
      }
    }
  });
});

(function ($) {
  $.fn.data_table_with_export = function (options) {
    var component_input = $(this);
    var settings = $.extend(
      {
        title_name: "Export Data",
      },
      options
    );

    var title_name = settings.title_name;
    var file_name = settings.title_name + " " + get_current_timestamp();
    var table_parent = component_input;
    table_parent.pretty_format_table();
    var button = table_parent.find("button");
    var button_td = button.closest("td");
    var index = button_td.index();
    var table = table_parent.DataTable({
      buttons: [
        {
          extend: "print",
          footer: true,
          exportOptions: {
            columns: ":visible:not(:eq(" + index + "))",
          },
          title: title_name,
        },
        {
          extend: "copyHtml5",
          footer: true,
          exportOptions: {
            columns: ":visible:not(:eq(" + index + "))",
          },
          title: title_name,
        },
        {
          extend: "csvHtml5",
          filename: file_name,
          footer: true,
          exportOptions: {
            columns: ":visible:not(:eq(" + index + "))",
          },
          title: title_name,
        },
        {
          extend: "excelHtml5",
          filename: file_name,
          footer: true,
          exportOptions: {
            columns: ":visible:not(:eq(" + index + "))",
          },
          title: title_name,
          autoFilter: true,
          sheetName: title_name,
        },
        {
          extend: "pdfHtml5",
          filename: file_name,
          footer: true,
          exportOptions: {
            columns: ":visible:not(:eq(" + index + "))",
          },
          orientation: "potrait",
          pageSize: "A4",
          download: "open",
          title: title_name,
          customize: function (doc) {
            doc["header"] = function (currentPage, pageCount) {
              return {
                text: document.title,
                alignment: "center",
              };
            };
            doc["footer"] = function (currentPage, pageCount) {
              return {
                text: "Page " + currentPage.toString() + " of " + pageCount,
                alignment: "center",
              };
            };
            doc.watermark = {
              text: document.title,
              color: "#3498db ",
              opacity: 0.3,
              bold: true,
              italics: false,
            };
          },
        },
        {
          extend: "colvis",
          postfixButtons: ["colvisRestore"],
        },
      ],
      dom:
        "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
        "<'row'<'col-md-12'tr>>" +
        "<'row'<'col-md-5'i><'col-md-7'p>>",
      lengthMenu: [
        [5, 10, 25, 50, 100, 250, 500, -1],
        [5, 10, 25, 50, 100, 250, 500, "All"],
      ],
      processing: true,
      pageLength: 100,
      pagingType: "full_numbers",
    });

    table.buttons().container().appendTo("#table_wrapper .col-md-5:eq(0)");
    return this;
  };
})(jQuery);

(function ($) {
  $.fn.data_table = function (options) {
    var component_input = $(this);
    var settings = $.extend(
      {
        title_name: "Export Data",
      },
      options
    );

    var title_name = settings.title_name;
    var file_name = settings.title_name + " " + get_current_timestamp();
    var table_parent = component_input;
    table_parent.pretty_format_table();
    var button = table_parent.find("button");
    var button_td = button.closest("td");
    var index = button_td.index();
    var table = table_parent.DataTable({
      lengthMenu: [
        [5, 10, 25, 50, 100, 250, 500, -1],
        [5, 10, 25, 50, 100, 250, 500, "All"],
      ],
      processing: true,
      pageLength: 100,
      pagingType: "full_numbers",
    });
    return this;
  };
})(jQuery);
