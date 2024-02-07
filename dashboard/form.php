<?php
include_once "../asset_default/side_bar.php";
?>
<div class="container body">
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="content">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Sales Sum Per Inventory Category</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div id="chart_inv_category" style="margin-bottom: 1em;" class="chart-display"></div>
                        </div>
                    </div>
                </div>


                <div class="col-md-6 col-sm-6">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Sales Sum Per Inventory</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div id="chart_inv" style="margin-bottom: 1em;" class="chart-display"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Sales Report Detail</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><button type="button" name="refresh" id="jq_refresh" class="btn btn-success refresh_data"><i class="fa fa-refresh"></i></button></li>
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="card-box table-responsive" id="data_detail">
                                <!-- Import From Form File -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->
    </div>
</div>
<script>
    function sum_inv_category(input_table) {
        var sums = {};
        input_table.rows({
            search: 'applied'
        }).every(function() {
            var name = this.data()[0];
            var value = parseFloat(this.data()[2]);

            // Update the sum for the current group
            if (sums[name]) {
                sums[name] += value;
            } else {
                sums[name] = value;
            }
        });
        // And map it to the format Highcharts uses
        return $.map(sums, function(sum, key) {
            return {
                name: key,
                sum: sum
            };
        });
    }

    function sum_inv(input_table) {
        var sums = {};
        input_table.rows({
            search: 'applied'
        }).every(function() {
            var name = this.data()[1];
            var value = parseFloat(this.data()[2]);

            // Update the sum for the current group
            if (sums[name]) {
                sums[name] += value;
            } else {
                sums[name] = value;
            }
        });

        // And map it to the format Highcharts uses
        return $.map(sums, function(sum, key) {
            return {
                name: key,
                sum: sum
            };
        });
    }

    function act_refresh_data_detail() {
        $.ajax({
            url: "property.php",
            method: "POST",
            data: {
                action_status: "refresh_data_detail"
            },
            success: function(data) {
                $("#data_detail").html(data);
                var table = $("table#report_sales_table");
                table = table.DataTable();
                table.on('draw', function() {
                    //Draw chart Inventory Category
                    chart_inv_category.update({
                        xAxis: {
                            categories: sum_inv_category(table).map((key) => key.name),
                        },
                        series: [{
                            data: sum_inv_category(table).map((key) => key.sum),
                        }]
                    });
                    //Draw chart Inventory
                    chart_inv.update({
                        xAxis: {
                            categories: sum_inv(table).map((key) => key.name),
                        },
                        series: [{
                            data: sum_inv(table).map((key) => key.sum),
                        }]
                    });

                });

                // Create chart Inventory Category
                var chart_inv_category = Highcharts.chart("chart_inv_category", {
                    chart: {
                        type: 'bar',
                        styledMode: true
                    },
                    title: {
                        text: 'Sales Sum Per Inventory Category'
                    },
                    xAxis: {
                        categories: sum_inv_category(table).map((key) => key.name),
                        title: {
                            text: "Inventory Category",
                        },
                    },
                    yAxis: {
                        title: {
                            text: "Total",
                        },
                    },
                    series: [{
                        name: "Sum Total",
                        data: sum_inv_category(table).map((key) => key.sum),
                    }]
                });

                // Create chart Inventory
                var chart_inv = Highcharts.chart("chart_inv", {
                    chart: {
                        type: 'bar',
                        styledMode: true
                    },
                    title: {
                        text: 'Sales Sum Per Inventory'
                    },
                    xAxis: {
                        categories: sum_inv(table).map((key) => key.name),
                        title: {
                            text: "Inventory",
                        },
                    },
                    yAxis: {
                        title: {
                            text: "Total",
                        },
                    },
                    series: [{
                        name: "Sum Total",
                        data: sum_inv(table).map((key) => key.sum),
                    }]
                });
            }
        });
    }


    $(document).ready(function() {
        act_refresh_data_detail();
        $(document).on("click", ".refresh_data", function() {
            act_refresh_data_detail();
        })
    })
</script>