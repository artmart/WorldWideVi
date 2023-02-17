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
    $status = '<td><span class="badge badge-soft-warning">Pending</span></td>';
    $status = ($c['paid']==1)?'<span class="badge badge-soft-success">Paid</span>':'<span class="badge badge-soft-danger">Unpaid</span>';

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
    </tr><!-- end tr --><!--        <th scope="col" style="word-wrap: break-word; !important">Schedule Id</th>          -->
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
          "info":     true,
          dom: "Bflrtip", 
          
          
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
          
          
          
          
          
          
          
          
          
          
            
          buttons: [
            {extend: "copy", className: "btn-sm"},
            {extend: "csv", className: "btn-sm"},
            {extend: "excel", className: "btn-sm"},
            {extend: "print", className: "btn-sm"},
          ],
        }); 
</script>  
























<?php /*
<div class="row">
<div class="col-xxl-4">
<div class="card">
<div class="card-header align-items-center d-flex">
<h4 class="card-title mb-0 flex-grow-1">Team Members</h4>
<div class="flex-shrink-0">
<div class="dropdown card-header-dropdown">
<a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="fw-semibold text-uppercase fs-12">Sort by: </span><span class="text-muted">Last 30 Days<i class="mdi mdi-chevron-down ms-1"></i></span>
</a>
<div class="dropdown-menu dropdown-menu-end">
    <a class="dropdown-item" href="#">Today</a>
    <a class="dropdown-item" href="#">Yesterday</a>
    <a class="dropdown-item" href="#">Last 7 Days</a>
    <a class="dropdown-item" href="#">Last 30 Days</a>
    <a class="dropdown-item" href="#">This Month</a>
    <a class="dropdown-item" href="#">Last Month</a>
</div>
</div>
</div>
</div><!-- end card header -->

<div class="card-body">

<div class="table-responsive table-card">
<table class="table table-borderless table-nowrap align-middle mb-0">
<thead class="table-light text-muted">
    <tr>
        <th scope="col">Member</th>
        <th scope="col">Hours</th>
        <th scope="col">Tasks</th>
        <th scope="col">Status</th>
    </tr>
</thead>
<tbody>
    <tr>
        <td class="d-flex">
            <img src="/images/users/avatar-1.jpg" alt="" class="avatar-xs rounded-3 me-2">
            <div>
                <h5 class="fs-13 mb-0">Donald Risher</h5>
                <p class="fs-12 mb-0 text-muted">Product Manager</p>
            </div>
        </td>
        <td>
            <h6 class="mb-0">110h : <span class="text-muted">150h</span></h6>
        </td>
        <td>
            258
        </td>
        <td style="width:5%;">
            <div id="radialBar_chart_1" data-colors='["--vz-primary"]' data-chart-series="50" class="apex-charts" dir="ltr"></div>
        </td>
    </tr><!-- end tr -->
    <tr>
        <td class="d-flex">
            <img src="/images/users/avatar-2.jpg" alt="" class="avatar-xs rounded-3 me-2">
            <div>
                <h5 class="fs-13 mb-0">Jansh Brown</h5>
                <p class="fs-12 mb-0 text-muted">Lead Developer</p>
            </div>
        </td>
        <td>
            <h6 class="mb-0">83h : <span class="text-muted">150h</span></h6>
        </td>
        <td>
            105
        </td>
        <td>
            <div id="radialBar_chart_2" data-colors='["--vz-primary"]' data-chart-series="45" class="apex-charts" dir="ltr"></div>
        </td>
    </tr><!-- end tr -->
    <tr>
        <td class="d-flex">
            <img src="/images/users/avatar-7.jpg" alt="" class="avatar-xs rounded-3 me-2">
            <div>
                <h5 class="fs-13 mb-0">Carroll Adams</h5>
                <p class="fs-12 mb-0 text-muted">Lead Designer</p>
            </div>
        </td>
        <td>
            <h6 class="mb-0">58h : <span class="text-muted">150h</span></h6>
        </td>
        <td>
            75
        </td>
        <td>
            <div id="radialBar_chart_3" data-colors='["--vz-primary"]' data-chart-series="75" class="apex-charts" dir="ltr"></div>
        </td>
    </tr><!-- end tr -->
    <tr>
        <td class="d-flex">
            <img src="/images/users/avatar-4.jpg" alt="" class="avatar-xs rounded-3 me-2">
            <div>
                <h5 class="fs-13 mb-0">William Pinto</h5>
                <p class="fs-12 mb-0 text-muted">UI/UX Designer</p>
            </div>
        </td>
        <td>
            <h6 class="mb-0">96h : <span class="text-muted">150h</span></h6>
        </td>
        <td>
            85
        </td>
        <td>
            <div id="radialBar_chart_4" data-colors='["--vz-warning"]' data-chart-series="25" class="apex-charts" dir="ltr"></div>
        </td>
    </tr><!-- end tr -->
    <tr>
        <td class="d-flex">
            <img src="/images/users/avatar-6.jpg" alt="" class="avatar-xs rounded-3 me-2">
            <div>
                <h5 class="fs-13 mb-0">Garry Fournier</h5>
                <p class="fs-12 mb-0 text-muted">Web Designer</p>
            </div>
        </td>
        <td>
            <h6 class="mb-0">76h : <span class="text-muted">150h</span></h6>
        </td>
        <td>
            69
        </td>
        <td>
            <div id="radialBar_chart_5" data-colors='["--vz-primary"]' data-chart-series="60" class="apex-charts" dir="ltr"></div>
        </td>
    </tr><!-- end tr -->
    <tr>
        <td class="d-flex">
            <img src="/images/users/avatar-5.jpg" alt="" class="avatar-xs rounded-3 me-2">
            <div>
                <h5 class="fs-13 mb-0">Susan Denton</h5>
                <p class="fs-12 mb-0 text-muted">Lead Designer</p>
            </div>
        </td>

        <td>
            <h6 class="mb-0">123h : <span class="text-muted">150h</span></h6>
        </td>
        <td>
            658
        </td>
        <td>
            <div id="radialBar_chart_6" data-colors='["--vz-success"]' data-chart-series="85" class="apex-charts" dir="ltr"></div>
        </td>
    </tr><!-- end tr -->
    <tr>
        <td class="d-flex">
            <img src="/images/users/avatar-3.jpg" alt="" class="avatar-xs rounded-3 me-2">
            <div>
                <h5 class="fs-13 mb-0">Joseph Jackson</h5>
                <p class="fs-12 mb-0 text-muted">React Developer</p>
            </div>
        </td>
        <td>
            <h6 class="mb-0">117h : <span class="text-muted">150h</span></h6>
        </td>
        <td>
            125
        </td>
        <td>
            <div id="radialBar_chart_7" data-colors='["--vz-primary"]' data-chart-series="70" class="apex-charts" dir="ltr"></div>
        </td>
    </tr><!-- end tr -->
</tbody><!-- end tbody -->
</table><!-- end table -->
</div>
</div><!-- end cardbody -->
</div><!-- end card -->
</div><!-- end col -->

<div class="col-xxl-4 col-lg-6">
<div class="card card-height-100">
<div class="card-header align-items-center d-flex">
<h4 class="card-title mb-0 flex-grow-1">Chat</h4>
<div class="flex-shrink-0">
<div class="dropdown card-header-dropdown">
<a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="text-muted"><i class="ri-settings-4-line align-middle me-1"></i>Setting <i class="mdi mdi-chevron-down ms-1"></i></span>
</a>
<div class="dropdown-menu dropdown-menu-end">
    <a class="dropdown-item" href="#"><i class="ri-user-2-fill align-bottom text-muted me-2"></i> View Profile</a>
    <a class="dropdown-item" href="#"><i class="ri-inbox-archive-line align-bottom text-muted me-2"></i> Archive</a>
    <a class="dropdown-item" href="#"><i class="ri-mic-off-line align-bottom text-muted me-2"></i> Muted</a>
    <a class="dropdown-item" href="#"><i class="ri-delete-bin-5-line align-bottom text-muted me-2"></i> Delete</a>
</div>
</div>
</div>
</div><!-- end card header -->

<div class="card-body p-0">
<div class="chat-conversation p-3" data-simplebar style="height: 400px;">
<ul class="list-unstyled chat-conversation-list chat-sm" id="users-conversation">
<li class="chat-list left">
    <div class="conversation-list">
        <div class="chat-avatar">
            <img src="/images/users/avatar-2.jpg" alt="">
        </div>
        <div class="user-chat-content">
            <div class="ctext-wrap">
                <div class="ctext-wrap-content">
                    <p class="mb-0 ctext-content">Good morning 😊</p>
                </div>
                <div class="dropdown align-self-start message-box-drop">
                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ri-more-2-fill"></i>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#"><i class="ri-reply-line me-2 text-muted align-bottom"></i>Reply</a>
                        <a class="dropdown-item" href="#"><i class="ri-share-line me-2 text-muted align-bottom"></i>Forward</a>
                        <a class="dropdown-item" href="#"><i class="ri-file-copy-line me-2 text-muted align-bottom"></i>Copy</a>
                        <a class="dropdown-item" href="#"><i class="ri-bookmark-line me-2 text-muted align-bottom"></i>Bookmark</a>
                        <a class="dropdown-item delete-item" href="#"><i class="ri-delete-bin-5-line me-2 text-muted align-bottom"></i>Delete</a>
                    </div>
                </div>
            </div>
            <div class="conversation-name"><small class="text-muted time">09:07 am</small> <span class="text-success check-message-icon"><i class="ri-check-double-line align-bottom"></i></span></div>
        </div>
    </div>
</li>
<!-- chat-list -->

<li class="chat-list right">
    <div class="conversation-list">
        <div class="user-chat-content">
            <div class="ctext-wrap">
                <div class="ctext-wrap-content">
                    <p class="mb-0 ctext-content">Good morning, How are you? What about our next meeting?</p>
                </div>
                <div class="dropdown align-self-start message-box-drop">
                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ri-more-2-fill"></i>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#"><i class="ri-reply-line me-2 text-muted align-bottom"></i>Reply</a>
                        <a class="dropdown-item" href="#"><i class="ri-share-line me-2 text-muted align-bottom"></i>Forward</a>
                        <a class="dropdown-item" href="#"><i class="ri-file-copy-line me-2 text-muted align-bottom"></i>Copy</a>
                        <a class="dropdown-item" href="#"><i class="ri-bookmark-line me-2 text-muted align-bottom"></i>Bookmark</a>
                        <a class="dropdown-item delete-item" href="#"><i class="ri-delete-bin-5-line me-2 text-muted align-bottom"></i>Delete</a>
                    </div>
                </div>
            </div>
            <div class="conversation-name"><small class="text-muted time">09:08 am</small> <span class="text-success check-message-icon"><i class="ri-check-double-line align-bottom"></i></span></div>
        </div>
    </div>
</li>
<!-- chat-list -->

<li class="chat-list left">
    <div class="conversation-list">
        <div class="chat-avatar">
            <img src="/images/users/avatar-2.jpg" alt="">
        </div>
        <div class="user-chat-content">
            <div class="ctext-wrap">
                <div class="ctext-wrap-content">
                    <p class="mb-0 ctext-content">Yeah everything is fine. Our next meeting tomorrow at 10.00 AM</p>
                </div>
                <div class="dropdown align-self-start message-box-drop">
                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ri-more-2-fill"></i>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#"><i class="ri-reply-line me-2 text-muted align-bottom"></i>Reply</a>
                        <a class="dropdown-item" href="#"><i class="ri-share-line me-2 text-muted align-bottom"></i>Forward</a>
                        <a class="dropdown-item" href="#"><i class="ri-file-copy-line me-2 text-muted align-bottom"></i>Copy</a>
                        <a class="dropdown-item" href="#"><i class="ri-bookmark-line me-2 text-muted align-bottom"></i>Bookmark</a>
                        <a class="dropdown-item delete-item" href="#"><i class="ri-delete-bin-5-line me-2 text-muted align-bottom"></i>Delete</a>
                    </div>
                </div>
            </div>
            <div class="ctext-wrap">
                <div class="ctext-wrap-content">
                    <p class="mb-0 ctext-content">Hey, I'm going to meet a friend of mine at the department store. I have to buy some presents for my parents 🎁.</p>
                </div>
                <div class="dropdown align-self-start message-box-drop">
                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ri-more-2-fill"></i>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#"><i class="ri-reply-line me-2 text-muted align-bottom"></i>Reply</a>
                        <a class="dropdown-item" href="#"><i class="ri-share-line me-2 text-muted align-bottom"></i>Forward</a>
                        <a class="dropdown-item" href="#"><i class="ri-file-copy-line me-2 text-muted align-bottom"></i>Copy</a>
                        <a class="dropdown-item" href="#"><i class="ri-bookmark-line me-2 text-muted align-bottom"></i>Bookmark</a>
                        <a class="dropdown-item delete-item" href="#"><i class="ri-delete-bin-5-line me-2 text-muted align-bottom"></i>Delete</a>
                    </div>
                </div>
            </div>
            <div class="conversation-name"><small class="text-muted time">09:10 am</small> <span class="text-success check-message-icon"><i class="ri-check-double-line align-bottom"></i></span></div>
        </div>
    </div>
</li>
<!-- chat-list -->

<li class="chat-list right">
    <div class="conversation-list">
        <div class="user-chat-content">
            <div class="ctext-wrap">
                <div class="ctext-wrap-content">
                    <p class="mb-0 ctext-content">Wow that's great</p>
                </div>
                <div class="dropdown align-self-start message-box-drop">
                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ri-more-2-fill"></i>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#"><i class="ri-reply-line me-2 text-muted align-bottom"></i>Reply</a>
                        <a class="dropdown-item" href="#"><i class="ri-share-line me-2 text-muted align-bottom"></i>Forward</a>
                        <a class="dropdown-item" href="#"><i class="ri-file-copy-line me-2 text-muted align-bottom"></i>Copy</a>
                        <a class="dropdown-item" href="#"><i class="ri-bookmark-line me-2 text-muted align-bottom"></i>Bookmark</a>
                        <a class="dropdown-item delete-item" href="#"><i class="ri-delete-bin-5-line me-2 text-muted align-bottom"></i>Delete</a>
                    </div>
                </div>
            </div>
            <div class="conversation-name"><small class="text-muted time">09:12 am</small> <span class="text-success check-message-icon"><i class="ri-check-double-line align-bottom"></i></span></div>
        </div>
    </div>
</li>
<!-- chat-list -->

<li class="chat-list left">
    <div class="conversation-list">
        <div class="chat-avatar">
            <img src="/images/users/avatar-2.jpg" alt="">
        </div>
        <div class="user-chat-content">
            <div class="ctext-wrap">
                <div class="message-img mb-0">
                    <div class="message-img-list">
                        <div>
                            <a class="popup-img d-inline-block" href="/images/small/img-1.jpg">
                                <img src="/images/small/img-1.jpg" alt="" class="rounded border">
                            </a>
                        </div>
                        <div class="message-img-link">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ri-more-fill"></i>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/images/small/img-1.jpg" download=""><i class="ri-download-2-line me-2 text-muted align-bottom"></i>Download</a>
                                        <a class="dropdown-item" href="#"><i class="ri-reply-line me-2 text-muted align-bottom"></i>Reply</a>
                                        <a class="dropdown-item" href="#"><i class="ri-share-line me-2 text-muted align-bottom"></i>Forward</a>
                                        <a class="dropdown-item" href="#"><i class="ri-bookmark-line me-2 text-muted align-bottom"></i>Bookmark</a>
                                        <a class="dropdown-item delete-item" href="#"><i class="ri-delete-bin-5-line me-2 text-muted align-bottom"></i>Delete</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="message-img-list">
                        <div>
                            <a class="popup-img d-inline-block" href="/images/small/img-2.jpg">
                                <img src="/images/small/img-2.jpg" alt="" class="rounded border">
                            </a>
                        </div>
                        <div class="message-img-link">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ri-more-fill"></i>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/images/small/img-2.jpg" download=""><i class="ri-download-2-line me-2 text-muted align-bottom"></i>Download</a>
                                        <a class="dropdown-item" href="#"><i class="ri-reply-line me-2 text-muted align-bottom"></i>Reply</a>
                                        <a class="dropdown-item" href="#"><i class="ri-share-line me-2 text-muted align-bottom"></i>Forward</a>
                                        <a class="dropdown-item" href="#"><i class="ri-bookmark-line me-2 text-muted align-bottom"></i>Bookmark</a>
                                        <a class="dropdown-item delete-item" href="#"><i class="ri-delete-bin-5-line me-2 text-muted align-bottom"></i>Delete</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="conversation-name"><small class="text-muted time">09:30 am</small> <span class="text-success check-message-icon"><i class="ri-check-double-line align-bottom"></i></span></div>
        </div>
    </div>
</li>
<!-- chat-list -->
</ul>
</div>
<div class="border-top border-top-dashed">
<div class="row g-2 mx-3 mt-2 mb-3">
<div class="col">
    <div class="position-relative">
        <input type="text" class="form-control border-light bg-light" placeholder="Enter Message...">
    </div>
</div><!-- end col -->
<div class="col-auto">
    <button type="submit" class="btn btn-info"><span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send float-end"></i></button>
</div><!-- end col -->
</div><!-- end row -->
</div>
</div><!-- end cardbody -->
</div><!-- end card -->
</div><!-- end col -->

<div class="col-xxl-4 col-lg-6">
<div class="card card-height-100">
<div class="card-header align-items-center d-flex">
<h4 class="card-title mb-0 flex-grow-1">Projects Status</h4>
<div class="flex-shrink-0">
<div class="dropdown card-header-dropdown">
<a class="dropdown-btn text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    All Time <i class="mdi mdi-chevron-down ms-1"></i></span>
</a>
<div class="dropdown-menu dropdown-menu-end">
    <a class="dropdown-item" href="#">All Time</a>
    <a class="dropdown-item" href="#">Last 7 Days</a>
    <a class="dropdown-item" href="#">Last 30 Days</a>
    <a class="dropdown-item" href="#">Last 90 Days</a>
</div>
</div>
</div>
</div><!-- end card header -->

<div class="card-body">
<div id="prjects-status" data-colors='["--vz-success", "--vz-primary", "--vz-warning", "--vz-danger"]' class="apex-charts" dir="ltr"></div>
<div class="mt-3">
<div class="d-flex justify-content-center align-items-center mb-4">
<h2 class="me-3 ff-secondary mb-0">258</h2>
<div>
    <p class="text-muted mb-0">Total Projects</p>
    <p class="text-success fw-medium mb-0">
        <span class="badge badge-soft-success p-1 rounded-circle"><i class="ri-arrow-right-up-line"></i></span> +3 New
    </p>
</div>
</div>

<div class="d-flex justify-content-between border-bottom border-bottom-dashed py-2">
<p class="fw-medium mb-0"><i class="ri-checkbox-blank-circle-fill text-success align-middle me-2"></i> Completed</p>
<div>
    <span class="text-muted pe-5">125 Projects</span>
    <span class="text-success fw-medium fs-12">15870hrs</span>
</div>
</div><!-- end -->
<div class="d-flex justify-content-between border-bottom border-bottom-dashed py-2">
<p class="fw-medium mb-0"><i class="ri-checkbox-blank-circle-fill text-primary align-middle me-2"></i> In Progress</p>
<div>
    <span class="text-muted pe-5">42 Projects</span>
    <span class="text-success fw-medium fs-12">243hrs</span>
</div>
</div><!-- end -->
<div class="d-flex justify-content-between border-bottom border-bottom-dashed py-2">
<p class="fw-medium mb-0"><i class="ri-checkbox-blank-circle-fill text-warning align-middle me-2"></i> Yet to Start</p>
<div>
    <span class="text-muted pe-5">58 Projects</span>
    <span class="text-success fw-medium fs-12">~2050hrs</span>
</div>
</div><!-- end -->
<div class="d-flex justify-content-between py-2">
<p class="fw-medium mb-0"><i class="ri-checkbox-blank-circle-fill text-danger align-middle me-2"></i> Cancelled</p>
<div>
    <span class="text-muted pe-5">89 Projects</span>
    <span class="text-success fw-medium fs-12">~900hrs</span>
</div>
</div><!-- end -->
</div>
</div><!-- end cardbody -->
</div><!-- end card -->
</div><!-- end col -->
</div><!-- end row -->
*/ ?>

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
