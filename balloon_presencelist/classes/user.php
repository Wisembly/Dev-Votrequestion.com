<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author nicolas
 * 
 */
class User extends Main {
    private $user_id;
    private $main_id;
    private $hotesse_id;
    private $status_id;
    private $nom;
    private $prenom;
    private $has_checked;
    private $time;
    private $nom_table;

    public function __construct()
    {
        $this->nom_table = 'presencelist_user';
        parent::__construct();
    }

    public function get_list_user()
    {
        $list_main = Base::select($this->nom_table,'','');
        return $list_main;
    }

    public function check_user($user_id)
    {
        
    }
}
?>
