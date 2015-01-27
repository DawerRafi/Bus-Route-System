<?php

session_start();
if(!isset($_SESSION["username"])){
 header( 'Location: logon.php');
} ?>
<?php
$flag = $_GET['flag'];
$type = $_GET['type'];
$id = $_GET['id'];
include 'connection.php';
if($flag == "bus"){
	if($type=="del"){
$query  = "UPDATE BUSES SET ROW_STATUS=0 WHERE BUS_ID=".$id;
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
	echo "<form method=POST action=updatebus.php onsubmit=";
	echo "\"return confirm('Are you sure you want to update the bus?');\"";
	echo "> <tr> <td>Capacity</td>";
	echo "<td><input type=text name=\"capacity\" value=".oci_result($stmt,"CAPACITY")."></td>
</tr>";
	echo "<tr><td>Location</td>";
	echo "<td><input type=text name=\"type\" value=".oci_result($stmt,"TYPE")."></td>
</tr>";
	echo "<tr><td><input type=hidden name=\"id\" value=".$id." ></td></tr>";
	echo "<tr><td><input type=submit value=SAVE></td>
	<td><a href=home.php  style=\"font-size:15px;text-align:center;font-style:italic\">  Back </a></td>
</tr>
</form>
</table>
";
	}
}
	?>
	
	<?php
if($flag =="city"){
	if($type=="del"){
	$query="UPDATE CITIES SET ROW_STATUS=0 WHERE CITY_ID=".$id;
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
	echo "<form method=POST action=updatecity.php onsubmit=\"return confirm('Are you sure you want to update the city?');\"> <tr> <td>CITY</td>";
	echo "<td><input type=text name=\"city\" value=".oci_result($stmt,"CNAME")."></td>
</tr>";
	echo "<tr><td><input type=hidden name=\"id\" value=".$id." ></td></tr>";
	echo "<tr><td><input type=submit value=SAVE></td>
	<td><a href=home.php  style=\"font-size:15px;text-align:center;font-style:italic\"> Back </a></td></tr>
</form>
</table>
";
	}
}
?>