<?php
	include_once("../database.php");
	session_start();

	if(!isset($_SESSION['userdata']))
	{
		header('Location: /website_1/index.php');
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
		case 'feed';
			include('./feed_view.php');
			break;
		case 'update';
			include('./update_view.php');
			break;
		case 'profile':
		default:
			include('./profile_view.php');
			break;
	}
?>
