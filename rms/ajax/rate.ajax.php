<?php

if (!isset($_POST['id_user']) || empty($_POST['id_user']) || !is_numeric($_POST['id_user']))
	die('Error #1');
else if (!isset($_POST['id_speaker']) || empty($_POST['id_speaker']) || !is_numeric($_POST['id_speaker']))
	die('Error #2');
else if (!isset($_POST['score']) || empty($_POST['score']) || !is_numeric($_POST['score']))
	die('Error #3');

require_once '../inc/config.php';

$id_user = $_POST['id_user'];
$id_speaker = $_POST['id_speaker'];
$score = $_POST['score'];

$count = mysql_result(mysql_query("SELECT COUNT(id) FROM ".$table_prefix."Rate WHERE id_user = ".$id_user." AND id_speaker = ".$id_speaker), 0);

if ($count == 0)
{
	mysql_query("INSERT INTO ".$table_prefix."Rate SET id_user = ".$id_user.", id_speaker = ".$id_speaker.", rate = ".$score);

	mysql_query("UPDATE ".$table_prefix."User SET nb_stars = nb_stars + ".$score.", nb_ratings = nb_ratings + 1, current_score = ((nb_stars + ".$score.")/(nb_ratings + 1)) WHERE id = ".$id_user);

	mysql_query("UPDATE ".$table_prefix."Speaker SET nb_stars = nb_stars + ".$score.", nb_ratings = nb_ratings + 1, current_score = ((nb_stars + ".$score.")/(nb_ratings + 1)) WHERE id = ".$id_speaker);
	
	require_once '../classes/profile_steps.class.php';

	$profileSteps = new ProfileSteps();

	$steps = $profileSteps->checkSteps($id_user);
	
	$steps[0] = $profileSteps->tryStep1($steps[0]);
	$steps[1] = $profileSteps->tryStep2($steps[1], $score);
	$steps[2] = $profileSteps->tryStep3($steps[2], $score);
	$steps[4] = $profileSteps->tryStep5($steps[4], $id_user);
	$steps[5] = $profileSteps->tryStep6($steps[5], $id_user);
	$steps[6] = $profileSteps->tryStep7($steps[6], $id_user);
	
	$profileSteps->setProfileSteps($steps, $id_user);
	$profileSteps->setProfileScore($steps);
}

mysql_close();

?>