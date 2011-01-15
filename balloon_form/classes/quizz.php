<?php
require_once 'base.php';

class Quizz
{
    public $id;
    public $nom;
    public $description;
	private $isAdmin = false;

    //Constructeur
    public function __construct() 
    {
    }

    //Liste des quizz
    function getAll()
    {
        $data  = select("quizz","","","id DESC");
        return $data;
    }

    function find($quizz_id)
    {
        $quizz = array("type" => "id", "id" => $quizz_id);
        $data  = select("quizz","",$quizz);
        return $data;
    }

    //Ajoute un quizz
    function add()
    {
        $champs = "'nom','description'";
        $valeur = "'".$this->nom."','".$this->description."'";
        $reponse = insert("quizz",$champs,$valeur);
    }

    //Modifier un quizz
    function update()
    {

    }


    //Supprime un quizz avec ces options et reponse
    function remove()
    {

    }

	public function isAdmin()
	{
		$this->isAdmin = true;
	}
	
	//Affiche un Quizz
	public function showQuizz($byId)
	{
		// on instancie les classes nécessaires
		$classItems = new Quizz_Item();
		$classOptions = new Quizz_Item_Option();
		
		// on récupère toutes les options du quizz
		$options = $classItems->getAllByQuizz($byId);
		
		// initialisation de la variable container
		$tmp_data = '<table id="show_quizz">';
		
		// on parcours le tableau des items
		foreach ($options as $donnee_item){
		    $type_aff = $donnee_item["type"];
		    
			// on entame un nouveau tr
			$tmp_data .= '<tr><td class="col-label">'.$donnee_item["label"].'&nbsp;:&nbsp;';
			if( $donnee_item['is_required'] == 1 )
				$tmp_data .= '<span class="required">*</span>';
			$tmp_data .= '</td><td class="col-field">';

			// on détecte le type d'input et on l'affiche proprement
		    switch ($type_aff)
			{
		        case 'text':
		            $tmp_data .= '<input name="'.$donnee_item["label"].'" type="text"/>';
					break;
		        case 'textarea':
		            $tmp_data .= '<textarea name="'.$donnee_item["label"].'"></textarea>';
					break;
		        case 'select':
		            $tmp_data .= '<select name="'.$donnee_item["label"].'">';
		                $datas = $classOptions->getAllByQuizzItem($donnee_item["id"]);
		                foreach ($datas as $data)
		                    $tmp_data .= "<option value=''>".$data["label"]."</option>";
		            $tmp_data .="</select>";
					break;
		        case 'radio':
		                $datas = $classOptions->getAllByQuizzItem($donnee_item["id"]);
		                foreach ($datas as $data)
		                    $tmp_data .= $data["label"]."<input type=radio name=".$donnee_item["label"]." value=".$data["label"].">";
					break;
		        case 'checkbox':
		                $datas = $classOptions->getAllByQuizzItem($donnee_item["id"]);
		                foreach ($datas as $data)
		                    $tmp_data .= $data["label"]."<input type=checkbox name=".$donnee_item["label"]." value=".$data["label"].">";
					break;
		    }
		
			if ( $this->isAdmin )
				$tmp_data .= '</td><td><img src="../img/edit.png"/></td><td><a href ="?action=insert&id='.$_GET['id'].'&delete='.$donnee_item['id'].'"><img src="../img/delete.png"/>' ;
		    $tmp_data .= '</td></tr>';
		}
		
			$tmp_data .= '</table>';

		return $tmp_data;
	}

	function hasVoted()
	{
		
	}
}

?>
