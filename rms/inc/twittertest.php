<?php

/* Load required lib files. */
session_start();
require_once('twitter/twitteroauth/twitteroauth.php');
require_once('twitter/config.php');

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
echo "<!-- Current API hits remaining: {$content->remaining_hits}.-->";

/* Get logged in user to help with tests. */
$connection->get('account/verify_credentials');

/**
/* BALLOON
**/

$tweets = $connection->get('statuses/user_timeline');

for ($i = 0; $i < 100; $i++)
{
	if (stristr($tweets[0]->text, '#ratemyspeaker') !== false)
	{
		// on passe à 1 ce qu'il faut
		mysql_query("UPDATE ".$table_prefix."Profile_Steps SET step4 = 1 WHERE id_user = ".$_SESSION['id_user']);
		
		// on maj ici score	
		mysql_query("UPDATE ".$table_prefix."User SET profile_score = (profile_score + ".$profile_steps->value_steps[4]." ) WHERE id = ".$_SESSION['id_user'])or die(mysql_error());
		
		break;
	}
}

/**
/* FIN BALLOON
**/

?>