<?php

session_start();
if(!isset($_SESSION["username"])){
 header( 'Location: logon.php');
} ?>
<?php
$city = $_REQUEST["city"];

include 'connection.php';
$query= "SELECT MAX(CITY_ID) FROM CITIES";
$stmt=oci_parse($conn,$query);
oci_execute($stmt);
oci_fetch($stmt);
$id =oci_result($stmt,1);
$id=$id+1;
$query="SELECT * FROM CITIES WHERE CNAME='".$city."'";
$stmt= oci_parse($conn,$query);
oci_execute($stmt);
if(oci_fetch($stmt)){
	echo 'City Already Added';
}
else{
$query= "INSERT INTO CITIES VALUES (".$id.",'".$city."',1)";
$stmt=oci_parse($conn,$query);
if(oci_execute($stmt)){
	oci_commit($conn);
	echo 'City Added Successfully';
}
else{
	echo 'Error Adding City. Please Try Again';
}
}

?>
