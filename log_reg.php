<?php
function process_login () 
	{
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
					$_POST['action'] = 'login-page';					
					include('login.php');
					exit();
				}
				else // login successful
				{
					$userdata = array();
					$userdata['alias'] = $found_username;
					$userdata['fname'] = $user['fname'];
					$userdata['lname'] = $user['lname'];
					$userdata['profilepic'] = $user['profilepic'];
					$_SESSION['userdata'] = $userdata;
					header("Location: ./profile/");  // go to other controller here
					exit();
				}
			}
		}
	}
	
	function register_user() 
	{
		include("./database.php");
	
		$error_message = '';
		
		$first_name = filter_input(INPUT_POST, 'firstname');
		$last_name = filter_input(INPUT_POST, 'lastname');
		$user_name = filter_input(INPUT_POST, 'username');
		$password = filter_input(INPUT_POST, 'password');
		$confirm_password = filter_input(INPUT_POST, 'confirmpassword');
		$email_address = filter_input(INPUT_POST, 'emailaddress', FILTER_VALIDATE_EMAIL);
		
		
		
		if($first_name === false || $first_name === '')
		{
			$error_message = 'Must enter a valid first name.';
		}
		else if($last_name === false || $last_name === '')
		{
			$error_message = 'Must enter a valid last name.';
		}
		else if($user_name === false || $user_name === '')
		{
			$error_message = 'Must enter a valid username.';
		}
		else if(get_username($user_name) != false){
			$error_message = 'That username is taken. Please enter another one.';
		}
		else if($password === false || $password === '')
		{
			$error_message = 'Must enter a valid password.';
		}
		else if($email_address === false || $email_address === '')
		{
			$error_message = 'Must enter a valid email address.';
		}
		else 
		{
			if(!($password === $confirm_password))
			{
				$error_message = 'Passwords do not match';
			}
			else
			{
				$error_message = '';
			}		
		}
		
		if(!empty($error_message))
		{
			include('register.php');
			exit();
		}
		
		add_user($user_name, $password, $first_name, $last_name, $email_address);
		// The message
		$message = '<html><body><h1>Thanks '.$first_name .'!</h1><p>You are now registered with Fakebook!'
					.'Please review the following information and confirm that it is all correct.<br>'
					.'First Name: ' .$first_name .'<br>'
					.'Last Name: ' .$last_name .'<br>'
					.'Username: ' .$user_name .'<br>'
					.'Email Address: ' .$email_address .'<br>'
					.'Password: ' .$password .'<br><br>'
			.'Once again thank you for registering with Fakebook.</p></body></html>';

		$message = wordwrap($message, 70, "\r\n");

		mail($email_address, 'Fakebook Registration', $message, "MIME-Version: 1.0\r\nContent-type:text/html:charset=UTF-8");
	}
	
	
?>