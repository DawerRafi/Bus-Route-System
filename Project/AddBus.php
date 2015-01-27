<html>
<head>
<script  type="text/javascript" src="js/jquery-1.11.1.js"></script>
<script type="text/javascript" language="javascript">
$(document).ready(function() {
	$("#button").click(function() {
    var x = document.getElementById("capacity").value;
	var y = document.getElementById("type").value;
    if (x == null || x == "") {
        alert("Capacity must be defined Eg. 40,30,25");
    }
	else if (y == null || y == "") {
        alert("Bus Type must be defined Eg. Luxury,Economy,etc");
    }
	else{
		$.get( 
             "addbusdb.php",
             {"capacity":$("#capacity").val(),"type":$("#type").val()},
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



<h1 align=center>ADD NEW BUS</h1>
<h2 align=center>This is sample Admin Page</h2>
<hr>
<br>
<br>
<label for=capacity>Capacity</label>
<input name=capacity type=numeric id="capacity" required> 
</input><br>
<label for=type>Bus Type</label>
<input name=type id="type" required> 
</input><br>
<button type=submit value="Add" id="button"> ADD </button>
</input>

<br>
</body>