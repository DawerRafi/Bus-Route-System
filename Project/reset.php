<?php
session_start();
if(!isset($_SESSION["username"])){
	
 header( 'Location: logon.php');
}
?>

<html>
<head>
<title>Reset Your Password
</title>

<style>
.form1{
text-align:center;
}
</style>
</head>

<body>
<form class=form1 method=POST action=resetauth.php>
<label for=cp>Current Password:</label>
<input type=text name="cp">
<br><br>
<label for=np>New Password: </label>
<input type=password name="np">
<br><br>
<label for=cnp>Confirm New Password: </label>
<input type=password name="cnp">
<br><br>
<input type=submit value=Login >
</form>
</body>

</html>