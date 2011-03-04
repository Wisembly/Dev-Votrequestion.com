<?php

require_once 'db/mysql.php' ;

$db_host = '10.0.211.162';
$db_user = 'rms';
$db_pass = 'ball00nSXSW2011';
$db_name = 'rms';
$db_port = '';
$table_prefix = 'ratemyspeaker_';

//Construct a db instance
	$db = new $sql_db();
	
	// essai connexion à SQL Privé
	if(is_array($db->sql_connect(
							$db_host, 
							$db_user,
							$db_pass,
							$db_name, 
							$db_port,
							false, 
							false
	))) 
		die("Unable to connect to the database");