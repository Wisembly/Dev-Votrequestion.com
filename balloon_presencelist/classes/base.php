<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of base
 *
 * @author nicolas
 */
class Base {
    private $database;
    private $login;
    private $password;
    private $database;
    private $sql_r;

    public function __construct()
    {
        // Information base de données
        $this->database = 'localhost';
        $this->login = 'root';
        $this->password = 'root';
        $this->database = 'balloon_presencelist';
        $this->sql_r = 0;
    }
    
    public function connection()
    {
        $chaine = mysql_connect($this->database,  $this->login, $this->password) or die ('Connection impossible !!');
        mysql_selectdb($this->database,$chaine) or die('Database not find !!');
        return $chaine;
    }

    public function deconnection()
    {
        mysql_close();
    }

    //Fonction insert
    function insert($table,$champs,$valeur)
    {
            global $sql_r ;
        $query = "INSERT INTO `$table`($champs) VALUE($valeur)";
        // echo $query;
        $reponse = mysql_query($query) or die ("Impossible d'exécuter la requette d'insertion");

            if ( $reponse )
                    $sql_r++ ;

        return $reponse;
    }

    //Fonction de selection
    function select($table,$selection,$options,$orderby = NULL,$sens = NULL,$limit = NULL)
    {
        global $sql_r ;
            if(empty($selection)){$selection = "*";}
        $query = "SELECT ".$selection." FROM `".$table."`";
        if (!empty($options)){
            $query = $query."WHERE `".$options["type"]."`=".$options["id"]." ";
        }
        if (!empty($orderby)){
            $query = $query."ORDER BY ".$orderby."";
        }
        if (!empty($sens)){
            $query = $query." ".$sens." ";
        }
        if (!empty($limit)){
            $query  = $query."LIMIT ".$limit."";
        }
        // echo $query;
        $reponse = mysql_query($query) or die ("Impossible d'exécuter la requette de selection");
        $temp =array();
            $sql_r++ ;

        while($data = mysql_fetch_array($reponse))
            array_push($temp, $data);

        return $temp;
    }

    //Fonction de delete
    function delete($table,$options)
    {
        global $sql_r ;
            $query = "DELETE FROM `".$table."` WHERE `".$options["type"]."`=".$options["id"]."";
        $reponse = mysql_query($query) or die ("Impossible d'exécuter la requette de suppression");
            if ( $reponse )
                    $sql_r++ ;

            return $reponse ;
    }

    // Fonction select count
    function select_count($table,$where_clause)
    {
            global $sql_r ;
            $query = "SELECT COUNT(*) as nbre FROM `".$table."` WHERE $where_clause";
            $count = mysql_fetch_array(mysql_query($query)) or die('Erreur dans la requête select_count');
            $sql_r++ ;

            return $count['nbre'];
    }

    function show_nbre_sql()
    {
            global $sql_r ;
            return $sql_r ;
    }
}
?>
