<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of showAnswer
 *
 * @author nicolas
 */
class ShowAnswer {


    function getReponseForOneItem($item_id)
    {
        $reponse = get_answer_item($item_id);
        return $reponse;
    }

    function getListOption($item_id)
    {
        $form = array(array("type" => "id_form_item", "id" => $item_id));
        $data  = select("form_item_option","",$form);
        return $data;
    }

    function countParticipants($idForm)
    {
        $table = "form_answer";
        $nb = select_count($table,$idForm);
        return $nb;
    }
}
?>
