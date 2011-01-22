<?php
include 'common.php';

if(!isset($_SESSION['connect'])){header('Location: login.php');}

if( !(isset($_GET['user']) && is_numeric($_GET['user'])) ) header('Location: index.php'); else $user_id = $_GET['user'];
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>Detail</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <link rel="stylesheet" href="css/jquery.mobile.css" />
    <script src="http://code.jquery.com/jquery-1.4.3.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.js"></script>

  </head>
  <body>
    <div data-role="page">
	<div data-role="header" data-theme="b"><h3>Page de detail</h3></div>
	<div data-role="content" data-theme="b">

            <div class="ui-content">
<?php 

			$info = $user->getInfo($user_id);
			echo '<img src="images/avatar-empty.gif" style="float:left;margin-right:10px;"/><h1>'.strtoupper($info[0]['nom']).' '.ucFirst($info[0]['prenom']).'</h1><br/>'.$info[0]['other_info'];	
			
            $retour = $user->if_check_user($user_id);
            if($retour[0][0] == 0)
			{
                        ?>
                <a href="pages/confirm.php?user=<?php echo $user_id;?>" rel="external" data-role="button" data-icon="check" style="background:-moz-linear-gradient(center top , #006633, #006633) repeat scroll 0 0 #006633">Checkin</a>
                <?php }else{ ?>
                <a href="pages/unckeck.php?user=<?php echo $user_id;?>" rel="external" data-role="button" data-icon="check">Uncheckin</a>
                <?php }?>
                <a href="index.php" rel="external" data-role="button" data-icon="check" style="background:-moz-linear-gradient(center top , #CC0000, #CC0000) repeat scroll 0 0 #CC0000">Cancel</a>
            </div>
        </div>
	<div data-role="footer" data-theme="b">Powered by Balloon</div>
    </div>
  </body>
</html>