<?php
require_once('common.php');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Form Balloon</title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.isrequired.js"></script>
    </head>
    <body>
        <?php
		if ( !isset($_GET['form_id']) )
		{
			echo 'Erreur : aucun id de formulaire renseigné';
		} 
		else if ( is_numeric($_GET['form_id']) )
		{
			$form_id = $_GET['form_id'];
			$form= new Form();
			$answer = new Answer();
			
			if ( !$form->find($form_id) )
				die('Pas de formulaire correspondant à cet id!');
				
			if ( !$form->hasItems($form_id) )
				die('Ce formulaire n\'a pas encore été paramétré!');
			
			/* on traite la réponse à un formulaire */
			// présence d'une réponse
			if ( isset($_POST['send_form']) && $_POST['send_form'] == true )
			{
				$reponse = $answer->recupAnswer();
				switch($answer->registerAnswer($form_id,$token->getToken()))
				{
					case '-1':
						echo 'Vous avez déjà envoyé votre participation pour ce formulaire';
						break;
					case '1':
						echo 'Votre participation a bien été pris en compte!';
						break;
					case '0' :
					default:	
						echo 'Une erreur est survenue, votre réponse n\'a pas été prise en compte. Veuillez contacter un administrateur.';
					break;
					
				}
			}
			else    // pas de présence de réponse 
			{
				/* on regarde si le formulaire a déjà été répondu */
				//  formulaire non répondu par cet user
//				if ( !$answer->hasAnswer($form_id,$token->getToken()) ) {
                            	if ( true ) {

					echo '<form action="index.php?form_id='.$form_id.'" method="POST">';
					echo '<input type="hidden" name="send_form" value="true"/>';
					echo $form->showForm($form_id);
					echo '<span id="showSubmit" style="display:none;"><input type="submit" value="Envoyer"/></span><span id="alert">Vous devez renseigner tous les champs obligatoires pour soumettre ce formulaire</span>';
					echo '</form>';
				}
				else    // possède une réponse de cet user
					echo 'Vous avez déjà répondu à ce formulaire!';
			}
		}
		else
			echo 'Erreur. Mauvais id de formulaire fourni.';
		
        // put your code here
		echo '<br/>'.show_nbre_sql().' requête(s) SQL';
		
        ?>
    </body>
</html>
