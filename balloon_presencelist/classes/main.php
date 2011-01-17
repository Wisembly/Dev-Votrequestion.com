<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of main
 *
 * @author nicolas
 * 
 */
class Main extends Base {
    private $id_main;
    private $nb_participants;
    private $nb_arrive;
    private $nom;
    private $description;
    private $nom_base;

    public function __construct()
    {
        $this->nom_base = 'presencelist_main';
        parent::__construct();
    }
 
    public function get_list_main()
    {
        $list_main = Base::select($this->nom_base,"","");
        return $list_main;
    }
}
?>
