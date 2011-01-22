<?php
$bi = array("super;star",'coucou;','cocu');

foreach($bi as $what){
$test = explode(";",$what) ;

if ( sizeof($test) == 1 || $test[1] == '' )
{
	if( sizeof($test) > 1 )	$what = substr($what,0,strpos(';')-1);
	$sql = "SELECT id,nom,prenom FROM pouet WHERE `nom` LIKE  '%$what%' OR `prenom` LIKE  '%$what%' AND has_checked = '0' ORDER BY nom ASC";
}
else
{
	$first = $test[0];
	$second = $test[1];

	$sql = "SELECT id,nom,prenom FROM poeut WHERE `nom` LIKE  '%$first%' OR `prenom` LIKE  '%$first%' OR `nom` LIKE  '%$second%' OR `prenom` LIKE  '%$second%' AND has_checked = '0' ORDER BY nom ASC";
}

	echo $sql.'<br/><br/>';

}
?>