<html>
<head>

</head>

<body>

<h1 align=center>CITIES</h1>
<h2 align=center>This is sample Admin Page</h2>
<hr>
<br>
<br>

<table border=1 width=60%>
<tr><th>CITY ID</th><th>NAME</th><th>Update</th></tr>
<?php
include 'connection.php';
$query="SELECT * FROM CITIES order by CNAME";
$stmt=oci_parse($conn,$query);
oci_execute($stmt);
 while (oci_fetch($stmt)) {
    echo  "<tr><td>".oci_result($stmt, "CITY_ID"). "</td>";
	echo      "<td>". oci_result($stmt, "CNAME") ."</td>";
	echo      "<td><a href=update.php?flag=city&type=up&id=".oci_result($stmt, "CITY_ID").">Update</a></td>";
	echo      "<td><a href=update.php?flag=city&type=del&id=".oci_result($stmt, "CITY_ID").">Delete</a></td>";
  }
?>
</body>
</html>