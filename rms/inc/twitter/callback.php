<?php
session_start();

require_once "twitteroauth/twitteroauth.php";

define('CONSUMER_KEY','tsemaKilSyufnq10OEYY6Q');
define('CONSUMER_SECRET' ,'UqCHtvcFtII91MdBsSEy2g0MbDOtePPpnWWlzFGidRE');
define('OAUTH_CALLBACK', 'http://www.ratemyspeaker.com/inc/twitter/callback.php');

$isLoggedOnTwitter = false;

if (!empty($_SESSION['access_token']) && !empty($_SESSION['access_token']['oauth_token']) && !empty($_SESSION['access_token']['oauth_token_secret'])) {

// On r�cup�re les tokens, nous sommes identifi�s.
$access_token = $_SESSION['access_token'];

/* On cr�� la connexion avec Twitter en fournissant les tokens d'acc�s en param�tres.*/
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

/* On r�cup�re les informations sur le compte Twitter du visiteur */
$twitterInfos = $connection->get('account/verify_credentials');
$isLoggedOnTwitter = true;
$status = $connection->post('statuses/update', array('status', 'test'));
}

elseif(isset($_REQUEST['oauth_token']) && $_SESSION['oauth_token'] === $_REQUEST['oauth_token']) {

// Les tokens d'acc�s ne sont pas encore stock�s, il faut v�rifier l'authentification
/* On cr�� la connexion avec Twitter en fournissant les tokens d'acc�s en param�tres.*/
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

/* On v�rifie les tokens et r�cup�re le token d'acc�s */
$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

/* On stocke en session les tokens d'acc�s et on supprime ceux qui ne sont plus utiles. */
$_SESSION['access_token'] = $access_token;
unset($_SESSION['oauth_token']);
unset($_SESSION['oauth_token_secret']);

if (200 == $connection->http_code) {
$twitterInfos = $connection->get('account/verify_credentials');
$isLoggedOnTwitter = true;
$status = $connection->post('statuses/update', array('status', 'test'));
}
else {
$isLoggedOnTwitter = false;
}

}
else {
$isLoggedOnTwitter = false;
}
?>