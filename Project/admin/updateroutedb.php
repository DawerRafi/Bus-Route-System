<?php

session_start();
if(!isset($_SESSION["username"])){
 header( 'Location: logon.php');
} ?>
<?php
$sid= $_POST['SID'];
$rid= $_POST['RID'];
$busid= $_POST['BUSID'];
$dep= $_POST['Departure'];

include 'connection.php';
$query="UPDATE ROUTE SET BUSID=".$busid.", DEPART_TIME='".$dep."' WHERE ROUTE_ID=".$sid;
$stmt=oci_parse($conn,$query);
//echo $query;
oci_execute($stmt);
oci_commit($conn);
header( 'Location: home.php');
?>
