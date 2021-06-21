<?php

include 'DB.php';

class Account {
	private $db;

	public function __construct(){
		$conn = new DB();
		$this->db = $conn->db_connection();
	}

	public function signup($uname,$email,$mobile,$password){

		//password hashing
		$s_password = $this->own_hash($password);
		$hashed_pass = $s_password;

		$date = new DateTime();
		$today = $date->format('Y/m/d H:i:s');

		// Query to insert new user
		if($this->db->query("INSERT INTO `users` (`uname`, `email`, `mobile`, `password`, `insert_date`) VALUES ('$uname', '$email', '$mobile', '$hashed_pass', '$today');")){
			return TRUE;
		}else{
			return FALSE;
		}

	} 

	public function own_hash($input_password){

		$secure = password_hash($input_password, PASSWORD_DEFAULT);
		return $secure;
	}

	public function email_exist($input_email){
		$query = $this->db->query("SELECT email FROM `users` WHERE email='$input_email';");
		if($query->num_rows==1){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function login($username,$password){
		$query = $this->db->query("SELECT * ,count(id) as total FROM `users` WHERE email='$username' or uname='$username';");
		while ($loginData = $query->fetch_assoc() ) {
			if($loginData['total']==1 && $this->verify_password($password,$loginData['password'])){
				//store login data into session
				$_SESSION['uid'] = $loginData['id'];
				$_SESSION['email'] = $loginData['email'];
				$_SESSION['logged_in'] = TRUE;
				header("Location:dashboard.php");
			}else{
				echo "Username and password is not correct";
			}
		}
	}

	public function verify_password($password,$table_password){
		if(password_verify($password, $table_password)){
			return TRUE;
		}
	}

	public function get_user_info($id){
		$query = $this->db->query("SELECT * FROM `users` WHERE id='$id';");
		if($query->num_rows > 0){
			while ($userData = $query->fetch_assoc() ) {
				return $userData;
			}
		}else{
			echo "ID is not valid";
		}
	}

	public function logout(){
		session_destroy();
		unset($_SESSION['uid']);
		unset($_SESSION['email']);
		unset($_SESSION['logged_in']);
		// back to index page
		header("Location:index.php");
	}
}

?>