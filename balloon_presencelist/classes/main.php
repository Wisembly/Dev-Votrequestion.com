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
    protected $nom_table_main;

    public function __construct()
    {
        $this->nom_table_main = 'presencelist_main';
        parent::__construct();
    }
 
    public function get_list_main()
    {
        $list_main = Base::select($this->nom_table_main,"","");
        return $list_main;
    }

	public function getTotal()
	{
		$total = Base::select($this->nom_table_main,'nb_participants',array('type'=>'id','id'=>1));
		return $total[0]['nb_participants'];
	}
	
	public function getArrive()
	{
		$total = Base::select($this->nom_table_main,'nb_arrive',array('type'=>'id','id'=>1));
		return $total[0]['nb_arrive'];
	}
}
?>
