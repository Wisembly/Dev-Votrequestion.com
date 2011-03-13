<?php

require_once 'config.php';
require_once 'classes/profile_steps.class.php';

$title = 'RateMySpeaker - Your profile';
$description = 'RateMySpeaker.com let you search SXSW speakers by their names or by the conference official #hashtag and rate their performance up to 5 stars!';
$keywords = 'SXSW, Balloon, Conference, Speaker, Rate, Rating, Rank, Best Speaker, Music, Austin, Texas, Web, Twitter';

if (isset($_GET['pseudo']) && !empty($_GET['pseudo']))
	$pseudo = $_GET['pseudo'];
else
	header('Location: ');

$user = mysql_query("SELECT * FROM ".$table_prefix."User WHERE lower(pseudo) = '".mysql_real_escape_string(strtolower($pseudo))."'");

$dir = '../' ;
if (mysql_num_rows($user) == 0)
	header('Location: '.$dir.'');
	
$user = mysql_fetch_assoc($user);
$profile_score = $user['profile_score'];
$header = '<script type="text/javascript" src="'.$dir.'js/raty/jquery.raty.min.js"></script>';

$_SESSION['completenes'] = $user['profile_score'] ;

$profile_steps = new ProfileSteps();
$completed_steps = $profile_steps->checkSteps($user['id']);

if ( isset($_SESSION['id_user']) && $user['id'] == $_SESSION['id_user'] && $completed_steps[3] == 0 )
{
	require_once 'twittertest.php';
	$completed_steps = $profile_steps->checkSteps($user['id']);
}

include 'header.php';

if ($user['current_score'] == 5)
	$message = 'My life missed U #SXSW\'s speakers';
else if ($user['current_score'] < 5 && $user['current_score'] >= 4.5)
	$message = 'I luv U all #SXSW\'s Speakers';
else if ($user['current_score'] < 4.5 && $user['current_score'] >= 4)
	$message = 'I\'m a speaker luver at #SXSW';
else if ($user['current_score'] < 4 && $user['current_score'] >= 3.5)
	$message = 'My $$ \'ve been well spent on #SXSW Speakers';
else if ($user['current_score'] < 3.5 && $user['current_score'] >= 3)
	$message = 'My ears are happy at #SXSW';
else if ($user['current_score'] < 3 && $user['current_score'] >= 2.5)
	$message = 'I\'m more into TCDiscrupt than #SXSW';
else if ($user['current_score'] < 2.5 && $user['current_score'] >= 2)
	$message = 'Hey Speakers at #SXSW : What\'s that fuck ?';
else if ($user['current_score'] < 2 && $user['current_score'] >= 1.5)
	$message = 'I should visit Austin rather that #SXSW';
else if ($user['current_score'] < 1.5 && $user['current_score'] >= 1)
	$message = 'I shouldn\'t \'ve spent so much $$ for #SXSW';
else
	$message = null;

?>

<div id="user_profile">
	<img class="speaker_picture <?php echo $user['url_avatar']; ?>" src="<?php echo $user['url_avatar']; ?>" width="50" height="50">
	<div class="speaker_description">
		<h2><?php echo $user['pseudo']; ?></h2>
		<p class="p1"><?php echo $user['bio']; ?></p><div class="clear"></div><br/>
			
		<p class="p2">Average Note</p>
		<div id="star0"></div>
		<div id="button_tweet_search">
			<a href="http://twitter.com/share?text=<?php echo utf8_encode($message); ?> on #RateMySpeaker&amp;via=<?php echo $user['pseudo']; ?>" class="twitter-share-button" data-count="none" data-via="ratemyspeaker">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
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
	<br/><br/>
	<h2><?php echo $user['pseudo']; ?>'s SXSW completeness</h2>
		<div id="speaker_conferences" class="progress">
			<div class="loadbar">
				<p style="width:<?php echo $profile_score; ?>%;">
					<span><?php if ( $profile_score == 100 ) echo '<b style="float:left;padding-left:10px;">I\'m the attendee, bitch!™</b>' ; ?>
					<?php echo $profile_score; ?>%</span>
				</p>
			</div>
			<ul id="progress">
				<li>
					<p><?php echo $profile_steps->lib_steps[0].' +'.$profile_steps->value_steps[0].'%'; ?></p>
				</li>
			<?php 
				foreach ( $completed_steps as $key => $step )
				{	
					echo '<li'.(!$step?' style="position:relative;"':null).'>';
					echo (!$step?'<span>':'<p>').$profile_steps->lib_steps[$key+1].' +'.$profile_steps->value_steps[$key+1].'%'.(!$step?'</span>':'</p>');
					echo '</li>';
				}
			?>
			</ul>
		</div>
	
	<br/><h2><?php echo $user['pseudo']; ?>'s ratings</h2>
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
					<img class="speaker_picture <?php echo $rate['url_avatar']; ?>" src="<?php echo !empty($rate['url_avatar']) ? $rate['url_avatar'] : $dir.'img/profile.gif'; ?>" width="50" height="50"/>
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

mysql_close();
include 'footer.php';

?>