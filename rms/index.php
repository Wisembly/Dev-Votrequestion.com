<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
session_start();

// gestion auth Twitter en Cookie
if (isset($_SESSION['id_user']))
{
	if ( !isset($_COOKIE['ratemyspeaker']) || ($_COOKIE['ratemyspeaker']['user_id'] != $_SESSION['id_user']) )
	{
		setcookie("ratemyspeaker[user_id]", $_SESSION['id_user'], time()+60*60*24*30) ;
		setcookie("ratemyspeaker[pseudo_twitter_user]", $_SESSION['pseudo_twitter_user'], time()+60*60*24*30) ;
		setcookie("ratemyspeaker[url_avatar_user]", $_SESSION['url_avatar_user'], time()+60*60*24*30) ;
	}
}
else if (isset($_COOKIE['ratemyspeaker']) && !empty($_COOKIE['ratemyspeaker']))
{
	$_SESSION['id_user'] = $_COOKIE['ratemyspeaker']['user_id'] ;
	$_SESSION['pseudo_twitter_user'] = $_COOKIE['ratemyspeaker']['pseudo_twitter_user'] ; 
	$_SESSION['url_avatar_user'] = $_COOKIE['ratemyspeaker']['url_avatar_user'] ;
}

// $_SESSION['id_user'] = 6 ;
// $_SESSION['pseudo_twitter_user'] = 'guillaumepotier' ;
// $_SESSION['url_avatar_user'] = 'http://a3.twimg.com/profile_images/1226148948/gui_normal.png';

if (isset($_GET['page']))
{
	$page = $_GET['page'];
	
	switch ($page)
	{
		case 'conference' :
			include 'inc/conference.php';
			break;
		case 'ranking' :
			include 'inc/ranking.php';
			break;
		case 'search' :
			include('inc/search.php');
			break;
		case 'user' :
			include('inc/user.php');
			break;	
		case '404' :
			include 'inc/404.php';
			break;
		case 'admin' :
			include 'inc/admin.php';
			break;
		case 'logout' :
			include 'inc/twitter/clearsessions.php';
			break;
		default :
			header('Location: ratemyspeaker.com');
			break;
	}
}
else
	include('inc/home.php');

?>