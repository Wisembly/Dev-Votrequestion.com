<?php
include '../common.php';
if(isset($_GET['user']))
{
    //On check l'user
    if(is_numeric($_GET['user'])){
        $user->check_user($_GET['user']);

        $action->add_action($_GET['user'],time(),$_SESSION['id_hotesse'],'1');
        header('Location: ../index.php');
    }
}
?>