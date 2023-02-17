<?php 

//$client_status = $_REQUEST['client_status'];
$where = '';
//if($client_status!==''){
   // $where = "WHERE c.status='$client_status' ";
//}
                       
$clients_chart_query = "SELECT c.*, b.id b_id, b.time, b.email b_email, b.name, b.scheduleID b_scheduleID, b.bookedDATE, b.agent b_agent, b.price b_price, b.paid 
                  FROM clients c LEFT JOIN bookings b ON b.email=c.email where c.status = 'scraper' " . $where;
$clients_chart = Yii::$app->getDb()->createCommand($clients_chart_query)->queryAll();  

$table = '';
foreach($clients_chart as $c){
    $status = '<td><span class="badge badge-soft-warning">Pending</span></td>';
    $status = ($c['paid']==1)?'<span class="badge badge-soft-success">Paid</span>':'<span class="badge badge-soft-danger">Unpaid</span>';

    //<span class="badge badge-soft-warning">Inprogress</span>
    //<td><span class="badge badge-soft-danger">Pending</span></td>
    //<td><span class="badge badge-soft-success">Completed</span></td>
   // <td><span class="badge badge-soft-warning">Progress</span></td>
          
    $table .= "<tr>
        <td>".$c['id'] ."</td>
        <td>".$c['email'] ."</td>
        <td>".$c['scheduleID']."</td>
        <td>".$c['bookedDATE']."</td>
       </tr>"; //<td>".$c['AGENT']."</td><td>".$status."</td><td>".number_format($c['price'], 2)."</td>
    }          
?>
<div class="row">
<div class="col-xl-12">
<div class="card">
<div class="card-header border-0 align-items-center d-flex">
<h4 class="card-title mb-0 flex-grow-1">Scrapers</h4> 
<div id="wait" style="display:none;z-index: 1000;"><img src='/images/ajaxloader.gif'/></div>
<div>
  <!--  <button type="button" class="btn btn-soft-secondary btn-sm" onclick="chartshow('booker')">Bookers</button>
    <button type="button" class="btn btn-soft-secondary btn-sm" onclick="chartshow('scraper')">Scrapers</button>
    <button type="button" class="btn btn-soft-secondary btn-sm" onclick="chartshow('')">All</button>-->
</div>
</div><!-- end card header -->


<div class="card-header p-0 border-0 bg-soft-light">
<div class="row g-0 text-center">
    
    
</div>
</div><!-- end card header -->
<div class="card-body ">

<div class="table-responsive table-card">
<table id="example4" class="table table-nowrap table-centered align-middle" width="100%" cellspacing="0">
<thead class="bg-light text-muted">
    <tr>
        <th scope="col">ID</th>  
        <th scope="col">Email</th>       
        <th scope="col" style="word-wrap: break-word; !important">Schedule Id</th>
        <th scope="col">BookedDate</th>
        <!--<th scope="col" style="width: 10%;">Agent</th>
        <th scope="col">Status</th>
        <th scope="col">Price</th>-->
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
$(document).ready(function () {
    $('#example4').DataTable({
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
    });
</script>

