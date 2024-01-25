<?php
include("dbchart.php");
?>
<!DOCTYPE html>
<html>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
 <head>
 </head>
 <body>
  <div id="wrapper">
   <div class="container mt-5 mb-5">
    <div class="col-lg-12">
    
    </div>
    <div class="form-row">
     <div class="form-group col-md-4">
      <!-- Chart 1 start -->
      
    <!-- Chart 3 end -->
    <br><br>
    <!-- Chart 4 starts -->
    <div class="form-row">
     <div class="form-group col-md-6">
      <div id="linechart" style="width: 600px; height: 400px;"></div>
     </div>
     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     <script type="text/javascript"> 
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart);
     function drawChart() {
     var data = google.visualization.arrayToDataTable([
     ['month', 'bills' ], 
      // sql data fetch start......
     <?php
     $sql = "SELECT month(date), count(pres) FROM bill  group by month(date) asc";
     $fire = mysqli_query($con, $sql);
     while ($result = mysqli_fetch_assoc($fire)){
     echo "['".$result['month(date)']."',".$result['count(pres)']."],";
     }
     ?>
      // sql data fetch end......
     ]);
     var options = {
     title: 'PWBS Sales',
     curveType: 'function',
     legend: { position: 'bottom' }
     };
     var chart = new google.visualization.AreaChart(document.getElementById('linechart'));
     chart.draw(data, options);
     }
     </script>
     <!-- Chart 4 ends -->


    <!-- Chart 5 ends -->
    <!-- <script admin lte cdn for div row. you can use bootstrap start -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css"/>
   <!-- <script cdn ends -->
   </body>
  </html>