<?php
include 'connection.php';
$query="UPDATE CITY SET CNAME='".$_GET['city']."' WHERE CITY_ID=".$_GET['id'];
$stmt = oci_parse($conn,$query);
oci_execute($stmt);
oci_commit($conn);

header( 'Location: home.php' ) ;

?>