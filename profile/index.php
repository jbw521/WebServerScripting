<?php
	include_once("../database.php");
	include_once("update_post.php");
	session_start();
	
	if(!isset($_SESSION['userdata']))
	{
		header('Location: ../');
		exit();
	}
	
	$action = filter_input(INPUT_POST, 'action');
	if($action === null)
	{
		$action = filter_input(INPUT_GET, 'action');
		if($action === null)
		{
			$action = 'profile';
		}
	}
	
	switch($action)
	{
		case 'logout':
			session_destroy();
			header("Location: /");
			break;
		case 'feed':
			include('./feed_view.php');
			break;
		case 'update':
			include('./update_view.php');
			break;
		case 'update_profile':
			confirm_update();
			break;
		case 'profile':
		default:
			include('./profile_view.php');
			break;
	}
?>
