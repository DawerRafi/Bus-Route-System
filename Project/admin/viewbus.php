<?php

session_start();
if(!isset($_SESSION["username"])){
 header( 'Location: logon.php');
} ?>
<html>
<head>

</head>

<body>

<h1 align=center>BUSES</h1>
<h2 align=center>This is sample Admin Page</h2>
<hr>
<br>
<br>

<table border=1 width=60%>
<tr><th>BUS ID</th><th>CAPACITY</th><th>BUS TYPE</th><th>BUS STATUS </th><th>MODEL</th><th>Update</th><th>Delete</th></tr>
<?php
include 'connection.php';
$query="SELECT * FROM BUSES WHERE ROW_STATUS=1";
$stmt=oci_parse($conn,$query);
oci_execute($stmt);
 while (oci_fetch($stmt)) {
    echo  "<tr><td>".oci_result($stmt, "BUS_ID"). "</td>";
	echo      "<td>". oci_result($stmt, "CAPACITY") ."</td>";
	echo      "<td>". oci_result($stmt, "TYPE") ."</td>";
	echo      "<td>". oci_result($stmt, "BUS_STATUS") ."</td>";
	echo      "<td>". oci_result($stmt, "MODEL") ."</td>";
	echo      "<td><a href=update.php?flag=bus&type=up&id=".oci_result($stmt, "BUS_ID").">Update</a></td>";
	echo      "<td><a href=update.php?flag=bus&type=del&id=".oci_result($stmt, "BUS_ID").">Delete</a></td>";
  }
?>
</body>
</html>