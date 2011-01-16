<?php
	if ( isset($_POST['name']) )
	{
		$form = new Form();
		$new = $form->add($_POST['name'],$_POST['desc']) ;
		if ( is_numeric($new) )
			echo 'Votre formulaire a bien été créé! Vous pouvez le paramétrer <a href="index.php?action=insert&id='.$new.'">ICI</a>';
		else
			echo 'Erreur lors de la création du formulaire';
	}
	
?>
	<a href="?action=liste">Retour à la liste</a><br/><br/>

<form action="index.php?action=create" method="POST"/>
<fieldset>
    <legend>Créer un nouveau Formulaire</legend>
	<table>
		<tr>
			<td class="col-label">Nom du Quiz</td>
			<td class="col-field">
				<input type="text" name="name" id="form_name"/>
			</td>
		</tr>
		<tr>
			<td class="col-label">Description du Quiz</td>
			<td class="col-field">
				<input type="text" name="desc" id="form_desc"/>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" value="Créer mon Quiz!"/>
			</td>
		</tr>
	</table>
</fieldset>
</form>