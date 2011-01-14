<?php
$option_type ="select";

    if(isset($_POST["label"])){
        $label = $_POST["label"];
        $options = $_POST["options"];
        if ($label == "" && $options == ""){
                //gestion des erreurs
                if($label == ""){$error1 = "<span style='color:red'>le champs est requis</span>";}
                if($options == ""){$error2 = "<span style='color:red'>ajouter au moins une option</span>";}
            }else{
                //on enregistre dans la base
                $label = $_POST["label"];
                $required = $_POST["requis"];
                if(empty ($required)){$required = 0;}else{$required = 1;}
                $quizz_item->addByTypeAndQuizz($option_type,$_GET["id"],$label,$required);
                $last_id = $quizz_item->findByQuizz($_GET["id"]);

                $list_option = array();
                $list_option = split(';',$options);

                foreach ($list_option as $option){
                    $quizz_item_option->addByQuizz($last_id,$option);
                }


                header("?action=insert&id=".$_GET["id"]);
            }
    }
?>

<fieldset>
    <legend><?php echo ucfirst($option_type);?></legend>
<form action="" method="post">
    Label :<input name="label" type="text"/><?php echo "&nbsp;".$error1;?><br/>
    Options :<input name="options" type="text"/><?php echo "&nbsp;".$error2;?><br/>
    Requis :<input name="requis" type="checkbox"><br/>
    <button type="submit">Ajouter</button>
    <input type="hidden" name="<?php echo $option_type;?>"/><br/>
    <span><b>Astuce :</b> Séparer les options avec des ;</span>
</form>
</fieldset>
