<?php

require_once 'config.php';

$title = 'RateMySpeaker';
$description = null;
$keywords = null;

if (isset($_GET['id']))
	$id = $_GET['id'];
else
	header('Location: index.php');

include 'header.php';

$speaker = mysql_fetch_assoc(mysql_query("SELECT * FROM ".$table_prefix."Speaker WHERE id = ".$id));

?>

<div id="speaker_profile">
	<img class="speaker_picture" src="<?php echo $speaker['url_avatar']; ?>">
	<div class="speaker_description">
		<h2><?php echo $speaker['real_name']; ?></h2>
		<p class="p1">
			<?php $speaker['position']; ?><br/>
			<?php $speaker['company']; ?><br/>
			<?php $speaker['bio']; ?>
		</p><br/><br/>
			
		<p class="p2">Rate him</p>
		<div id="star"></div>
		<div class="source">
			<script type="text/javascript">
				$(function() {
					$('#star').raty({
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
	
	<br/><h2>Rate other speakers in the same conferences...</h2>
<?php

$conferences = mysql_query("SELECT C.id FROM ".$table_prefix."Conference AS C, ".$table_prefix."SpeakerInConf AS S WHERE C.id = S.id_conf AND id_speaker = ".$speaker['id']) or die(mysql_error());

while ($conference = mysql_fetch_row($conferences))
{

?>

	<div id="speaker_conferences">
		<p class="titreconf p2">Why Balloon will become a giant?</p><br/>

<?php

	$other_speakers = mysql_query("SELECT real_name, url_avatar FROM ".$table_prefix."Speaker AS S, ".$table_prefix."SpeakerInConf AS L WHERE S.id = L.id_speaker AND id_conf = ".$conference[0]." AND S.id != '".$id."'");
	
	while ($other_speaker = mysql_fetch_assoc($other_speakers))
	{
	
?>
		<div class="speaker">
			<img class="speaker_picture" src="<?php echo $other_speaker['url_avatar']; ?>">
			<?php echo $other_speaker['real_name']; ?><div id="star"></div>
				<div class="source">
					<script type="text/javascript">
						$(function() {
							$('#star').raty({
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
		</div><div class="clear"></div>
		
<?php
		
	}
}

?>

	</div>
</div>