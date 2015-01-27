<?php

session_start();
if(!isset($_SESSION["username"])){
 header( 'Location: logon.php');
} ?>
<?php
include 'connection.php';
$query="UPDATE CITIES SET CNAME='".$_POST['city']."' WHERE CITY_ID=".$_POST['id'];
$stmt = oci_parse($conn,$query);
oci_execute($stmt);
oci_commit($conn);

header( 'Location: home.php' ) ;

?>