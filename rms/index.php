<?php

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
		case 'logout' :
			include 'inc/twitter/clearsessions.php';
			break;
		default :
			include('inc/home.php');
			break;
	}
}
else
	include('inc/home.php');

?>