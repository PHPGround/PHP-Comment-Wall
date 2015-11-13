<?php 
	session_start();
	require('new_connection.php');

	if(isset($_POST['action']) && $_POST['action'] == 'login')
	{
		$query = "SELECT * FROM thewall.users WHERE users.email = '{$_POST['email']}' AND users.password = '{$_POST['password']}'";
		// echo($query);
		$user = fetch_record($query);
		$_SESSION['session_id'] = $user['id'];
		// var_dump($user);
		if(empty($_POST['email']))
		{
			$_SESSION['error'][] = "Please enter an email address.";
		}
		if(empty($_POST['password']))
		{
			$_SESSION['error'][] = "You did not enter a password.";
		}
		else
		{
			if($user['email'] == $_POST['email'])
			{
				header("location: success.php?new=false");
				die();
			}
			else
			{
				$_SESSION['error'][] = "That email/password combination does not exist.";
			}
			
		}
		if(isset($_SESSION['error']))
		{
			header("location: index.php");
			die();
		}
		
	}
	elseif(isset($_POST['action']) && $_POST['action'] == 'register')
	{
		//notifies user to complete all fields
		if(empty($_POST['first_name']))
		{
			$_SESSION['error'][] = "Please fill in all fields.";
		}
		elseif(empty($_POST['last_name']))
		{
			$_SESSION['error'][] = "Please fill in all fields.";
		}
		elseif(empty($_POST['password']))
		{
			$_SESSION['error'][] = "Please fill in all fields.";
		}
		elseif(empty($_POST['email']))
		{
			$_SESSION['error'][] = "Please fill in all fields.";
		}
		//prevents duplicate email addresses
		$users = fetch_all("SELECT * FROM users");
		foreach ($users as $key => $value) 
		{
			if($_POST['email'] == $users[$key]['email'])
			{
				$_SESSION['error'][] = "That email address is already in use";
			}
		}
		//additional criterion
		if(is_numeric($_POST['first_name']))
		{
			$_SESSION['error'][] = "First name cannot contain numbers.";
		}
		if(is_numeric($_POST['last_name']))
		{
			$_SESSION['error'][] = "Last name cannot contain numbers.";
		}
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && !empty($_POST['email']))
		{
			$_SESSION['error'][] = "Please enter a valid email address.";
		}
		if(strlen($_POST['password']) < 6 && !empty($_POST['password']))
		{
			$_SESSION['error'][] = "Password must contain at least 6 characters.";
		}
		if($_POST['password'] !== $_POST['confirm_pass'])
		{
			$_SESSION['error'][] = "Passwords do not match.";
		}

		if(isset($_SESSION['error']))
		{
			header("location: index.php");
			die();
		}
		else
		{
			$query = "INSERT INTO thewall.users (first_name, last_name, email, password, created_at, updated_at) VALUES ('{$_POST['first_name']}', '{$_POST['last_name']}', '{$_POST['email']}', '{$_POST['password']}', NOW(), NOW())";
			$user = run_mysql_query($query);
			$_SESSION['session_id'] = $user;
			header("location: success.php?new=true");	
			die();
		}

	}
	elseif(isset($_POST['action']) && $_POST['action'] == 'msg')
	{
		$query = "INSERT INTO thewall.messages (message, created_at, updated_at, user_id) VALUES ('{$_POST['message']}', NOW(), NOW(), '{$_POST['userid']}')";
		run_mysql_query($query);
		header("location: success.php?new=false");
	}
	elseif(isset($_POST['action']) && $_POST['action'] == 'cmt')
	{
		$query = "INSERT INTO thewall.comments (comment, created_at, updated_at, user_id, message_id) VALUES ('{$_POST['comment']}', NOW(), NOW(), '{$_POST['userid']}', '{$_POST['messageid']}')";
		$comment = run_mysql_query($query);
		header("location: success.php?new=false");
	}
	else
	{
		session_destroy();
		header("location: index.php");
		die();
	}


 ?>