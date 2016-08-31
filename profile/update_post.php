<?php
function confirm_update()
{
	$first_name = filter_input(INPUT_POST, 'firstname');
	$last_name = filter_input(INPUT_POST, 'lastname');
	$user_name = filter_input(INPUT_POST, 'username');
	$password = filter_input(INPUT_POST, 'password');
	$confirm_password = filter_input(INPUT_POST, 'confirmpassword');
	$email_address = filter_input(INPUT_POST, 'emailaddress', FILTER_VALIDATE_EMAIL);
	$profilepic = check_image();
			
	$_SESSION['userdata']['fname'] = $first_name;
	$_SESSION['userdata']['lname'] = $last_name;
	$_SESSION['userdata']['email'] = $email_address;
	$_SESSION['userdata']['profilepic'] = $profilepic;
	
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
		include('update_view.php');
		exit();
	}
		
	$updated = update_user($_SESSION['userdata']['alias'], $password, $first_name, $last_name, $email_address, $profilepic);

	include('update_confirmation.php');
}
function check_image()
{
	if(isset($_FILES['profileimg'])){
		$errors= array();
		$file_name = $_FILES['profileimg']['name'];
		$file_size =$_FILES['profileimg']['size'];
		$file_tmp =$_FILES['profileimg']['tmp_name'];
		$file_type=$_FILES['profileimg']['type'];
		$file_ext=strtolower(end(explode('.',$_FILES['profileimg']['name'])));

		$extensions= array("jpeg","jpg","png");

		if(in_array($file_ext,$extensions)=== false){
			$errors[]="extension not allowed, please choose a JPEG or PNG file.";
		}

		if($file_size > 2097152){
			$errors[]='File size must be exactly 2 MB';
		}

		if(empty($errors)==true){
			$file_name = uniqid().".".$file_ext;
			move_uploaded_file($file_tmp,"../img/user/".$file_name);
			if($_SESSION['userdata']['profilepic'] != "user_blank.jpg")
			{
				unlink("../img/user/".$_SESSION['userdata']['profilepic']);
			}
			return $file_name;
		}else{
			print_r($errors);
		}
	}
	return "user_blank.jpg";
}
?>