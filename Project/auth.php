<?php
$user= $_POST['user'];
$pass = $_POST['pass'];
include 'connection.php';
$query = "SELECT ADMIN_ID,RESET_DATE,USERNAME FROM ADMINS WHERE USERNAME='". $user ."' AND PASSWORD='". $pass ."'";
$stmt = oci_parse($conn,$query);
if(oci_execute($stmt)){
if(oci_fetch($stmt)>0){
$admin=oci_result($stmt,'ADMIN_ID');
if($admin!=NULL){

	session_start();
$_SESSION["id"] = $admin;
$_SESSION["username"] = oci_result($stmt,"USERNAME");
$_SESSION["resetdate"] = oci_result($stmt,"RESET_DATE");
	//echo date("Y-m-d");
//$arr = date_parse($_SESSION["resetdate"]);
//$resetdate= $arr["year"]."-".$arr["month"]."-".$arr["day"];
//echo $resetdate;

$dateTimestamp1 = strtotime(date("d-M-y"));
$dateTimestamp2 = strtotime($_SESSION["resetdate"]);
if($dateTimestamp1 > $dateTimestamp2) {
 header( 'Location: reset.php');
}
else{
	header( 'Location: home.php' ) ;
}
}
else{
header( 'Location: logon.php' ) ;
}
}
else{
header( 'Location: logon.php' ) ;
}
}

?>