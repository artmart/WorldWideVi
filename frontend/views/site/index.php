<?php
$this->title = 'WorldWideVi: Dashboard';

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
            $potential_revenue_total_this_month = $potential_revenue_total_this_month + $c['b_price'];
        }else{
                $revenue_total_this_monyh = $revenue_total_this_monyh + $c['b_price'];
                
        }
        }
   
        
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

<div id="monthly_overview_chart_show"></div>

<script>
function chartshow(dt){    
    $.ajax({
			type: 'post',
			url: '/site/topchart',
			data: {'dt': dt},
            beforeSend: function(){$("#wait").css("display", "block"); }, 
			success: function (response) {
			     $("#wait").css("display", "none");
			     $( '#monthly_overview_chart_show' ).html(response);
                 //overviewchartinit();
			}
        }); 
  }
  
$(document).ready(function(){chartshow('1'); });
</script>
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
<!--
<div class="align-items-center mt-xl-3 mt-4 justify-content-between d-flex">
<div class="flex-shrink-0">
<div class="text-muted">Showing <span class="fw-semibold">5</span> of <span class="fw-semibold">25</span> Results
</div>
</div>
<ul class="pagination pagination-separated pagination-sm mb-0">
<li class="page-item disabled">
    <a href="#" class="page-link">←</a>
</li>
<li class="page-item">
    <a href="#" class="page-link">1</a>
</li>
<li class="page-item active">
    <a href="#" class="page-link">2</a>
</li>
<li class="page-item">
    <a href="#" class="page-link">3</a>
</li>
<li class="page-item">
    <a href="#" class="page-link">→</a>
</li>
</ul>
</div>
-->
</div><!-- end card body -->
</div><!-- end card -->
</div><!-- end col -->
</div><!-- end row -->

<?php 
//bookings//
$bookings = Yii::$app->getDb()->createCommand("SELECT * FROM bookings")->queryAll();  

$table_b = '';
foreach($bookings as $c){
    //$status = '<td><span class="badge badge-soft-warning">Pending</span></td>';
    //$status = ($c['paid']==1)?'<span class="badge badge-soft-success">Paid</span>':'<span class="badge badge-soft-danger">Unpaid</span>';


     $status = '<select name="status" id="'.$c["id"].'" class="form-control form-control-sm input-xs select-first">';   //onchange="changestatus('.$c["id"].')"
     $status .= ($c['paid']==0)?'<option value="0" selected>Unpaid</option>':'<option value="0">Unpaid</option>';
     $status .= ($c['paid']==1)?'<option value="1" selected>Paid</option>':'<option value="1">Paid</option>';
     $status .= ($c['paid']==2)?'<option value="2" selected>Pending</option>':'<option value="2">Pending</option>';        
     $status .= '</select>';

    //<span class="badge badge-soft-warning">Inprogress</span>
    //<td><span class="badge badge-soft-danger">Pending</span></td>
    //<td><span class="badge badge-soft-success">Completed</span></td>
   // <td><span class="badge badge-soft-warning">Progress</span></td>
          
    $table_b .= "<tr>
        <td>".$c['id'] ."</td>
        <td>".$c['time'] ."</td>        
        <td>".$c['email'] ."</td>
        <td>".$c['name'] ."</td>
        <td>".$c['bookedDATE']."</td>
        <td>".$c['agent']."</td>
        <td>".number_format($c['price'], 2)."</td>
        <td>".$status."</td>
       </tr>"; //<td>".$status."</td>         <td>".$c['scheduleID']."</td>
    
    }         
?>
<div class="row">
<div class="col-xl-12">
<div class="card">
<div class="card-header border-0 align-items-center d-flex">
<h4 class="card-title mb-0 flex-grow-1">Booked</h4> 
<!--<div id="wait" style="display:none;z-index: 1000;"><img src='/images/ajaxloader.gif'/></div>-->
<div>
<!--
    <button type="button" class="btn btn-soft-secondary btn-sm" onclick="chartshow('booker')">Bookers</button>
    <button type="button" class="btn btn-soft-secondary btn-sm" onclick="chartshow('scraper')">Scrapers</button>
    -->
</div>
</div><!-- end card header -->


<div class="card-header p-0 border-0 bg-soft-light">
<div class="row g-0 text-center">
</div>
</div><!-- end card header -->
<div class="card-body">
<div class="table-responsive table-card">
<table id="example3" class="table table-nowrap table-centered align-middle" width="100%" cellspacing="0">
<thead class="bg-light text-muted">
    <tr>
        <th scope="col">ID</th>  
        <th scope="col">Time</th>
        <th scope="col">Email</th>       
        <th scope="col">Name</th>
        <th scope="col">BookedDate</th>
        <th scope="col" style="width: 10%;">Agent</th>
        <th scope="col">Price</th>
        <th scope="col">Status</th>
    </tr><!-- end tr --><!-- <th scope="col" style="word-wrap: break-word; !important">Schedule Id</th>          -->
</thead><!-- thead -->
<tbody>
<?=$table_b?> 
</tbody><!-- end tbody -->
</table><!-- end table -->
</div>

</div><!-- end card body -->


</div><!-- end card -->
</div><!-- end col -->
</div><!-- end row -->
<script>
    $('#example3').DataTable({
          "ordering": true,
          "paging": true,
          "searching": true,
          "info": true,
          dom: "Bflrtip", 
          
     /*     
    "initComplete": function() {

      // Select the column whose header we need replaced using its index(0 based)

      this.api().column(7).every(function() {

        var column = this;

        // Put the HTML of the <select /> filter along with any default options 

        var select = $('<select class="form-control input-sm"><option value="">All</option></select>')

          // remove all content from this column's header and 

          // append the above <select /> element HTML code into it 

          .appendTo($(column.header()).empty())

          // execute callback when an option is selected in our <select /> filter

          .on('change', function() {

            // escape special characters for DataTable to perform search

            var val = $.fn.dataTable.util.escapeRegex($(this).val());

            // Perform the search with the <select /> filter value and re-render the DataTable

            column.search(val ? '^' + val + '$' : '', true, false).draw();

          });

        // fill the <select /> filter with unique values from the column's data

        column.data().unique().sort().each(function(d, j) {

          select.append("<option value='" + jQuery(d).text() + "'>" + d + "</option>")

        });
        
       // select.append('<option value="<span class=\"badge badge-soft-success\">Paid</span>">Paid</option>')

      });

    },
          
       "columnDefs": [{
      targets: [7],
      orderable: false
    }],    
          
      */    

          buttons: [
            {extend: "copy", className: "btn-sm"},
            {extend: "csv", className: "btn-sm"},
            {extend: "excel", className: "btn-sm"},
            {extend: "print", className: "btn-sm"},
          ],
        }); 
</script>  
<script>

$('.select-first').on('change', function(e) {
    var options = $(this).find('option:selected').val();
    var id = $(this).attr("id")
    var selecto = 'id='+ id + '&option='+ options;

        $.ajax({
			type: 'post',
			url: '/site/changestatus',
			data: {'id': id, 'option': options},
            beforeSend: function(){$("#wait").css("display", "block"); }, 
			success: function (response) {
			     $("#wait").css("display", "none");
                 if(response==1){
                    alert("Status Updated Successfully");
                    location.reload(); 
                 }else{alert("Some error occurred. Please try again.");}
			     
			}
        }); 

})

function changestatus(id){
    
}

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
