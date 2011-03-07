<?php session_start() ?>

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
</head>
<body>
	<div class="content">
		<a href="?index.php"><img class="logo" src="img/logo/logo1.png"></a>
		<?php
		
		if (!isset($_SESSION['id_user']))
			echo '<a href="inc/twitter/redirect.php">Connect to Twitter to rate your speaker</a>';
		else
			echo '<a href="?page=user&pseudo='.$_SESSION['pseudo_twitter_user'].'">Your profile</a>';
		
		?>