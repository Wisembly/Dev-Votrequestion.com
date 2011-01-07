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
        <td><button <?php if(isset ($_POST["text"])){echo 'style="background-color:coral"';}else{echo 'style="background-color:beige"';}?> name="text" type="submit">Add text</button></td>
        <td><button <?php if(isset ($_POST["select"])){echo 'style="background-color:coral"';}else{echo 'style="background-color:beige"';}?> name="select" type="submit">Add select</button></td>
        <td><button <?php if(isset ($_POST["checkbox"])){echo 'style="background-color:coral"';}else{echo 'style="background-color:beige"';}?> name="checkbox" type="submit">Add checkbox</button></td>
        <td><button <?php if(isset ($_POST["radio"])){echo 'style="background-color:coral"';}else{echo 'style="background-color:beige"';}?> name="radio" type="submit">Add radio</button></td>
        <td><button <?php if(isset ($_POST["textarea"])){echo 'style="background-color:coral"';}else{echo 'style="background-color:beige"';}?> name="textarea" type="submit">Add textarea</button></td>
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
$quiz_item_option = new Quiz_Item_Option();
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
<table>
<?php
$donnees_item = $quiz_item->list_item_quiz($_GET["id"]);
foreach ($donnees_item as $donnee_item){
    $type_aff = $donnee_item["type"];
    switch ($type_aff){
        case 'text':
            echo "<tr><td>";
            echo $donnee_item["label"]."&nbsp;:&nbsp;</td><td><input name='".$donnee_item["label"]."' type='text'/>";
            if($donnee_item["is_requiried"] == 1){echo "<span style='color:red'>*</span>";}
            echo "</td><td><img src='../img/edit.png' /></td>";
            echo "<td><a href ='?action=insert&id=".$_GET["id"]."&delete=".$donnee_item["id"]."'><img src='../img/delete.png'/></td><tr></a>";
            break;
        case 'textarea':
            echo "<tr><td>";
            echo $donnee_item["label"]."&nbsp;:&nbsp;</td><td><textarea name='".$donnee_item["label"]."'></textarea>";
            if($donnee_item["is_requiried"] == 1){echo "<span style='color:red'>*</span>";}
            echo "</td><td><img src='../img/edit.png' /></td>";
            echo "<td><a href ='?action=insert&id=".$_GET["id"]."&delete=".$donnee_item["id"]."'><img src='../img/delete.png'/></td><tr></a>";
            break;
        case 'select':
            echo "<tr><td>";
            echo $donnee_item["label"]."&nbsp;:&nbsp;</td><td>
            <select name='".$donnee_item["label"]."'>";
                $datas = $quiz_item_option->get_item_option($donnee_item["id"]);
                foreach ($datas as $data){
                    echo "<option value=''>".$data["label"]."</option>";
                }
            echo"</select>";
            if($donnee_item["is_requiried"] == 1){echo "<span style='color:red'>*</span>";}
            echo "</td><td><img src='../img/edit.png' /></td>";
            echo "<td><a href ='?action=insert&id=".$_GET["id"]."&delete=".$donnee_item["id"]."'><img src='../img/delete.png'/></td><tr></a>";
            break;
        case 'radio':
            echo "<tr><td>";
            echo $donnee_item["label"]."&nbsp;:&nbsp;</td><td>";
                $datas = $quiz_item_option->get_item_option($donnee_item["id"]);
                foreach ($datas as $data){
                    echo $data["label"]."<input type=radio name=".$donnee_item["label"]." value=".$data["label"]."><br/>";
                }
            if($donnee_item["is_requiried"] == 1){echo "<span style='color:red'>*</span>";}
            echo "</td><td><img src='../img/edit.png' /></td>";
            echo "<td><a href ='?action=insert&id=".$_GET["id"]."&delete=".$donnee_item["id"]."'><img src='../img/delete.png'/></td><tr></a>";
            break;
        case 'checkbox':
            echo "<tr><td>";
            echo $donnee_item["label"]."&nbsp;:&nbsp;</td><td>";
                $datas = $quiz_item_option->get_item_option($donnee_item["id"]);
                foreach ($datas as $data){
                    echo $data["label"]."<input type=checkbox name=".$donnee_item["label"]." value=".$data["label"]."><br/>";
                }
            if($donnee_item["is_requiried"] == 1){echo "<span style='color:red'>*</span>";}
            echo "</td><td><img src='../img/edit.png' /></td>";
            echo "<td><a href ='?action=insert&id=".$_GET["id"]."&delete=".$donnee_item["id"]."'><img src='../img/delete.png'/></td><tr></a>";
            break;

    }
}
?>
</table>


<?php
if(isset($_GET["delete"])){

    $quiz_item->delete_element($_GET["delete"]);
    echo "<a href='?action=insert&id=".$_GET["id"]."'>Rafrechir</a>";
}
?>
