<?php

$title = 'RateMySpeaker - SXSW Edition';
$description = 'RateMySpeaker.com let you search SXSW speakers by their names or by the conference official #hashtag and rate their performance up to 5 stars!';
$keywords = null;

include 'header.php';

?>

<div id="description">
	<h1>Rate SXSW speakers and share your opinion on Twitter</h1>

</div>	

<div id="search">
	<form method="post" action="">
		<input id="speaker_name" value="Enter speaker name or conf #hashtag" type="text">
	</form>
</div>

<br/><h3>or see the best SXSW Speakers</h3>
<div id="green_button"><a href="?page=ranking" class="button green">Best speakers</a></div>

<script type="text/javascript">
	$(function() {
		$("#speaker_name").click(function() {
			if ($(this).attr("value") == "Enter speaker name or conf #hashtag")
				$(this).attr("value", "");
		});
		$("#speaker_name").blur(function() {
			if ($(this).attr("value") == "")
				$(this).attr("value", "Enter speaker name or conf #hashtag");
		});
		$("#speaker_name").autocomplete("ajax/search.ajax.php",
		{
			formatItem: function(data, i, n, value) {
				var img = value.split("..")[1] ;
				if (img=='none'){img = "img/empty.png";}
				else if(img==''){img = "img/profile.gif";}
				else if (img=='hashtag'){img = "img/twitter.gif";}
				return "<img src='" + img + "'/> " + value.split("..")[0];
			},
			formatResult: function(data, value) {
				return value.split(".")[0];
			}
		});
		$("#speaker_name").result(function(event, data) {
			if (data && data != 'none..No results|none') {
				if ( data[0].substr(0,1) == '#')
				{
					var url = data[0].split("hashtag")[0];
					var redirect = "c/" + url.replace(/[^a-zA-Z0-9]/g,'')+ "/" + data[1];
				}
				else
				{
					var url = data[0].split("http")[0];
					var redirect = "s/" + url.replace(/[^a-zA-Z0-9]/g,'')+ "/" + data[1];
				}
				
				window.location = redirect;
			}
		});
	});	
</script>

<?php

include 'footer.php';

?>