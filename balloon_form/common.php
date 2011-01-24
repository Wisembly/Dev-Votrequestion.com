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
?>