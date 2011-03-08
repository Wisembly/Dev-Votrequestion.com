<?php

require_once 'config.php';

$title = 'RateMySpeaker - Your profile';
$description = 'RateMySpeaker.com let you search SXSW speakers by their names or by the conference official #hashtag and rate their performance up to 5 stars!';
$keywords = 'SXSW, Balloon, Conference, Speaker, Rate, Rating, Rank, Best Speaker, Music, Austin, Texas, Web, Twitter';

if (isset($_GET['pseudo']) && !empty($_GET['pseudo']))
	$pseudo = $_GET['pseudo'];
else
	header('Location: index.php');

$user = mysql_query("SELECT * FROM ".$table_prefix."User WHERE lower(pseudo) = '".mysql_real_escape_string(strtolower($pseudo))."'");

$dir = '../' ;
if (mysql_num_rows($user) == 0)
	header('Location: '.$dir.'index.php');
	
$user = mysql_fetch_assoc($user);

include 'header.php';

if ($user['current_score'] == 5)
	$message = 'My life missed U #SXSW’s speakers';
else if ($user['current_score'] < 5 && $user['current_score'] >= 4.5)
	$message = 'I luv U all #SXSW’s Speakers';
else if ($user['current_score'] < 4.5 && $user['current_score'] >= 4)
	$message = 'I’m a speaker luver at #SXSW';
else if ($user['current_score'] < 4 && $user['current_score'] >= 3.5)
	$message = 'My $$ ‘ve been well spent on #SXSW Speakers';
else if ($user['current_score'] < 3.5 && $user['current_score'] >= 3)
	$message = 'My ears are happy at #SXSW';
else if ($user['current_score'] < 3 && $user['current_score'] >= 2.5)
	$message = 'I’m more into TCDiscrupt than #SXSW';
else if ($user['current_score'] < 2.5 && $user['current_score'] >= 2)
	$message = 'Hey Speakers at #SXSW: What’s that fuck ?';
else if ($user['current_score'] < 2 && $user['current_score'] >= 1.5)
	$message = 'I should visit Austin rather that #SXSW';
else if ($user['current_score'] < 1.5 && $user['current_score'] >= 1)
	$message = 'I shouldn’t ‘ve spent so much $$ for #SXSW';
else
	$message = null;

?>

<div id="user_profile">
	<img class="speaker_picture <?php echo resizing($user['url_avatar']); ?>" src="<?php echo $user['url_avatar']; ?>">
	<div class="speaker_description">
		<h2><?php echo $user['pseudo']; ?></h2>
		<p class="p1"><?php echo $user['bio']; ?></p><div class="clear"></div><br/>
			
		<p class="p2">Average Note</p>
		<div id="star0"></div>
		<div id="button_tweet_search">
			<a href="http://twitter.com/share?text=<?php echo utf8_encode($message); ?> on #RateMySpeaker&amp;via=<?php echo $user['pseudo']; ?>" class="twitter-share-button" data-count="horizontal" data-via="ratemyspeaker">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
		</div>
		<?php echo utf8_encode($message); ?>
		<div class="source">
			<script type="text/javascript">
				$(function() {
					$('#star0').raty({
						readOnly:	true,
						start:		<?php echo $user['current_score']; ?>,
						half:       true,
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
	
	<br/><h2>His ratings</h2>
			<div id="speaker_conferences">
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
				<div class="speaker">
					<img class="speaker_picture <?php echo resizing($speaker['url_avatar']); ?>" src="<?php echo !empty($rate['url_avatar']) ? $rate['url_avatar'] : $dir.'img/profile.gif'; ?>" />
					<a href="<?php echo $dir.'s/'.str_replace(' ','',$rate['real_name']); ?>/<?php echo $rate['id']; ?>"><?php echo $rate['real_name']; ?></a>
					<div id="star<?php echo $i; ?>" class="starR fivestars"></div>
					<div class="source">
						<script type="text/javascript">
							$(function() {
								$('#star<?php echo $i; ?>').raty({
									readOnly:	true,
									start:		<?php echo $rate['rate']; ?>,
									half:       true,
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
</div>

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