<?php

$title = 'RateMySpeaker - SXSW Edition';
$description = 'RateMySpeaker.com let you search SXSW speakers by their names or by the conference official #hashtag and rate their performance up to 5 stars!';
$keywords = 'SXSW, Balloon, Conference, Speaker, Rate, Rating, Rank, Best Speaker, Music, Austin, Texas, Web, Twitter';

include 'header.php';

?>

<div id="description">
	<h1><strong>I'm the attendee, bitch!</strong></h1>

</div>	

<div id="search">
	<form method="post" action="">
		<input id="speaker_name" value="Enter speaker name or conf #hashtag" type="text">
	</form>
</div>

<br/><h3>or see the best SXSW Speakers</h3>
<div id="green_button"><a href="?page=ranking" class="button green">Check best SXSW speakers!</a></div>

<script type="text/javascript">	
$(function(){$("#speaker_name").click(function(){if($(this).attr("value")=="Enter speaker name or conf #hashtag")
$(this).attr("value","");});$("#speaker_name").blur(function(){if($(this).attr("value")=="")
$(this).attr("value","Enter speaker name or conf #hashtag");});$("#speaker_name").autocomplete("ajax/search.ajax.php",{formatItem:function(data,i,n,value){var img=value.split("..")[1];if(img=='none'){img="img/empty.png";}
else if(img==''){img="img/profile.gif";}
else if(img=='hashtag'){img="img/twitter.gif";}
return"<img src='"+img+"'/> "+value.split("..")[0];},formatResult:function(data,value){return strip_tags(value.split(".")[0]);}});$("#speaker_name").result(function(event,data){if(data&&data!='none..No results|none'){if(data[0].substr(0,1)=='#')
{var url=data[0].split("hashtag")[0];var redirect="c/"+url.replace(/[^a-zA-Z0-9]/g,'')+"/"+data[1];}
else if(data[1]=='none')
{redirect='http://twitter.com/#!/ratemyspeaker';}
else
{var url=data[0].split("http")[0];var redirect="s/"+url.replace(/[^a-zA-Z0-9]/g,'')+"/"+data[1];}
window.location=redirect;}});});
function strip_tags (input, allowed) {allowed = (((allowed || "") + "").toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join('');var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi,commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;return input.replace(commentsAndPhpTags, '').replace(tags, function ($0, $1) {return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';});}
</script>

<?php include 'footer.php'; ?>