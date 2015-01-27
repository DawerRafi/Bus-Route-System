<?php
$to = $_REQUEST["to"];
$from = $_REQUEST["from"];
$duration= $_REQUEST["duration"];
$fare = $_REQUEST["fare"];

include 'connection.php';
$query= "SELECT MAX(EDGE_ID) EDGE_ID FROM EDGES";
$stmt=oci_parse($conn,$query);
oci_execute($stmt);
oci_fetch($stmt);
$id =oci_result($stmt,'EDGE_ID');
$id=$id+1;
$query= "INSERT INTO EDGES VALUES (".$id.",".$from.",".$to.",".$fare.",".$duration.")";
$stmt=oci_parse($conn,$query);
if(oci_execute($stmt)){
	oci_commit($conn);
	echo 'Stop Added Successfully';
}
else{
	echo 'Error Adding Stop. Please Try Again';
}
?>