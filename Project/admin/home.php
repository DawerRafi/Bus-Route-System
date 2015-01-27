<?php

session_start();
if(!isset($_SESSION["username"])){
 header( 'Location: logon.php');
}
else{?>
<html>
<head>
<style>
#header { 
	min-width: 800px; 
	width:100%;
	height: 50px; 
	position:fixed;
	left:0px;
	top:0px;
	background-color: #333; 
} 
#nav {  
	width: 100%; 
	margin-left:auto;
	margin-right:auto;
	background-color: #333; 
	font-family:"Century Gothic", "HelveticaNeueLT Pro 45 Lt", sans-serif; 
	float: left; 
}
#nav li { 
	list-style: none; 
	float: left; 
	width: 220px; 
	height: 30px; 
	line-height: 30px; 
	text-align: center;
} 
#nav li a { 
	color: white; 
	text-decoration: none; 
	display: block; 
} 
#nav li a:hover { 
	background-color: #066; 
} 
#home .home a, #home .home a:hover,
#tutorials .tutorials a, #tutorials .tutorials a:hover,
#about .about a, #about .about a:hover,
#contact .contact a, #contact .contact a:hover,
#news .news a, #news .news a:hover {
 	background-color: #FFF; 
	color: #000;
	cursor: default;  
} 		
#nav li ul { 
	position: relative;  
	left:-40px;
	display: none; 
} 
#nav li:hover ul { 
	display: block; 
} 
#nav li ul li { 
	float: none; 
	display: inline; 
}
#nav li ul li a { 
	width: 218px; 
	position: relative; 
	border-left: 1px solid black; 
	border-right: 1px solid black; 
	border-bottom: 1px solid black; 
	background: #333; 
	color: #fff; 
}
#nav li ul li a:hover { 
	background: #066; 
	color: #000; 
}
#bodydiv{
margin-top:60px;
}
</style>
<script  type="text/javascript" src="../js/jquery-1.11.1.js"></script>

<style type="text/css">
body{
	background-color: #FFD633;
	
}
#mainform{
	float:right;
}

</style>
<script type="text/javascript" language="javascript">
$(document).ready(function() {
	$(".route").click(function() {
		$.get( 
             "indexes.php",
             {},
           function(data) {
                $("#maindiv").html(data);
				
             }
			 );
	});
	$(".reservations").click(function() {
		$.get( 
             "viewreservation.php",
             {},
           function(data) {
                $("#maindiv").html(data);
				
             }
			 );
	});
		$(".shroute").click(function() {
		$.get( 
             "showroute.php",
             {},
           function(data) {
                $("#maindiv").html(data);
				
             }
			 );
	});
	
	$(".addbus").click(function() {
		$.get( 
             "AddBus.php",
             {},
           function(data) {
                $("#maindiv").html(data);
				
             }
			 );
	});
	
	$(".addcity").click(function() {
		$.get( 
             "AddCity.php",
             {},
           function(data) {
                $("#maindiv").html(data);
				
             }
			 );
	});
	$("#viewbus").click(function() {
		$.get( 
             "viewbus.php",
             {},
           function(data) {
                $("#maindiv").html(data);
				
             }
			 );
	});
	$("#viewcity").click(function() {
		$.get( 
             "viewcity.php",
             {},
           function(data) {
                $("#maindiv").html(data);
				
             }
			 );
	});
});
</script>
</head>
<body>

<div id="header">

    <ul id="nav">
		<center>
      <li class="home"><a href="#" class="shroute">Manage Routes</a>
	  <ul>
          <li><a href="#" class="shroute">Show All Routes</a></li>
          <li><a href="#" class="route">Add New Route</a></li>
        </ul>
	  
	  </li>
      <li class="tutorials"><a href="#" class="addbus">Manage Buses</a>
        <ul>
          <li><a href="#" class="addbus">Add New Bus</a></li>
          <li><a href="#">Update Bus</a></li>
          <li><a href="#" id="viewbus">View All Buses</a></li>
        </ul>
      </li>
      <li ><a href="#" class="reservations">View Reservations</a></li>
      <li ><a href="#" class="addcity">Manage Cities</a>
        <ul>
          <li><a href="#" class="addcity">Add New City</a></li>
          <li><a href="#">Delete City</a></li>
          <li><a href="#" id="viewcity">View All Cities</a></li>
        </ul>
      </li>
      <li class="contact"><a href="#">Contact</a></li>
	  	</center>
    </ul><!-- nav --> 

  </div><!-- header -->     
  
<div id="bodydiv">
<?php
echo '<br>';
echo 'Welcome '.$_SESSION["username"];
}
?>

<form method=GET action=logout.php id=mainform>
<input type=submit value="Logout" align="right"></form>

<div id="maindiv">
	<?php include 'bar.php'; ?>
</div>

</div>
</body>
</html>