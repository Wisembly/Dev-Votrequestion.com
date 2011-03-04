<?php

require_once '../inc/config.php';

$search = $_GET['q'];

$speakers = mysql_query("SELECT id, real_name FROM ".$table_prefix."Speaker WHERE real_name LIKE '%".$search."%' LIMIT 10");

while ($speaker = mysql_fetch_row($speakers))
	echo $speaker[1].'|'.$speaker[0]."\n";
	
?>