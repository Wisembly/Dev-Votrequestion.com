<a href="?action=liste">Retour à la liste</a><br/>
<fieldset>
    <legend>Informations</legend>
<?php
        $quiz = new Quiz();
        $reponse = $quiz->detail_quiz($_GET["id"]);
        echo "<u>Nom du quizz</u>: ".$reponse[0]["nom"]."<br/>";
        echo "<u>Description</u>: ".$reponse[0]["description"];
        $id = $reponse[0]["id"];
?>
</fieldset>
<br/>
<table>
    <tr>
    <form action="?action=insert&id=<?php echo $id;?>" method="post">
        <td><button name="text" type="submit">Add text</button></td>
        <td><button name="select" type="submit">Add select</button></td>
        <td><button name="checkbox" type="submit">Add checkbox</button></td>
        <td><button name="radio" type="submit">Add radio</button></td>
        <td><button name="textarea" type="submit">Add textarea</button></td>
    </form>
    </tr>
</table>

<?php
if(isset($_POST["text"])){$menu_item = "text";}
if(isset($_POST["select"])){$menu_item = "select";}
if(isset($_POST["checkbox"])){$menu_item = "checkbox";}
if(isset($_POST["radio"])){$menu_item = "radio";}
if(isset($_POST["textarea"])){$menu_item = "textarea";}

//include par rapport à index.php dans admin
$quiz_item = new Quiz_Item();
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
<u>Rendu du formulaire :</u><br/>
<?php
$donnees_item = $quiz_item->list_item_quiz($_GET["id"]);
foreach ($donnees_item as $donnee_item){
    $type_aff = $donnee_item["type"];
    switch ($type_aff){
        case 'text':
            echo $donnee_item["label"]."&nbsp;:&nbsp;<input name='".$donnee_item["label"]."' type='text'/>";
            if($donnee_item["is_requiried"] == 1){echo "<span style='color:red'>*</span>";}
            echo"<br/>";
            break;
    }
}
?>
