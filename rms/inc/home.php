<?php

$title = 'RateMySpeaker';
$description = null;
$keywords = null;

include 'header.php';

?>

<div id="description">
	<h1>Rate SXSW speakers and share your opinion on Twitter</h1>

</div>	

<div id="search">

	<?php if (isset($_SESSION['id_user'])) { ?>
		<form method="post" action="">
			<input id="speaker_name" value="Enter a speaker name" type="text">
		</form>
	<?php } else { ?>
		<div id="twitter_button_connect_home" ><a href="inc/twitter/redirect.php"><img src="img/twitter-login.png" alt="Connect to Twitter to rate your speaker" /></a></div>
	<?php } ?>
	
</div>

<br/><h1>or see the best SXSW Speakers</h1>
<div id="green_button"><a href="?page=ranking" class="button green">Speaker ranking</a></div>

<script type="text/javascript">
	$(function() {
		$("#speaker_name").click(function() {
			if ($(this).attr("value") == "Enter a speaker name")
				$(this).attr("value", "");
		});
		$("#speaker_name").blur(function() {
			if ($(this).attr("value") == "")
				$(this).attr("value", "Enter a speaker name");
		});
		$("#speaker_name").autocomplete("ajax/search.ajax.php",
		{
			formatItem: function(data, i, n, value) {
				var img = value.split("..")[1] ;
				if(img==''){img = "img/profile.gif";}	
				return "<img src='" + img + "'/> " + value.split("..")[0];
			},
			formatResult: function(data, value) {
				return value.split(".")[0];
			}
		});
		$("#speaker_name").result(function(event, data) {
			if (data) {
				window.location = "?page=search&name=" + data[0].replace(/[^a-zA-Z0-9]/g,'') + "&id=" + data[1];
			}
		});
	});	
</script>

<?php

include 'footer.php';

?>