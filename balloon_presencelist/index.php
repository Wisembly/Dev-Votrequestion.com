<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'common.php';

if(isset($_POST['login']))
{
    //On vas chercher la liste des hotesses et on compare
    $list_hotesse = $hotesse->get_list_hotesse();
    foreach ($list_hotesse as $une_hotesse)
    {
        if($une_hotesse['login'] == $_POST['login'])
        {
            $_SESSION['connect'] = $_POST['login'];
            header('Location: index.php');
        }
    }
}
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
      <div id="jqm-home" class="ui-page ui-body-b ui-page-active" data-theme="b" data-role="page">
          <a href="test.html" class="ui-link-inherit" data-rel="dialog" data-inline="true">ICI</a>
<?php


if(isset($_SESSION['connect']))
    {
    ?><a href="logout.php">Logout (<?php echo $_SESSION['connect'];?>)</a> - <a href="import/index.php">Import file</a>
    <br/><div id="refrech"><a href="index.php"><input type="button" value="Rafrechir"/></a></div><?php
        //On affiche les participants
        $data = $main->get_list_main();
        echo '<u>NOM :</u> '.$data[0]['nom'];

        $list_user = $user->get_list_user();
        ?>
    <div class="ui-content">
        <ul class="ui-listview ui-listview-inset ui-corner-all ui-shadow" data-dividertheme="b" data-theme="c" data-inset="true" role="listbox">
            <li class="ui-li ui-li-divider ui-btn ui-bar-b ui-corner-top ui-btn-up-undefined" 
                data-role="list-divider" role="heading" tabindex="0">Liste des inscrits</li>
        <?php
        foreach ($list_user as $one_user)
        {

            if($one_user['has_checked'] != 0){
                ?>

            <li class="ui-btn ui-btn-icon-right ui-li ui-btn-up-c" role="option" tabindex="-1" data-theme="c">
                <div class="ui-btn-inner">
                    <div class="ui-btn-text">
                        <?php
                        echo strtoupper($one_user["nom"])."<br/>".ucfirst(strtolower($one_user["prenom"]));
                        ?>
                    </div>
                    
                </div>
                
            </li>

            <?php

            }else{
            ?>
    
        <li class="ui-btn ui-btn-icon-right ui-li ui-btn-up-c" role="option" tabindex="-1" data-theme="c">
            <div class="ui-btn-inner">
            <div class="ui-btn-text">
                <a href="index.php?user=<?php echo $one_user['id']; ?>" class="ui-link-inherit" data-rel="dialog"  >
                <?php
                echo strtoupper($one_user["nom"])."<br/>".ucfirst(strtolower($one_user["prenom"]));
                ?>
                </a>
            </div>
            <span class="ui-icon ui-icon-arrow-r"></span>
        </div>
        </li>
            <?php
            }
        }
        ?>
        </ul>
    </div>
        <?php
    }
else
    {
        //On affiche l'ecran de connexion
    ?>
<form method="post" action="index.php?action=login">
    <fieldset>
        <legend>
            Connexion à PresenceList
        </legend>
        Login : <input type="text" name="login"/>
        <br/><input type="submit"/>
    </fieldset>
</form>
    <?php
    }
?>

    
    <div style="text-align: center">Powered by Balloon</div>
      </div>
  </body>
</html>
