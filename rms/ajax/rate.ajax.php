<?php

require_once '../inc/config.php';

mysql_query("INSERT INTO ".$table_prefix."Rate SET id_speaker = ".$_POST['speaker_id'].", rate = ".$_POST['score']);

echo "INSERT INTO ".$table_prefix."Rate SET id_speaker = ".$_POST['speaker_id'].", rate = ".$_POST['score'];

?>