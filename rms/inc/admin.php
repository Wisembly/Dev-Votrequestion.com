<?php
	
	require_once 'config.php';
	
	$admins = array(1,2,3,4,6,8);
	$dir = '../';
	
	if ( isset($_SESSION['id_user']) && in_array($_SESSION['id_user'],$admins) )
	{
		include 'header.php';
		
		// nbre rates
		$count_rates = mysql_result(mysql_query("SELECT COUNT(id) FROM ".$table_prefix."Rate WHERE id_user > 10"),0);
		
		// nbre users
		$count_users = mysql_result(mysql_query("SELECT COUNT(id) FROM ".$table_prefix."User"),0);
		
		// 5 derniers users
		$users = mysql_query("SELECT pseudo, url_avatar, profile_score FROM ".$table_prefix."User ORDER BY id DESC LIMIT 5");
		
		echo '<div id="speaker_conferences"><h1>'.$count_rates.' Votes by Users!</h1><br/>';
		
		echo '<h1>'.$count_users.' logged Users!</h1><br/>';
		
		echo '<h1>5 last Users!</h1><table style="width:480px;margin:0 auto; text-align:center;">';
		
		while ($u = mysql_fetch_row($users))
			echo '<tr><td width="160px;"><img src="'.$u[1].'" width="14" height="14"> <a href="http://twitter.com/'.$u[0].'">'.$u[0].'</a></td><td width="160px;">'.$u[2].'% progress</td><td width="160px;"><a href="../u/'.$u[0].'">Profil</a></td></tr>';
		
		echo '</table><br/></div>';
		
		include 'footer.php';
	}
	else
	{
		header('Location: ../404');
		die();
	}
?>