<?php

Class DB{

	private $servername = "localhost";
	private $username = "root";
	private $password = "";
	private $db = "calendar";

	public function __construct(){
		session_start();
	}

	public function db_connection(){
		// $conn = new mysqli($servername,$username,$password,$db);
		$conn = new mysqli($this->servername, $this->username, $this->password, $this->db);
		if($conn->connect_errno){
			die("Connection Failed".$conn->connect_errno);
		}
		return $conn;
	}
}

?>