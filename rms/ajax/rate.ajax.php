<?php

require_once '../inc/config.php';

$count = mysql_result(mysql_query("SELECT COUNT(id) FROM ".$table_prefix."Rate WHERE id_user = ".$_POST['id_user']." AND id_speaker = ".$_POST['id_speaker']), 0);

if ($count == 0) {
	mysql_query("INSERT INTO ".$table_prefix."Rate SET id_user = ".$_POST['id_user'].", id_speaker = ".$_POST['id_speaker'].", rate = ".$_POST['score']);

	mysql_query("UPDATE ".$table_prefix."User SET nb_stars = nb_stars + ".$_POST['score'].", nb_ratings = nb_ratings + 1, current_score = ((nb_stars + ".$_POST['score'].")/(nb_ratings + 1)) WHERE id = ".$_POST['id_user']);

	mysql_query("UPDATE ".$table_prefix."Speaker SET nb_stars = nb_stars + ".$_POST['score'].", nb_ratings = nb_ratings + 1, current_score = ((nb_stars + ".$_POST['score'].")/(nb_ratings + 1)) WHERE id = ".$_POST['id_speaker']);
}
	
?>