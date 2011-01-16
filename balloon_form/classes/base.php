<?php
function connectDB(){
    $var = mysql_pconnect("localhost:8889","root","root") or die("Impossible de connecter à la Base de données");
    mysql_select_db("balloon_sondage", $var) or die ("Impossible de trouver la base de données");
return $var;
}


//Fonction insert
function insert($table,$champs,$valeur){
    $query = "INSERT INTO `$table`($champs) VALUE($valeur)";
    echo $query;
    $reponse = mysql_query($query) or die ("Impossible d'exécuter la requette d'insertion");
    return $reponse;
}


//Fonction de selection
function select($table,$selection,$options,$orderby = NULL,$sens = NULL,$limit = NULL){
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
    while($data = mysql_fetch_array($reponse)){
        array_push($temp, $data);
    };
    return $temp;
}

//Fonction de delete
function delete($table,$options){
    $query = "DELETE FROM `".$table."` WHERE `".$options["type"]."`=".$options["id"]."";
    $reponse = mysql_query($query) or die ("Impossible d'exécuter la requette de suppression");
}

// Fonction select count
function select_count($table,$where_clause)
{
	$query = "SELECT COUNT(*) as nbre FROM `".$table."` WHERE $where_clause";
	$count = mysql_fetch_array(mysql_query($query)) or die('Erreur dans la requête select_count');
	
	return $count['nbre'];
}
?>
