<?php
class Form_Item
{
    public $id;
    public $form_id;
    public $type;
    public $label;
    public $required;

    //Constructeur
    public function  __construct() 
    {

    }


    //Sauvgarde l'idem dans la base de données
    public function addByTypeAndForm($type, $form_id, $label, $required)
    {
        $this->type = $type;
        $this->form_id = $form_id;
        $this->label = $label;
        $this->required = $required;
        $champs = "`form_id`,`type`,`label`,`is_required`";
        $valeur = "'".$this->form_id."','".$this->type."','".$this->label."','".$this->required."'";
        $reponse = insert("form_item",$champs,$valeur);
    }

    public function getAllByForm($form_id)
    {
        $form = array(array("type" => "form_id", "id" => $form_id));
        $data  = select("form_item","",$form,"id ASC");
        return $data;
    }

	// retourne last id du dernier item
    public function findByForm($form_id)
    {
        $form = array(array("type" => "form_id", "id" => $form_id));
        $data  = select("form_item","id",$form,"id","DESC","1");
        $lastID = $data[0]["id"];
        return $lastID;
    }

    public function delete($id)
    {
        $table = "form_item_option";
        $options = array(array("type" => "id_form_item", "id" => $id));
        delete($table,$options);

        $table = "form_item";
        $options = array(array("type" => "id", "id" => $id));
        delete($table,$options);
    }

    public function edit($id,$champs,$valeur)
    {
        $table = "form_item";
        $where = array("id" => "id", "value" => $id);
        update($table,$champs,$valeur,$where);
    }
}
?>
