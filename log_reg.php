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
                                        $userdata['email'] = $user['email'];
					$_SESSION['userdata'] = $userdata;
					header("Location: ./profile/");  // go to other controller here
					exit();
				}
			}
		}
	}
	
	function register_user() 
	{	
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
                else if (!(preg_match('/^[a-zA-Z]/', $first_name) === 1)) // DOESN'T WORK
                {
                    $error_message = 'First name must start with a letter.';
                }
		else if($last_name === false || $last_name === '')
		{
			$error_message = 'Must enter a valid last name.';
		}
                else if (!(preg_match('/^[a-zA-Z]/', $last_name) === 1))
                {
                    $error_message = 'Last name must start with a letter.';
                }
		else if($user_name === false || $user_name === '')
		{
			$error_message = 'Must enter a valid username.';
		}
		else if (!(preg_match('/^[a-zA-Z]{4,20}$/', $user_name) === 1))
		{
			$error_message = 'Alias must start with a letter and be between 4 and 20 characters.';
		}
		else if(get_username($user_name) != false)
		{
			$error_message = 'That username is taken. Please enter another one.';
		}
		else if($email_address === false || $email_address === '')
		{
			$error_message = 'Must enter a valid email address.';
		}
		else if (!(preg_match('/[a-zA-Z0-9_.+]+@[a-zA-Z0-9-]+.[a-zA-Z]+/', $email_address) === 1)) // Source : http://stackoverflow.com/questions/12026842/how-to-validate-an-email-address-in-php
		{
			$error_message = 'Must enter a valid email address.';
		}
		else if (!(preg_match('/^[a-zA-Z]/', $email_address) === 1))
		{
			$error_message = 'Email address must start with a letter.';
		}
		else if($password === false || $password === '')
		{
			$error_message = 'Must enter a valid password.';
		}
                else if(!(preg_match('/[\S]{10,}[\s]{0}/', $password) === 1))
                {
                    $error_message = 'Must enter at least 10 non-whitespace characters for the password';
                }
                else if(!(preg_match('/[a-zA-Z]+/', $password) === 1))
                {
                    $error_message = 'Must have at least one letter';
                }
                else if(!(preg_match('/\W+/', $password) === 1))
                {
                    $error_message = 'Must enter at least 1 non-word character';
                }
                else if(!(preg_match('/\d+/', $password) === 1))
                {
                    $error_message = 'Must enter at least 1 number';
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
		include('confirmation.php');
		
		$user = get_username($user_name);
		
		$userdata = array();
		$userdata['alias'] = $user_name;
		$userdata['fname'] = $user['fname'];
		$userdata['lname'] = $user['lname'];
		$userdata['profilepic'] = $user['profilepic'];
		$userdata['email'] = $user['email'];
		$_SESSION['userdata'] = $userdata;
		
		header("Refresh:10; url=http://localhost/website_1/profile/", true, 303);  // go to other controller here. source: http://stackoverflow.com/questions/11299006/header-location-delay
					
	}
	
	
?>