<?php

session_start();
if(!isset($_SESSION["username"])){
 header( 'Location: logon.php');
} ?>
<?php
$src = $_POST['src'];
$des = $_POST['des'];
$deptime = $_POST['deptime'];
$bus = $_POST['bus'];

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


function AddRoute($conn,$str,$arrlength,$stops,$des,$src,$deptime,$bus){
$query ="SELECT SUM(FARE) sum FROM EDGES WHERE EDGE_ID IN ".$str.")";
$stmt=oci_parse($conn,$query);
 if ( !oci_execute($stmt,OCI_DEFAULT) ) {
    
        // If we have a problem, rollback then die
        oci_rollback($conn);
        die;
    }
oci_fetch($stmt);
$tfare=oci_result($stmt,1);

$query ="SELECT SUM(DURATION) FROM EDGES WHERE EDGE_ID IN ".$str.")";
$stmt=oci_parse($conn,$query);

 if ( !oci_execute($stmt,OCI_DEFAULT) ) {
    
        // If we have a problem, rollback then die
        oci_rollback($conn);
        die;
    }
oci_fetch($stmt);
$ttime=oci_result($stmt,1);

$query= "SELECT MAX(ROUTE_ID) ROUTE_ID FROM ROUTE";
$stmt=oci_parse($conn,$query);
 if ( !oci_execute($stmt,OCI_DEFAULT) ) {
    
        // If we have a problem, rollback then die
        oci_rollback($conn);
        die;
    }
oci_fetch($stmt);
$id =oci_result($stmt,'ROUTE_ID');
$id=$id+1;

$query= "SELECT MAX(schedule_ID) FROM ROUTE";
$stmt=oci_parse($conn,$query);
 if ( !oci_execute($stmt,OCI_DEFAULT) ) {
    
        // If we have a problem, rollback then die
        oci_rollback($conn);
        die;
    }
oci_fetch($stmt);
$id3 =oci_result($stmt,1);
$id3=$id3+1;
$date=date( "d-M-y H:i:s",strtotime($deptime));
echo $date;
$query ="INSERT INTO ROUTE VALUES (".$id.",".$bus.",".$tfare.",".$ttime.",".$des.",".$src.",to_date(to_char(to_date(Translate('".$deptime."','T',' '),'YYYY-MM-DD HH24:MI:SS'),'dd-MON-yy HH24:MI:SS'),'dd-MON-yy HH24:MI:SS'),".$id3.",1)";
echo $query;
$stmt=oci_parse($conn,$query);
 if ( !oci_execute($stmt,OCI_DEFAULT) ) {
    
        // If we have a problem, rollback then die
        oci_rollback($conn);
        die;
    }

$query= "SELECT MAX(Route_Edge_ID) FROM Route_Edge";
$stmt=oci_parse($conn,$query);
 if ( !oci_execute($stmt,OCI_DEFAULT) ) {
    
        // If we have a problem, rollback then die
        oci_rollback($conn);
        die;
    }
oci_fetch($stmt);
$id2 =oci_result($stmt,1);
$id2=$id2+1;

for($x=0;$x<$arrlength;$x++) {
	$query ="INSERT INTO Route_Edge VALUES (".$id2.",".$id.",".$stops[$x].")";
	$stmt=oci_parse($conn,$query);
 if ( !oci_execute($stmt,OCI_DEFAULT) ) {
    
        // If we have a problem, rollback then die
        oci_rollback($conn);
        die;
    }
	$id2=$id2 +1;
}
oci_commit($conn);
return $id;
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
$ROUTEID=AddRoute($conn,$str,$arrlength,$stops,$des,$src,$deptime,$bus);
//echo $ROUTEID;
header( 'Location: home.php' ) ;



?>