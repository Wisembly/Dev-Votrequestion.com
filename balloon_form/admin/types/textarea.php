<?php
    if(isset($_POST["label"])){
        $label = $_POST["label"];
        if ($label == ""){
                //gestion des erreurs
                $error = "<span style='color:red'>le champs est requis</span>";
            }else{
                //on enregistre dans la base
                $label = $_POST["label"];
                $required = $_POST["requis"];
                if(empty ($required)){$required = 0;}else{$required = 1;}
                $quiz_item->add_item_quiz("textarea",$_GET["id"],$label,$required);
                header("?action=insert&id=".$_GET["id"]);
            }
    }
?>

<fieldset>
    <legend>Textarea</legend>
<form action="" method="post">
    Label :<input name="label" type="text"/><?php echo "&nbsp;".$error;?><br/>
    Requis :<input name="requis" type="checkbox"><br/>
    <button type="submit">Ajouter</button>
    <input type="hidden" name="textarea"/>
</form>
</fieldset>