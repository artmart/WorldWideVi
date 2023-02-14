<?php 
$client_status = $_REQUEST['client_status'];

$where = '';
if($client_status!==''){
    $where = "WHERE c.status='$client_status' ";
}

/*
$clients_chart_query = "SELECT  DATE_FORMAT(c.addedTime, '%Y-%M') dt, COUNT(*) cnt_total, SUM(IF(b.paid=1, b.price, 0)) revenue, SUM(IF(b.paid<>1, b.price, 0)) potencial_revenue,
                        SUM(IF(b.id>0, 1, 0)) active_clients, SUM(IF((b.id=0 or b.id IS null), 1, 0)) bookers_amount
                        FROM clients c LEFT JOIN bookings b ON b.email=c.email ". $where ." GROUP BY dt ORDER BY dt asc";
*/                        
$clients_chart_query = "SELECT c.*, b.id b_id, b.time, b.email b_email, b.name, b.scheduleID b_scheduleID, b.bookedDATE, b.agent b_agent, b.price b_price, b.paid 
                  FROM clients c LEFT JOIN bookings b ON b.email=c.email " . $where;
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
        <td>".$c['AGENT']."</td>
        <td>".$status."</td>
        <td>".number_format($c['price'], 2)."</td>
       </tr>"; 
    
    }           
?>
<div class="table-responsive">
<table id="example2" class="display table table-nowrap align-middle" width="100%" cellspacing="0">
<thead class="bg-light text-muted">
    <tr>
        <th scope="col">ID</th>  
        <th scope="col">Email</th>       
        <th scope="col" style="word-wrap: break-word; !important">Schedule Id</th>
        <th scope="col">BookedDate</th>
        <th scope="col" style="width: 10%;">Agent</th>
        <th scope="col">Status</th>
        <th scope="col">Price</th>
    </tr><!-- end tr -->
</thead><!-- thead -->
<tbody>
<?=$table?> 
</tbody><!-- end tbody -->
</table><!-- end table -->
</div>

<?php 
/*
echo $this->registerJs(
    '$("#example4").DataTable({
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
        });',
         \yii\web\View ::POS_LOAD ,
    'yiiOptions'
);
*/
?>
<script>


/*
$(document).ready(function () {
    $('#example2').DataTable({
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
    });*/ 
</script>    