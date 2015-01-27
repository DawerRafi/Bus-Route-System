<?php

session_start();
if(!isset($_SESSION["username"])){
 header( 'Location: logon.php');
} ?>
<?php
$id=$_GET['id'];
include 'connection.php';
$query="UPDATE RESERVATIONS SET STATUS=2 WHERE RES_ID=".$id;
$stmt=oci_parse($conn,$query);
	if(oci_execute($stmt)){
	 echo 'Ticket Confirmed';
	}
	else{
	 echo 'Error Confirming Ticket';
	}
	
	
?>