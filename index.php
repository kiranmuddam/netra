<?php
include "connect.php";
ob_start();
$alarm=0;
$date=date("Y-m-d");
$alarms_count=mysqli_fetch_array(mysqli_query($con,"SELECT * from chart where date='$date'"));
$alarms_count=$alarms_count['alerts_count'];
$a="SELECT * FROM data";
$buzz=mysqli_num_rows(mysqli_query($con,"SELECT * FROM data where alarm=0 ORDER by sno asc"));
$total_alerts_count=mysqli_num_rows(mysqli_query($con,"SELECT * FROM data where alert=1"));

if($buzz>0){
$buzz=mysqli_num_rows(mysqli_query($con,"SELECT * FROM data where alarm=0 ORDER by sno asc"));
$b=mysqli_query($con,"SELECT * FROM data order by alarm asc LIMIT 1");
$days_count=mysqli_num_rows(mysqli_query($con,"SELECT * from chart"));
$q=mysqli_query($con,$a); 
$total_data_count=mysqli_num_rows($q);
?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
   <!-- <meta http-equiv="refresh" content="1"/>-->

    <link rel="icon" href="https://getbootstrap.com/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Netra Analytics Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/album.css" rel="stylesheet">
    <style>
    .counter
{
    background-color: #eaecf0;
    text-align: center;
}
.employees,.customer,.design,.order
{
    margin-top: 70px;
    margin-bottom: 70px;
}
.counter-count
{
    font-size: 28px;
    background-color: #00b3e7;
    border-radius: 50%;
    position: relative;
    color: #ffffff;
    text-align: center;
    line-height: 82px;
    margin-left:27%;
    width: 40%;
    height: 60%;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    -o-border-radius: 50%;
    display: inline-block;
}
    </style>
  </head>

  <body>

    <header>
      <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              <h4 class="text-white">About</h4>
              <p class="text-muted">Netra is a project to detect accident situations and alert the driver in real-time. This project is developed for fiction2science contest. </p>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
              <h4 class="text-white">Contact</h4>
              <!--<ul class="list-unstyled">
                <li><a href="http://localhost/netra/index.php##" class="text-white">Follow on Twitter</a></li>
                <li><a href="http://localhost/netra/index.php##" class="text-white">Like on Facebook</a></li>
                <li><a href="http://localhost/netra/index.php##" class="text-white">Email me</a></li>
              </ul>-->
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="http://localhost/netra/index.php##" class="navbar-brand d-flex align-items-center">
            <strong>Netra Analytics Dashboard</strong>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>

    <main role="main">

      

      <div class="album py-5 bg-light">
        <div class="container">
        <div class="row">
            <div class="col-md-9">
            <?php
            if ($b){
              while($res=mysqli_fetch_array($b,MYSQLI_BOTH)){
               echo "<table border='1' class='table table-striped table-dark' style='font-weight:bold;height:95%;'>";
             echo "<b><tr><td>Alert Serial No : </td><td><button class='btn btn-info'>".$res['sno']."</button></td></tr></b>";
               echo "<b><tr><td>TIme To Collision (TTC) : </td><td><button class='btn btn-primary'>".$res['ttc']."</button></td></tr></b>";
               echo "<b><tr><td>Distance between Vehicles : </td><td><button class='btn btn-primary'>".$res['distance']."</button></td></tr></b>";
               echo "<b><tr><td>Alert Level :</td><td> <button class='btn btn-danger'>".$res['alert']."</button></td></tr></b> ";
               #echo "<b><tr><td>Turn off Alarm:</td><td> <button class='btn btn-danger' onclick=''>OFF</button></td></tr></b> ";
           
               if($res['alert']==0){
                   echo "<b><tr><td class='text-bold'>Alert Message:</td><td class='text-bold text-success'> You are in Normal Mode </td></tr></b></table></div> ";
                   $alarm=0;
                  }
               elseif ($res['alert']==1){
                 if($res['alarm']==0){
                   $alarm=1;
                  $cs=mysqli_query($con,"UPDATE data set alarm=1");
                  echo "<b><tr><td class='text-bold'>Alert Message:</td><td class='text-bold text-warning'> You are in Alert Mode. </td></tr></b> </table></div>";
  
                  echo "
             <iframe src='alarm.wav' allow='autoplay' style='display:none' id='iframeAudio'>\
             </iframe>"; 
                 }else{
                  $alarm=0;
                  echo "<b><tr><td class='text-bold'>Alert Message:</td><td class='text-bold text-warning'> You are in Alert Mode. </td></tr></b> </table></div>";

                 }
                

               }
              elseif ($res['alert']==2 && $res['alarm']==0){
                $cs=mysqli_query($con,"UPDATE data set alarm=1");
                echo "<b><tr><td class='text-bold'>Alert Message:</td><td class='text-bold text-danger'> You are in Danger. Please Wake Up .</td><td> </td></tr></b> </table></div>"; 

                echo "
           <iframe src='alarm.wav' allow='autoplay' style='display:none' id='iframeAudio'>
           </iframe>";

           //send way 2 sms
           
               }
             } 
             
           }
           
           else {
             echo "<script>alert('failed')</script>";
           }
           ?>
            <div class="col-md-3">
             <div class="card mb-4 box-shadow" style="height:32%;">
                <div class="card-body">
                    <p class="counter-count"><?php if($alarm==0){
                      echo "OFF";}
                      else{
                        echo "ON";
                    } ?></p>
                    <center><p class="card-text">Alarm Status</p></center>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                     <!-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>-->
                    </div>
                    <!--<small class="text-muted">9 mins</small>-->
                  </div>
                </div>
              </div>
              
              <div class="card mb-4 box-shadow" style="height:32%;">
                <div class="card-body">
                    <p class="counter-count"><?php echo $alarms_count; ?></p>
                    <center><p class="card-text"><?php echo strval($date) , " Alarms count"; ?>   </p></center>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                     <!-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>-->
                    </div>
                    <!--<small class="text-muted">9 mins</small>-->
                  </div>
                </div>
              </div>
         

            </div>
            </div>
            <br><br>
          <div class="row">
            <div class="col-md-9">
            <div class="container" style="width:100%;">
  <div id="chart-container container" style="width:100%;">
      <canvas id="mycanvas"></canvas></div>
  </div>
              <!--<div class="card mb-4 box-shadow">
                <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22728%22%20height%3D%22226%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20728%20226%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16ee8cbe243%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A36pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16ee8cbe243%22%3E%3Crect%20width%3D%22728%22%20height%3D%22226%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22242.671875%22%20y%3D%22129.0828125%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                <div class="card-body">
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                    </div>
                    <small class="text-muted">9 mins</small>
                  </div>
                </div>
              </div>-->
            </div>
            <div class="col-md-3">
              <div class="card mb-4 box-shadow" style="height:32%;">
                <div class="card-body">
                    <p class="counter-count"><?php echo $total_data_count; ?></p>
                    <center><p class="card-text">Total Data Processed</p></center>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                     <!-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>-->
                    </div>
                    <!--<small class="text-muted">9 mins</small>-->
                  </div>
                </div>
              </div>
              <div class="card mb-4 box-shadow" style="height:32%;">
                <div class="card-body">
                    <p class="counter-count"><?php echo $days_count; ?></p>
                    <center><p class="card-text">Total Number Of Days</p></center>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                     <!-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>-->
                    </div>
                    <!--<small class="text-muted">9 mins</small>-->
                  </div>
                </div>
              </div>
            </div>
          </div>


             <div class="row">
            <div class="col-md-9">
            <div class="container" style="width:100%;">
  <div id="chart-container container" style="width:100%;">
      <canvas id="mycanvas2"></canvas></div>
  </div>
              <!--<div class="card mb-4 box-shadow">
                <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22728%22%20height%3D%22226%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20728%20226%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16ee8cbe243%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A36pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16ee8cbe243%22%3E%3Crect%20width%3D%22728%22%20height%3D%22226%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22242.671875%22%20y%3D%22129.0828125%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                <div class="card-body">
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                    </div>
                    <small class="text-muted">9 mins</small>
                  </div>
                </div>
              </div>-->
            </div>
            <div class="col-md-3">
              <div class="card mb-4 box-shadow" style="height:32%;">
                <div class="card-body">
                    <p class="counter-count"><?php echo $total_data_count; ?></p>
                    <center><p class="card-text">Total Data Processed</p></center>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                     <!-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>-->
                    </div>
                    <!--<small class="text-muted">9 mins</small>-->
                  </div>
                </div>
              </div>
              <div class="card mb-4 box-shadow" style="height:32%;">
                <div class="card-body">
                    <p class="counter-count"><?php echo $days_count; ?></p>
                    <center><p class="card-text">Total Number Of Days</p></center>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                     <!-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>-->
                    </div>
                    <!--<small class="text-muted">9 mins</small>-->
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

    </main>

    <footer class="text-muted">
      <div class="container">
        <p class="float-right">
          <a href="http://localhost/netra/index.php##">Back to top</a>
        </p>
        <p>Netra Project © Netra Team, 2019 Netra Analytics Web Dashboard.</p>
        
      </div>
    </footer>
<script>
$('.counter-count').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 5000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
</script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/jquery-3.2.1.slim.min.js"  crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="assets/popper.min.js"></script>
    <script src="assets/bootstrap.min.js"></script>
    <script src="assets/holder.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/Chart.min.js"></script>
    <script type="text/javascript" src="js/app.js"></script>
    <script type="text/javascript" src="js/app2.js"></script>

  

<svg xmlns="http://www.w3.org/2000/svg" width="348" height="226" viewBox="0 0 348 226" preserveAspectRatio="none" style="display: none; visibility: hidden; position: absolute; top: -100%; left: -100%;"><defs><style type="text/css"></style></defs><text x="0" y="17" style="font-weight:bold;font-size:17pt;font-family:Arial, Helvetica, Open Sans, sans-serif">Thumbnail</text></svg></body></html>
<?php
echo '<meta http-equiv="refresh" content="3"/>';
} else{?>
  <?php 
  $buzz=mysqli_num_rows(mysqli_query($con,"SELECT * FROM data where alarm=0 ORDER by sno asc"));
  $b=mysqli_query($con,"SELECT * FROM data order by alarm asc LIMIT 1");
$days_count=mysqli_num_rows(mysqli_query($con,"SELECT * from chart"));
$q=mysqli_query($con,$a); 
$total_data_count=mysqli_num_rows($q);
?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
   <!-- <meta http-equiv="refresh" content="1"/>-->

    <link rel="icon" href="https://getbootstrap.com/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Netra Analytics Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/album.css" rel="stylesheet">
    <style>
    .counter
{
    background-color: #eaecf0;
    text-align: center;
}
.employees,.customer,.design,.order
{
    margin-top: 70px;
    margin-bottom: 70px;
}
.counter-count
{
    font-size: 28px;
    background-color: #00b3e7;
    border-radius: 50%;
    position: relative;
    color: #ffffff;
    text-align: center;
    line-height: 82px;
    margin-left:27%;
    width: 40%;
    height: 60%;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    -o-border-radius: 50%;
    display: inline-block;
}
    </style>
  </head>

  <body>

    <header>
      <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              <h4 class="text-white">About</h4>
              <p class="text-muted">Netra is a project to detect accident situations and alert the driver in real-time. This project is developed for fiction2science contest. </p>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
              <h4 class="text-white">Contact</h4>
              <!--<ul class="list-unstyled">
                <li><a href="http://localhost/netra/index.php##" class="text-white">Follow on Twitter</a></li>
                <li><a href="http://localhost/netra/index.php##" class="text-white">Like on Facebook</a></li>
                <li><a href="http://localhost/netra/index.php##" class="text-white">Email me</a></li>
              </ul>-->
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="http://localhost/netra/index.php##" class="navbar-brand d-flex align-items-center">
            <strong>Netra Analytics Dashboard</strong>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>

    <main role="main">

      

      <div class="album py-5 bg-light">
        <div class="container">
        <div class="row">
            <div class="col-md-9">
            <?php
            if ($b){
              while($res=mysqli_fetch_array($b,MYSQLI_BOTH)){
               echo "<table border='1' class='table table-striped table-dark' style='font-weight:bold;height:95%;'>";
             echo "<b><tr><td>Alert Serial No : </td><td><button class='btn btn-info'>".$res['sno']."</button></td></tr></b>";
               echo "<b><tr><td>TIme To Collision (TTC) : </td><td><button class='btn btn-primary'>".$res['ttc']."</button></td></tr></b>";
               echo "<b><tr><td>Distance between Vehicles : </td><td><button class='btn btn-primary'>".$res['distance']."</button></td></tr></b>";
               echo "<b><tr><td>Alert Level :</td><td> <button class='btn btn-danger'>".$res['alert']."</button></td></tr></b> ";
               #echo "<b><tr><td>Turn off Alarm:</td><td> <button class='btn btn-danger' onclick=''>OFF</button></td></tr></b> ";
           
               if($res['alert']==0){
                   echo "<b><tr><td class='text-bold'>Alert Message:</td><td class='text-bold text-success'> You are in Normal Mode </td></tr></b></table></div> ";
                   $alarm=0;
                  }
               elseif ($res['alert']==1){
                 if($res['alarm']==0){
                   $alarm=1;
                  $cs=mysqli_query($con,"UPDATE data set alarm=1");
                  echo "<b><tr><td class='text-bold'>Alert Message:</td><td class='text-bold text-warning'> You are in Alert Mode. </td></tr></b> </table></div>";
  
                  echo "
             <iframe src='alarm.wav' allow='autoplay' style='display:none' id='iframeAudio'>\
             </iframe>"; 
                 }else{
                  $alarm=0;
                  echo "<b><tr><td class='text-bold'>Alert Message:</td><td class='text-bold text-warning'> You are in Alert Mode. </td></tr></b> </table></div>";

                 }
                

               }
              elseif ($res['alert']==2 && $res['alarm']==0){
                $cs=mysqli_query($con,"UPDATE data set alarm=1");
                echo "<b><tr><td class='text-bold'>Alert Message:</td><td class='text-bold text-danger'> You are in Danger. Please Wake Up .</td><td> </td></tr></b> </table></div>"; 

                echo "
           <iframe src='alarm.wav' allow='autoplay' style='display:none' id='iframeAudio'>
           </iframe>";

           //send way 2 sms
           
               }
             } 
             
           }
           
           else {
             echo "<script>alert('failed')</script>";
           }
           ?>
            <div class="col-md-3">
             <div class="card mb-4 box-shadow" style="height:32%;">
                <div class="card-body">
                    <p class="counter-count"><?php if($alarm==0){
                      echo "OFF";}
                      else{
                        echo "ON";
                    } ?></p>
                    <center><p class="card-text">Alarm Status</p></center>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                     <!-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>-->
                    </div>
                    <!--<small class="text-muted">9 mins</small>-->
                  </div>
                </div>
              </div>
              
              <div class="card mb-4 box-shadow" style="height:32%;">
                <div class="card-body">
                    <p class="counter-count"><?php echo $alarms_count; ?></p>
                    <center><p class="card-text"><?php echo strval($date) , " Alarms count"; ?> </p></center>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                     <!-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>-->
                    </div>
                    <!--<small class="text-muted">9 mins</small>-->
                  </div>
                </div>
              </div>
         

            </div>
            </div>
            <br><br>
          <div class="row">
            <div class="col-md-9">
            <div class="container" style="width:100%;">
  <div id="chart-container container" style="width:100%;">
      <canvas id="mycanvas"></canvas></div>
      <div id="chart-container container" style="width:50%;">
      <canvas class="mycanvas"></canvas></div>
  </div>
              <!--<div class="card mb-4 box-shadow">
                <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22728%22%20height%3D%22226%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20728%20226%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16ee8cbe243%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A36pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16ee8cbe243%22%3E%3Crect%20width%3D%22728%22%20height%3D%22226%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22242.671875%22%20y%3D%22129.0828125%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                <div class="card-body">
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                    </div>
                    <small class="text-muted">9 mins</small>
                  </div>
                </div>
              </div>-->
            </div>
            <div class="col-md-3">
              <div class="card mb-4 box-shadow" style="height:32%;">
                <div class="card-body">
                    <p class="counter-count"><?php echo $total_data_count; ?></p>
                    <center><p class="card-text">Total Data Processed</p></center>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                     <!-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>-->
                    </div>
                    <!--<small class="text-muted">9 mins</small>-->
                  </div>
                </div>
              </div>
              <div class="card mb-4 box-shadow" style="height:32%;">
                <div class="card-body">
                    <p class="counter-count"><?php echo $days_count; ?></p>
                    <center><p class="card-text">Total Number Of Days</p></center>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                     <!-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>-->
                    </div>
                    <!--<small class="text-muted">9 mins</small>-->
                  </div>
                </div>
              </div>
            </div>
          </div>


             <div class="row">
            <div class="col-md-9">
            <div class="container" style="width:100%;">
  <div id="chart-container container" style="width:100%;">
      <canvas id="mycanvas2"></canvas></div>
      <div id="chart-container container" style="width:50%;">
      <canvas class="mycanvas"></canvas></div>
  </div>
              <!--<div class="card mb-4 box-shadow">
                <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22728%22%20height%3D%22226%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20728%20226%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16ee8cbe243%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A36pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16ee8cbe243%22%3E%3Crect%20width%3D%22728%22%20height%3D%22226%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22242.671875%22%20y%3D%22129.0828125%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                <div class="card-body">
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                    </div>
                    <small class="text-muted">9 mins</small>
                  </div>
                </div>
              </div>-->
            </div>
            <div class="col-md-3">
              <div class="card mb-4 box-shadow" style="height:32%;">
                <div class="card-body">
                    <p class="counter-count"><?php echo $total_alerts_count; ?></p>
                    <center><p class="card-text">Total Alerts Count</p></center>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                     <!-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>-->
                    </div>
                    <!--<small class="text-muted">9 mins</small>-->
                  </div>
                </div>
              </div>
              <div class="card mb-4 box-shadow" style="height:32%;">
                <div class="card-body">
                    <p class="counter-count"><?php echo $alarms_count; ?></p>
                    <center><p class="card-text"><?php echo $date, " Alerts Count" ?></p></center>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                     <!-- <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>-->
                    </div>
                    <!--<small class="text-muted">9 mins</small>-->
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

    </main>

    <footer class="text-muted">
      <div class="container">
        <p class="float-right">
          <a href="http://localhost/netra/index.php##">Back to top</a>
        </p>
        <p>Netra Project © Netra Team, 2019 Netra Analytics Web Dashboard.</p>
        
      </div>
    </footer>
<script>
$('.counter-count').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 5000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
</script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/jquery-3.2.1.slim.min.js"  crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="assets/popper.min.js"></script>
    <script src="assets/bootstrap.min.js"></script>
    <script src="assets/holder.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/Chart.min.js"></script>
    <script type="text/javascript" src="js/app.js"></script>
    <script type="text/javascript" src="js/app2.js"></script>
<svg xmlns="http://www.w3.org/2000/svg" width="348" height="226" viewBox="0 0 348 226" preserveAspectRatio="none" style="display: none; visibility: hidden; position: absolute; top: -100%; left: -100%;"><defs><style type="text/css"></style></defs><text x="0" y="17" style="font-weight:bold;font-size:17pt;font-family:Arial, Helvetica, Open Sans, sans-serif">Thumbnail</text></svg></body></html>
<?php
/* echo '<meta http-equiv="refresh" content="1"/>'; */
}?>
