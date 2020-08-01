<?php
//error_reporting(0);
include "connect.php";
if ($_REQUEST['ttc'] && $_REQUEST['distance']){
#$alert=intval($_GET['alert']);
$ttc=$_GET['ttc'];
$distance=$_GET['distance'];
$date=$_GET['date'];
if($distance<=3){
	$alert=1;
	$alarm=0;
}else{
	$alert=0;
	$alarm=1;
}
echo $date;
$a="INSERT INTO data (ttc,distance,alert,alarm) VALUES('$ttc','$distance','$alert','$alarm')";
$test=mysqli_query($con,"SELECT * from chart where date='$date'");
$rows=mysqli_num_rows($test);
if($rows==0){
	$b=mysqli_query($con,"INSERT INTO chart (total_data_count,alerts_count) VALUES('0','0')");
}
$cs=mysqli_query($con,"UPDATE chart set total_data_count=total_data_count+1,alerts_count=alerts_count+'$alert' WHERE date='$date'");
$q=mysqli_query($con,$a);
if ($q){
	echo "<script>alert('success')</script>";
}

else {
	echo "<script>alert('failed')</script>";
}
}
else {
	echo "it needs url args alert,ttc,distance";
}
?>