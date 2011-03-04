<?php

require_once '../inc/config.php';

$speakers = mysql_query(search(mysql_real_escape_string($_GET['q'])));

while ($speaker = mysql_fetch_row($speakers))
	echo $speaker[1].'..'.$speaker[2].'|'.$speaker[0]."\n";

// recherche maison selon firstname && lastname
// http://stackoverflow.com/questions/4770568/sql-condition-a-b-and-c-like-d-or-a-like-b-and-c-d
function search($what)
{
	global $table_prefix;
	$table = '' ;
	$test = explode(";",strtolower($what)) ;
	
	if ( sizeof($test) == 1 || $test[1] == '' )
	{
		if( sizeof($test) > 1 )	$what = $test[0];
		$sql = "SELECT id,real_name,url_avatar FROM ".$table_prefix."Speaker WHERE (lower(firstname) LIKE  '$what%' OR lower(lastname) LIKE  '$what%') ORDER BY real_name ASC LIMIT 5";
	}
	else
	{
		$first = $test[0];
		$second = $test[1];

		$sql = "SELECT id,real_name,url_avatar FROM ".$this->nom_table." WHERE ((lower(firstname) = '$first' AND lower(lastname) LIKE '$second%') OR (lower(lastname) = '$first' AND lower(lastname) LIKE '$second%')) ORDER BY real_name ASC LIMIT 5";
	}
		
	return $sql;
}

	
?>