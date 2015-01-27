<?php

session_start();
if(!isset($_SESSION["username"])){
 header( 'Location: logon.php');
} ?>
<html>
<head>
<script  type="text/javascript" src="../js/jquery-1.11.1.js"></script>
<script type="text/javascript" language="javascript">
$(document).ready(function() {
	$("#button").click(function() {
	var x= document.getElementById("ncity").value;
	if(x== null || x==""){
	alert("Enter City Name");
	}
	else{
		$.get( 
             "addcitydb.php",
             {"city":$("#ncity").val()},
           function(data) {
				alert(data);
             }
			 );
			 }
	});
	
	});
</script>
</head>
<body>



<h1 align=center>ADD NEW CITY</h1>
<h2 align=center>This is sample Admin Page</h2>
<hr>
<br>

<label for=ncity>City</label>
<input name=ncity id="ncity"> 
</input>
<br>
<button type=submit value="Add" id="button">ADD</button> 
</input>

<br>
</body>