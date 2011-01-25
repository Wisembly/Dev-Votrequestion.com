<?php
	require_once 'classes/token.php';
    require_once 'classes/form.php';
	require_once 'classes/form_answer.php';
    require_once 'classes/form_item.php';
    require_once 'classes/form_item_option.php';
    require_once 'classes/showAnswer.php';

	// connexion à la DB
	$var = connectDB();
	
	// gestion des tokens
	$token = new Token();
	
	// ouverture des sessions
	session_start();

        // Chaine = custom_date( TimeStamp )
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
        }
?>