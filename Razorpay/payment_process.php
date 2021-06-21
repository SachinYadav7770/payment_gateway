<?php
date_default_timezone_set("Asia/Kolkata");
session_start();
include('db.php');
if (isset($_POST['amt']) && isset($_POST['name'])) {
	$amount=$_POST['amt'];
	$name=$_POST['name'];
	$order_id=$_POST['order_id'];
	$payment_status="pending";
	$added_on=date('Y-m-d h:i:s');
	echo $sql=mysqli_query($con,"INSERT INTO `razorpay` (`name`, `amount`, `order_id`, `payment_status`, `added_on`) VALUES('$name','$amount','$order_id','$payment_status','$added_on');");
	$_SESSION['OID']=mysqli_insert_id($con);
}

if (isset($_POST['payment_id']) && isset($_SESSION['OID'])) {
	$payment_id=$_POST['payment_id'];
	$razorpay_signature=$_POST['razorpay_signature'];
	$payment_status="complete";
	mysqli_query($con,"UPDATE `razorpay` SET `payment_status` = '$payment_status', `razorpay_signature` = '$razorpay_signature', `payment_id` = '$payment_id' WHERE `razorpay`.`id` = '".$_SESSION['OID']."';");
}
?>