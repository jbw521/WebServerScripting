<?php include("./bin/master_top.php");
	include("./database.php");
	$first_name = filter_input(INPUT_POST, 'firstname');
	$last_name = filter_input(INPUT_POST, 'lastname');
	$user_name = filter_input(INPUT_POST, 'username');
	$password = filter_input(INPUT_POST, 'password');
	$confirm_password = filter_input(INPUT_POST, 'confirmpassword');
	$email_address = filter_input(INPUT_POST, 'emailaddress', FILTER_VALIDATE_EMAIL);
	
	if($email_address === false || $email_address === '')
	{
		$error_message = 'Must enter a valid email address.';
	}
	
	if(!($password === $confirm_password))
	{
		$error_message = 'Passwords do not match';
	}
	else
	{
		$error_message = '';
	}	
	
	if(!empty($error_message))
	{
		include('update_profile.php');
		exit();
	}
	
	update_user($user_name, $password, $first_name, $last_name, $email_address);

?>

		
            <p>
				<span id="confirmation_message">Your information has been update!</span>
			</p>
			
<?php include("./bin/master_bottom.php");?>	