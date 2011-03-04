<?php include("includes/header.php"); ?>

<div id="user_profile">
	<img class="user_picture" src="http://a3.twimg.com/profile_images/1169535523/Incubateur_HEC_2010_001_17.jpg">
	<div class="speaker_description">
		<h2>Romain David</h2>
		<p class="p1">Web Entrepreneur, co-founder at @Balloon & Photographer</p1><div class="clear"></div><br/>
			
		<p class="p2">Average Note</p2>
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
	
	<br/><h2>His ratings</h2>
	
	<div id="user_historic">
		
		<div class="speaker">
			<img class="speaker_picture" src="http://static.sched.org/a/155594/avatar.jpg.50x50px.jpg">
			Romain David<div id="star1"></div>
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
		
		<div class="speaker">
			<img class="speaker_picture" src="http://static.sched.org/a/155594/avatar.jpg.50x50px.jpg">
			Romain David<div id="star2"></div>
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
	
	</div>
</div>
<?php include("includes/footer.php"); ?>	
