<?php
	
	require_once 'config.php';
	
	$admins = array(1,2,3,4,6,8);
	$dir = '../';
	
	if ( isset($_SESSION['id_user']) && in_array($_SESSION['id_user'],$admins) )
	{
		include 'header.php';
		
		// nbre rates
		$count_rates = mysql_result(mysql_query("SELECT COUNT(id) FROM ".$table_prefix."Rate"),0);
		
		// nbre users
		$count_users = mysql_result(mysql_query("SELECT COUNT(id) FROM ".$table_prefix."User"),0);
		
		echo '<div id="speaker_conferences"><h1>'.$count_rates.' Votes!</h1>';
		
		echo '<br/><br/><h1>'.$count_users.' logged Users!</h1></div>';
		
		include 'footer.php';
	}
	else
	{
		header('Location: ../404');
		die();
	}
?>