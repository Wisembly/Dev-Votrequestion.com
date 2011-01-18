<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of actions
 *
 * @author nicolas
 */
class Actions extends User {
    private $action_id;
    private $user_id;
    private $time;
    private $hotesse_id;
    private $type;
    private $nom_table;

    public function __construct() {
        $this->nom_table = 'presencelist_action';
        parent::__construct();
    }

    public function add_action($user_id,$time,$hotesse_id,$type)
    {
        $this->user_id = $user_id;
        $this->time = $time;
        $this->hotesse_id = $hotesse_id;
        $this->type = $type;
        $champs = "`user_id`,`time`,`hotesse_id`,`type`";
        $valeur = "'".$this->user_id."','".$this->time."','".$this->hotesse_id."','".$this->type."'";
        Base::insert($this->nom_table,$champs,$valeur);
    }

    public function get_action($user_id)
    {
        $where = array('type'=>'user_id','id'=>$user_id);
        $reponse = Base::select($this->nom_table,'',$where);
        return $reponse;
    }
}
?>
