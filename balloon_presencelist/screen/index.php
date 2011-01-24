<?php include '../common.php';?>
<html>
  <head>
    <title>Index - PresenceList</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <link rel="stylesheet" href="../css/jquery.mobile.css" />
	<link rel="stylesheet" href="../css/style.css"/>	

	
	<script type="text/javascript" src="../javascript/jquery.js"></script>
	<script type="text/javascript" src="../javascript/js.js"></script>

    <!--<link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.css" />
    <script src="http://code.jquery.com/jquery-1.4.3.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.js"></script>-->
  </head>
  <body style="margin:0;">
      
      <a name="search"></a>
      <div data-role="page">
<?php

		$active = array('','');
        if(isset($_GET['type']))
        {
	        $type = $_GET['type'];
	        switch($type)
	        {
	            case 'al':
	                $txt = "Ordre d'arrivée";
	                $donnees = $user->get_user_checked_order_time();
	$active[0] = 'background:#00254A;' ;
	                break;
	            case 'ar':
	                $txt = "Ordre d'alphabétique";
	                $donnees= $user->get_user_checked_order_alpha();
	$active[1] = 'background:#00254A;' ;
	                break;

	        }
        }
        else
		{ 
			$txt = "Ordre d'alphabétique";
			$donnees = $user->get_user_checked_order_alpha();
			$active[0] = 'background:#00254A;' ;
			$type="al";
		}
		
		if ( $type == 'ar' )
		{
			echo'<div id="alphabet"><ul id="alphabet">';

			$a = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
			foreach ( $a as $a )
				echo '<li><a href="#'.$a.'">'.$a.'</a></li>';
			
			echo'</ul></div>';
		} else {
			echo '<div id="alphabet"><ul id="alphabet"><h2>Liste d\'arrivée Ordre d\'arrivée</h2></ul></div>';
		}
		
?></ul>
        <a href="index.php?type=<?php echo $type; ?>" rel="external" class="ui-btn ui-btn-icon-left ui-btn-corner-all ui-shadow ui-btn-up-b" style="float:left;width:50%;"><div id="responsecount">Rafraichir la liste</div></a>
        </div>
<h2 style="float:right;margin-right:2em;">
<?php echo $main->getArrive().' arrivés sur '.$main->getTotal().' attendus'; ?>
</h2>

			<a href="index.php?type=al" rel="external" class="ui-btn ui-btn-icon-left ui-btn-corner-all ui-shadow ui-btn-up-b" style="float:left;width:45%;<?php echo $active[0]; ?>">Ordre d'arrivée</a>
			<a href="index.php?type=ar" rel="external" class="ui-btn ui-btn-icon-left ui-btn-corner-all ui-shadow ui-btn-up-b" style="float:right;width:45%;<?php echo $active[1]; ?>">Ordre alphabétique</a>


	<div style="clear:both;"></div>
	<div data-role="content" data-theme="c">

            

                <ul data-filter="false" data-role="listview" class="ui-listview" role="listbox">
       
<div id="myContent">
    <?php //include 'reload.php';

$current_letter ='';
foreach ($donnees as $donnee)
{
    $first_letter = $donnee['nom'][0];

    if($first_letter != $current_letter)
    {
        $current_letter = $first_letter;

        if($type == 'ar')
		{
echo'<a name="'.strtoupper($current_letter).'"></a><li data-theme="a" data-role="list-divider" class="ui-btn list-divider ui-btn-icon-right ui-li ui-btn-up-a"><b>'.strtoupper($current_letter).'</b><a class="top" href="#search">Top</a></li>';
        }
    }
          ?>
            <a href="detail.php?user=<?php echo $donnee['id']; ?>" class="ui-link-inherit">
				<li data-theme="c" data-inset="true" class="ui-btn ui-btn-icon-right ui-li ui-btn-up-c">
                    <?php
                    echo strtoupper($donnee["nom"])." ".ucfirst(strtolower($donnee["prenom"]));
                    ?>
            	</li>
			</a>
    <?php
    }


?>


</div>
        
                </ul>
                





        </div>
    </div>

      <!--<div style="position: absolute;z-index: 100;background-color: #2489CE">
      <div id="responsecount">Refresh dans <b></b> secondes</div>
      </div>-->
		<div data-role="footer" class="ui-bar-b ui-footer" style="text-align:center;">Powered by Balloon</div>
  </body>
</html>