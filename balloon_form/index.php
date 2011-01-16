<?php
require_once('common.php');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Quizz Balloon</title>
    </head>
    <body>
        <?php
		if ( !isset($_GET['quizz_id']) )
		{
			echo 'Erreur : aucun id de Quizz renseigné';
		} else
		{
			$quizz_id = $_GET['quizz_id'];
			$quizz= new Quizz();
			$answer = new Answer();
			
			/* on traite la réponse à un formulaire */
			// présence d'une réponse
			if ( isset($_POST['send_form']) && $_POST['send_form'] == true )
			{
				$reponse = $answer->recupAnswer();
				if ( $answer->registerAnswer($quizz_id,$token->getToken()) )
					echo 'Votre Quizz a bien été pris en compte!';
				else
					echo 'Une erreur est survenue, votre réponse n\'a pas été prise en compte. Veuillez contacter un administrateur.';
			}
			else    // pas de présence de réponse 
			{
				/* on regarde si le formulaire a déjà été répondu */
				//  formulaire non répondu par cet user
				if ( !$answer->hasAnswer($quizz_id,$token->getToken()) ) {
					echo '<form action="index.php?quizz_id='.$quizz_id.'" method="POST"/>';
					echo '<input type="hidden" name="send_form" value="true"/>';
					echo $quizz->showQuizz($quizz_id);
					echo '<input type="submit" value="Envoyer"/>';
					echo '</form>';
				}
				else    // possède une réponse de cet user
					echo 'Vous avez déjà répondu à ce quizz!';
			}
		}
		
        // put your code here
        ?>
    </body>
</html>
