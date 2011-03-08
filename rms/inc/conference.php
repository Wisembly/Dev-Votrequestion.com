<?php

require_once 'config.php';

$description = null;
$keywords = null;

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
		header('Location: index.php');
		die();
	}
}

$conference = mysql_fetch_row(mysql_query("SELECT * FROM ".$table_prefix."Conference WHERE id = ".$id." LIMIT 1"));

$title = 'RateMySpeaker - '.$conference[1];

include 'header.php';

$id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;

?>

<div id="speaker_profile">
	
	<br/><h2><?php echo $conference[1]; ?></h2>

	<div id="speaker_conferences">
	
<?php

	$speakers = mysql_query("SELECT S.id, real_name, url_avatar FROM ".$table_prefix."Speaker AS S, ".$table_prefix."SpeakerInConf AS L WHERE S.id = L.id_speaker AND id_conf = ".$conference[0]);

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
			<img class="speaker_picture <?php echo resizing($speaker['url_avatar']); ?>" src="<?php echo !empty($speaker['url_avatar']) ? $speaker['url_avatar'] : $dir.'img/profile.gif'; ?>" />
			<a href="<?php echo $dir.'s/'.str_replace(' ','',$speaker['real_name']); ?>/<?php echo $speaker['id']; ?>"><?php echo $speaker['real_name']; ?></a>
			<div id="star<?php echo $i; ?>" class="starR fivestars" value="<?php echo $speaker['id']; ?>">
				<input type="hidden" value=<?php echo $speaker['id']; ?> />
			</div>
			<div class="source">
				<script type="text/javascript">
					$(function() {
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

mysql_close();
include 'footer.php';

?>