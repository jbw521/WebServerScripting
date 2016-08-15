<?php 
	include('database.php');

	$error_message = '';

	$username = filter_input(INPUT_POST, 'username');
	$password = filter_input(INPUT_POST, 'password');
	
	if($username === false)
	{
		$error_message .= "\nPlease enter a username.";
	}
	if($password === false)
	{
		$error_message .= "\nPlease enter a password.";
	}
	
	if($error_message != '')
	{
		include('index.php');
		exit();
	}
	else // input was good, check DB for user's info
	{
		$user = get_username($username);
		
		if(!$user) // user was not found
		{
			$error_message = "User not found. Please create a new user.";
			include('register.php');
			exit();
		}
		else
		{
			$found_username = $user['alias'];
			$found_password = $user['password'];
			if($found_password != $password) // password doesn't match
			{
				$error_message = "Invalid Password.";
				include('index.php');
				exit();
			}
			else // login successful
			{
				include('update_profile.php');
			}
		}
	}
	
?>
