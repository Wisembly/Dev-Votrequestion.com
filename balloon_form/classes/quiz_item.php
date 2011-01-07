<?php
class Quiz_Item{
    var $id;
    var $quiz_id;
    var $type;
    var $label;
    var $required;

    //Constructeur
    public function  __construct() {

    }


    //Sauvgarde l'idem dans la base de données
    public function add_item_quiz($type,$quiz_id,$label,$required){
        $this->type = $type;
        $this->quiz_id = $quiz_id;
        $this->label = $label;
        $this->required = $required;
        $champs = "`quiz_id`,`type`,`label`,`is_requiried`";
        $valeur = "'".$this->quiz_id."','".$this->type."','".$this->label."','".$this->required."'";
        $reponse = insert("quiz_item",$champs,$valeur);
    }

    public function list_item_quiz($quiz_id){
        $quiz = array("type" => "quiz_id", "id" => $quiz_id);
        $data  = select("quiz_item","",$quiz);
        return $data;
    }

    public function get_id_for_quiz($quiz_id){
        $quiz = array("type" => "quiz_id", "id" => $quiz_id);
        $data  = select("quiz_item","id",$quiz,"id","DESC","1");
        $lastID = $data[0]["id"];
        return $lastID;
    }

    public function delete_element($id){
        $table = "quiz_item_option";
        $options = array("type" => "id_quiz_item", "id" => $id);
        delete($table,$options);

        $table = "quiz_item";
        $options = array("type" => "id", "id" => $id);
        delete($table,$options);
    }
}
?>
