<?php

require_once 'db/mysql.php' ;
$db_host = '10.0.211.162';
$db_user = 'rms';
$db_pass = 'ball00nSXSW2011';
$db_name = 'rms';
$db_port = '';
$table_prefix = 'ratemyspeaker_';

//Construct a db instance
mysql_connect($db_host,$db_user,$db_pass);
mysql_select_db($db_name);