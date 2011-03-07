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
	<form method="post" action="">
		<input id="speaker_name" value="Enter a speaker name" type="text">
	</form>
</div>

<br/><h3>or see the best SXSW Speakers</h3>
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
				if (typeof(img) == "undefined"){img = "img/empty.png";}
				else if(img==''){img = "img/profile.gif";}
				return "<img src='" + img + "'/> " + value.split("..")[0];
			},
			formatResult: function(data, value) {
				return value.split(".")[0];
			}
		});
		$("#speaker_name").result(function(event, data) {
			if (data && data != 'none..No results|none') {
				var url = data[0].split("http")[0];
				window.location = "s/" + url.replace(/[^a-zA-Z0-9]/g,'')+ "/" + data[1];
			}
		});
	});	
</script>

<?php

include 'footer.php';

?>