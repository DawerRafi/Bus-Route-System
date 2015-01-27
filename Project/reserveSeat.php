<?php

include 'connection.php';
$rid=$_GET['rid'];
$query='SELECT * FROM ROUTE WHERE ROUTE_ID= :rid';
$stid = oci_parse($conn, $query);
$ba = array(':rid' => $rid);
foreach ($ba as $key => $val) {
oci_bind_by_name($stid, $key, $ba[$key]);
}
oci_execute($stid);
//$query="SELECT TFARE,TTIME FROM ROUTE WHERE ROUTE_ID=".$rid."";
//echo $query;
//$stmt=oci_parse($conn,$query);
//oci_execute($stmt);
oci_fetch($stid);
$fare=oci_result($stid,'TFARE');
$time=oci_result($stid,'TTIME');

?>

<html>
<head>
<script  type="text/javascript" src="js/jquery-1.11.1.js"></script>
<script type="text/javascript" language="javascript">
$(document).ready(function() {
$("#submit").click(function() {
	var emailID = document.getElementById("email").value;
   atpos = emailID.indexOf("@");
   dotpos = emailID.lastIndexOf(".");
   
   if( document.getElementById("name").value == "" )
   {
     alert( "Please enter your name" );
     document.getElementById("name").focus() ;
   }
   else if( document.getElementById("CNIC").value == "" || isNaN(document.getElementById("CNIC").value)
   || (document.getElementById("CNIC").value.length !=13))
   {
     alert( "Invalid CNIC." );
     document.getElementById("CNIC").focus() ;
   }
   else if(emailID == "" )
   {
     alert( "Please enter your email." );
     document.getElementById("email").focus() ;
   }
   else if (atpos < 1 || ( dotpos - atpos < 2 )) 
   {
       alert("Please enter correct email ID")
     document.getElementById("email").focus() ;
   }
   else if( document.getElementById("no").value == "" || isNaN(document.getElementById("no").value))
   {
     alert( "Please enter your contact number." );
     document.getElementById("no").focus() ;
   }
   else if( document.getElementById("ticket").value == "" || isNaN(document.getElementById("ticket").value))
   {
     alert( "Please enter the number of tickets." );
     document.getElementById("ticket").focus() ;
   }
   else{
		$.get( 
             "reserve.php",
             {"name":$("#name").val(),"cnic":$("#CNIC").val(),"email":$("#email").val(),"no":$("#no").val(),"ticket":$("#ticket").val(),"fare":$("#fare").val(),"time":$("#time").val(),"rid":$("#rid").val()},
           function(data) {
				alert(data);
				
				
             }
			 );
			 }
	});
	});
</script>
<style>
</style>
</head>
<body>
<h2>Please Enter Your Personal Information</h2>
<table border=1 width=60%>
<tr><td><h3>Name :</h3></td><td><input name=name id=name type=text></td>
</tr>
<tr><td><h3>CNIC :</h3></td><td><input name=CNIC id=CNIC type=numeric align=middle required></td></tr>
<tr><td><h3>Email :</h3></td><td><input name=email id=email type=email align=middle required></td></tr>
<tr><td><h3>Contact No :</h3></td><td><input name=no id=no type=numeric align=middle required></td></tr>
<tr><td><h3>No. of Tickets</h3></td><td><input name=ticket id=ticket type=numeric align=middle required></td></tr>
<input name=fare id=fare type=hidden value= <?php echo $fare;?>>
<input name=time id=time type=hidden value= <?php echo $time;?>>
<input name=rid id=rid type=hidden value= <?php echo $rid;?>>
<tr><td></td><td><input type=button id=submit value="Reserve"></td></tr>
</table>
</body>
</html>
