<?php include '../common.php';?>
<!--<script type="text/javascript">
        var refresh = 10;
        var count = 10 ;
        var refreshId = setInterval(function()
        {
//             $('#myContent').load('index.php #myContent');
                $.get("reload.php", function(data){
                    $("#myContent").html(data);
                });
        }, refresh*1000);
        var refreshCount = setInterval(function()
        {
            if ( count != 0 )
                count--;
            else
                count = refresh;
             $('#responsecount b').html(count);
        }, 1*1000);
    </script>-->




<html>
  <head>
    <title>Index - PresenceList</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.css" />
    <script src="http://code.jquery.com/jquery-1.4.3.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.js"></script>

    

  </head>
  <body onload="window.scrollTo(0, 1)">
      
      
      <div data-role="page">
	<div data-role="header" data-theme="c"><h3>Liste des inscrits - <?php

		$active = array('','');
        if(isset($_GET['type']))
            {
                $type = $_GET['type'];
                switch($type)
                {
                    case 'al':
                        echo "Ordre d'arrivée";
                        $donnees = $user->get_user_checked_order_time();
						$active[0] = 'class="ui-btn-active"' ;
                        break;
                    case 'ar':
                        echo "Ordre d'alphabétique";
                        $donnees= $user->get_user_checked_order_alpha();
						$active[1] = 'class="ui-btn-active"' ;
                        break;

                }
            }
        else{ echo "Ordre d'alphabétique";$donnees = $user->get_user_checked_order_alpha(); $active[0] = 'class="ui-btn-active"' ;}?></h3>
        <a href="index.php?type=<?php echo $type; ?>" rel="external" data-icon="gear"><div id="responsecount">Rafraichir la liste</div></a>
        </div>
	<div data-role="content" data-theme="c">

            

                <ul data-filter="false" data-role="listview" class="ui-listview" role="listbox">
       
<div id="myContent">
    <?php //include 'reload.php';


    

foreach ($donnees as $donnee)
    {
        $current_letter ='';

    $first_letter = substr($donnee['nom'],0,1);
                 if($first_letter != $current_letter)
                     {
                     $current_letter = $first_letter;

                     if($type == 'ar'){
                     ?>
             <li data-theme="a" data-role="list-divider" class="ui-btn ui-btn-icon-right ui-li ui-btn-up-a"><?php echo strtoupper($first_letter);?></li>
                    <?php
                     }
                     }
                       ?>


            <li data-theme="c" data-inset="true" class="ui-btn ui-btn-icon-right ui-li ui-btn-up-c">
                <a href="#" class="ui-link-inherit">
                    <?php
                    echo strtoupper($donnee["nom"])." ".ucfirst(strtolower($donnee["prenom"]));
                    ?>
                </a>
            </li>



    <?php
    }


?>


</div>
        
                </ul>
                





        </div>
	<div data-role="footer" data-id="foo1" data-position="fixed">
            <div data-role="navbar">
			<ul>
				<li><a href="index.php?type=al" rel="external" <?php echo $active[0]; ?>>Ordre d'arrivée</a></li>
				<li><a href="index.php?type=ar" rel="external" <?php echo $active[1]; ?>>Ordre alphabétique</a></li>
			</ul>
		</div>
        </div>
    </div>

      <!--<div style="position: absolute;z-index: 100;background-color: #2489CE">
      <div id="responsecount">Refresh dans <b></b> secondes</div>
      </div>-->
  </body>
</html>