<?php
header("Content-type: application/json");  
header('Content-type: text/html; charset=utf-8');

$dir = '../' ;
require_once $dir.'inc/config.php';

echo isset($_GET['callback']) ? $_GET['callback'].'(' : null;

if(isset($_GET['c']))
	$speakers = mysql_query("SELECT real_name,url_avatar,nb_ratings,current_score FROM ratemyspeaker_Speaker AS S, ratemyspeaker_SpeakerInConf AS L WHERE S.id = L.id_speaker AND L.id_conf IN (SELECT id FROM ratemyspeaker_Conference WHERE hashtag = '".mysql_real_escape_string(urldecode($_GET['c']))."') ORDER BY current_score DESC, real_name ASC");
else
	$speakers = mysql_query("SELECT real_name,url_avatar,nb_ratings,current_score FROM ".$table_prefix."Speaker ORDER BY current_score DESC, real_name ASC LIMIT 20");
	
$results = array();
		
while ( $r = mysql_fetch_row($speakers) )
{
	array_push($results, array(
			'real_name'			=>	$r[0],
			'url_avatar'		=>	empty($r[1]) ? 'ratemyspeaker.com/img/profile.gif' : $r[1],
			'nb_votes'			=>	$r[2],
			'current_score'		=>	$r[3]
		)
	);
}

echo (sizeof($results)>0) ? json_encode(array('results'=>$results)) : '[]' ;

echo isset($_GET['callback']) ? ');' : null;

mysql_close();

?>