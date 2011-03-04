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

<script type="text/javascript">
	$(function() {
		$("#speaker_name").click(function() {
			if (this.value == "Enter a speaker name")
				this.value = "";
		}).blur(function() {
			if (this.value == "")
				this.value = "Enter a speaker name";
		}).autocomplete("ajax/search.ajax.php");
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