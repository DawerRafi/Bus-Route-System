<?php
$rid=$_GET['rid'];
$ticket=$_GET['ticket'];
$name=$_GET['name'];
$cnic=$_GET['cnic'];
$email=$_GET['email'];
$no=$_GET['no'];
$fare=$_GET['fare'];
$time=$_GET['time'];

include 'connection.php';
$query="SELECT MAX(RES_ID) FROM RESERVATIONS";
$stmt=oci_parse($conn,$query);
oci_execute($stmt);
oci_fetch($stmt);
$id=oci_result($stmt,1);
$id=$id+1;

$query="INSERT INTO RESERVATIONS (RES_ID,ROUTE_ID,NO_TICKETS,CUST_NAME,CNIC,EMAIL,CONTACTNO,FARE,TIME,ROW_STATUS,STATUS)
VALUES(".$id.",".$rid.",".$ticket.",'".$name."',".$cnic.",'".$email."',".$no.",".$fare.",'".$time."',1,01)";
$stmt=oci_parse($conn,$query);
$bool=oci_execute($stmt);
if($bool){
oci_commit($conn);
echo "Ticket(s) successfully reserved. Your reservation ID is :".$id." .Please save this for Future Reference";
}
else{
echo 'Transaction Unsuccessful. Please try again or contact the administrator.';
}
?>