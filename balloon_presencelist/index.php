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
    <link rel="stylesheet" href="css/jquery.mobile.css" />
	<link rel="stylesheet" href="css/style.css"/>	

	
	<script type="text/javascript" src="javascript/jquery.js"></script>
	<script type="text/javascript" src="javascript/js.js"></script>
  </head>
  <body class="ui-mobile-viewport">
	<a name="search"></a>
	<div id="alphabet"><ul id="alphabet">
<?php	

	$a = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	foreach ( $a as $a )
		echo '<li><a href="#'.$a.'">'.$a.'</a></li>';
?>	
	</ul>
	</div>
	<a id="ajout" href="ajout.php" class="ui-btn ui-btn-icon-left ui-btn-corner-all ui-shadow ui-btn-up-b">Ajouter un Invité non présent dans la liste</a>
	<h2 style="float:right;margin-right:2em;">
	<?php echo $main->getArrive().' arrivés sur '.$main->getTotal().' attendus'; ?>
	</h2>
       <div data-role="page">
	<div data-role="header" data-theme="b" data-nobackbtn="true">
            <?php
            $data = $main->get_list_main();
            ?>
            <!--<a href="index.php" rel="external" data-icon="gear">Rafraichir</a>
            <a href="import/index.php" rel="external" data-icon="gear" class="ui-btn-right" style="margin-right:140px;">Import file</a>
            <a href="logout.php" rel="external" data-icon="gear" class="ui-btn-right">Logout (<?php echo $_SESSION['connect'];?>)</a>-->
			
				<div class="ui-field-contain ui-body ui-br" data-role="fieldcontain">
                    <label class="ui-input-text" for="name">Search:</label>
                    <input style="width: 100%" class="ui-input-text ui-body-null ui-corner-all ui-shadow-inset ui-body-c" type="text" name="name" id="search" value=""  />
                </div>
			
			<div id="results_search"></div>
        </div>



	<div id="content" data-role="content" data-theme="b">
         <?php
         //recuperation des donnees
         $list_user = $user->get_list_user();
         ?>
         <ul data-filter="true" data-role="listview" class="ui-listview" role="listbox">
             <?php
             $current_letter ='';
             foreach ($list_user as $one_user)
             {
             
                 $first_letter = strtoupper($one_user['nom'][0]);
                 if($first_letter != $current_letter)
                 {
                     $current_letter = $first_letter;
                     ?><a name="<?php echo strtoupper($first_letter);?>"></a>
             <li data-theme="a" data-role="list-divider" class="ui-btn list-divider ui-btn-icon-right ui-li ui-btn-up-a"><b><?php echo strtoupper($current_letter);?></b><a class="top" href="#search">Top</a></li>
                    <?php
                 }
                 ?>



            
                    <?php
                    if($one_user['has_checked'] != 0){
                        echo '<a class="iframe" href="detail.php?user='.$one_user['id'].'" data-rel="dialog"><li data-theme="e" class="ui-btn ui-btn-icon-right ui-li ui-btn-up-e"><s>';
                        echo strtoupper($one_user["nom"])." ".ucfirst(strtolower($one_user["prenom"]));
                        echo '</s></li></a>';
                    }
                    else{ ?>
                    
                    <a href="detail.php?user=<?php echo $one_user['id']; ?>" data-rel="dialog" class="iframe"><li data-theme="c" class="ui-btn ui-btn-icon-right ui-li ui-btn-up-c">
                        <?php echo strtoupper($one_user["nom"])." ".ucfirst(strtolower($one_user["prenom"]));?>
                    </li></a>
                    
                    <?php }?>
             
             
             <?php 
             }
             ?>
	</ul>
        </div>
	<div data-role="footer" data-theme="b">Powered by Balloon</div>
    </div>
  </body>
</html>
