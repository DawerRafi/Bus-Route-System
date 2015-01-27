<?php

session_start();
if(!isset($_SESSION["username"])){
 header( 'Location: logon.php');
} ?>
<html>
<head>
<script type="text/javascript" language="javascript">
$(document).ready(function() {
	
		$("#confirm").click(function() {
		var n = $(this).attr("n");
		$.get( 
             "updateroute.php",
             {"id":n},
           function(data) {
							$("#m").html(data);
				
             }
			 );
	});
	
	});
</script>
<style>
#m{
	float:left;
	width:100%;
}
</style>
</head>
<body>


<div id=m>
<h1 align=center>ROUTES</h1>
<h2 align=center>This is sample Admin Page</h2>
<hr>
<br>
<table border=1 width=80%>
<tr><th>ROUTE ID</th><th>BUS ID</th><th>Departure Time</th><th>Start City</th><th>End City</th><th>Update</th></tr>
<?php
include 'connection.php';
$query="SELECT ROUTE.ROUTE_ID,BUSES.TYPE,ROUTE.DEPART_TIME,A.CNAME,B.CNAME FROM ROUTE,CITIES A, CITIES B,BUSES WHERE ROUTE.ROW_STATUS=1 AND A.CITY_ID=ROUTE.STARTCITY AND B.CITY_ID=ROUTE.ENDCITY AND ROUTE.BUSID=BUSES.BUS_ID";
$stmt=oci_parse($conn,$query);
oci_execute($stmt);
 while (oci_fetch($stmt)) {
    echo  "<tr><td>".oci_result($stmt, "ROUTE_ID"). "</td>";
	echo      "<td>". oci_result($stmt, "TYPE") ."</td>";
	echo      "<td>". oci_result($stmt, "DEPART_TIME") ."</td>";
	echo      "<td>". oci_result($stmt, 4) ."</td>";
	echo      "<td>". oci_result($stmt, 5) ."</td>";
	echo      "<td><a href=\"#\" id=confirm n=".oci_result($stmt, "ROUTE_ID").">Update</a></td>";
  }
?>
</table>
</div>
</body>
</html>