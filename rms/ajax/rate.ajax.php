<?php

require_once '../inc/config.php';

mysql_query("INSERT INTO ".$table_prefix."Rate SET id_user = ".$_POST['id_user'].", id_speaker = ".$_POST['id_speaker'].", rate = ".$_POST['score']);

mysql_query("UPDATE ".$table_prefix."User SET nb_stars = nb_stars + ".$_POST['score'].", nb_ratings = nb_ratings + 1, current_score = (nb_stars + ".$_POST['score']."/nb_ratings + 1) WHERE id = ".$_POST['id_user']);

mysql_query("UPDATE ".$table_prefix."Speaker SET nb_stars = nb_stars + ".$_POST['score'].", nb_ratings = nb_ratings + 1, current_score = (nb_stars + ".$_POST['score']."/nb_ratings + 1) WHERE id = ".$_POST['id_speaker']);

?>