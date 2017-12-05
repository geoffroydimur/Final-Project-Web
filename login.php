<?php
require_once("db.php");
session_start();
$conn = db_connect("localhost", "root", "root", "Credentials");
if (isset($_POST['mail'])){
	insert_user($conn, $_POST['firstname'], $_POST['lastname'], $_POST['mail'], $_POST['password']);
}

if (isset($_POST['logout'])){
	session_destroy();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
</head>
<body>
	<form action="modify.php" method="post">
		<fieldset>
			<legend>Login</legend>
			<label for="mail">Email Address</label>
			<input type="email" name="mail" id="mail" placeholder="geoffroy.dimur@whatever.com" required="required">
			<br>
			<label for="password">Password</label>
			<input type="password" name="password" id="password" required="required" placeholder="Password">
			<br>
			<button type="submit" value="submit">Login</button>
			<button type="reset" value="reset">Reset</button>
		</fieldset>	
	</form>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script>
		var email = document.getElementById("password")
		var confirm_password = document.getElementById("confirm_password");

		function validatePassword(){
		  if(password.value != confirm_password.value) {
		    confirm_password.setCustomValidity("Passwords Don't Match");
		  } 
		  else {
		    confirm_password.setCustomValidity('');
		  }
		}
		password.onchange = validatePassword;
		confirm_password.onkeyup = validatePassword;
	</script>

	<form action="registration.php">
		<button type="submit" value="register">Register</button>
	</form>
</body>
</html>
