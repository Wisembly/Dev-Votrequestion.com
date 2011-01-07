<?php
class Quiz_Item_Option extends Quiz_Item{
    var $id;
    var $quiz_item_id;
    var $label;

    public function __construct() {
        parent::__construct();
    }

    public function add_item_option($quiz_idem_id,$label){
        $this->quiz_item_id  = $quiz_idem_id;
        $this->label = $label;
        $champs = "`id_quiz_item`,`label`";
        $valeur = "'".$this->quiz_item_id."','".$this->label."'";
        $reponse = insert("quiz_item_option",$champs,$valeur);
    }

    public function get_item_option($quiz_item_id){
        $quiz = array("type" => "id_quiz_item", "id" => $quiz_item_id);
        $data  = select("quiz_item_option","",$quiz);
        return $data;
    }
}

?>
