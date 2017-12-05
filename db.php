<?php
	
require_once("User.php");

function db_connect($servername, $username, $password, $dbname){
	try{
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo " Connected successfully ";
		return $conn;
	}
	catch (PDOException $e){
		echo "Connection failed: ".$e->getMessage();
	}
}

function retrieve_users($conn){
	try{
		$sql = $conn->prepare("SELECT * FROM Users");
		$sql->execute();
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		$result = $sql->fetchAll();
		echo count ($result)." results returned ";
		return $result;
	}
	catch(PDOException $e){
		echo "Error: ".$e->getMessage();
	}
}

function insert_user($conn, $firstname, $lastname, $email, $password){
	try{
		$sql = $conn->prepare("INSERT INTO Users VALUES (null, '$firstname', '$lastname', '$email', '$password')");
		$sql->execute();
		//echo " New record created successfully ";
		
	}
	catch(PDOException $e){
		echo "Error: ".$e->getMessage();
	}
}

function update_user($conn, $id, $firstname, $lastname, $email, $password){
	try{
		$sql = $conn->prepare("UPDATE Users SET First_Name = '$firstname', Last_name = '$lastname', Email = '$email', Password = '$password' WHERE ID = '$id'");
		$sql->execute();
		echo " Your credentials were updated successfully ";
	}
	catch(PDOException $e){
		echo "Error: ".$e->getMessage();
	}
}


function user_auth($conn, $email, $pass) {
	try {
	    // Check that user exists
		$test = $conn->prepare("SELECT ID FROM Users WHERE Email = '$email'"); 
	    $test->execute();
	    $users = $test->fetchAll();
	    if (count($users) > 0) {
	    	$id = $users[0][0]; // UserID will be the only field in the only record
			$auth = $conn->prepare("SELECT Password FROM Users WHERE ID = '$id'");
	    	$auth->execute();
	    	$password = $auth->fetchAll();
			
	    	if ($pass == $password[0][0]) {
	    		return $id;
	 		}
	 		else {
	 			return null;
	 		}
	    }
	    else {
	    	return null;
	    }
	}
	catch (PDOException $e) {
	    echo "Error: " . $e->getMessage();
	}
}

function db_reset($conn, $file){
	try{
		$query = file_get_contents($file);
		$sql = $conn->prepare($query);
		$sql->execute();
		echo " Database has been reset ";
	}
	catch (PDOException $e){
		echo "Error: ".$e->getMessage();
	}
}

?>