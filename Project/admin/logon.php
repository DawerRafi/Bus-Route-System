<?php

session_start();
if(isset($_SESSION["username"])){
header( 'Location: home.php' );
}
?>

<html>
<head>
<title> ABC BUS SERVICES
</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<script  type="text/javascript" src="../js/jquery-1.11.1.js"></script>
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
	width: 220px; 
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

</head>
<body>
<div id=header>
</div>
<div id=main>
		<div id=navigation>
		<ul id="nav">
      <li class="tutorials"><a href="../index.php" id="home">Home</a>
	  </li>
      <li class="tutorials"><a href="../index.php" id="reservations">Reservations</a>
      </li>
      <li class="tutorials"><a href="../index.php" id="schedule">View Reservation</a>
	  </li>
      <li class="tutorials"><a href="../index.php" id="contact">Contact Us</a>
        
      </li>
      <li class="tutorials"><a href="#" id="login">Admin Panel</a></li>
    </ul><!-- nav --> 
		</div>
		<br>
		<br>
		<div id="maindiv" align="center">
		
</div>

<h1 align=center>ADMIN LOGIN </h1>
<hr>
<br>


<br>
<div class=container>
<form class="col-md-12" method=POST action=auth.php>

    <div class="form-group" >
        <input type="text" class="form-control input-lg" placeholder="Username" name="user" required>
    </div>
    <div class="form-group">
        <input type="password" class="form-control input-lg" placeholder="Password" name="pass" required>
    </div>
    <div class="form-group">
        <button type=submit class="btn btn-primary btn-lg btn-block">Submit</button>
        <span><a href="#">Need help?</a></span>
        <span class="pull-right"><a href="#">New Registration</a></span>
    </div>
</form>
</div>
</div>
</body>



</html>