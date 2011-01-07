<?php
function connectDB(){
    $var = mysql_pconnect("localhost:8889","root","root") or die("Imposible de connecter à la Base de données");
    mysql_select_db("balloon_sondage", $var) or die ("Imposible de trouver la base de données");
return $var;
}



//Fonction insert
function insert($table,$champs,$valeur){
    $query = "INSERT INTO `".$table."`(".$champs.") VALUE(".$valeur.")";
    //echo $query;die();
    $reponse = mysql_query($query) or die ("Imposible d'exécuter la requette d'insertion");
    return $reponse;
}


//Fonction de selection
function select($table,$selection,$options){
    if(empty($selection)){$selection = "*";}
    $query = "SELECT ".$selection." FROM `".$table."`";
    if (!empty($options)){
        $query = $query."WHERE `".$options["type"]."`=".$options["id"];
    }
    //echo $query;die();
    $reponse = mysql_query($query) or die ("Imposible d'exécuter la requette de selection");
    $temp =array();
    while($data = mysql_fetch_array($reponse)){
        array_push($temp, $data);
    };
    return $temp;
}
?>
