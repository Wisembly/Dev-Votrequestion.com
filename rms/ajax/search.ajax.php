<?php

require_once '../inc/config.php';

$speakers = mysql_query(search(mysql_real_escape_string($_GET['q'])));
$count_results = 0 ;

while ($speaker = mysql_fetch_row($speakers))
{
	echo $speaker[1].'..'.((isset($_GET['q']) && substr($_GET['q'],0,1) == '#') ? 'hashtag' : $speaker[2]).'|'.$speaker[0]."\n";	
	$count_results++;
}

if (!$count_results)
	echo 'No results..none|none';


// recherche maison selon firstname && lastname
// http://stackoverflow.com/questions/4770568/sql-condition-a-b-and-c-like-d-or-a-like-b-and-c-d
function search($what)
{
	global $table_prefix;
	$table = '' ;
	$test = explode(" ",strtolower($what)) ;
	$sql2 = null ;
	
	if ( sizeof($test) == 1 || $test[1] == '')
	{
		if( sizeof($test) > 1 )	$what = $test[0];
		
		if (substr($what,0,1) == '#' )
			$sql = "SELECT id,hashtag FROM ".$table_prefix."Conference WHERE hashtag LIKE '$what%' ORDER BY hashtag ASC LIMIT 10";
		else
			$sql = "SELECT id,real_name,url_avatar FROM ".$table_prefix."Speaker WHERE (lower(firstname) LIKE  '$what%' OR lower(lastname) LIKE  '$what%') ORDER BY real_name ASC LIMIT 10";
		
	}
	else
	{
		$first = $test[0];
		$second = $test[1];

		$sql = "SELECT id,real_name,url_avatar FROM ".$table_prefix."Speaker WHERE ((lower(firstname) = '$first' AND lower(lastname) LIKE '$second%') OR (lower(lastname) = '$first' AND lower(firstname) LIKE '$second%')) ORDER BY real_name ASC LIMIT 10";
	}
		
	return $sql;
}

mysql_close();	
?>