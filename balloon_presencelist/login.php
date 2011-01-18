<?php require_once 'common.php';
if(isset($_POST['name']))
        {
            //On vas chercher la liste des hotesses et on compare
            $list_hotesse = $hotesse->get_list_hotesse();
            foreach ($list_hotesse as $une_hotesse)
            {
                if(strtolower($une_hotesse['login']) == strtolower($_POST['name']))
                {
                    $_SESSION['connect'] = strtolower($_POST['name']);
                    $_SESSION['id_hotesse'] = $une_hotesse['id'];
                    header('Location: index.php');
                }
            }
        }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>Login</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.css" />
    <script src="http://code.jquery.com/jquery-1.4.3.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.js"></script>

  </head>
  <body>
    <div data-role="page">
	<div data-role="header" data-theme="b" data-nobackbtn="true"><h3>Page de login</h3></div>
	<div data-role="content" data-theme="b">

            <div class="ui-content">
                <form method="post" action="">
                <div class="ui-field-contain ui-body ui-br" data-role="fieldcontain">
                    <label class="ui-input-text" for="name">Login:</label>
                    <input style="width: 100%" class="ui-input-text ui-body-null ui-corner-all ui-shadow-inset ui-body-c" type="text" name="name" id="name" value=""  />
                </div>

                <button class="ui-btn-hidden" data-theme="b" type="submit" tabindex="-1">Login</button>
            </form>
            </div>
        </div>
	<div data-role="footer" data-theme="b">Powered by Balloon</div>
    </div>
  </body>
</html>