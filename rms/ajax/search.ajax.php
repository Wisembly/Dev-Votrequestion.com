<?php

require_once '../inc/config.php';

$search = $_GET['q'];

$speakers = mysql_query("SELECT id, real_name FROM ".$table_prefix."Speaker WHERE real_name LIKE '%".$search."%' LIMIT 10");

while ($speaker = mysql_fetch_assoc($speakers))
	echo $speaker['real_name'].'|'.$speaker['id'];
	
?>