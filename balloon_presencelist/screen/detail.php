<?php
include '../common.php';

if(!isset($_SESSION['connect'])){header('Location: ../login.php');}

if( !(isset($_GET['user']) && is_numeric($_GET['user'])) ) header('Location: ../index.php'); else $user_id = $_GET['user'];
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>Detail</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <link rel="stylesheet" href="../css/jquery.mobile.css" />
    <script src="http://code.jquery.com/jquery-1.4.3.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.js"></script>

  </head>
  <body>
    <div data-role="page">
	<div data-role="header" data-theme="b"><h3>Page de detail</h3></div>
	<div data-role="content" data-theme="b">

            <div class="ui-content">
<?php 

function getRelativeTime($stime,$langue='fr') { 
    // Déduction de la date donnée à la date actuelle 
    $time = time() - $stime; 
 
    // Calcule si le temps est passé ou à venir 
    if ($time > 0) { 
		if ( $langue == 'fr' )
        	$when = "il y a"; 
		else
			$when = "ago" ;
    } else if ($time < 0) { 
		if ( $langue == 'fr' )
			$when = "dans environ"; 
		else
			$when = "in approx" ;
    } else { 
		if ( $langue == 'fr' )
			return "il y a moins d'une seconde"; 
		else
			return "less than a second ago";
    } 
    $time = abs($time); 
     
    // Tableau des unités et de leurs valeurs en secondes 
	if ( $langue == 'fr' )
		$times = array( 31104000 =>  'an{s}',       // 12 * 30 * 24 * 60 * 60 secondes 
                    2592000  =>  'mois',        // 30 * 24 * 60 * 60 secondes 
                    86400    =>  'jour{s}',     // 24 * 60 * 60 secondes 
                    3600     =>  'heure{s}',    // 60 * 60 secondes 
                    60       =>  'minute{s}',   // 60 secondes 
                    1        =>  'seconde{s}'); // 1 seconde  
	else
		$times = array( 31104000 =>  'year{s}',       // 12 * 30 * 24 * 60 * 60 secondes 
                    2592000  =>  'month{s}',        // 30 * 24 * 60 * 60 secondes 
                    86400    =>  'day{s}',     // 24 * 60 * 60 secondes 
                    3600     =>  'hour{s}',    // 60 * 60 secondes 
                    60       =>  'minute{s}',   // 60 secondes 
                    1        =>  'second{s}'); // 1 seconde
     
    foreach ($times as $seconds => $unit) { 
        // Calcule le delta entre le temps et l'unité donnée 
        $delta = round($time / $seconds); 
         
        // Si le delta est supérieur à 1 
        if ($delta >= 1) { 
            // L'unité est au singulier ou au pluriel ? 
            if ($delta == 1) { 
                $unit = str_replace('{s}', '', $unit); 
            } else { 
                $unit = str_replace('{s}', 's', $unit); 
            } 
            // Retourne la chaine adéquate 
			if ( $langue == 'fr' )
				return $when." ".$delta." ".$unit; 
			else
				return $delta." ".$unit." ".$when;
        } 
    } 
}

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

			$info = $user->getInfo($user_id);
			$what_happened = $action->get_action($user_id);
			echo '<div style="float:right;"<h2>Dernière(s) action(s)</h2>';
			foreach($what_happened as $t){
				$type = ($t['type'] == 1) ? 'CheckIn' : ( ($t['type'] == 2) ? 'Ajout et CheckIn' : 'UncheckIn' );
				echo '<b>'.$type.' '.getRelativeTime($t['time']).' par '.$hotesse->get_hotesse($t['hotesse_id']).'</b><br/>';
			}
			echo '</div>';
			echo '<img src="../images/avatar-empty.gif" style="float:left;margin-right:10px;"/><h1>'.strtoupper($info[0]['nom']).' '.ucFirst($info[0]['prenom']).'</h1><br/>'.$info[0]['other_info'];	
			
?>
                <a href="index.php" rel="external" data-role="button" data-icon="check" style="background:-moz-linear-gradient(center top , #CC0000, #CC0000) repeat scroll 0 0 #CC0000">Retour</a>
            </div>
        </div>
	<div data-role="footer" data-theme="b" style="text-align:center;">Powered by Balloon</div>
    </div>
  </body>
</html>