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
		<p>Connect to Twitter to rate speakers</p>
	<?php } ?>
	
</div>

<br/><h1>or see the best SXSW Speakers</h1>
<a href="?page=ranking" class="button green">Speaker ranking</a>

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