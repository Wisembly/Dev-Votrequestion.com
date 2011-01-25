<?php
/* 
 * Export to XLS
 */
$form_id = $_GET['id'];


    require_once '../../classes/token.php';
    require_once '../../classes/form.php';
    require_once '../../classes/form_answer.php';
    require_once '../../classes/form_item.php';
    require_once '../../classes/form_item_option.php';
    require_once '../../classes/showAnswer.php';

	// connexion à la DB
	$var = connectDB();

	// gestion des tokens
	$token = new Token();

	// ouverture des sessions
	session_start();


$form_id = $_GET['id'];
// On recupère les données

$showAnswer = new ShowAnswer();
$datas = $showAnswer->getDataForExport($form_id);

$label_flag="";
ob_start();
echo "Questions;Réponses;\n";
foreach ($datas as $data){
    if($label_flag != $data['label'])
    {
        echo "\n\n".$data['label'];
        $label_flag = $data['label'];

    }

    echo";";
    echo $data['value'];
    echo ";\n";
}
$content = ob_get_contents();
ob_end_clean();


$f = fopen('../export/export_'.$form_id.'.csv','w');
fwrite($f, $content);
if ( fclose($f) )
{
    header('Location: ../index.php?action=open&file='.$form_id);
}
else
{
    echo 'Erreur';
}
?>
