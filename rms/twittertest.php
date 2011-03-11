<?php

/* Load required lib files. */
session_start();
require_once('inc/twitter/twitteroauth/twitteroauth.php');
require_once('inc/twitter/config.php');

/* If access tokens are not available redirect to connect page. */
if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
    header('Location: ./clearsessions.php');
}
/* Get user access tokens out of the session. */
$access_token = $_SESSION['access_token'];

/* Create a TwitterOauth object with consumer/user tokens. */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

/* If method is set change API call made. Test is called by default. */
$content = $connection->get('account/rate_limit_status');
echo "Current API hits remaining: {$content->remaining_hits}.";

/* Get logged in user to help with tests. */
$user = $connection->get('account/verify_credentials');

/**
/* BALLOON
**/

$tweets = $connection->get('statuses/user_timeline');

for ($i = 0; $i < 100; $i++)
{
	if (stristr($tweets[0]->text, '#ratemyspeaker') !== false)
	{
		$profileSteps->tryStep4($_SESSION['id_user']);
		break;
	}
}

/**
/* FIN BALLOON
**/

?>