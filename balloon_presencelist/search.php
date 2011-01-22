<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'common.php';

if ( isset($_GET['search']) )
	echo $user->search($_GET['search']);


?>