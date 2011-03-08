<?php
/**
 * @file
 * Clears PHP sessions and redirects to the connect page.
 */
 
/* Load and clear sessions */
session_start();
session_destroy();

/* Delete cookies */
setcookie("ratemyspeaker[user_id]") ;
setcookie("ratemyspeaker[pseudo_twitter_user]") ;
setcookie("ratemyspeaker[url_avatar_user]") ;


unset($_COOKIE['ratemyspeaker']['user_id']);
unset($_COOKIE['ratemyspeaker']['pseudo_twitter_user']);
unset($_COOKIE['ratemyspeaker']['pseudo_twitter_user']);

 
/* Redirect to page with the connect to Twitter option. */
header('Location: ../../index.php');
