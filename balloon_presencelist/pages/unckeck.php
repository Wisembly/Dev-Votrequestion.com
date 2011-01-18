<?php
include '../common.php';
if(isset($_GET['user']))
{
    //On check l'user
    if(is_numeric($_GET['user'])){
        $user->uncheck_user($_GET['user']);

        $action->add_action($_GET['user'],time(),$_SESSION['id_hotesse'],'0');
        header('Location: ../index.php');
    }
}
?>