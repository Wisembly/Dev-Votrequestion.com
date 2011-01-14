<?php
require_once 'base.php';

class Quizz
{
    public $id;
    public $nom;
    public $description;

    //Constructeur
    public function __construct() 
    {
    }

    //Liste des quizz
    function getAll()
    {
        $data  = select("quizz","","");
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
}

?>
