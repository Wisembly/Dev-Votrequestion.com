<?php
if(isset($_GET['action'])){
    $action = $_GET['action'];

    if(isset($_GET['edit'])){
        $item_edit = $_GET['edit'];
        if(isset($_POST[$item_edit])){
            if(isset($_POST['options'])){
                $idItem = $_GET['edit'];
                $list = explode(";", $_POST["options"]);
                $champs = 'label';
                $fio = new Form_Item_Option();
                $fio->deleteOptionForItem($idItem);
                foreach($list as $item){
                    $fio->addByForm($idItem, $item);
                }
            }
            $champs = 'label';
            $valeur = $_POST[$item_edit];

            $id = $_GET['edit'];
            $fi = new Form_Item();
            $fi->edit($id,$champs,$valeur);
            header('Location : index.php?action=insert&id='.$_GET['id']);
        }
    }


    if($action == 'insert'){
?>
<a href="?action=liste">Retour à la liste</a><br/>
<?php
    }else{
?>
<a href="?action=insert&id=<?php echo $_GET['id'];?>">Retour au formulaire</a><br/>
<?php
    }
    ?>
<fieldset>
    <legend>Informations</legend>
<?php

	if ( !(isset($_GET['id']) && is_numeric($_GET['id'])) )
		die('Erreur');
		
	$form = new Form();
	$reponse = $form->find($_GET["id"]);
	echo "<u>Nom du formulaire</u>: ".$reponse[0]["nom"]."<br/>";
	echo "<u>Description</u>: ".$reponse[0]["description"];
	$id = $reponse[0]["id"];
?>
</fieldset>
<br/>
<?php
    if($action == 'insert'){
?>
<table>
    <tr>
    <form action="?action=insert&id=<?php echo $id;?>" method="post">
        <td><button <?php if(isset ($_POST["text"])){echo 'style="background-color:coral"';}else{echo 'style="background-color:beige"';}?> name="text" type="submit">Add text</button></td>
        <td><button <?php if(isset ($_POST["select"])){echo 'style="background-color:coral"';}else{echo 'style="background-color:beige"';}?> name="select" type="submit">Add select</button></td>
        <td><button <?php if(isset ($_POST["checkbox"])){echo 'style="background-color:coral"';}else{echo 'style="background-color:beige"';}?> name="checkbox" type="submit">Add checkbox</button></td>
        <td><button <?php if(isset ($_POST["radio"])){echo 'style="background-color:coral"';}else{echo 'style="background-color:beige"';}?> name="radio" type="submit">Add radio</button></td>
        <td><button <?php if(isset ($_POST["textarea"])){echo 'style="background-color:coral"';}else{echo 'style="background-color:beige"';}?> name="textarea" type="submit">Add textarea</button></td>
    </form>
    </tr>
</table>
<?php
    }
?>
<?php
if(isset($_POST["text"])){$menu_item = "text";}
if(isset($_POST["select"])){$menu_item = "select";}
if(isset($_POST["checkbox"])){$menu_item = "checkbox";}
if(isset($_POST["radio"])){$menu_item = "radio";}
if(isset($_POST["textarea"])){$menu_item = "textarea";}

//include par rapport à index.php dans admin
$form_item = new Form_Item();
$form_item_option = new Form_Item_Option();
if(isset($menu_item)){
    switch($menu_item){
        case "text":
            include 'types/text.php';
            break;
        case "select":
            include 'types/select.php';
            break;
        case "checkbox":
            include 'types/checkbox.php';
            break;
        case "radio":
            include 'types/radio.php';
            break;
        case "textarea":
            include 'types/textarea.php';
            break;
    }
}
?>
    <hr/>
    <?php if($action == 'insert'){ echo '<u>Rendu du formulaire :</u>';} else{ echo '<u>Edition du formulaire</u>';}?>
    <br/>
    <?php
    $form_id = $_GET['id'];
    $form= new Form();
    $form->isAdmin();

    if($action == 'insert'){
        echo $form->showForm($form_id,"insert");
    }else{
        echo $form->showForm($form_id,"edit");
    }
    if(isset($_GET["delete"])){
        $form_item->delete($_GET["delete"]);
        echo "<a href='?action=insert&id=".$_GET["id"]."'>Rafraichir</a>";
    }
}
?>
