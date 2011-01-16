<a href="?action=liste">Retour à la liste</a><br/><br/>
<fieldset>
    <legend>Informations</legend>

<?php
	if ( !(isset($_GET['id']) && is_numeric($_GET['id'])) )
		die('Erreur');
	
	echo 'Page en construction..<br/>';
	
	$answer = new Answer();
	$reponses = $answer->getAllAnswersByForm($_GET['id']);
	foreach ( $reponses as $val )
	{
		echo $val[0].'<br/>';
	}
	
?>