<?php
/**
 * @file
 * Clears PHP sessions and redirects to the connect page.
 */

/* Delete cookies */
setcookie("ratemyspeaker[user_id]",null,0,'/') ;
setcookie("ratemyspeaker[pseudo_twitter_user]",null,0,'/') ;
setcookie("ratemyspeaker[url_avatar_user]",null,0,'/') ;

/* Load and clear sessions */
session_start();
session_destroy();
 
/* Redirect to page with the connect to Twitter option. */
header('Location: ../../index.php');
?>