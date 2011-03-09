<?php 
	session_start() ;
	
	require_once('mobile_device_detect/mobile_device_detect.php');
	$mobile = mobile_device_detect(true,false,true,true,true,true,true,false,false);
	
	$dir = isset($dir) ? $dir : '' ;
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
	<link rel="shortcut icon" href="<?php echo $dir; ?>favicon.ico" />
	<link rel="stylesheet" media="all" href="<?php echo $dir; ?>css/styles.css" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
	<script src="<?php echo $dir; ?>js/script.js"></script>
	<script type="text/javascript">
		if (typeof jQuery == 'undefined'){document.write(unescape("%3Cscript src='<?php echo $dir; ?>js/jquery-1.4.4.min.js' type='text/javascript'%3E%3C/script%3E"));}
	</script>

	<?php echo isset($header)?$header:null; ?>
	<script type="text/javascript">$script("//www.google-analytics.com/ga.js",function(){var t=_gat._getTracker("UA-17949982-2");t._setDomainName("ratemyspeaker.com");t._trackPageview();});</script>
	
		<?php 
			// gestion du hack css mobile
			echo ($mobile == true) ? '<link rel="stylesheet" media="all" href="'.$dir.'css/mobile.css" /><meta content="True" name="HandheldFriendly" /><meta content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" name="viewport" />' : null;
		?>
</head>

<?php echo '<body'.($mobile ? ' onload="window.scrollTo(0, 1)"' : null).'>' ; ?>

<div class="content">

<?php
	if (!isset($_SESSION['id_user']))
	{
			echo '<div id="twitter_button_connect" ><a href="'.$dir.'inc/twitter/redirect.php"><img src="'.$dir.'img/twitter-login.png" alt="Connect to Twitter to rate your speaker" width="151" height="24"/></a></div></div>';
	}
	else
	{
		echo '<div id="twitter_button_connect" ><a href="'.$dir.'u/'.$_SESSION['pseudo_twitter_user'].'"><img width="14" height="14" src="'.$_SESSION['url_avatar_user'].'" alt="Connect to Twitter to rate your speaker" /> @'.$_SESSION['pseudo_twitter_user'].'</a> - <a href="'.$dir.'inc/twitter/clearsessions.php">Logout</a></div>';
	}
?>
		
		<a href="http://www.ratemyspeaker.com"><img class="logo" src="<?php echo $dir; ?>img/logo/logo1.png" alt="Logo RateMySpeaker" width="413" height="106"/></a>
