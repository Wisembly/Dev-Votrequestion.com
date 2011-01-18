<?php
session_start();
include_once 'classes/base.php';
include_once 'classes/main.php';
include_once 'classes/user.php';
include_once 'classes/actions.php';
include_once 'classes/hotesse.php';
include_once 'classes/status.php';


$base = new Base();
$connection = $base->connection();

$main = new Main();
$hotesse = new Hotesse();
$user = new User();
$status = new Status();
$action = new Actions();

?>
