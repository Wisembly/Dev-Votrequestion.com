<?php
session_start();

require_once "twitteroauth/twitteroauth.php";

define('CONSUMER_KEY','WvboHLGiSoe8KexuwH88A');
define('CONSUMER_SECRET' ,'V7Z3rTcfsOPAA7aCtbt26FPkCVc0hdtIHIqK0mGTA');
define("OAUTH_CALLBACK", "http://www.shoesnextdoor.com/tweet/callback.php");

$isLoggedOnTwitter = false;

if (!empty($_SESSION['access_token']) && !empty($_SESSION['access_token']['oauth_token']) && !empty($_SESSION['access_token']['oauth_token_secret'])) {

// On r�cup�re les tokens, nous sommes identifi�s.
$access_token = $_SESSION['access_token'];

/* On cr�� la connexion avec Twitter en fournissant les tokens d'acc�s en param�tres.*/
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

/* On r�cup�re les informations sur le compte Twitter du visiteur */
$twitterInfos = $connection->get('account/verify_credentials');
$isLoggedOnTwitter = true;
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
$post = $connection->post('statuses/update', array('status' => 'coucou'));
echo var_dump($post);
}
else {
$isLoggedOnTwitter = false;
}

}
else {
$isLoggedOnTwitter = false;
}

function postToMyTwitter($message){

require_once "twitteroauth/twitteroauth.php";

echo $token = $access_token['oauth_token'];
echo $token_secret = $access_token['oauth_token_secret'];
echo $token;

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $token, $token_secret);
$twitterInfos = $connection->get('account/verify_credentials'); 

if (200 == $connection->http_code) {
$parameters = array('status' => $message);
$status = $connection->post('statuses/update', $parameters);
}
}

postToMyTwitter('Bonjour tout le monde !');
?>