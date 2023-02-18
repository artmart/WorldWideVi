<?php 
$dt = $_REQUEST['dt'];

$where = '';
if($dt!=='0'){
    $where = 'WHERE c.addedTime>=CURDATE() - INTERVAL '.$dt.' MONTH';
}

$active_clients = 0;
$potential_revenue = 0;
$revenue = 0;
$bookers_amount = 0;

$categories_chart = [];
$active_clients_chart = [];
$potential_revenue_chart = [];
$revenue_chart = [];
$bookers_amount_chart = [];

$clients_chart_query = "SELECT  DATE_FORMAT(c.addedTime, '%Y-%M') dt, COUNT(*) cnt_total, SUM(IF(b.paid=1, b.price, 0)) revenue, SUM(IF(b.id>0, b.price, 0)) potencial_revenue,
                        SUM(IF(b.id>0, 1, 0)) active_clients, SUM(IF((b.id=0 or b.id IS null), 1, 0)) bookers_amount
                        FROM clients c LEFT JOIN bookings b ON b.email=c.email ". $where ." GROUP BY dt ORDER BY dt asc";
$clients_chart = Yii::$app->getDb()->createCommand($clients_chart_query)->queryAll();  
 
foreach($clients_chart as $c){
    $categories_chart[] = $c['dt'];
    $active_clients_chart[] = $c['active_clients'];
    $potential_revenue_chart[] = $c['potencial_revenue'];
    $revenue_chart[] = $c['revenue'];
    $bookers_amount_chart[] = $c['bookers_amount'];
    
    $active_clients = $active_clients + $c['active_clients'];
    $potential_revenue = $potential_revenue + $c['potencial_revenue'];
    $revenue = $revenue + $c['revenue'];
    $bookers_amount = $bookers_amount + $c['bookers_amount'];
    }           
?>

<div class="card-header p-0 border-0 bg-soft-light">
<div class="row g-0 text-center">
    <div class="col-6 col-sm-3">
        <div class="p-3 border border-dashed border-start-0">
            <h5 class="mb-1"><?=$active_clients;?></h5>
            <p class="text-muted mb-0">Active clients</p>
        </div>
    </div>
    <!--end col-->
    <div class="col-6 col-sm-3">
        <div class="p-3 border border-dashed border-start-0">
            <h5 class="mb-1">$<?=$potential_revenue;?></h5>
            <p class="text-muted mb-0">Potential revenue (unfinished clients)</p>
        </div>
    </div>
    <!--end col-->
    <div class="col-6 col-sm-3">
        <div class="p-3 border border-dashed border-start-0">
            <h5 class="mb-1">$<?=$revenue;?></h5>
            <p class="text-muted mb-0">Revenue (finished clients)</p>
        </div>
    </div>
    <!--end col-->
    <div class="col-6 col-sm-3">
        <div class="p-3 border border-dashed border-start-0 border-end-0">
            <h5 class="mb-1 text-success"><?=$bookers_amount;?></h5>
            <p class="text-muted mb-0">Bookers amount (finished clients)</p>
        </div>
    </div>
    <!--end col-->
</div>
</div><!-- end card header -->
<div class="card-body p-0 pb-2">
<div class="row">
<div class="col-sm-6">
    <div id="projects-overview-chart1" data-colors='["--vz-primary", "--vz-warning", "--vz-success"]' class="apex-charts" dir="ltr"></div>
</div>
<div class="col-sm-6">
    <div id="projects-overview-chart2" data-colors='["--vz-primary", "--vz-warning", "--vz-success"]' class="apex-charts" dir="ltr"></div>
</div>
</div>
<script>
//function overviewchartinit(){
// Projects Overview
//var linechartcustomerColors = getChartColorsArray("projects-overview-chart");
//if (linechartcustomerColors) {
    var options = {
        series: [{
            name: 'Bookers amount',
            type: 'bar',
            data: <?=json_encode($bookers_amount_chart);?>
        }, {
            name: 'Active Clients',
            type: 'bar',
            data: <?=json_encode($active_clients_chart);?>
        }],
        chart: {height: 374, type: 'line', toolbar: {show: false}},
        stroke: {
            curve: 'smooth',
            dashArray: [0, 3, 0],
            width: [0, 1, 0],
        },
        //colors:['#008FFB', '#3f51b5', '#A300D6', '#F9C80E'],
        dataLabels: {
          style: {
            colors: ['#D7263D', '#3f51b5']
          }
        },
        colors: ['#D7263D', '#3f51b5'],
        fill: {colors: ['#D7263D', '#3f51b5']},
        markers: {
            size: [0, 4, 0],
            strokeWidth: 2,
            hover: {size: 4}
        },
        xaxis: {
            categories: <?=json_encode($categories_chart);?>,
            axisTicks: {show: false},
            axisBorder: {show: false}
        },
        grid: {
            show: true,
            xaxis: {lines: {show: true}},
            yaxis: {lines: {show: false}},
            padding: {top: 0, right: -2, bottom: 15, left: 10},
        },
        legend: {
            show: true,
            horizontalAlign: 'center',
            offsetX: 0,
            offsetY: -5,
            markers: {width: 9, height: 9, radius: 6},
            itemMargin: {horizontal: 10, vertical: 0},
        },
        plotOptions: {
           // bar: {columnWidth: '30%', barHeight: '70%'}
        },
        //colors: ['blue', 'green', 'red', 'yellow'], // linechartcustomerColors,
        tooltip: {
            shared: true,
            y: [{
                formatter: function (y) {
                    if (typeof y !== "undefined") {return y.toFixed(0);}
                    return y;
                }
            },{
                formatter: function (y) {
                    if (typeof y !== "undefined") {
                        return y.toFixed(0);
                    }
                    return y;
                }
            }]
        }
    };
    var chart = new ApexCharts(document.querySelector("#projects-overview-chart1"), options);
    chart.render();
    
///////////////////////////////////////////////////
    var options = {
        series: [{
                    name: 'Potential revenue',
                    type: 'bar',
                    data: <?=json_encode($potential_revenue_chart);?>
                }, {
                    name: 'Revenue',
                    type: 'bar',
                    data: <?=json_encode($revenue_chart);?>
                }],
        chart: {height: 374, type: 'line', toolbar: {show: false}},
        stroke: {
            curve: 'smooth',
            dashArray: [0, 3, 0],
            width: [0, 1, 0],
        },
        colors: ['#662E9B', '#F9C80E'],
        fill: {colors: ['#662E9B', '#F9C80E']},
        markers: {
            size: [0, 4, 0],
            strokeWidth: 2,
            hover: {size: 4}
        },
        xaxis: {
            categories: <?=json_encode($categories_chart);?>,
            axisTicks: {show: false},
            axisBorder: {show: false}
        },
        grid: {
            show: true,
            xaxis: {lines: {show: true}},
            yaxis: {lines: {show: false}},
            padding: {top: 0, right: -2, bottom: 15, left: 10},
        },
        legend: {
            show: true,
            horizontalAlign: 'center',
            offsetX: 0,
            offsetY: -5,
            markers: {width: 9, height: 9, radius: 6},
            itemMargin: {horizontal: 10, vertical: 0},
        },
        plotOptions: {
           // bar: {columnWidth: '30%', barHeight: '70%'}
        },
        //colors: ['blue', 'green', 'red', 'yellow'], // linechartcustomerColors,
        tooltip: {
            shared: true,
            y: [{
                formatter: function (y) {
                    if (typeof y !== "undefined") {
                        return "$" + y.toFixed(2);
                    }
                    return y;
                }
            }, {
                formatter: function (y) {
                    if (typeof y !== "undefined") {
                        return "$" + y.toFixed(2);
                    }
                    return y;
                }
            }]
        }
    };
    var chart = new ApexCharts(document.querySelector("#projects-overview-chart2"), options);
    chart.render();
    
//}
//}
</script>
</div><!-- end card body -->