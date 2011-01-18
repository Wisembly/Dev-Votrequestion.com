<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>Detail</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.css" />
    <script src="http://code.jquery.com/jquery-1.4.3.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.js"></script>

  </head>
  <body>
    <div data-role="page">
	<div data-role="header" data-theme="b"><h3>Page de detail</h3></div>
	<div data-role="content" data-theme="b">

            <div class="ui-content">
                ceci est la page detail

                <a href="index.html" data-role="button" data-icon="check" style="background:-moz-linear-gradient(center top , #006633, #006633) repeat scroll 0 0 #006633">Checkin</a>

                <a href="" class="ui-dialog" data-role="button" data-icon="check" style="background:-moz-linear-gradient(center top , #CC0000, #CC0000) repeat scroll 0 0 #CC0000">Cancel</a>
            </div>
        </div>
	<div data-role="footer" data-theme="b">Powered by Balloon</div>
    </div>
      <script type="tetext/javascript">
      $(document).ready(function(){
        $('.ui-dialog').dialog('close');
      });
      </script>
  </body>
</html>