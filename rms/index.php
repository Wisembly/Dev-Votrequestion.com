<?php

if (isset($_GET['page']))
{
	$page = $_GET['page'];
	
	switch ($page)
	{
		case 'ranking' :
			include 'inc/ranking.php';
			break;
		case 'search' :
			include('inc/search.php');
			break;
		default :
			include('inc/home.php');
			break;
	}
}
else
	include('inc/home.php');

?>