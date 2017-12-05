<!doctype html>
<?php
require_once("db.php");

$conn = db_connect("localhost", "root", "root", "Credentials");
session_start();
?>
<html>
<head>
	<title>Address Modification Page</title>
	<meta charset="utf-8">
</head>
<body>
	<!-- PRINT NAVIGATION BAR -->
	<?php
	if (isset($_POST['mail'])){
		
		$id = user_auth($conn, $_POST['mail'], $_POST['password']);
		
		if (isset($id)){

			$user = User::create_user($conn, $id);
			$_SESSION['user'] = $user;

			echo "<p>Welcome ".$_SESSION['user']->firstname." !</p>";
			?>

			<form action="modify-address.php" method="post">
				<fieldset>
					<legend>Modify Address</legend>
					<p>
						<label for="street">Street</label>
						<input type="text" name="street" id="street" value="<?php echo $_SESSION['user']->street; ?>" required="required">
					</p>
					<p>
						<label for="complement">Complement</label>
						<input type="text" name="complement" id="complement" value="<?php echo $_SESSION['user']->complement; ?>" required="required">
					</p>
					<p>
						<label for="city">City</label>
						<input type="text" name="city" id="city" value="<?php echo $_SESSION['user']->city; ?>" required="required">
					</p>
					<p>
						<label for="state">State/Province</label>
						<input type="password" name="state" id="state" required="required">
					</p>
					<p>
						<label for="country">Country</label>
						<input type="password" name="country" id="country" required="required">
					</p>
					<p>
						<input type="hidden" name="modification" value="yes">
						<button type="submit" value="Submit">Submit</button>
						<button type="reset" value="Reset">Reset</button>
					</p>
				</fieldset>		
			</form>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
			<p>
				<?php
				/*
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
			*/
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


