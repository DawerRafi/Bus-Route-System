<?php

session_start();
if(!isset($_SESSION["username"])){
 header( 'Location: logon.php');
} ?>
<?php

$id= $_GET['id'];
include 'connection.php';
$query="SELECT * FROM ROUTE WHERE ROUTE_ID=".$id;
$stmt=oci_parse($conn,$query);
oci_execute($stmt);
oci_fetch($stmt);

?>
<html>

<form method=POST action=updateroutedb.php>
<input type=hidden name=SID value=<?php echo $id ?> />
<table>
<tr><td><label for=RID>Route ID</label></td>
<td><input type=text name=RID value=<?php echo oci_result($stmt,'ROUTE_ID') ?> disabled /></td></tr>
<input type=hidden name=RID value=<?php echo oci_result($stmt,'ROUTE_ID') ?> />
<br>
<tr><td><label for=bus>BUS</label></td>
<td><select name=BUSID for=bus> <?php 
$bus=oci_result($stmt,'BUSID');
$dept=oci_result($stmt,'DEPART_TIME');

$query="SELECT * FROM BUSES where ROW_STATUS=1";
$stmt2=oci_parse($conn,$query);
oci_execute($stmt2);
while(oci_fetch($stmt2)){
$bus2=oci_result($stmt2,'BUS_ID');
$bustype=oci_result($stmt2,3);
$busmodel=oci_result($stmt2,6);
$busview=$bustype ."-".$busmodel;
if($bus2==$bus){
	echo "<option id=".$bus2." value=".$bus2." selected>".$busview."</option>";
}
else{
	echo "<option id=".$bus2." value=".$bus2.">".$busview."</option>";
}

}


?></select></td></tr>
<br>
<tr><td><label for=Departure>Departure Date</label></td>
<td><input type=text name=Departure value=<?php echo oci_result($stmt,'DEPART_TIME')?> /></td></tr>
<br>
<tr><td>
<input type=submit name=Submit value="Submit" /></td></tr>
<br>
</table>
</form>
<br>
<br>
<?php
$query2="SELECT A.CNAME,B.CNAME FROM ROUTE,CITIES A,CITIES B WHERE ROUTE_ID=".$id." AND ROUTE.STARTCITY=A.CITY_ID AND ROUTE.ENDCITY=B.CITY_ID";
$stmt2=oci_parse($conn,$query2);
oci_execute($stmt2);
oci_fetch($stmt2);

?>
<table border=1px width=80%>
<tr><td><h3>Start City</h3></td><td><h3>Destination City</h3></td></tr>
<tr><td><?php echo oci_result($stmt2,1);?></td><td><?php echo oci_result($stmt2,2);?></td></tr>
</table>
<?php
$query3="SELECT * FROM ROUTE_EDGE WHERE ROUTE_ID=".$id;
$stmt3=oci_parse($conn,$query3);
oci_execute($stmt3);

?>
<h2>Stops for this Route</h2>
<table border=1px width=80%>

<tr><td><h3>FROM</h3></td><td><h3>TO</h3></td><td><h3>FARE</h3></td><td><h3>DURATION</h3></td></tr>
<?php
while(oci_fetch($stmt3)){
$query4="SELECT A.CNAME,B.CNAME,FARE,DURATION FROM EDGES,CITIES A,CITIES B WHERE EDGE_ID=".oci_result($stmt3,3)." AND EDGES.SOURCE_ID=A.CITY_ID AND EDGES.DEST_ID=B.CITY_ID";
$stmt4=oci_parse($conn,$query4);
oci_execute($stmt4);
oci_fetch($stmt4);
echo "<tr><td>".oci_result($stmt4,1)."</td><td>".oci_result($stmt4,2)."</td><td>".oci_result($stmt4,3)."</td><td>".oci_result($stmt4,4)."</td></tr>";
}
?>
</table>

</html>
