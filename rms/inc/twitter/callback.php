<?php
session_start();

require_once "twitteroauth/twitteroauth.php";

define('CONSUMER_KEY','tsemaKilSyufnq10OEYY6Q');
define('CONSUMER_SECRET' ,'UqCHtvcFtII91MdBsSEy2g0MbDOtePPpnWWlzFGidRE');
define('OAUTH_CALLBACK', 'http://www.ratemyspeaker.com/inc/twitter/callback.php');

$isLoggedOnTwitter = false;

if (!empty($_SESSION['access_token']) && !empty($_SESSION['access_token']['oauth_token']) && !empty($_SESSION['access_token']['oauth_token_secret'])) {

// On récupère les tokens, nous sommes identifiés.
$access_token = $_SESSION['access_token'];

/* On créé la connexion avec Twitter en fournissant les tokens d'accès en paramètres.*/
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

/* On récupère les informations sur le compte Twitter du visiteur */
$twitterInfos = $connection->get('account/verify_credentials');
$isLoggedOnTwitter = true;
$status = $connection->post('statuses/update', array('status', 'test'));
}

elseif(isset($_REQUEST['oauth_token']) && $_SESSION['oauth_token'] === $_REQUEST['oauth_token']) {

// Les tokens d'accès ne sont pas encore stockés, il faut vérifier l'authentification
/* On créé la connexion avec Twitter en fournissant les tokens d'accès en paramètres.*/
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

/* On vérifie les tokens et récupère le token d'accès */
$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

/* On stocke en session les tokens d'accès et on supprime ceux qui ne sont plus utiles. */
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