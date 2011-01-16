<?php

Class Answer
{
	private $answer = array();
	
	public function __construct()
	{	
	}
	
	public function hasAnswer($quizz_id,$token)
	{
		return select_count('quizz_answer',"quizz_id='$quizz_id' AND token='$token'") == 0 ? false : true ;
	}
	
	public function recupAnswer()
	{
		$quizz_item_id = '' ;
		$answer = array();
		
		// on va désormais parcourir le contenu de tout ce qui a été filé en params POST		
		while ( list($cle, $valeur) = each($_POST) ) 
		{
			$quizz_item_id = $cle ;
			$value = '' ;
			
			//--> Test si $valeur est un array -> c'est qu'on a une réponse à une checkbox
			if ( is_array($valeur) ) 
				while ( list(, $valeurArray) = each($valeur) )
					$value .= $valeurArray.';';
			else
				$value = $valeur;
			
			// on stoque dans $answer les réponses
			array_push($this->answer,array($quizz_item_id,$value));
		}

		return $this->answer;
	}

	public function registerAnswer($quizz_id,$token)
	{
				
		// on parcours l'array des réponses
		foreach ( $this->answer as $value )
			if ( is_numeric($value[0]) )
				insert('quizz_item_answer', '`quizz_id`,`quizz_item_id`,`value`', "'$quizz_id','".$value[0]."','".mysql_real_escape_string($value[1])."'");

		// maintenant qu'on a inséré toutes les réponses à tous les items, on empêche le gars de re-voter
		$reponse = insert('quizz_answer','`quizz_id`,`token`,`timestamp`',"'$quizz_id','$token','".time()."'");
	
		// on retourne le true ou false final
		return $reponse ;
	}
}

?>