<?php
require_once 'base.php';

class Quiz
{
    public $id;
    public $nom;
    public $description;

    //Constructeur
    public function __construct() 
    {
    }

    //Liste des quiz
    function getAll()
    {
        $data  = select("quiz","","");
        return $data;
    }

    function find($quiz_id)
    {
        $quiz = array("type" => "id", "id" => $quiz_id);
        $data  = select("quiz","",$quiz);
        return $data;
    }

    //Ajoute un quiz
    function add()
    {
        $champs = "'nom','description'";
        $valeur = "'".$this->nom."','".$this->description."'";
        $reponse = insert("quiz",$champs,$valeur);
    }

    //Modifier un quiz
    function update()
    {

    }


    //Supprime un quiz avec ces options et reponse
    function remove()
    {

    }
}

?>
