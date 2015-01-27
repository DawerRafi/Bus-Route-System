<?php

session_start();
if(isset($_SESSION["username"])){
header( 'Location: home.php' );
}
?>

<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>Logon
</title>

 <link rel="stylesheet" href="assets/css/bootstrap.min.css">
<style>
.form1{
text-align:center;
}
</style>
</head>


<body>
<div class=container>
<form class="col-md-12" method=POST action=auth.php>

    <div class="form-group">
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
</body>



</html>