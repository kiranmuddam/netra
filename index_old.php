<html>
<head>
<!--<meta http-equiv="refresh" content="3"/>-->
  <title>Netra _ for you with you</title> 
  <link rel="stylesheet" type="text/css" href="bootstrap.min.css" />
</head>
<body>
  <div class="container">
  <div class="page-header"><h1 class="h1-responsive text-bold text-success">Project Netra</h1>
  </div><br>
  <div class="container" style="width:100%;">
  <div id="chart-container container" style="width:100%;">
      <canvas id="mycanvas"></canvas></div>
      <div id="chart-container container" style="width:50%;">
      <canvas class="mycanvas"></canvas></div>
  </div>
    
<?php
include "connect.php";
$alarm=0;
$a="SELECT * FROM data order by sno desc LIMIT 1";
$q=mysqli_query($con,$a); 

if ($q){
   while($res=mysqli_fetch_array($q,MYSQLI_BOTH)){
    echo "<table border='1' class='table table-stripped' table-responsive style='font-weight:bold;width:50%;'>";
  echo "<b><tr><td>S.No: </td><td><button class='btn btn-info'>".$res['sno']."</button></td></tr></b>";
    echo "<b><tr><td>TTC: </td><td><button class='btn btn-primary'>".$res['ttc']."</button></td></tr></b>";
    echo "<b><tr><td>Distance: </td><td><button class='btn btn-primary'>".$res['distance']."</button></td></tr></b>";
    echo "<b><tr><td>Alert Level:</td><td> <button class='btn btn-danger'>".$res['alert']."</button></td></tr></b> ";
    #echo "<b><tr><td>Turn off Alarm:</td><td> <button class='btn btn-danger' onclick=''>OFF</button></td></tr></b> ";


    if($res['alert']==0){
        echo "<b><tr><td class='text-bold'>Alert Message:</td><td class='text-bold text-success'> You are in Normal Mode </td></tr></table ";
    }
    elseif ($res['alert']==1){
     echo "
<iframe src='alarm.wav' allow='autoplay' style='display:none' id='iframeAudio'>
</iframe>"; 
echo "<b><tr><td class='text-bold'>Alert Message:</td><td class='text-bold text-warning'> You are in Alert Mode. </td></tr></b> </table>";
    }
   elseif ($res['alert']==2){
     echo "
<iframe src='alarm.wav' allow='autoplay' style='display:none' id='iframeAudio'>
</iframe>";
echo "<b><tr><td class='text-bold'>Alert Message:</td><td class='text-bold text-danger'> You are in Danger. Please Wake Up .</td><td> </td></tr></b> </table>"; 
//send way 2 sms

    }
  } 
  
}

else {
  echo "<script>alert('failed')</script>";
}
?>

</div>


 <!-- javascript -->
 <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/Chart.min.js"></script>
    <script type="text/javascript" src="js/app.js"></script>

</body>