<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'common.php';

if(!isset($_SESSION['connect'])){header('Location: login.php');}

if(isset($_GET['user']) && isset($_SESSION['connect'])  )
{
    //On check l'user
    if(is_numeric($_GET['user'])){
        $user->check_user($_GET['user']);
    }
    header('Location: index.php');
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html class="ui-mobile portrait min-width-320px min-width-480px max-width-768px max-width-1024px">
  <head>
    <title>Index - PresenceList</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!--<link rel="stylesheet" type="text/css" href="css/jquery.mobile-1.0a2.min.css">
    <script type="text/javascript" src="javascript/jquery.mobile-1.0a2.min.js"></script>
    <script type="text/javascript" src="javascript/jquery.js"></script>-->

    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.css" />
    <script src="http://code.jquery.com/jquery-1.4.3.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.js"></script>

  </head>
  <body class="ui-mobile-viewport">
       <div data-role="page">
	<div data-role="header" data-theme="b" data-nobackbtn="true">
            <?php
            $data = $main->get_list_main();
            ?>
            <h3>Checking list - <?php echo $data[0]['nom'];?></h3>
            <a href="index.php" data-icon="gear">Rafraichir</a>
            <a href="import/index.php" data-icon="gear" class="ui-btn-right" style="margin-right:140px;">Import file</a>
            <a href="logout.php" data-icon="gear" class="ui-btn-right">Logout (<?php echo $_SESSION['connect'];?>)</a>
        </div>
	<div data-role="content" data-theme="b">
         <?php
         //recuperation des donnees
         $list_user = $user->get_list_user();
         ?>
         <ul data-filter="true" data-role="listview" class="ui-listview" role="listbox">
             <?php
             foreach ($list_user as $one_user)
                {
             ?>

            <li role="option" data-role="list-divider" tabindex="0" data-theme="c" class="ui-btn ui-btn-icon-right ui-li ui-btn-up-c" style="display: block;">
                <div class="ui-btn-text">
                    <a href="detail.php?user=<?php echo $one_user['id']; ?>" data-rel="dialog" class="ui-link-inherit">
                        <?php echo strtoupper($one_user["nom"])." ".ucfirst(strtolower($one_user["prenom"]));?>
                    </a>
                </div>
             </li>
             
             <?php 
             }
             ?>
	</ul>
        </div>
	<div data-role="footer" data-theme="b">Powered by Balloon</div>
    </div>
  </body>
</html>
