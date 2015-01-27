

<html>
<head>
<script type="text/javascript" language="javascript">
$(document).ready(function() {
	
		$(".ticket").click(function() {
		var n = $(this).attr("n");
		$.get( 
             "ticket.php",
             {"id":n},
           function(data) {
                  $("#main").html(data);
				
             }
			 );
	});
	
		$(".confirm").click(function() {
		var n = $(this).attr("n");
		$.get( 
             "confirm.php",
             {"id":n},
           function(data) {
							window.location.reload();
				
             }
			 );
	});
	
	});
</script>
</head>
<body>
<div id=main>
<table border=1px width=80%>
<tr><td>Customer Name</td><td>Reservation Date</td><td>From City</td><td>To City</td><td>Total Fare</td><td>No of Tickets</td><td>Status</td></tr>
<?php

session_start();
if(!isset($_SESSION["username"])){
 header( 'Location: logon.php');
} ?>
<?php
include 'connection.php';
$query="SELECT * FROM RESERVATIONS WHERE ROW_STATUS=1";
	$stmt=oci_parse($conn,$query);
	oci_execute($stmt);
	
	while(oci_fetch($stmt)){
	$id=oci_result($stmt,1);
	$rid=oci_result($stmt,2);
	$query2="SELECT A.CNAME,B.CNAME FROM ROUTE,CITIES A, CITIES B,STATUS WHERE ROUTE.STARTCITY=A.CITY_ID AND ROUTE.ENDCITY=B.CITY_ID 
	AND ROUTE_ID=".$rid;
	$stmt2=oci_parse($conn,$query2);
	oci_execute($stmt2);
	oci_fetch($stmt2);
	$query3="SELECT NAME FROM RESERVATIONS,STATUS WHERE RESERVATIONS.RES_ID=".$id." AND RESERVATIONS.STATUS=STATUS.STATUS_ID";
	$stmt3=oci_parse($conn,$query3);
	oci_execute($stmt3);
	oci_fetch($stmt3);
		echo "<tr><td>".oci_result($stmt,5)."</td><td>".oci_result($stmt,3)."</td><td>".oci_result($stmt2,1)."</td><td>".oci_result($stmt2,2)."</td>
		<td>".oci_result($stmt,9)."</td><td>".oci_result($stmt,4)."</td><td>".oci_result($stmt3,1)."</td>";
		if(oci_result($stmt,12)==1){
		echo "<td><a href=\"#\" class=\"confirm\" n=".oci_result($stmt,1).">Confirm Reservation</a></td></tr>";
		}
		else{
		echo "<td><a href=\"#\" class=\"ticket\" n=".oci_result($stmt,1).">View Ticket</a></td></tr>";
		}
	}
	
?>	
</table>
</div>
</body>
</html>