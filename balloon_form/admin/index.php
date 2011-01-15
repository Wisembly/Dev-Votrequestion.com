<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Interface admin</title>
        <?php
        require_once '../classes/quizz.php';
        require_once '../classes/quizz_item.php';
        require_once '../classes/quizz_item_option.php';
        $var = connectDB();
        ?>
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
                    case "insert":
                        include 'pages/creer_quizz.php';
                        break;
                    case "liste":
                        include 'pages/liste_quizz.php';
                        break;
					case "create":
						include 'pages/new_quizz.php';
						break;
                    default:
                        include 'pages/liste_quizz.php';
                        break;
                }
            }else
                include 'pages/liste_quizz.php';
        ?>

        


        <?php
        // put your code here
        ?>
    </body>
</html>