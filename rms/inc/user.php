<?php

require_once 'config.php';

$title = 'RateMySpeaker';
$description = null;
$keywords = null;

include 'header.php';

$user = mysql_fetch_assoc(mysql_query("SELECT * FROM ".$table_prefix."User WHERE pseudo = '".$_GET['pseudo']."'"));

?>

<div id="user_profile">
	<img class="user_picture" src="<?php echo $user['url_avatar']; ?>">
	<div class="speaker_description">
		<h2><?php echo $user['pseudo']; ?></h2>
		<p class="p1"><?php echo $user['bio']; ?></p><div class="clear"></div><br/>
			
		<p class="p2">Average Note</p>
		<div id="star0"></div>
		<div class="source">
			<script type="text/javascript">
				$(function() {
					$('#star0').raty({
					  cancel:     false,
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
	
	$rates = mysql_query("SELECT real_name, url_avatar, rate FROM ".$table_prefix."Speaker AS S, ".$table_prefix."Rate AS R WHERE S.id = R.id_speaker AND R.id_user = ".$user['id']);
	
	$i = 0;
	
	if (mysql_num_rows($rates) > 0)
	{
		while ($rate = mysql_fetch_arrow($rates))
		{
	
	?>
	
	<div id="user_historic">
		<div class="speaker">
			<img class="speaker_picture" src="<?php echo $rate['url_avatar']; ?>">
			<?php echo $rate['real_name']; ?><div id="star<?php echo $i; ?>"></div>
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
</div>

<?php

		$i++;
		}
	}

include 'footer.php';

?>
