<?php
require_once '../common.php';
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Interface admin</title>
        <style>
            img {
                border: 0;
            }
        </style>
    </head>
    <body>
        <h2>Bienvenue dans l'administration</h2>
        <?php
            if(isset($_GET["action"])){
                $menu = $_GET["action"];
                switch ($menu){
                    case 'insert':
                        include 'pages/creer_form.php';
                        break;
                    case 'liste':
                        include 'pages/liste_form.php';
                        break;
					case 'create':
						include 'pages/new_form.php';
						break;
					case 'delete':
						include 'pages/delete_form.php';
						break;
					case 'reponses':
						include 'pages/show_reponses.php';
						break;
                    default:
                        include 'pages/liste_form.php';
                        break;
                }
            }else
                include 'pages/liste_form.php';
        ?>

        


        <?php
		echo '<br/>'.show_nbre_sql().' requête(s) SQL';
        // put your code here
        ?>
    </body>
</html>