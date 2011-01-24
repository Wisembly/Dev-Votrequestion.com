<?php
$sql_r = 0 ;

function connectDB()
{
	global $sql_r ;
    $var = mysql_pconnect("localhost:8889","root","root") or die("Impossible de connecter à la Base de données");
    mysql_select_db("balloon_form", $var) or die ("Impossible de trouver la base de données");
	mysql_query("SET NAMES 'utf8'");
	$sql_r++ ;
	return $var;
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
// table : nom de la table
// selection : * si vide, sinon spécifier un ou des champ(s)
// where : rajouter un ou des clauses where
// orderby : specifier un option pour le triage
// sens : DESC ou ASC
// limit : nombre de reponse
function select($table,$selection,$where,$orderby = NULL,$sens = NULL,$limit = NULL)
{
    global $sql_r ;
	if(empty($selection)){$selection = "*";}
    $query = "SELECT ".$selection." FROM `".$table."`";
    if (!empty($where)){
        $flag_where = 0;
        foreach($where as $_where){
            if($flag_where == 1){ $query = $query." AND ";}else{ $query = $query."WHERE ";}
            $query = $query."`".$_where["type"]."`=".$_where["id"]." ";
            $flag_where = 1;
        }
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
    //echo $query;die();
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

function update($table,$champs,$valeur,$where)
{
    global $sql_r ;
    $query = "UPDATE `$table` SET $champs = '$valeur' WHERE ".$where['id']."=".$where["value"];
    //die($query);
    $reponse = mysql_query($query) or die ("Impossible d'exécuter la requette d'update");
    if ( $reponse )
        $sql_r++ ;
        return $reponse;
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

function get_answer_item($formId)
{
    $query= "SELECT * FROM form_item_answer AS A ";
    $query.="LEFT OUTER JOIN form_item AS I ";
    $query.="ON A.form_item_id = I.id ";
    $query.="WHERE A.form_id = '".$formId."' ORDER BY A.form_item_id ASC,A.id DESC";

    //echo $query;die();
    $reponse = mysql_query($query) or die("SELECT JOINT ERROR");
    $temp =array();
	

    while($data = mysql_fetch_array($reponse))
        array_push($temp, $data);

    return $temp;
}
?>
