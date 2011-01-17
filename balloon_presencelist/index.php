<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
include_once 'classes/base.php';
include_once 'classes/main.php';
include_once 'classes/user.php';
include_once 'classes/hotesse.php';
include_once 'classes/status.php';

$base = new Base();
$connection = $base->connection();

$main = new Main();
$hotesse = new Hotesse();
$user = new User();
$status = new Status();

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

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>Index - PresenceList</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  </head>
  <body>
<?php


if(isset($_SESSION['connect']))
    {
    ?><a href="logout.php">Logout</a><br/><?php
        //On affiche les participants
        $data = $main->get_list_main();
        echo '<u>NOM :</u> '.$data[0]['nom'];
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
  </body>
</html>
