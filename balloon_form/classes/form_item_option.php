<?php
class Form_Item_Option extends Form_Item
{
    public $id;
    public $form_item_id;
    public $label;

    public function __construct() 
    {
        parent::__construct();
    }

    public function addByForm($form_idem_id, $label)
    {
        $this->form_item_id  = $form_idem_id;
        $this->label = $label;
        $champs = "`id_form_item`,`label`";
        $valeur = "'".$this->form_item_id."','".$this->label."'";
        $reponse = insert("form_item_option",$champs,$valeur);
    }

    public function getAllByFormItem($form_item_id)
    {
        $form = array("type" => "id_form_item", "id" => $form_item_id);
        $data  = select("form_item_option","",$form,'id','ASC');
        return $data;
    }
}

?>
