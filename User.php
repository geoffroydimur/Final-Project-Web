<?php
class User{
	
	public $id, $firstname, $lastname, $email;

	function __construct($id, $firstname, $lastname, $email){
		$this->id = $id;
		$this->firstname = $firstname;
		$this->lastname = $lastname;
		$this->email = $email;
	}

	function SetID($id){
		$this->id = $id;
	}

	function SetFirstName($firstname){
		$this->firstname = $firstname;
	}

	function SetLastName($lastname){
		$this->lastname = $lastname;
	}

	function SetEmail($email){
		$this->email = $email;
	}

	function GetID(){
		return $this->id;
	}

	function GetFirstName(){
		return $this->firstname;
	}

	function GetLastName(){
		return $this->lastname;
	}

	function GetEmailName(){
		return $this->email;

	}

	static function create_user($conn, $id){
		$sql = $conn->prepare("SELECT First_Name, Last_name, Email FROM Users WHERE ID = '$id'");
		$sql->execute();
		$info = $sql->fetchAll();
		$user = new User($id, $info[0]['First_Name'], $info[0]['Last_name'], $info[0]['Email']);
		return $user;
	}

}
?>