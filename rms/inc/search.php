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
	$search = @mysql_query("SELECT id FROM ".$table_prefix."Speaker WHERE CONCAT(lower(firstname),lower(lastname)) = '".mysql_real_escape_string(strtolower($_GET['name']))."' LIMIT 1");
	
	if ( mysql_num_rows($search) > 0 )
	{
		$id = mysql_result($search,0) ;
		$dir = '../';
	}
	else
	{
		header('Location: index.php');
		die();
	}
}

$speaker = mysql_query("SELECT * FROM ".$table_prefix."Speaker WHERE id = ".$id);

if (mysql_num_rows($speaker) == 0)
	header('Location: index.php');

$speaker = mysql_fetch_assoc($speaker);

$title = 'RateMySpeaker - '.$speaker['real_name'];
include 'header.php';

$id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;

if (isset($id_user))
{
	$rated1 = mysql_query("SELECT rate FROM ".$table_prefix."Rate WHERE id_speaker = ".$id." AND id_user = ".$id_user);
	$rated1 = (mysql_num_rows($rated1) > 0) ? mysql_result($rated1, 0) : null;
}

/**
/ ON MET LES CONF EN BUFFER POUR RECUP LES HASHTAG ET LES METTRE DANS LE TWEET
*/

$hashtag = array();

ob_start();

$conferences = mysql_query("SELECT C.id, name, hashtag FROM ".$table_prefix."Conference AS C, ".$table_prefix."SpeakerInConf AS S WHERE C.id = S.id_conf AND id_speaker = ".$id);

$i = 1;

while ($conference = mysql_fetch_row($conferences))
{

array_push($hashtag, $conference[2]);

?>

	<div id="speaker_conferences">
		<p class="titreconf p2"><?php echo $conference[1]; ?></p>

<?php

	$other_speakers = mysql_query("SELECT S.id, real_name, url_avatar FROM ".$table_prefix."Speaker AS S, ".$table_prefix."SpeakerInConf AS L WHERE S.id = L.id_speaker AND id_conf = ".$conference[0]." AND S.id != '".$id."'");
	
	if (mysql_num_rows($other_speakers) == 0)
		echo '<div class="speaker">No other speaker</div>';
	else
	{
		while ($other_speaker = mysql_fetch_assoc($other_speakers))
		{
		
			if (isset($id_user))
			{
				$rated2 = mysql_query("SELECT rate FROM ".$table_prefix."Rate WHERE id_speaker = ".$other_speaker['id']." AND id_user = ".$id_user);
				$rated2 = (mysql_num_rows($rated2) > 0) ? mysql_result($rated2, 0) : null;
			}
		
?>
			<div class="speaker">
				<img class="speaker_picture <?php echo resizing($other_speaker['url_avatar']); ?>" src="<?php echo !empty($other_speaker['url_avatar']) ? $other_speaker['url_avatar'] : $dir.'img/profile.gif'; ?>" />
				<a href="<?php echo $dir.'s/'.str_replace(' ','',$other_speaker['real_name']); ?>/<?php echo $other_speaker['id']; ?>"><?php echo $other_speaker['real_name']; ?></a>
				<div id="star<?php echo $i; ?>" class="starR fivestars" value="<?php echo $other_speaker['id']; ?>">
					<input type="hidden" value=<?php echo $other_speaker['id']; ?> />
				</div>
				<div class="source">
					<script type="text/javascript">
						$(function() {
							$('#star<?php echo $i; ?>').raty({
								readOnly:	<?php echo (!isset($_SESSION['id_user']) || isset($rated2)) ? 'true' : 'false'; ?>,
								start:		<?php echo isset($rated2) ? $rated2 : 0; ?>,
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
	}

?>
	</div>

<?php
	
}

$conf = ob_get_contents();

ob_end_clean();

/**
/ FIN BUFFER
*/

$tweet = 'Just rated '.$speaker['real_name'].' on #RateMySpeaker for #SXSW';
$tweet2 = 'Just rated '.$speaker['real_name'].' on %23RateMySpeaker for %23SXSW';

if (isset($hashtag[0]))
{
	$str = 'Just rated '.$speaker['real_name'].' on #RateMySpeaker for #SXSW '.$hashtag[0].' http://t.co/ZFBSoDW via @ratemyspeaker';
	
	if (strlen($str) <= 140)
	{
		$tweet = 'Just rated '.$speaker['real_name'].' on #RateMySpeaker for #SXSW '.$hashtag[0];
		$tweet2 = 'Just rated '.$speaker['real_name'].' on %23RateMySpeaker for %23SXSW '.urlencode($hashtag[0]);
		
		if (isset($hashtag[1]))
		{
			$str = 'Just rated '.$speaker['real_name'].' on #RateMySpeaker for #SXSW '.$hashtag[0].' '.$hashtag[1].' http://t.co/ZFBSoDW via @ratemyspeaker';
			
			if (strlen($str) <= 140)
			{
				$tweet = 'Just rated '.$speaker['real_name'].' on #RateMySpeaker for #SXSW '.$hashtag[0].' '.$hashtag[1];
				$tweet2 = 'Just rated '.$speaker['real_name'].' on %23RateMySpeaker for %23SXSW '.urlencode($hashtag[0]).' '.urlencode($hashtag[1]);
				
				if (isset($hashtag[2]))
				{
					$str = 'Just rated '.$speaker['real_name'].' on #RateMySpeaker for #SXSW '.$hashtag[0].' '.$hashtag[1].' '.$hashtag[2].' http://t.co/ZFBSoDW via @ratemyspeaker';
					
					if (strlen($str) <= 140)
					{
						$tweet = 'Just rated '.$speaker['real_name'].' on #RateMySpeaker for #SXSW '.$hashtag[0].' '.$hashtag[1].' '.$hashtag[2];
						$tweet2 = 'Just rated '.$speaker['real_name'].' on %23RateMySpeaker for %23SXSW '.urlencode($hashtag[0]).' '.urlencode($hashtag[1]).' '.urlencode($hashtag[2]);
					}
				}
			}
		}
	}
}

?>

<div id="speaker_profile">
	<img class="speaker_picture <?php echo resizing($speaker['url_avatar']); ?>" src="<?php echo !empty($speaker['url_avatar']) ? $speaker['url_avatar'] : $dir.'img/profile.gif'; ?>">
	<div class="speaker_description">
		<h2><?php echo $speaker['real_name']; ?></h2>
		<p class="p1">
			<?php if ($speaker['position'] != '</p>') echo $speaker['position']; ?><br/>
			<?php if ($speaker['company'] != '</p>') echo $speaker['company']; ?><br/>
			<?php if ($speaker['bio'] != '</p>') echo $speaker['bio']; ?>
		</p>
			
		<p class="p2">Rate <?php echo $speaker['firstname']; ?></p>
		<div id="star0" class="starR">
			<input type="hidden" value=<?php echo $id; ?> />
		</div>
		<div id="button_tweet_search" style="<?php if (!$rated1) echo 'display:none'; ?>;">
			<a href="http://twitter.com/share?text=<?php echo $tweet; ?>" class="twitter-share-button" data-count="none" data-via="ratemyspeaker" data-related="balloon">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
		</div>
		
		<div class="source">
			<script type="text/javascript">
				$(function() {
					$('#star0').raty({
						readOnly:	<?php echo (!isset($_SESSION['id_user']) || isset($rated1)) ? 'true' : 'false'; ?>,
						start:		<?php echo isset($rated1) ? $rated1 : 0; ?>,
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
	
	<br/><h2>Rate other speakers in the same conferences...</h2>
	
	<?php
	
	echo $conf;
	
	?>

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
				if ($(this).attr("id") == "star0") {
					$("#button_tweet_search").show("fast");
					var Left=window.screen.width/2-300;
					var Top=window.screen.height/2-200;
					window.open("http://twitter.com/share?text=<?php echo $tweet2; ?>&via=ratemyspeaker", "Tweet <?php echo $speaker['real_name']; ?> !", "width=600, height=400, left=" + Left + ", top=" + Top + "toolbar=no, menubar=no, location=no, directories=no, status=no, resizeable=no");
				}
			<? } else { ?>
				var field = $(this);
				field.fadeOut('slow',function(){
					field.html('<a href="<?php echo $dir; ?>inc/twitter/redirect.php"><img width="151" height="24" src="<?php echo $dir; ?>img/twitter-login.png" alt="Connect to Twitter to rate your speaker" /></a></div><div id="popup" style="display:none;">Connect to Twitter to rate your speaker !');
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