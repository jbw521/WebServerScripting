<?php
	include_once("../database.php");
	
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