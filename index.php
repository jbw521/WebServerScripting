<?php
	include_once("./database.php");
	include_once("./log_reg.php");
	session_start();
	
	if(isset($_SESSION['userdata']))
	{
		header('Location: ./profile/');
		exit();
	}
	
	$action = filter_input(INPUT_POST, 'action');
	if($action === null)
	{
		$action = filter_input(INPUT_GET, 'action');
		if($action === null)
		{
			$action = 'login-page';
		}
	}
	
	switch($action)
	{
		case 'login-page';
			include('./login.php');
			break;
		case 'login';
			process_login();
			break;
		case 'reg':
			include('./register.php');
			break;
		case 'subreg':
			register_user();
			break;
	}
?>
