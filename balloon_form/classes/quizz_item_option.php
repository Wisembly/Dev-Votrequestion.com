<?php
class Quizz_Item_Option extends Quizz_Item
{
    public $id;
    public $quizz_item_id;
    public $label;

    public function __construct() 
    {
        parent::__construct();
    }

    public function addByQuizz($quizz_idem_id, $label)
    {
        $this->quizz_item_id  = $quizz_idem_id;
        $this->label = $label;
        $champs = "`id_quizz_item`,`label`";
        $valeur = "'".$this->quizz_item_id."','".$this->label."'";
        $reponse = insert("quizz_item_option",$champs,$valeur);
    }

    public function getAllByQuizzItem($quizz_item_id)
    {
        $quizz = array("type" => "id_quizz_item", "id" => $quizz_item_id);
        $data  = select("quizz_item_option","",$quizz);
        return $data;
    }
}

?>
