<?php

require_once 'config.php';

$title = 'RateMySpeaker';
$description = null;
$keywords = null;

if (isset($_GET['id']))
	$id = $_GET['id'];
else
	header('Location: index.php');

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

$speaker = mysql_fetch_assoc(mysql_query("SELECT * FROM ".$table_prefix."Speaker WHERE id = ".$id));

?>

<div id="speaker_profile">
	<img class="speaker_picture" src="<?php echo !empty($speaker['url_avatar']) ? $speaker['url_avatar'] : 'img/profile.gif'; ?>">
	<div class="speaker_description">
		<h2><?php echo $speaker['real_name']; ?></h2>
		<p class="p1">
			<?php if ($speaker['position'] != '</p>') echo $speaker['position']; ?><br/>
			<?php if ($speaker['company'] != '</p>') echo $speaker['company']; ?><br/>
			<?php if ($speaker['bio'] != '</p>') echo $speaker['bio']; ?>
		</p>
			
		<p class="p2">Rate him</p>
		<div id="star0" class="starR"><input type="hidden" value=<?php echo $id; ?> /></div>
		<a href="inc/twitter/redirect.php">Tweet !</a>
		<div class="source">
			<script type="text/javascript">
				$(function() {
					$('#star0').raty({
					  cancel:     false,
					  half:       false,
					  size:       24,
					  starHalf:   'star-half-big.png',
					  starOff:    'star-off-big.png',
					  starOn:     'star-on-big.png'
					});
				});
			</script>
		</div>
	</div>
	
	<br/><h2>Rate other speakers in the same conferences...</h2>
<?php

$conferences = mysql_query("SELECT C.id, name FROM ".$table_prefix."Conference AS C, ".$table_prefix."SpeakerInConf AS S WHERE C.id = S.id_conf AND id_speaker = ".$speaker['id']);

$i = 1;

while ($conference = mysql_fetch_row($conferences))
{

?>

	<div id="speaker_conferences">
		<p class="titreconf p2"><?php echo $conference[1]; ?></p>

<?php

	$other_speakers = mysql_query("SELECT S.id, real_name, url_avatar FROM ".$table_prefix."Speaker AS S, ".$table_prefix."SpeakerInConf AS L WHERE S.id = L.id_speaker AND id_conf = ".$conference[0]." AND S.id != '".$id."'");
	
	while ($other_speaker = mysql_fetch_assoc($other_speakers))
	{
	
?>
		<div class="speaker">
			<img class="speaker_picture <?php echo resizing($other_speaker['url_avatar']); ?>" src="<?php echo !empty($other_speaker['url_avatar']) ? $other_speaker['url_avatar'] : 'img/profile.gif'; ?>">
			<?php echo $other_speaker['real_name']; ?><div id="star<?php echo $i; ?>" class="starR fivestars" value="<?php echo $other_speaker['id']; ?>"><input type="hidden" value=<?php echo $other_speaker['id']; ?> /></div>
				<div class="source">
					<script type="text/javascript">
						$(function() {
							$('#star<?php echo $i; ?>').raty({
							  cancel:     false,
							  half:       false,
							  size:       24,
							  starHalf:   'star-half-big.png',
							  starOff:    'star-off-big.png',
							  starOn:     'star-on-big.png'
							});
						});
					</script>
				</div>
		</div><div class="clear"></div>
		
<?php
		$i++;
	}
	
	if (empty($other_speaker))
		echo '<div class="speaker">No other speaker</div>';
?>

	</div>

<?php
	
}

?>

</div>

<script type="text/javascript">
	$(function() {
		$(".starR").click(function() {
			$.post("ajax/rate.ajax.php", {
				speaker_id: $(this).find("input:first-child").attr("value"),
				score: $(this).find("input:last-child").attr("value")
			});
		});
	});
</script>

<?php

include 'footer.php';

?>