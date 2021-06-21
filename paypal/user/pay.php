<?php
include 'PaypalPay.php';
$paypal_pay = new PaypalPay();

if(isset($_SESSION['uid']) && isset($_SESSION['logged_in'])){
	if($_POST['tid'] != NULL && $_POST['status'] != NULL && $_POST['value'] != NULL){
		if($paypal_pay->pay($_SESSION['uid'],$_POST['value'],$_POST['tid'],$_POST['status'])==TRUE){
			echo "success";
		}
	}else{
		header("Location: dashboard.php");
	}
}else{
	header("Location: index.php");
}
?>