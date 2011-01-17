<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of hotesse
 *
 * @author nicolas
 */
class Hotesse extends User {
    private $id_hotesse;
    private $login;
    private $real_name;
    private $nom_base;

    public function __construct()
    {
        parent::__construct();
        $this->nom_base = 'presencelist_hotesse';
    }

    public function get_list_hotesse()
    {
        $list_main = Base::select($this->nom_base,"","");
        return $list_main;
    }
}
?>
