<?php
$clients_query = "SELECT c.*, b.id b_id, b.time, b.email b_email, b.name, b.scheduleID b_scheduleID, b.bookedDATE, b.agent b_agent, b.price b_price, b.paid 
                  FROM clients c LEFT JOIN bookings b ON b.email=c.email";
$clients = Yii::$app->getDb()->createCommand($clients_query)->queryAll();    
//$bookings = Yii::$app->getDb()->createCommand("SELECT * FROM clients")->queryAll(); 
$table = '';

    $active_clients_total_this_month = 0;
    $potential_revenue_total_this_month = 0;
    $revenue_total_this_monyh = 0;
    $bookers_total_this_month = 0;

foreach($clients as $c){

    if($c['b_id']>0){
        //$active_clients++;
        //$potential_revenue = $potential_revenue + $c['price'];
        if(date('Ym')==date('Ym', strtotime($c['addedTime']))){ 
        $active_clients_total_this_month++;
        if($c['paid']!==1 ){
           // $potential_revenue_total_this_month = $potential_revenue_total_this_month + $c['b_price'];
        }else{
                $revenue_total_this_monyh = $revenue_total_this_monyh + $c['b_price'];
                
        }
        }
   
        $potential_revenue_total_this_month = $potential_revenue_total_this_month + $c['b_price'];
        $table .= "<tr>
                <td>".$c['name']."</td>
                <td>".$c['email'] ."</td>
                <td>".$c['fromDATE']."</td>
                <td>".$c['desiredDATE']."</td>
                <td>".$c['bookedDATE']."</td>
                <td>".$c['scheduleID']."</td>
                <td>".$c['AGENT']."</td>
                <td>".number_format($c['price'], 2)."</td>
               </tr>"; 
         }else{
            if(date('Ym')==date('Ym', strtotime($c['addedTime']))){ 
                    $bookers_total_this_month++;
                }
         }     
    } 

?>

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




<div class="row project-wrapper">
<div class="col-xxl-12">
<div class="row">
<div class="col-xl-3">
<div class="card card-animate">
<div class="card-body">
<div class="d-flex align-items-center">
    <div class="avatar-sm flex-shrink-0">
        <span class="avatar-title bg-soft-primary text-primary rounded-2 fs-2">
            <i data-feather="briefcase" class="text-primary"></i>
        </span>
    </div>
    <div class="flex-grow-1 overflow-hidden ms-3">
        <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Active clients</p>
        <div class="d-flex align-items-center mb-3">
            <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value" data-target="<?=$active_clients_total_this_month;?>"><?=$active_clients_total_this_month;?></span></h4>
            <!--<span class="badge badge-soft-danger fs-12"><i class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>5.02 %<span>-->
        </div>
        <p class="text-muted text-truncate mb-0">Clients this month</p>
    </div>
</div>
</div><!-- end card body -->
</div>
</div><!-- end col -->

<div class="col-xl-3">
<div class="card card-animate">
<div class="card-body">
<div class="d-flex align-items-center">
    <div class="avatar-sm flex-shrink-0">
        <span class="avatar-title bg-soft-warning text-warning rounded-2 fs-2">
            <i data-feather="award" class="text-warning"></i>
        </span>
    </div>
    <div class="flex-grow-1 ms-3">
        <p class="text-uppercase fw-medium text-muted mb-3">Revenue <small>(finished clients)</small></p>
        <div class="d-flex align-items-center mb-3">
            <h4 class="fs-4 flex-grow-1 mb-0">$<span class="counter-value" data-target="<?=$revenue_total_this_monyh;?>"><?=$revenue_total_this_monyh;?></span></h4>
            <!--<span class="badge badge-soft-success fs-12"><i class="ri-arrow-up-s-line fs-13 align-middle me-1"></i>3.58 %</span>-->
        </div>
        <p class="text-muted mb-0">Revenue this month</p>
    </div>
</div>
</div><!-- end card body -->
</div>
</div><!-- end col -->

<div class="col-xl-3">
<div class="card card-animate">
<div class="card-body">
<div class="d-flex align-items-center">
    <div class="avatar-sm flex-shrink-0">
        <span class="avatar-title bg-soft-info text-info rounded-2 fs-2">
            <i data-feather="clock" class="text-info"></i>
        </span>
    </div>
    <div class="flex-grow-1 overflow-hidden ms-3">
        <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Total Montly Bookers</p>
        <div class="d-flex align-items-center mb-3">
            <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value" data-target="<?=$bookers_total_this_month;?>"><?=$bookers_total_this_month;?></span></h4>
            <!--<span class="badge badge-soft-danger fs-12"><i class="ri-arrow-down-s-line fs-13 align-middle me-1"></i>10.35 %</span>-->
        </div>
        <p class="text-muted text-truncate mb-0">Bookers this month</p>
    </div>
</div>
</div><!-- end card body -->
</div>
</div><!-- end col -->

<div class="col-xl-3">
<div class="card card-animate">
<div class="card-body">
<div class="d-flex align-items-center">
<div class="avatar-sm flex-shrink-0">
    <span class="avatar-title bg-soft-warning text-warning rounded-2 fs-2">
        <i data-feather="award" class="text-warning"></i>
    </span>
</div>
<div class="flex-grow-1 ms-3">
    <p class="text-uppercase fw-medium text-muted mb-3" style="margin-left: -60px;">Potential revenue <small>(unfinished clients)</small></p>
    <div class="d-flex align-items-center mb-3">
        <h4 class="fs-4 flex-grow-1 mb-0">$<span class="counter-value" data-target="<?=$potential_revenue_total_this_month;?>"><?=$potential_revenue_total_this_month;?></span></h4>
        <!--<span class="badge badge-soft-success fs-12"><i class="ri-arrow-up-s-line fs-13 align-middle me-1"></i>3.58 %</span>-->
    </div>
    <p class="text-muted mb-0">Revenue this month</p>
</div>
</div>
</div><!-- end card body -->
</div>
</div><!-- end col -->
</div><!-- end row -->

<div class="row">
<div class="col-xl-12">
<div class="card">
<div class="card-header border-0 align-items-center d-flex">
<h4 class="card-title mb-0 flex-grow-1">Monthly Overview</h4> 
<div id="wait" style="display:none;z-index: 1000;"><img src='/images/ajaxloader.gif'/></div>
<div>
    <button type="button" class="btn btn-soft-secondary btn-sm" onclick="chartshow('0')">ALL</button>
    <button type="button" class="btn btn-soft-secondary btn-sm" onclick="chartshow('1')">1M</button>
    <button type="button" class="btn btn-soft-secondary btn-sm" onclick="chartshow('6')">6M</button>
    <button type="button" class="btn btn-soft-primary btn-sm" onclick="chartshow('12')">1Y</button>
</div>
</div><!-- end card header -->











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
        yaxis: {min: 0},
    
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
        yaxis: {min: 0},
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





</div><!-- end card -->
</div><!-- end col -->
</div><!-- end row -->
</div><!-- end col -->
</div><!-- end row -->

<div class="row">
<div class="col-xl-12">
<div class="card">
<div class="card-header d-flex align-items-center">
<h4 class="card-title flex-grow-1 mb-0">Active Clients</h4>
<div class="flex-shrink-0">
<!--<a href="javascript:void(0);" class="btn btn-soft-info btn-sm">Export Report</a>-->
</div>
</div><!-- end cardheader -->
<div class="card-body">
<div class="table-responsive table-card">
<table id="example1" class="table table-nowrap table-centered align-middle" width="100%" cellspacing="0">
<thead class="bg-light text-muted">
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Start Date</th>
        <th scope="col">Due Date</th>
        <th scope="col">bookedDATE</th>
        <th scope="col">Schedule Id</th>
        <th scope="col" style="width: 10%;">Agent Name</th>
        <th scope="col">Price</th>
    </tr><!-- end tr -->
</thead><!-- thead -->
<tbody>
<?=$table?> 
</tbody><!-- end tbody -->
</table><!-- end table -->
</div>
</div><!-- end card body -->
</div><!-- end card -->
</div><!-- end col -->
</div><!-- end row -->
<script>
    $('#example1').DataTable({
          "ordering": true,
          "paging": true,
          "searching": true,
          "info":     true,
          dom: "Bflrtip",   
          buttons: [
            {extend: "copy", className: "btn-sm"},
            {extend: "csv", className: "btn-sm"},
            {extend: "excel", className: "btn-sm"},
            {extend: "print", className: "btn-sm"},
          ],
        }); 
</script>