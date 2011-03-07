<?php

require_once 'config.php';

$title = 'RateMySpeaker';
$description = null;
$keywords = null;

function resizing($img)
{
	if (empty($img))
		return null;
	else
	{
		$size = getImageSize($img);
		return ($size[0] > 50) ? 'resizing_image' : null;
	}
}

include 'header.php';

$speakers = mysql_query("SELECT * FROM ".$table_prefix."Speaker ORDER BY current_score DESC LIMIT 20");

$i = 1;

?>

<div id="speaker_profile">
	<div id="speaker_conferences">

<?php

while ($speaker = mysql_fetch_assoc($speakers))
{

?>

		<div class="speaker">
			<img class="speaker_picture <?php echo resizing($speaker['url_avatar']); ?>" src="<?php echo !empty($speaker['url_avatar']) ? $speaker['url_avatar'] : 'img/profile.gif'; ?>" />
			<a href="?page=search&name=<?php echo $speaker['real_name']; ?>&id=<?php echo $speaker['id']; ?>"><?php echo $speaker['real_name']; ?></a>
			<div id="star<?php echo $i; ?>" class="starR fivestars" value="<?php echo $speaker['id']; ?>">
				<input type="hidden" value=<?php echo $speaker['id']; ?> />
			</div><br />
			Ratings : <?php echo $speaker['nb_ratings']; ?>
			<div class="source">
				<script type="text/javascript">
					$(function() {
						$('#star<?php echo $i; ?>').raty({
							readOnly:	true,
							start:		<?php echo $speaker['current_score']; ?>,
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

include 'footer.php';

?>

