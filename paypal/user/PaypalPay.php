<?php

include 'DB.php';

	class PaypalPay {
		private $db;

		public function __construct(){
			$conn = new DB();
			$this->db = $conn->db_connection();
		}

		public function pay($id,$amount,$transaction_id,$status){
			$date = new DateTime();
			$today = $date->format('Y/m/d H:i:s');

			// Query to insert new user
			if($this->db->query("INSERT INTO `paypal_data` (`user_id`, `amount`, `transaction_id`, `status`, `insert_date`) VALUES ('$id', '$amount', '$transaction_id', '$status', '$today');")){
				return TRUE;
			}else{
				return FALSE;
			}
		}

	}

?>