<?php
$flag = $_GET['flag'];
$type = $_GET['type'];
$id = $_GET['id'];
include 'connection.php';
if($flag == "bus"){
	if($type=="del"){
$query  = "DELETE BUSES WHERE BUS_ID=".$id;
$stmt = oci_parse($conn, $query);
oci_execute($stmt);
oci_commit($stmt);
header ('Location: home.php' ) ;
}
	else{
$query  = "select * from BUSES WHERE BUS_ID=".$id;
$stmt = oci_parse($conn, $query);
oci_execute($stmt);
oci_fetch($stmt);
	echo "<table>";
	echo "<form method=POST action=updatebus.php onsubmit=return confirm('Do you really want to submit the form?');> <tr> <td>Capacity</td>";
	echo "<td><input type=text name=capacity value=".oci_result($stmt,"CAPACITY")."></td>
</tr>";
	echo "<tr><td>Location</td>";
	echo "<td><input type=text name=type value=".oci_result($stmt,"TYPE")."></td>
</tr>";
	echo "<tr><td><input type=hidden name=id value=".$id." ></td></tr>";
	echo "<tr><td></td><td><input type=submit value=SAVE></td>
</tr>
</table>
</form>";
	}
}
	?>
	
	<?php
if($flag =="city"){
	if($type=="del"){
	$query="DELETE CITIES WHERE CITY_ID=".$id;
	$stmt = oci_parse($conn,$query);
	oci_execute($stmt);
	oci_commit($stmt);
	header ('Location: home.php' ) ;
	}
	else{
	$query  = "select * from CITIES WHERE CITY_ID=".$id;
	$stmt = oci_parse($conn, $query);
	oci_execute($stmt);
	oci_fetch($stmt);
	echo "<table>";
	echo "<form method=POST action=updatecity.php onsubmit=return confirm('Do you really want to submit the form?');> <tr> <td>CITY</td>";
	echo "<td><input type=text name=city value=".oci_result($stmt,"CNAME")."></td>
</tr>";
	echo "<tr><td><input type=hidden name=id value=".$id." ></td></tr>";
	echo "<tr><td></td><td><input type=submit value=SAVE></td>
</tr>
</table>
</form>";
	}
}
?>