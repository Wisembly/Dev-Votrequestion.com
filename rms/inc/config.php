<?php

$db_host = 'localhost';
$db_user = 'root';
$db_pass = 'root';
$db_name = 'ratemyspeaker';
$db_port = '';
$table_prefix = 'ratemyspeaker_';

//Construct a db instance
mysql_connect($db_host,$db_user,$db_pass);
mysql_select_db($db_name);