<?php
include 'connection.php';
//echo "Hello";
	$query="select edge_id,fare,duration,A.CNAME source,B.CNAME dest from edges,cities A,cities B
where edges.source_id=A.CITY_ID AND edges.dest_id=B.CITY_ID";
$stmt = oci_parse($conn,$query);
oci_execute($stmt);
while(oci_fetch($stmt)){
 $id=oci_result($stmt,1);
 $duration = oci_result($stmt,3);
 $source = oci_result($stmt,4);
 $dest = oci_result($stmt,5);
 echo "<option id=".$id." value=".$id.">".$source ." - ".$dest."</option>";
}
?>