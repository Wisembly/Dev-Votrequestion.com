<?php
	require_once 'classes/token.php';
    require_once 'classes/quizz.php';
	require_once 'classes/quizz_answer.php';
    require_once 'classes/quizz_item.php';
    require_once 'classes/quizz_item_option.php';

	// connexion à la DB
	$var = connectDB();
	
	// gestion des tokens
	$token = new Token();
	
	// ouverture des sessions
	session_start();
?>