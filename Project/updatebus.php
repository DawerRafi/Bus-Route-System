<?php
include 'connection.php';
$query="UPDATE BUSES SET CAPACITY='".$_GET['capacity']."', type='".$_GET['type']."' WHERE BUS_ID=".$_GET['id'];
$stmt = oci_parse($conn,$query);
oci_execute($stmt);
oci_commit($conn);

header( 'Location: home.php' ) ;

?>