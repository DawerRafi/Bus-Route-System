<html>
<head>
<style>
#res{
width:50%;
height:200px;
border: 2px solid;
    border-radius: 25px;
box-shadow: 5px 5px 5px #888888;
background-color:#00B8E6;
}
</style>
</head>
<head>
<script  type="text/javascript" src="js/jquery-1.11.1.js"></script>
<script type="text/javascript" language="javascript">
	$(document).ready(function() {
$("#viewAll").click(function() {
	var date=document.getElementById("depart").value;
   if( date == "" )
   {
     alert( "Please provide the Date" );
     document.getElementById("depart").focus() ;
   }
   else if (!date.match(/\d\d\d\d\-\d\d\-\d\d/)) {
		alert("Please enter valid date");
     document.getElementById("depart").focus() ;
  }
   else if( document.getElementById("src").value == "" )
   {
     alert( "Please provide your Source City" );
     document.getElementById("src").focus() ;
   }
   else if( document.getElementById("dest").value == "" )
   {
     alert( "Please provide your Destination." );
     document.getElementById("dest").focus() ;
   }
   else{
		$.get( 
             "reservations.php",
             {"src":$("#src").val(),"depart":$("#depart").val(),"dest":$("#dest").val()},
           function(data) {
				$("#content").html(data);
				
				
             }
			 );
			 }
	});
	
	$(".reserve").click(function() {
		var n = $(this).attr("n");
		$.get( 
             "reserveSeat.php",
             {"rid":n},
           function(data) {
				$("#content").html(data);
				
				
             }
			 );
	});
});
</script>
</head>
<body>
<div id=content>
<?php
if(!empty($_GET['depart']) && !empty($_GET['src']) && !empty($_GET['dest'])){
	$depart=$_GET['depart'];
	$src=$_GET['src'];
	$dest=$_GET['dest'];
	
include 'connection.php';
echo "<table border=1 width=900px>";
	//<form method=GET action=\"ReserveSeat.php\">
		echo "<tr><td><h3>From</h3></td><td><h3>To</h3></td><td><h3>Departure Time</h3></td><td><h3>Duration</h3></td><td><h3>Bus Type</h3></td><td><h3>Fare</h3></td><td><h3>Reserve Ticket</h3></td></tr>
		";
$date=date( "d-M-y",strtotime($depart));
$date= strtoupper($date);


$query="SELECT * FROM ROUTE WHERE ROW_STATUS=1 AND STARTCITY=".$src." AND ENDCITY=".$dest." AND to_char(Depart_Time,'dd-MON-yy')='".$date."'";	

$stmt=oci_parse($conn,$query);
oci_execute($stmt);


$found=0;
while(oci_fetch($stmt)){
$found=1;
$counter=1;
$query2="SELECT TYPE FROM BUSES WHERE BUS_ID=".oci_result($stmt,'BUSID');	
$stmt2=oci_parse($conn,$query2);
oci_execute($stmt2);
oci_fetch($stmt2);

$query3="SELECT A.CNAME,B.CNAME FROM CITIES A,CITIES B WHERE A.CITY_ID=".$src." AND B.CITY_ID=".$dest;	
$stmt3=oci_parse($conn,$query3);
oci_execute($stmt3);
oci_fetch($stmt3);
	$rid=oci_result($stmt,'ROUTE_ID');
	echo "<tr><td>".oci_result($stmt3,1)."</td><td>".oci_result($stmt3,2)."</td><td>".oci_result($stmt,'DEPART_TIME')."</td>
	<td>".oci_result($stmt,'TTIME')." Hrs</td><td>".oci_result($stmt2,'TYPE')."</td><td>Rs. ".oci_result($stmt,'TFARE')."</td>
	<td><a href=\"#\" class=reserve n=".$rid."> Reserve </a></td>
	</tr><input type=hidden id=RID".$counter." value=".$rid.">";
	$counter=$counter+1;
}
if($found==0){
	echo 'No such bus route available between the required cities or given date.';
}
echo //</form>
	"</table>";

}
else{
echo 
"<div align=center id=res>"

//<form method=GET action=\"reservations.php\">
."<table>
<tr></tr>
<br>
<tr><td>Date of Departure :</td><td><input type=date name=depart id=depart placeholder=\"YYYY-MM-DD\"></td></tr>
<br>
<tr><td>From City :</td><td><select name=src id=src>
<?php
";
include 'connection.php';
//echo "Hello";
	$query="SELECT * FROM CITIES WHERE ROW_STATUS=1";
$stmt = oci_parse($conn,$query);
oci_execute($stmt);
while(oci_fetch($stmt)){
 $id=oci_result($stmt,'CITY_ID');
 $name=oci_result($stmt,'CNAME');
 echo "<option id=".$id." value=".$id.">".$name."</option>";
}
echo 
"</select></td></tr>
<br>
<tr><td>To City :</td><td><select name=dest id=dest>";

include 'connection.php';
//echo "Hello";
	$query="SELECT * FROM CITIES WHERE ROW_STATUS=1";
$stmt = oci_parse($conn,$query);
oci_execute($stmt);
while(oci_fetch($stmt)){
 $id=oci_result($stmt,'CITY_ID');
 $name=oci_result($stmt,'CNAME');
 echo "<option id=".$id." value=".$id.">".$name."</option>";
}
echo
"</select></td></tr>
<tr></tr>
<tr></tr>
<tr><td></td><td><input type=\"submit\" value=\"Search\" id=\"viewAll\" ></td></tr>

</table>"
//</form>
."</div>";
}
?>
</div>
</body>
</html>