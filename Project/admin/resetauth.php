<?php
session_start();
if(!isset($_SESSION["username"])){
	
 header( 'Location: logon.php');
}
$cp= $_POST['cp'];
$np = $_POST['np'];
$cnp = $_POST['cnp'];
include 'connection.php';

if($np==$cnp){
$date = strtotime("+60 day");
$date = date('d-M-Y', $date);
$query = "UPDATE ADMINS SET RESET_DATE='".$date."',PASSWORD='".$np."' WHERE USERNAME='". $_SESSION["username"] ."' AND PASSWORD='". $cp ."'";
$stmt = oci_parse($conn,$query);
oci_execute($stmt);
oci_commit();
session_unset();
session_destroy();
 header( 'Location: logon.php');
}
else{
header( 'Location: reset.php');
}

?>
