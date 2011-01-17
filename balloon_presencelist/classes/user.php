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
    private $id_user;
    private $main_id;
    private $hotesse_id;
    private $status_id;
    private $nom;
    private $prenom;
    private $has_checked;
    private $time;

    public function __construct()
    {
        parent::__construct();
    }

    public function get_list_user()
    {
        
    }
}
?>
