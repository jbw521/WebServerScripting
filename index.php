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
			$users_sidebar = array();
			switch($userListType)
			{
				case 'newest':
					$users_sidebar = get_newest_users();
					break;
				case 'mostComments':
					$users_sidebar = get_users_most_comments();
					break;
				case 'all':
				default:
					$users_sidebar = get_all_users_sidebar();
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
			$profile_pic = $f_name = $l_name = 'error';
			$aliasCheck = htmlspecialchars(FILTER_INPUT(INPUT_GET, 'alias'));
			
			if($aliasCheck === $_SESSION['userdata']['alias'] || $aliasCheck == "")
			{
				$profile_pic = $_SESSION['userdata']['profilepic'];
				$f_name = $_SESSION['userdata']['fname'];
				$l_name = $_SESSION['userdata']['lname'];
			}
			else
			{
				$user_data = get_username($aliasCheck);
				if(empty($user_data))
				{
					include('../fuck.php');
					break;
				}
				$profile_pic = $user_data['profilepic'];
				$f_name = $user_data['fname'];
				$l_name = $user_data['lname'];
			}
			include('./profile_view.php');
			break;
	}
?>