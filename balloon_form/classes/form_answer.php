<?php

Class Answer
{
	private $answer = array();
	private $total_answers = 0 ;
	
	public function __construct()
	{	
	}
	
	// on regarde si le mec a déjà répondu au formulaire
	public function hasAnswer($form_id,$token)
	{
		return select_count('form_answer',"form_id='$form_id' AND token='$token'") == 0 ? false : true ;
	}
	
	// on récupère toutes les variables POST à la soumission d'un formulaire
	public function recupAnswer()
	{
		$form_item_id = '' ;
		$answer = array();
		
		// on va désormais parcourir le contenu de tout ce qui a été filé en params POST		
		while ( list($cle, $valeur) = each($_POST) ) 
		{
			$form_item_id = $cle ;
			$value = '' ;
			
			//--> Test si $valeur est un array -> c'est qu'on a une réponse à une checkbox
			if ( is_array($valeur) ) 
				while ( list(, $valeurArray) = each($valeur) )
					$value .= $valeurArray.';';
			else
				$value = $valeur;
			
			// on stoque dans $answer les réponses
			array_push($this->answer,array($form_item_id,$value));
		}

		return $this->answer;
	}

	// on insère dans la base et on valide les flags nécessaires
	public function registerAnswer($form_id,$token)
	{
		// on vérifie que la réponse n'exite pas déjà pour cet user (resend de formulaire par exemple)
		if ( $this->hasAnswer($form_id,$token) )
		{
			$reponse  = -1 ;
		}
		else
		{					
			// on parcours l'array des réponses
			foreach ( $this->answer as $value )
				if ( is_numeric($value[0]) && !empty($value[1]) )
					insert('form_item_answer', '`form_id`,`form_item_id`,`value`', "'$form_id','".$value[0]."','".mysql_real_escape_string($value[1])."'");

			// maintenant qu'on a inséré toutes les réponses à tous les items, on empêche le gars de re-voter
			$reponse = insert('form_answer','`form_id`,`token`,`timestamp`',"'$form_id','$token','".time()."'");
			$reponse = $reponse ? 1 : 0 ; 
		}
	
		// on retourne le true ou false final
		return $reponse ;
	}

	// on récupère toutes les réponses du formulaire
	public function getAllStats($byFormId)
	{
		$this->total_answers = select_count('form_answer',"form_id = '$byFormId'");
		
		/* To Be Continued.. */
	}
	
	public function getAllAnswersByItem($withItemId)
	{
		return select('form_item_answer','value',array('type' => 'form_item_id', 'id' => $withItemId),'timestamp','DESC');
	}
	
	public function getAllAnswersByForm($withFormId)
	{
		return select('form_item_answer','value',array('type' => 'form_id', 'id' => $withFormId),'form_item_id','ASC');
	}
}

?>