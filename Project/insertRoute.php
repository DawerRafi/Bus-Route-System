<?php
$src = $_POST['src'];
$des = $_POST['des'];
$deptime = $_POST['deptime'];

echo 'Redirecting...';

$numberofstops= $_POST['numberofstops'];
$stops= array_fill(0, $numberofstops, NULL);
$where = array_fill(0, $numberofstops, NULL);
$counter=1;
while($numberofstops!=0){
 $stops[$counter-1]= $_POST["stop".$counter.""];
 $counter = $counter +1;
$numberofstops = $numberofstops -1 ;
}


function AddRoute($conn,$str,$arrlength,$stops){
$query ="SELECT SUM(FARE) sum FROM EDGES WHERE EDGE_ID IN ".$str.")";
$stmt=oci_parse($conn,$query);
oci_execute($stmt);
oci_fetch($stmt);
$tfare=oci_result($stmt,1);

$query ="SELECT SUM(DURATION) FROM EDGES WHERE EDGE_ID IN ".$str.")";
$stmt=oci_parse($conn,$query);
oci_execute($stmt);
oci_fetch($stmt);
$ttime=oci_result($stmt,1);

$query= "SELECT MAX(ROUTE_ID) ROUTE_ID FROM ROUTE";
$stmt=oci_parse($conn,$query);
oci_execute($stmt);
oci_fetch($stmt);
$id =oci_result($stmt,'ROUTE_ID');
$id=$id+1;

$query ="INSERT INTO ROUTE VALUES (".$id.",".$tfare.",".$ttime.",".$des.",".$src.")";
$stmt=oci_parse($conn,$query);
oci_execute($stmt);
oci_commit($stmt);

$query= "SELECT MAX(Route_Edge_ID) FROM Route_Edge";
$stmt=oci_parse($conn,$query);
oci_execute($stmt);
oci_fetch($stmt);
$id2 =oci_result($stmt,1);
$id2=$id2+1;

for($x=0;$x<$arrlength;$x++) {
	$query ="INSERT INTO Route_Edge VALUES (".$id2.",".$id.",".$stops[$x].")";
	$stmt=oci_parse($conn,$query);
	oci_execute($stmt);
	oci_commit($stmt);
	$id2=$id2 +1;
}
}

function ToStringStops($stops,$arrlength){
$str="(";
for($x=0;$x<$arrlength-1;$x++) {
   $str .=(string)$stops[$x];
   $str .=",";
}
	$str .=$stops[$arrlength-1];
	return $str;
	}


$arrlength=count($stops);
$str= ToStringStops($stops,$arrlength);	
include 'connection.php';
AddRoute($conn,$str,$arrlength,$stops);

header( 'Location: home.php' ) ;



?>