<?php
$this->title = 'WorldWideVi: Dashboard';

     
?>


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

<?php 
//bookings//
$bookings = Yii::$app->getDb()->createCommand("SELECT * FROM bookings")->queryAll();  

$table_b = '';
foreach($bookings as $c){
    //$status = '<td><span class="badge badge-soft-warning">Pending</span></td>';
    //$status = ($c['paid']==1)?'<span class="badge badge-soft-success">Paid</span>':'<span class="badge badge-soft-danger">Unpaid</span>';

    $color_class = "badge badge-soft-danger";
    if($c['paid']==1){$color_class = "badge badge-soft-success";}
    if($c['paid']==2){$color_class = "badge badge-soft-warning";}

     $status = '<select name="status" id="'.$c["id"].'" class="form-control form-control-sm select-first '.$color_class.' " style="padding-top: 7px; font-size: 10px;">';   //onchange="changestatus('.$c["id"].')"
     $status .= ($c['paid']==0)?'<option value="0" selected="selected" class="badge badge-soft-danger">Unpaid</option>':'<option value="0" class="badge badge-soft-danger">Unpaid</option>';
     $status .= ($c['paid']==1)?'<option value="1" selected="selected" class="badge badge-soft-success">Paid</option>':'<option value="1" class="badge badge-soft-success">Paid</option>';
     $status .= ($c['paid']==2)?'<option value="2" selected="selected" class="badge badge-soft-warning">Pending</option>':'<option value="2" class="badge badge-soft-warning">Pending</option>';        
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

<style>
.badge{
    -webkit-appearance: none;
-moz-appearance: none;
appearance: none;
width: 100%;
}

</style>
<script>
 datatable = $('#example3').DataTable({
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
                 
                  var second_class = 'form-control-sm select-first badge badge-soft-danger';                      
                    if(options==1){second_class = 'form-control-sm select-first badge badge-soft-success';}
                    if(options==2){second_class = 'form-control-sm select-first badge badge-soft-warning';}
                  $("#"+id).attr('class', second_class);
                   //$("#"+id).addClass('form-control');
                 if(response==1){

                    //$(this).css({cursor:"default"});
                    //e.preventDefault(); 
               
                    
                     //$("#"+id).slice(1).remove();
                    //$("#"+id).addClass(second_class);
                   
                    
                    //document.querySelector(this.id).className = second_class;
                    //$(".first").removeClass("second");
                    //$("#"+id).css({cursor:"default"});
                    //$( '#example3' ).click();
                    //e.preventDefault();   
                    chartshow('1');
                   
                      
                 }else{alert("Some error occurred. Please try again.");}
			     
			}
        }); 
})
</script>
