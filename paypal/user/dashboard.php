<?php
include 'Account.php';
$account = new Account();
if(isset($_GET['logout'])){
	$account->logout();
}
if(!isset($_SESSION['uid']) && !isset($_SESSION['logged_in'])){
	header("Location: index.php");
}else{
	$user = $account->get_user_info(strip_tags($_SESSION['uid']));
}
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Add meta tags for mobile and IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title> PayPal Smart Payment Buttons Integration | Client Demo </title>
</head>
	<style type="text/css">
	body{
		background: #ccc;
	}
	.container{
		max-width: 600px;
		margin: 50px auto;
		background: #fff;
		padding: 40px;
	}
</style>
<body>
	<div class="container">
	Welcome <?php echo $user['uname'];?> sir <a href="?logout">Logout</a>
	<div id="paypal-button-container"></div>
	<div id="success_payment_div"></div>
	</div>
</body>
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://www.paypal.com/sdk/js?client-id=AUaS1t8BVhgMXPjW1RPwf2zj8SFsaeDiofxSaqc4iGABmZ9i2mBaHkBjVsNI0aB_45bnXP_UhWbI_tqK&currency=USD"></script>
<script type="text/javascript" src="paypal_pay.js"></script>
</html>