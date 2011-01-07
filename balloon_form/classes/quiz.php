<?php
require_once 'base.php';

class Quiz{
    var $id;
    var $nom;
    var $description;

    //Constructeur
    public function __construct() {
    }

    //Liste des quiz
    function list_quiz(){
        $data  = select("quiz","","");
        return $data;
    }

    function detail_quiz($quiz_id){
        $quiz = array("type" => "id", "id" => $quiz_id);
        $data  = select("quiz","",$quiz);
        return $data;
    }

    //Ajoute un quiz
    function add_quiz(){
        $champs = "'nom','description'";
        $valeur = "'".$this->nom."','".$this->description."'";
        $reponse = insert("quiz",$champs,$valeur);
    }

    //Modifier un quiz
    function edit_quiz(){

    }


    //Supprime un quiz avec ces options et reponse
    function remove_quiz(){

    }
}

?>
