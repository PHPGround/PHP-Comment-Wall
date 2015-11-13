<?php 

session_start();
include('new_connection.php');

if(!isset($_SESSION['error']))
{
	$_SESSION['error'] = [];
}
else
{
	foreach ($_SESSION['error'] as $message) 
	{
		echo $message . "<br>";
	}
}
unset($_SESSION['error']);

?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<meta name="description" value="index">
	<link rel="stylesheet" type="text/css" href="index_css.css">
</head>
<body>
	<h2>Login</h2>
	<form action = "process.php" method="post">
		<input type="hidden" name="action" value="login">
		<label>E-mail Address</label>
		<input type="text" name="email">
		<label>Password</label>
		<input type="password" name="password">
		<input type="submit" value="Login">
	</form>
	<p id="not">Don't have an account with us?</p>
	<h2>Register</h2>
	<form action="process.php" method="post">
		<input type="hidden" name="action" value="register">
		<label>E-Mail Address</label>
		<input type="text" name="email" placeholder="E-Mail Address">
		<label>First Name</label>
		<input type="text" name="first_name" placeholder="First Name">
		<label>Last Name</label>
		<input type="text" name="last_name" placeholder="Last Name">
		<label>Password</label>
		<input type="password" name="password" placeholder="Password">
		<label>Re-Type Password</label>
		<input type="password" name="confirm_pass" placeholder="Confirm Password">
		<input id="sub" type="submit" value="Register">
	</form>

</body>
</html>
