<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Interface admin</title>
        <?php
        require_once '../classes/quiz.php';
        require_once '../classes/quiz_item.php';
        $var = connectDB();
        ?>
    </head>
    <body>
        <h2>Bienvenue dans l'administration</h2>
        <?php
            if(isset($_GET["action"])){
                $menu = $_GET["action"];
                switch ($menu){
                    case "insert":
                        include 'pages/creer_quiz.php';
                        break;
                    case "liste":
                        include 'pages/liste_quiz.php';
                        break;
                    default:
                        include 'pages/liste_quiz.php';
                        break;
                }
            }else{
                include 'pages/liste_quiz.php';
            }
        ?>

        


        <?php
        // put your code here
        ?>
    </body>
</html>