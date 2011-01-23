<?php
include 'common.php';
$flag = false;

if(!isset($_SESSION['connect'])){header('Location: login.php');}

if ( isset($_POST['name']) )
{
	$nom = addslashes(strtoupper($_POST['name']));
	$prenom = addslashes(ucFirst(strtolower($_POST['prenom'])));
	$other = addslashes($_POST['other'])."<br/>AJOUT DURANT EMARGEMENT";
	
	if ( $user->add_user($nom,$prenom,$other) && $action->action_new_user($_SESSION['id_hotesse']) )
		$flag = true ;
}
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>Detail</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <link rel="stylesheet" href="css/jquery.mobile.css" />
    <script src="http://code.jquery.com/jquery-1.4.3.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.js"></script>

  </head>
  <body>
    <div data-role="page">
	<div data-role="header" data-theme="b"><h3>Ajout d'un invité</h3></div>
	<div data-role="content" data-theme="b">
            <div class="ui-content">
<?php if ( $flag ) { ?>
	
<h2>Ajout et Check In de <?php echo strtoupper($_POST['name']).' '.ucfirst(strtolower($_POST['prenom'])); ?> correctement effectué!</h2>
	<a href="index.php" rel="external" data-role="button" data-icon="check">Retour à la feuille d'émargement</a>
 
<?php    
} else {
	?>	
			<form action="ajout.php" method="post">
							<fieldset>
								<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
									<div data-role="fieldcontain">
									    <label for="name">Nom:</label>
									    <input type="text" name="name" id="name" value=""  />
									</div>

									<div data-role="fieldcontain">
									    <label for="name">Prénom:</label>
									    <input type="text" name="prenom" id="prenom" value=""  />
									</div>

									<div data-role="fieldcontain">
										<label for="textarea">Autres informations:</label>
										<textarea cols="40" rows="12" name="other" id="other"></textarea>
									</div>
									</div>
								</div>

								<button type="submit" data-theme="a" class="ui-btn-hidden" tabindex="-1">Submit</button>
							</fieldset>
						</form>
                <a href="index.php" rel="external" data-role="button" data-icon="check">Cancel</a>
<?php } ?>
			</div>
        </div>
	<div data-role="footer" data-theme="b">Powered by Balloon</div>
    </div>
  </body>
</html>