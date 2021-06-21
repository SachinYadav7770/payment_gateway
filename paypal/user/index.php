<?php
include 'Account.php';
$msg = '';
$account = new Account();
if(isset($_POST['submit']) && $_POST['submit']=='login'){
	if(empty($_POST['username']) || empty($_POST['password'])){
		$msg = "<p class='error'>Please Filled all the inputs</p>";
	}else{
		$account->login(strip_tags($_POST['username']),strip_tags($_POST['password']));
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
		max-width: 400px;
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
<form method="post" action="">
	<h2>Login</h2>
	<input type="text" name="username" placeholder="Username">
	<input type="password" name="password" placeholder="*******">
	<input type="submit" name="submit" value="login">	
	<hr><h4>If you don't have account <a href="signup.php">Sign Up</a></h4>
</form>
</body>
</html>