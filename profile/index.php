<?php
	require_once("../database.php");
	include_once('./update_post.php');
	session_start();
	
	
	if(!isset($_SESSION['userdata']))
	{
		header('Location: /~stickman3/');
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
			header("Location: /~stickman3/");
			break;
		case 'changeUserListType':
			$userListType = filter_input(INPUT_POST, 'userListType');
			switch($userListType)
			{
				case 'all':
					$users_sidebar = get_all_users_sidebar();
					break;
				case 'newest':
					$users_sidebar = get_newest_users();
					break;
				case 'mostComments':
					$users_sidebar = get_users_most_comments();
					break;
			}
			include('./feed_view.php');
			break;
		case 'feed':
			if(!isset($users_sidebar))
			{
				$users_sidebar = get_all_users_sidebar();
			}
			include('./feed_view.php');
			break;
		case 'update':
			include('./update_view.php');
			break;
		case 'update_profile':
			confirm_update();
			break;
		case 'user-profile':
			
			break;
		case 'profile':
		default:
			include('./profile_view.php');
			break;
	}
?>