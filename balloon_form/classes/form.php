<?php
require_once 'base.php';

class Form
{
    public $id;
    public $nom;
    public $description;
	private $isAdmin = false;

    //Constructeur
    public function __construct() 
    {
    }

    //Liste des form
    function getAll()
    {
        $data  = select("form","","","id DESC");
        return $data;
    }

    function find($form_id)
    {
        $form = array("type" => "id", "id" => $form_id);
        $data  = select("form","",$form);
        return $data;
    }

    //Ajoute un form
    function add($nom,$description)
    {
        $champs = "nom,description";
        $valeur = "'".mysql_real_escape_string($nom)."','".mysql_real_escape_string($description)."'";
        $reponse = insert('form',$champs,$valeur);

		// on récupère désormais le tout faichement créé id de form qu'on va retourner
        $data  = select('form','id','','id','DESC','1');
        $lastID = $data[0]['id'];
        return $lastID;
    }

	// A des items?
	public function hasItems($form_id)
	{
		return select_count('form_item',"form_id = '$form_id'") == 0 ? false : true ;
	}
	
    //Modifier un form
    function update()
    {

    }


    //Supprime un form avec ses options et réponses
    function remove($form_id)
    {
		
    }

	public function isAdmin()
	{
		$this->isAdmin = true;
	}
	
	//Affiche un Form
	public function showForm($byId)
	{
		// on instancie les classes nécessaires
		$classItems = new Form_Item();
		$classOptions = new Form_Item_Option();
		
		// on récupère toutes les options du form
		$options = $classItems->getAllByForm($byId);
		
		// initialisation de la variable container
		$tmp_data = '<table id="show_form">';
		
		// compte nombre de champs
		$count = 0 ;
		
		// on parcours le tableau des items
		foreach ($options as $donnee_item){
		    $type_aff = $donnee_item["type"];
			$count++ ;
			$class_required = '' ;
		    
			// on entame un nouveau tr
			$tmp_data .= '<tr><td class="col-label">'.$donnee_item["label"].'&nbsp;:&nbsp;';
			if( $donnee_item['is_required'] == 1 ) {
				$tmp_data .= '<span class="required">*</span>';
				$class_required = 'class="isRequired"' ;
			}
			$tmp_data .= '</td><td class="col-field">';

			// on détecte le type d'input et on l'affiche proprement
		    switch ($type_aff)
			{
		        case 'text':
		            $tmp_data .= '<input name="'.$donnee_item["id"].'" type="text" '.$class_required.'/>';
					break;
		        case 'textarea':
		            $tmp_data .= '<textarea name="'.$donnee_item["id"].'" '.$class_required.'></textarea>';
					break;
		        case 'select':
		            $tmp_data .= '<select name="'.$donnee_item["id"].'">';
		                $datas = $classOptions->getAllByFormItem($donnee_item["id"]);
		                foreach ($datas as $data)
		                    $tmp_data .= "<option value='".$data["label"]."'>".$data["label"]."</option>";
		            $tmp_data .="</select>";
					break;
		        case 'radio':
						$tmp_data .= '<ul '.$class_required.'>' ;
		                $datas = $classOptions->getAllByFormItem($donnee_item["id"]);
		                foreach ($datas as $data)
		                    $tmp_data .= '<li><input type="radio" name="'.$donnee_item["id"].'" value="'.$data["label"].'">'.$data["label"].'</li>';
						$tmp_data .= '</ul>' ;
					break;
		        case 'checkbox':
						$tmp_data .= '<ul '.$class_required.'>' ;
		                $datas = $classOptions->getAllByFormItem($donnee_item["id"]);
		                foreach ($datas as $data)
		                    $tmp_data .= '<li><input type="checkbox" name="'.$donnee_item['id'].'[]" value="'.$data["label"].'" id="checkbox_'.$donnee_item["id"].'">'.$data["label"].'</li>';
						$tmp_data .= '</ul>' ;
					break;
		    }
		
			if ( $this->isAdmin )
				$tmp_data .= '</td><td><img src="../img/edit.png"/></td><td><a href ="?action=insert&id='.$_GET['id'].'&delete='.$donnee_item['id'].'"><img src="../img/delete.png"/>' ;
		    $tmp_data .= '</td></tr>';
		}
		
			$tmp_data .= '</table>';
			
		return $tmp_data;
	}


}

?>
