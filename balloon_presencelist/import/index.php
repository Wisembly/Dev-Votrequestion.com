<?php
mysql_connect('localhost','root','root');
mysql_select_db('balloon_presencelist');
mysql_query("TRUNCATE TABLE `presencelist_user`");

$content = file_get_contents("list.txt");
$users = explode(";", $content);

$nb_users = 0 ;

foreach ($users as $user)
    {
    $data = explode(",", $user);
//echo "INSERT INTO `presencelist_user` (`presencelist_id`,`status_id`,`nom`,`prenom`)VALUE('1','1','".$data[0]."','".$data[2]."')";
    //echo "<br/>";

     mysql_query("INSERT INTO `presencelist_user`(`presencelist_id`,`status_id`,`nom`,`prenom`)VALUE('1','1','".$data[0]."','".$data[1]."')");
   
	$nb_users++ ;
    }

	mysql_query("UPDATE presencelist_main SET nb_participants = '$nb_users', nb_arrive = '0' WHERE id = '1'");
	
header('Location: ../index.php');

?>
