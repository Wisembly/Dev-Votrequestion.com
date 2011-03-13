<?php

require_once 'config.php';
$dir = '' ;

$title = 'RateMySpeaker';
$description = 'RateMySpeaker.com let you search SXSW speakers by their names or by the conference official #hashtag and rate their performance up to 5 stars!';
$keywords = 'SXSW, Balloon, Conference, Speaker, Rate, Rating, Rank, Best Speaker, Music, Austin, Texas, Web, Twitter';
$header = '<script type="text/javascript" src="'.$dir.'js/raty/jquery.raty.min.js"></script>';

include 'header.php';

$speakers = mysql_query("SELECT id,real_name,url_avatar,nb_ratings,current_score FROM ".$table_prefix."Speaker ORDER BY current_score DESC LIMIT 20");

$i = 1;

?>

<div id="speaker_profile">
	<div id="speaker_conferences">
	<h1>Top 20 SXSW Speakers</h1>

<?php

while ($speaker = mysql_fetch_row($speakers))
{

?>
		<div class="speaker">
			<img class="speaker_picture <?php echo $speaker[2]; ?>" src="<?php echo !empty($speaker[2]) ? $speaker[2] : 'img/profile.gif'; ?>" weight="50" height="50" />
			<a href="<?php echo $dir.'s/'.str_replace(' ','',$speaker[1]); ?>/<?php echo $speaker[0]; ?>"><?php echo $speaker[1]; ?></a>
			<div id="star<?php echo $i; ?>" class="starR fivestars" value="<?php echo $speaker[0]; ?>">
				<input type="hidden" value=<?php echo $speaker[0]; ?> />
			</div><br />
			<!-- Ratings : <?php echo $speaker[3]; ?> -->
			<div class="source">
				<script type="text/javascript">
					$(function() {
						$('#star<?php echo $i; ?>').raty({
							readOnly:	true,
							start:		<?php echo $speaker[4]; ?>,
							half:       true,
							size:       24,
							starHalf:   'star-half-big.png',
							starOff:    'star-off-big.png',
							starOn:     'star-on-big.png'
						});
					});
				</script>
			</div>
		</div>
		<div class="clear"></div>

<?php
	$i++;
}

?>

	</div>
</div>

<?php

mysql_close();
include 'footer.php';

?>

