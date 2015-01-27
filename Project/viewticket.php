<?php

?>

<html>
<head>
<script  type="text/javascript" language="javascript">
$(document).ready(function() {
$("#submit").click(function() {
	if(document.getElementById("cnic").value==""){
	alert("Please Enter your reservation number.");
	document.getElementById("cnic").focus();
	}
	else if(isNaN(document.getElementById("cnic").value) || document.getElementById("cnic").value<=0){
	alert("Please Enter a valid reservation number.");
	document.getElementById("cnic").focus();
	}
	else{	
		$.get( 
             "viewticketdb.php",
             {"cnic":$("#cnic").val()},
           function(data) {
                $("#maindiv").html(data);
				
             }
			 );
			 }
	});
	});
</script>
</head>
<body>
<div id=content>
<label for=cnic>Enter Your Reservation No :</label>
<input type=numeric name=cnic id=cnic value=""/>
<input type=button id=submit value="Enter" />
</div>
</body>
</html>