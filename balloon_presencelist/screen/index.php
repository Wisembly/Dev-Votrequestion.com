<html>
  <head>
    <title>Index - PresenceList</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script type="text/javascript" src="../javascript/jquery.js"></script>

    <script type="text/javascript">
        var refresh = 10;
        var count = 10 ;
        var refreshId = setInterval(function()
        {
             $('#responsecontainer').load('reload.php');
        }, refresh*1000);
        var refreshCount = setInterval(function()
        {
            if ( count != 0 )
                count--;
            else
                count = refresh;
             $('#responsecount b').html(count);
        }, 1*1000);
    </script>

  </head>
  <body onload="$('#responsecontainer').load('reload.php');">
      <h3>Liste des inscrits</h3>
      <div id="responsecount">Refresh dans <b></b> secondes</div>
      <div id="responsecontainer"></div>
  </body>
</html>