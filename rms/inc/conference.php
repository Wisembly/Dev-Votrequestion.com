<?php

require_once 'config.php';

$description = 'RateMySpeaker.com let you search SXSW speakers by their names or by the conference official #hashtag and rate their performance up to 5 stars!';
$keywords = 'SXSW, Balloon, Conference, Speaker, Rate, Rating, Rank, Best Speaker, Music, Austin, Texas, Web, Twitter';

if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id']))
{
	$id = $_GET['id'];
	$dir = '../../';
}
else
{
	// on search si id existe
	$search = mysql_query("SELECT id FROM ".$table_prefix."Conference WHERE hashtag = '#".mysql_real_escape_string($_GET['name'])."' LIMIT 1");
	
	if ( mysql_num_rows($search) > 0 )
	{
		$id = mysql_result($search, 0) ;
		$dir = '../';
	}
	else
	{
		header('Location: ');
		die();
	}
}

$conference = mysql_fetch_row(mysql_query("SELECT * FROM ".$table_prefix."Conference WHERE id = ".$id." LIMIT 1"));
$header = '<script type="text/javascript" src="'.$dir.'js/raty/jquery.raty.min.js"></script>';

$title = 'RateMySpeaker - '.$conference[1];

include 'header.php';

$id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;

?>

<div id="speaker_profile">
	
	<br/><h2><?php echo $conference[1]; ?></h2>

	<div id="speaker_conferences">
	
<?php

	$speakers = mysql_query("SELECT S.id, real_name, url_avatar, current_score FROM ".$table_prefix."Speaker AS S, ".$table_prefix."SpeakerInConf AS L WHERE S.id = L.id_speaker AND id_conf = ".$conference[0]);

	$i = 0;
	
	while ($speaker = mysql_fetch_assoc($speakers))
	{
	
		if (isset($id_user))
		{
			$rated = mysql_query("SELECT rate FROM ".$table_prefix."Rate WHERE id_user = ".$id_user." AND id_speaker = ".$speaker['id']);
			$rated = (mysql_num_rows($rated) > 0) ? mysql_result($rated, 0) : null;
		}
	
?>
		<div class="speaker">
			<img class="speaker_picture <?php echo $speaker['url_avatar']; ?>" src="<?php echo !empty($speaker['url_avatar']) ? $speaker['url_avatar'] : $dir.'img/profile.gif'; ?>" />
			<a href="<?php echo $dir.'s/'.str_replace(' ','',$speaker['real_name']); ?>/<?php echo $speaker['id']; ?>"><?php echo $speaker['real_name']; ?></a>
			<div id="star<?php echo $i; ?>" class="starR fivestars" value="<?php echo $speaker['id']; ?>">
				<input type="hidden" value=<?php echo $speaker['id']; ?> />
			</div>
			<div id="starAverage<?php echo $i; ?>" class="starR"></div>
			<div class="source">
				<script type="text/javascript">
					$(function() {
						$('#starAverage<?php echo $i; ?>').raty({
							readOnly:	'true',
							start:		<?php echo $speaker['current_score']; ?>,
							half:       true,
							size:       24,
							path:		'<?php echo $dir; ?>img/',
							starHalf:   'star-half.png',
							starOff:    'star-off.png',
							starOn:     'star-on.png'
						});
						$('#star<?php echo $i; ?>').raty({
							readOnly:	<?php echo (!isset($_SESSION['id_user']) || isset($rated)) ? 'true' : 'false'; ?>,
							start:		<?php echo isset($rated) ? $rated : 0; ?>,
							half:       false,
							size:       24,
							path:		'<?php echo $dir; ?>img/',
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
	
<script type="text/javascript">
	$(function() {
		$(".starR").click(function() {
			<?php if (isset($_SESSION['id_user'])) { ?>
				$.post("<?php echo $dir; ?>ajax/rate.ajax.php", {
					id_user: <?php echo $_SESSION['id_user']; ?>,
					id_speaker: $(this).find("input:first-child").attr("value"),
					score: $(this).find("input:last-child").attr("value")
				});
				var targetID = $(this).attr("id");
				$.fn.raty.readOnly(true, '#' + targetID);
			<? } else { ?>
				var field = $(this);
				field.fadeOut('slow',function(){
					field.html('<a href="<?php echo $dir; ?>inc/twitter/redirect.php"><img src="<?php echo $dir; ?>img/twitter-login.png" alt="Connect to Twitter to rate your speaker" /></a></div><div id="popup" style="display:none;">Connect to Twitter to rate your speaker !');
					field.fadeIn('slow');
				});
			<?php } ?>
		});
	});
</script>

<?php

mysql_close();
include 'footer.php';

?>