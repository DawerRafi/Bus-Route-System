<html>
<head>

<link rel="stylesheet" type="text/css" href="css/TableCSSCode.css">
<script  type="text/javascript" src="js/jquery-1.11.1.js"></script>
<script type="text/javascript" src="js/script.js"></script> 
  <script type="text/javascript" language="javascript">
 $(document).ready(function() {
    $("#adds").click(function(event){
		var x= document.getElementById("fare").value;
		var y = document.getElementById("duration").value;
		if(x==null || x==""){
			alert("Please Enter the Fare");
		}
		else if(y==null || y==""){
			alert("Please enter the Duration");
		}
		else{
          $.get( 
             "jquery/insertstop.php",
             {"to":$("#to").children(":selected").attr("id"), "from":$("#from").children(":selected").attr("id"), "duration":$("#duration").val(), "fare":$("#fare").val()},
           function(data) {
               // $("#stage").html(data);
				alert(data);
				
             }

          );
		  }
      });
	 
   });
   </script>

<style>
#maincontainer{
width:100%;
}
#disstops{
 position: absolute;
    left: 10px;
    width: 60%;
}
#addstops{
 border: 2px solid;
 position: absolute;
    right: 0px;
    width: 300px;
	
    margin-left: auto;
    margin-right: auto;
}
</style>
<title>BUS SCHEDULES</title>
<?php

function populateDropDown(){

include 'connection.php';
//echo "Hello";
	$query="SELECT * FROM CITIES";
$stmt = oci_parse($conn,$query);
oci_execute($stmt);
while(oci_fetch($stmt)){
 $id=oci_result($stmt,'CITY_ID');
 $name=oci_result($stmt,'CNAME');
 echo "<option id=".$id." value=".$id.">".$name."</option>";
}
}
function populateDropDownEdges(){

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
}
?>

</head>

<body>
<h1 align=center>ENTER NEW BUS SCHEDULE</h1>
<h2 align=center>This is sample Admin Page</h2>
<hr>
<br>
<div id=maincontainer>

<div id=disstops>
<form method=POST action=insertRoute.php>
<table >
<tr>
<td> Source City</td>
<td><select name=src><?php populateDropDown() ?></select></td>
</tr>

<tr>
	<td>Destination City</td>
	<td><select name=des><?php populateDropDown() ?></select></td>
</tr>

<tr>
	<td>Departure Time</td>
	<td><input type=date name=deptime required></td>
</tr>

</table>
<br>
<div id=stops>
 Select Stops
<br>
<input type=hidden value="1" id=numberofstops name=numberofstops>
<select name="stop1"><?php populateDropDownEdges() ?>
</select>

<label for="From 1">From</label>
<input type=text value="" name="From 1">


<label for="To 1">To</label>
<input type=text value="" name="To 1">


<label for="dur 1">Duration</label>
<input type=text value="" name="dur 1">
<br>

</div>
<br>
<input type=button value="Add Another Stop" OnClick=addFields()> 
<input type=submit value=Save>
		<input type=reset value=Clear></td>
</form >
</div>
<div id=addstops>
<h2>Add new Stop</h2>
<br>

<label for=From>From</label>
<select name=From id="from"> <?php populateDropDown() ?>
</select>
<br>

<label for=To>To</label>
<select name=To id="to"> <?php populateDropDown() ?>
</select>
<br>


<label for=duration>Duration</label>
<input type=text value="" id="duration" />
<br>

<label for=fare>Fare</label>
<input type=numeric value="" id="fare" />
<br>
<input type="button" value="Add" id="adds" />

<div id="stage">

</div>
</div>
</div>

<br>
<br>
</body>

</html>