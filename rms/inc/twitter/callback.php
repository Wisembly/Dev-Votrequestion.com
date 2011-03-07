<?php
/**
 * @file
 * Take the user when they return from Twitter. Get access tokens.
 * Verify credentials and redirect to based on response from Twitter.
 */

/* Start session and load lib */
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');

/* If the oauth_token is old redirect to the connect page. */
if (isset($_REQUEST['oauth_token']) && $_SESSION['oauth_token'] !== $_REQUEST['oauth_token']) {
  $_SESSION['oauth_status'] = 'oldtoken';
  header('Location: ./clearsessions.php');
}

/* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

/* Request access tokens from twitter */
$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

/* Save the access tokens. Normally these would be saved in a database for future use. */
$_SESSION['access_token'] = $access_token;

/* Remove no longer needed request tokens */
unset($_SESSION['oauth_token']);
unset($_SESSION['oauth_token_secret']);

/* If HTTP response is 200 continue otherwise send to connect page to retry */
if (200 == $connection->http_code) {
  /* The user has been verified and the access tokens can be saved for future use */
  $_SESSION['status'] = 'verified';
  
	/**
	/ BALLOON
	*/
	
	if (isset($_SESSION['twitter_msg']) && isset($_SESSION['speaker_id']))
	{
		$post = $connection->post('statuses/update', array('status' => $_SESSION['twitter_msg']));
		
		header('Location: ../../index.php?page=search&id='.$_SESSION['speaker_id']);
	}
	else
	{
		require_once '../config.php';
		
		$twitterInfos = $connection->get('account/verify_credentials');
		$user = $twitterInfos->status->entities->user_mentions[0];
		
		echo var_dump($twitterInfos->status); die();
		
		$user_exist = mysql_result(mysql_query("SELECT id FROM ".$table_prefix."User WHERE id_twitter = ".$user->id), 0);
		
		if (empty($user_exist))
		{
			mysql_query("INSERT INTO ".$table_prefix."User SET 
				id_twitter = ".$user->id.",
				pseudo = '".$user->screen_name."',
				bio = '".$twitterInfos->description."',
				url_avatar = '".$twitterInfos->profile_image_url."'"
			);
			
			$_SESSION['id_user'] = mysql_insert_id();
		}
		else
			$_SESSION['id_user'] = $user_exist;
		
		$_SESSION['pseudo_twitter_user'] = $user->screen_name;
	  
		header('Location: ../../index.php');
	}
  
	/**
	/ FIN BALLOON
	*/
	
} else {
  /* Save HTTP status for error dialog on connnect page.*/
  header('Location: ./clearsessions.php');
}
