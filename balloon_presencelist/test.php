<?php
die();
include 'common.php';
?>

	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
	<html class="ui-mobile portrait min-width-320px min-width-480px max-width-768px max-width-1024px">
	  <head>
	    <title>Index - PresenceList</title>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	  </head>
	  <body class="ui-mobile-viewport">

<?php
ob_start();
	echo "Nom;Prénom;Type d'Invités;Société;Invitant;Présence;Heure;Commentaires;Vip;Modif;\n";
$select = mysql_query("SELECT * FROM presencelist_user AS U LEFT OUTER JOIN presencelist_action AS A ON U.id = A.user_id WHERE U.presencelist_id='1' GROUP BY U.id ORDER BY U.nom ASC, U.prenom ASC");
while ( $s = mysql_fetch_array($select) )
{
	// traitement other_info
	$replace = array("<b>Type d'Invité</b> : ","<b>Type d\'Invité</b> : ","<b>Société</b> : ","<b>Invitant</b> : ","<b>Commentaires</b> : ","<b>VIP</b> : ","<b>Modif</b> : ");
	$other = str_replace($replace,"",$s['other_info']);
	$o = explode("<br/>",$other);
	
	echo strtoupper($s['nom']);	
	echo ';';
	echo ucfirst(strtolower($s['prenom']));
	echo ';';	
	echo $o[0] ;
	echo ';';	
	echo $o[1] ;
	echo ';';	
	echo $o[2] ;
	echo ';';	
	echo ($s['has_checked'] == 1) ? 'OUI' : 'NON';
	echo ';';
	echo ($s['time'] != "") ? custom_date($s['time']) : "";
	echo ';';
	echo ($s['type'] == 2) ? 'CRÉÉ SUR PLACE '.$o[3] : ''.$o[3] ;
	echo ';';	
	echo $o[4] ;
	echo ';';
	echo $o[5];
	echo ";\n";		
}
	$content = ob_get_contents();
	ob_end_clean();
	
	$f = fopen('export.csv','w');
	fwrite($f,$content);
	if ( fclose($f) )
		echo 'Correctement Exporté';
	else
		echo 'Erreur';
?>

</body>
</html>

<?php
function custom_date ($date,$short = 0) {
	$mois = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre' );
	if ( $short == 0 )
	 	return date('d' ,$date).' '.$mois[date('n' ,$date)-1].' '.date('Y' ,$date).' à '.date('G\hi' ,$date) ;
	else if ( $short == 1 )
		return date('d' ,$date).' '.$mois[date('n' ,$date)-1].' '.date('Y' ,$date) ;
	else if ( $short == 2 )
		return date('d' ,$date).'/'.date('m' ,$date).'/'.date('Y' ,$date).' à '.date('G\hi' ,$date) ;
	else
		return date('d' ,$date).' '.$mois[date('n' ,$date)-1].' '.date('Y' ,$date) ;
		
	 	
	// date('g:i a' ,$date) //pour 15:45pm
}

?>