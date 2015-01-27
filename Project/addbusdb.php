<?php
$capacity = $_REQUEST["capacity"];
$dtype= $_REQUEST["type"];

include 'connection.php';
$query= "SELECT MAX(BUS_ID) FROM BUSES";
$stmt=oci_parse($conn,$query);
oci_execute($stmt);
oci_fetch($stmt);
$id =oci_result($stmt,1);
$id=$id+1;
$query="SELECT * FROM BUSES WHERE CAPACITY=".$capacity." AND TYPE='".$dtype."'";
$stmt= oci_parse($conn,$query);
oci_execute($stmt);
if(oci_fetch($stmt)){
	echo 'Bus Already Present';
}
else{
$query= "INSERT INTO BUSES (BUS_ID,CAPACITY,TYPE) VALUES (".$id.",".$capacity.",'".$dtype."')";
$stmt=oci_parse($conn,$query);
if(oci_execute($stmt)){
	oci_commit($conn);
	echo 'Bus Added Successfully';
}
else{
	echo 'Error Adding Bus. Please Try Again';
}
}

?>
