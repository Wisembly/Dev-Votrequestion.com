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
        $list_main = Base::select($this->nom_table,'','','nom','ASC');
        return $list_main;
    }


    public function check_user($user_id)
    {
        $where = array('id'=>'id','value'=>$user_id);
        $retour = Base::update($this->nom_table,'has_checked','1',$where);
		$retour2 = Base::update2($this->nom_table_main,'nb_arrive = (nb_arrive+1)',"id = '1'");
        return $retour && $retour2;
    }

    public function uncheck_user($user_id)
    {
        $where = array('id'=>'id','value'=>$user_id);
        $retour = Base::update($this->nom_table,'has_checked','0',$where);
		$retour2 = Base::update2($this->nom_table_main,'nb_arrive = (nb_arrive-1)',"id = '1'");
        return $retour && $retour2;
    }

    public function if_check_user($user_id)
    {
        $where = array('type'=>'id','id'=>$user_id);
        $user = Base::select($this->nom_table,'has_checked',$where);
        return $user;
    }

    public function get_user_checked_order_time()
    {
        $where = array('type'=>'has_checked','id'=>'1');
        $list_main = Base::select($this->nom_table,'',$where,'time','DESC');
        return $list_main;
    }

    public function get_user_checked_order_alpha()
    {
        $where = array('type'=>'has_checked','id'=>'1');
        $list_main = Base::select($this->nom_table,'',$where,'nom','ASC');
        return $list_main;
    }

	public function getInfo($user_id)
	{
		return Base::select($this->nom_table,'',array('type'=>'id','id'=>$user_id));
	}
	
	public function search($what)
	{
		$table = '' ;
		$test = explode(";",$what) ;
		
		if ( sizeof($test) == 1 || $test[1] == '' )
		{
			if( sizeof($test) > 1 )	$what = $test[0];
			$sql = "SELECT id,nom,prenom FROM ".$this->nom_table." WHERE `nom` LIKE  '%$what%' OR `prenom` LIKE  '%$what%' AND has_checked = '0' ORDER BY nom ASC";
		}
		else
		{
			$first = $test[0];
			$second = $test[1];

			$sql = "SELECT id,nom,prenom FROM ".$this->nom_table." WHERE (`nom` = '$first' AND `prenom` LIKE '$second%') OR (`prenom` = '$first' AND `prenom` LIKE '$second%') AND has_checked = '0' ORDER BY nom ASC";
		}
			
		$table .= '<h3>Results:</h3>';
		
		$search = mysql_query($sql);
		while ( $one_user = mysql_fetch_array($search) ) {
			$table .= '<a class="iframe" href="detail.php?user='.$one_user['id'].'" data-rel="dialog"><li data-theme="c" class="ui-btn ui-btn-icon-right ui-li ui-btn-up-c">';
            $table .=  strtoupper($one_user["nom"])." ".ucfirst(strtolower($one_user["prenom"]));
            $table .= '</li></a>';
		}
		
		return $table.'<br/>';
	}
}
?>
