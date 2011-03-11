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
	
	$steps[0] = ($steps[0] == 0) ? 1 : 0;
	$steps[1] = ($steps[1] == 0 && $score == 5) ? 1 : 0;
	$steps[2] = ($steps[2] == 0 && $score == 1) ? 1 : 0;
	$steps[4] = ($steps[4] == 0 && mysql_result(mysql_query("SELECT nb_ratings FROM ".$table_prefix."User WHERE id_user = ".$id_user), 0) >= 3) ? 1 : 0;
	$steps[5] = ($steps[5] == 0 && mysql_result(mysql_query("SELECT COUNT(DISTINCT id_conf) FROM ".$table_prefix."Rate AS R, ".$table_prefix."SpeakerInConf AS S WHERE R.id_speaker = S.id_speaker AND id_user = ".$id_user), 0) >= 3) ? 1 : 0;
	$steps[6] = ($steps[6] == 0 && mysql_result(mysql_query("SELECT COUNT(id_user) FROM ".$table_prefix."User WHERE id_user = ".$id_user." AND nb_ratings >= 10 AND current_score >= 4"), 0) > 0) ? 1 : 0;
	
	mysql_query("UPDATE ".$table_prefix."Profile_Steps SET step1 = ".$steps[0].", step2 = ".$steps[1].", step3 = ".$steps[2].", step5 = ".$steps[4].", step6 = ".$steps[5].", step7 = ".$steps[6]." WHERE id_user = ".$id_user);
	
	$profileSteps->setProfileScore($steps);
}

mysql_close();

?>