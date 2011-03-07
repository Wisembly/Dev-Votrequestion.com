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

$user = mysql_fetch_assoc(mysql_query("SELECT * FROM ".$table_prefix."User WHERE pseudo = '".$_GET['pseudo']."'"));

?>

<div id="user_profile">
	<img class="speaker_picture <?php echo resizing($user['url_avatar']); ?>" src="<?php echo $user['url_avatar']; ?>">
	<div class="speaker_description">
		<h2><?php echo $user['pseudo']; ?></h2>
		<p class="p1"><?php echo $user['bio']; ?></p><div class="clear"></div><br/>
			
		<p class="p2">Average Note</p>
		<div id="star0"></div>
		<div class="source">
			<script type="text/javascript">
				$(function() {
					$('#star0').raty({
						readOnly:	true,
						start:		<?php echo $user['current_score']; ?>,
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
	
	<br/><h2>His ratings</h2>
	
	<?php
	
	$rates = mysql_query("SELECT S.id, real_name, url_avatar, rate FROM ".$table_prefix."Speaker AS S, ".$table_prefix."Rate AS R WHERE S.id = R.id_speaker AND R.id_user = ".$user['id']);
	
	$i = 1;
	
	if (mysql_num_rows($rates) == 0)
		echo 'No rate';
	else
	{
		while ($rate = mysql_fetch_assoc($rates))
		{
	
	?>
			<div id="speaker_conferences">
				<div class="speaker">
					<img class="speaker_picture <?php echo resizing($speaker['url_avatar']); ?>" src="<?php echo !empty($rate['url_avatar']) ? $rate['url_avatar'] : 'img/profile.gif'; ?>" />
					<a href="?page=search&name=<?php echo $rate['real_name']; ?>&id=<?php echo $rate['id']; ?>"><?php echo $rate['real_name']; ?></a>
					<div id="star<?php echo $i; ?>" class="starR fivestars"></div>
					<div class="source">
						<script type="text/javascript">
							$(function() {
								$('#star<?php echo $i; ?>').raty({
									readOnly:	true,
									start:		<?php echo $rate['rate']; ?>,
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
			</div>

<?php

			$i++;
		}
	}

include 'footer.php';

?>

</div>