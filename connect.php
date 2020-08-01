


<?php

//error_reporting(0);
date_default_timezone_set("Asia/Kolkata");
setlocale(LC_ALL,"hu_HU.UTF8");
$time=(strftime("%Y, %B %d, %A."))." ".date("h:i:s a");
$ip=$_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
ini_set('max_execution_time', 0);

//database variables
$sessionweb="cygnus19@session";  //variable for preventing SESSION HIJACKING
$con = mysqli_connect("localhost","root","","netra");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $date=date('Y-m-d'); 
  $title="Cygnus'19";
?>
</body>
</html>