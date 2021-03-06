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
	
	// if (isset($_SESSION['twitter_msg']) && isset($_SESSION['speaker_id']))
	// {
		// $post = $connection->post('statuses/update', array('status' => $_SESSION['twitter_msg']));

		// header('Location: '.$_SESSION['page_redirect_after_login']);
	// }
	// else
	// {	
		$user = $connection->get('account/verify_credentials');
		
		require_once '../config.php';
		
		$user_exist = mysql_query("SELECT id,profile_score FROM ".$table_prefix."User WHERE id_twitter = ".$user->id);
		
		if (mysql_num_rows($user_exist) == 0)
		{
			mysql_query("INSERT INTO ".$table_prefix."User SET 
				id_twitter = ".$user->id.",
				pseudo = '".$user->screen_name."',
				bio = '".$user->description."',
				url_avatar = '".$user->profile_image_url."'"
			);
			
			$new_user_id = mysql_insert_id();
			
			// on lui crée sa ligne de steps
			mysql_query("INSERT INTO ".$table_prefix."Profile_Steps SET id_user = ".$new_user_id) ;
			
			$_SESSION['id_user'] = $new_user_id;
		}
		else
		{
			$get_infos = mysql_fetch_row($user_exist);
			$_SESSION['id_user'] = $get_infos[0];
			$_SESSION['completenes'] = $get_infos[1];
		}
		
		$_SESSION['pseudo_twitter_user'] = $user->screen_name;
		$_SESSION['url_avatar_user'] = $user->profile_image_url;
	  
		header('Location: '.$_SESSION['page_redirect_after_login']);
	// }
  
	/**
	/ FIN BALLOON
	*/
	
} else {
  /* Save HTTP status for error dialog on connnect page.*/
  header('Location: ./clearsessions.php');
}
