<!doctype html>
<?php
require_once("db.php");

$conn = db_connect("localhost", "root", "root", "Credentials");
session_start();
if (isset($_POST['modification'])){
	update_user($conn, $_SESSION['user']->id, $_POST['firstname'],
	$_POST['lastname'], $_POST['mail'], $_POST['password']);
}
?>
<html>
<head>
	<title>Modification Page</title>
	<meta charset="utf-8">
</head>
<body>
	<?php
	if (isset($_POST['mail'])){
		
		$id = user_auth($conn, $_POST['mail'], $_POST['password']);
		
		if (isset($id)){

			$user = User::create_user($conn, $id);
			$_SESSION['user'] = $user;

			echo "<p>Welcome ".$_SESSION['user']->firstname." !</p>";
			?>

			<form action="modify.php" method="post">
				<fieldset>
					<legend>Modify Credentials</legend>
					<p>
						<label for="firstname">First Name</label>
						<input type="text" name="firstname" id="firstname" value="<?php echo $_SESSION['user']->firstname; ?>" required="required">
					</p>
					<p>
						<label for="lastname">Last Name</label>
						<input type="text" name="lastname" id="lastname" value="<?php echo $_SESSION['user']->lastname; ?>" required="required">
					</p>
					<p>
						<label for="mail">Email Address</label>
						<input type="email" name="mail" id="mail" value="<?php echo $_SESSION['user']->email; ?>" required="required">
					</p>
					<p>
						<label for="password">Password</label>
						<input type="password" name="password" id="password" required="required">
					</p>
					<p>
						<label for="confirm_password">Confirm Password</label>
						<input type="password" name="confirm_password" id="confirm_password" required="required">
					</p>
					<p>
						<input type="hidden" name="modification" value="yes">
						<button type="submit" value="Submit">Submit</button>
						<button type="reset" value="Reset">Reset</button>
					</p>
				</fieldset>		
			</form>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
			<script>
				var password = document.getElementById("password")
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
			<p>
				<?php
				if (isset($_COOKIE['firstname']))
				{
					echo "<br> ".$_SESSION['user']->firstname." ".$_SESSION['user']->lastname." | Last login ".$_COOKIE['lastlogin'].".";
				}

				else 
				{
					echo "This is your first login!";
				}
				setcookie('lastlogin', date("Y-m-d  H:i:s"));
				?>
			</p>
			<form action="login.php" method="post">
				<button type="submit" name="logout" value="logout">Logout</button>
			</form>

			<?php
		}

		else {
			?>
			<p>Your credentials were wrong, press the button to try again !</p>
			<form action="login.php">
				<button type="submit" value="Submit">Go back to login</button>
			</form>
			<?php
		}
	}
	else{
		?>
			<p>Please Login to access this page</p>
			<form action="login.php">
				<button type="submit" value="Submit">Go back to login</button>
			</form>
			<?php
	}
	
	?>
	<h5>
		Geoffroy DIMUR
	</h5>
</body>
</html>


