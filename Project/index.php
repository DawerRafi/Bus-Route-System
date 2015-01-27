<html>
<head>
<title> ABC BUS SERVICES
</title>
<script  type="text/javascript" src="js/jquery-1.11.1.js"></script>
<style>
img {
z-index:-1;
}
body{

	background-color: #FFD633; 
}
#main {
	width:100%;
}
#content {
float:left;
display:inline;
width:70%;
}
#navigation{
	width:100%;
	height:35px;
	text-align:center;
	padding:0px;
	margin:0px;
	background-color: #333; 
}
#navigation ul {
	margin-top:0px;
	display: inline-block;
	height:100%;
	
	background-color: #333; 
}
#header { 
	min-width: 800px; 
	width:100%;
	height: 100px; 
	background-color: #FFD633; 
} 
#nav {  
	font-family:"Century Gothic", "HelveticaNeueLT Pro 45 Lt", sans-serif;
}
#nav li { 
	list-style: none; 
	float: left; 
	width: 200px;
	text-height: max-size; 
	text-align: center;
} 
#nav li a { 
	color: white; 
	text-decoration: none; 
	display: block; 
	z-index:2;
} 
#nav li a:hover { 
	background-color: #066; 
	height:100%;
} 
#nav li ul { 
	position: relative;  
	left:-40px;
	display: none; 
} 
#nav li:hover ul { 
	display: block; 
	z-index:2;
} 
#nav li ul li { 
	float: none; 
	display: inline; 
	position:relative;
	top:30px;
	z-index:2;
}
#nav li ul li a { 
	width: 218px; 
	position: relative;
	border-left: 1px solid black; 
	border-right: 1px solid black; 
	border-bottom: 1px solid black; 
	background: #333; 
	color: #fff; 
	z-index:2;
}
#nav li ul li a:hover { 
	background: #066; 
	color: #000; 
	z-index:2;
}
#bodydiv{
margin-top:60px;
}
</style>
<script type="text/javascript" language="javascript">
$(document).ready(function() {
	
		$("#home").click(function() {
		$.get( 
             "slider.php",
             {},
           function(data) {
                $("#maindiv").html(data);
				
             }
			 );
	});
	
	$("#reservations").click(function() {
		$.get( 
             "reservations.php",
             {},
           function(data) {
                $("#maindiv").html(data);
				
             }
			 );
	});
	
	$("#schedule").click(function() {
		$.get( 
             "viewticket.php",
             {},
           function(data) {
                $("#maindiv").html(data);
				
             }
			 );
	});
	$("#contact").click(function() {
		$.get( 
             "viewbus.php",
             {},
           function(data) {
                $("#maindiv").html(data);
				
             }
			 );
	});
	
	
function changepage() {
		$.get( 
             "reservations.php",
             {"src":$("#src").val(),"depart":$("#depart").val(),"dest":$("#dest").val()},
           function(data) {
				$("#maindiv").html(data);	
             }
			 );
	
}
	
});
</script>
</head>
<body>
<div id=header>
</div>
<div id=main>
		<div id=navigation>
		<ul id="nav">
      <li class="tutorials"><a href="#" id="home">Home</a>
	  </li>
      <li class="tutorials"><a href="#" id="reservations">Reservations</a>
      </li>
      <li class="tutorials"><a href="#" id="schedule">View Reservation</a>
	  </li>
      <li class="tutorials"><a href="#" id="contact">Contact Us</a>
        
      </li>
      <li class="tutorials"><a href="admin/logon.php" id="login">Admin Panel</a></li>
    </ul><!-- nav --> 
		</div>
		<br>
		<br>
		<div id="maindiv" align="center">
		<?php include 'slider.php';?>
		</div>
</div>
</body>
</html>