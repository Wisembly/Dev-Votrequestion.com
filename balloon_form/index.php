<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Quizz Balloon</title>
        <?php
        require_once 'classes/quizz.php';
        require_once 'classes/quizz_item.php';
        require_once 'classes/quizz_item_option.php';
        $var = connectDB();
        ?>
    </head>
    <body>
        <?php
		if ( !isset($_GET['quizz_id']) )
		{
			// voir ce qu'on y met
		} else
		{
			$quizz_id = $_GET['quizz_id'];
			$quizz= new Quizz();
			
			
			echo $quizz->showQuizz($quizz_id);
			
		}
		
        // put your code here
        ?>
    </body>
</html>
