<?php 
	session_start() ;
	
	require_once('mobile_device_detect/mobile_device_detect.php');
	$mobile = mobile_device_detect(true,false,true,true,true,true,true,false,false);
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?php echo $title; ?></title>
	<meta name="description" content="<?php echo $description; ?>" /> 
	<meta name="keywords" content="<?php echo $keywords; ?>" /> 
	<meta name="author" content="Balloon" />
	<link rel="shortcut icon" href="favicon.ico" />
	<link rel="stylesheet" media="all" href="css/styles.css" />
	<link rel="stylesheet" media="all" href="css/jquery.autocomplete.css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript">
	if (typeof jQuery == 'undefined')
	{
	    document.write(unescape("%3Cscript src='js/jquery-1.4.2.min.js' type='text/javascript'%3E%3C/script%3E"));
	}
	</script>
	<script type="text/javascript" src="js/raty/jquery.raty.min.js"></script>
	<script type="text/javascript" src="js/autocomplete/jquery.autocomplete.min.js"></script>

	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-17949982-2']);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	</script>
	
		<?php 
			// gestion du hack css mobile
			echo ($mobile == true) ? '<link rel="stylesheet" media="all" href="css/mobile.css" /><meta content="True" name="HandheldFriendly" /><meta content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" name="viewport" />' : null;
		?>
</head>

<?php echo '<body'.($mobile ? ' onload="window.scrollTo(0, 1)"' : null).'>' ; ?>

<div class="content">

<?php
	if (!isset($_SESSION['id_user']))
	{
			echo '<div id="twitter_button_connect" ><a href="inc/twitter/redirect.php"><img src="img/twitter-login.png" alt="Connect to Twitter to rate your speaker" /></a></div></div>';
	}
	else
	{
		echo '<div id="twitter_button_connect" ><img width="14px" height="14px" src="'.$_SESSION['url_avatar_user'].'" /> @'.$_SESSION['pseudo_twitter_user'].' : <a href="?page=user&pseudo='.$_SESSION['pseudo_twitter_user'].'">Your profile</a></div>';
	}
?>
		
		<a href="http://www.ratemyspeaker.com"><img class="logo" src="img/logo/logo1.png"></a>