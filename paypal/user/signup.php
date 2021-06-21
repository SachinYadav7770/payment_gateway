<?php
include 'Account.php';
$msg = '';
$account = new Account();
if(isset($_POST['submit']) && $_POST['submit']=='signup'){
	if(empty($_POST['username']) || empty($_POST['email']) || empty($_POST['mobile']) || empty($_POST['password'])){
		$msg = "<p class='error'>Please Filled all the inputs</p>";
	}elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
		$msg = "<p class='error'>Please Filled proper email</p>";
	}elseif($account->email_exist($_POST['email'])){
		$msg = "<p class='error'>Email is already exist</p>";
	}else{
		if($account->signup(strip_tags($_POST['username']),strip_tags($_POST['email']),strip_tags($_POST['mobile']),strip_tags($_POST['password']))){
			$msg = "<p class='success'>Thanks ".$_POST['username']." . You are Registed Successfully <br><a href='index.php'>Go to Login</a></p>";
			?>
			<style type="text/css">
				#up_form{
					display: none;
				}
			</style>
			<?php
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<style type="text/css">
	body{
		background: #ccc;
	}
	form{
		max-width: 500px;
		margin: 50px auto;
		background: #fff;
		padding: 40px;
	}
	input{
		margin: 10px;
		padding: 10px;
	}
	.error{
		color: red;
	}
	.success{
		color: green;
	}
</style>
<body>
<span><?php echo $msg;?></span>
<form method="post" action="" id="up_form">
	<h2>Sign Up</h2>
	<input type="text" name="username" placeholder="Username">
	<input type="text" name="email" placeholder="Email">
	<input type="number" name="mobile" placeholder="Mobile">
	<input type="password" name="password" placeholder="*******">
	<input type="submit" name="submit" value="signup">	
	<hr><h4>If you have already an account <a href="index.php">Login</a></h4>
</form>
</body>
</html>