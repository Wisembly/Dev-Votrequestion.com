<?php
class Quizz_Item
{
    public $id;
    public $quizz_id;
    public $type;
    public $label;
    public $required;

    //Constructeur
    public function  __construct() 
    {

    }


    //Sauvgarde l'idem dans la base de données
    public function addByTypeAndQuizz($type, $quizz_id, $label, $required)
    {
        $this->type = $type;
        $this->quizz_id = $quizz_id;
        $this->label = $label;
        $this->required = $required;
        $champs = "`quizz_id`,`type`,`label`,`is_required`";
        $valeur = "'".$this->quizz_id."','".$this->type."','".$this->label."','".$this->required."'";
        $reponse = insert("quizz_item",$champs,$valeur);
    }

    public function getAllByQuizz($quizz_id)
    {
        $quizz = array("type" => "quizz_id", "id" => $quizz_id);
        $data  = select("quizz_item","",$quizz);
        return $data;
    }

    public function findByQuizz($quizz_id)
    {
        $quizz = array("type" => "quizz_id", "id" => $quizz_id);
        $data  = select("quizz_item","id",$quizz,"id","DESC","1");
        $lastID = $data[0]["id"];
        return $lastID;
    }

    public function delete($id)
    {
        $table = "quizz_item_option";
        $options = array("type" => "id_quizz_item", "id" => $id);
        delete($table,$options);

        $table = "quizz_item";
        $options = array("type" => "id", "id" => $id);
        delete($table,$options);
    }
}
?>
