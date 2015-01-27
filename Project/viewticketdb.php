<?php
$cnic =$_GET['cnic'];
include 'connection.php';
$query="SELECT STATUS FROM RESERVATIONS WHERE RES_ID=".$cnic;
$stmt=oci_parse($conn,$query);
oci_execute($stmt);
oci_fetch($stmt);
if(oci_result($stmt,1)==2){
	$_GET['id']=$cnic;
	include 'admin/ticket.php';
}
else{
	echo 'You payment has not yet been recieved. Please contact our Customer Services';
}
?>