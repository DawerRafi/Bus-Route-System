<?php
$id=$_GET['id'];
include 'connection.php';
$query="SELECT * FROM RESERVATIONS WHERE RES_ID=".$id;
$stmt=oci_parse($conn,$query);
oci_execute($stmt);
oci_fetch($stmt);
$query2="SELECT A.CNAME,B.CNAME,DEPART_TIME FROM ROUTE,CITIES A,CITIES B WHERE ROUTE.ROUTE_ID=".oci_result($stmt,2)." AND ROUTE.STARTCITY=A.CITY_ID AND ROUTE.ENDCITY=B.CITY_ID";
$stmt2=oci_parse($conn,$query2);
oci_execute($stmt2);
oci_fetch($stmt2);
?>

<html>
<head>
<style>
#mama{
align:center;
border:2px solid;
}
#heading{
text-align:center;
}
#total{
text-align:right;
}
#final{
border:1px solid;
}
</style>
</head>
<body>
<div id=mama>

<h2 id=heading>ABC BUS SERVICES</h2>
<table width=100%>
<tr><td>Date of Reservation :</td><td><?php echo oci_result($stmt,3);?></td><td></td></tr>
<tr><td>Customer Name :</td><td><?php echo oci_result($stmt,5);?></td><td></td></tr>
<tr><td>CNIC :</td><td><?php echo oci_result($stmt,6);?></td><td></td></tr>
<tr><td>Contact No :</td><td><?php echo oci_result($stmt,8);?></td><td></td></tr>
</table>
<table width=100% border=1px >
<tr><td><h3>From City</h3></td><td><h3>To City</h3></td><td><h3>Time of Departure</h3></td><td><h3>Fare</h3></td></tr>
<tr><td><?php echo oci_result($stmt2,1)?> </td><td><?php echo oci_result($stmt2,2)?> </td><td><?php echo oci_result($stmt2,3)?> </td><td><?php echo oci_result($stmt,9)?> </td>
</table>
<table width=100% >
<tr><td>No. of Tickets :</td><td id=total><?php echo oci_result($stmt,4)?></td></tr>
<tr id=final><td><h2>Total :</h2></td><td id=total><?php 
$no=oci_result($stmt,4);
$fare=oci_result($stmt,9);
$total=($fare*$no);
echo $total ?></td></tr>

</table>
</div>
</body>
</html>