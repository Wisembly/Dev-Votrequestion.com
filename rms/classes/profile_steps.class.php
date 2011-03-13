<?php

	class ProfileSteps
	{
	
		public $lib_steps = array(
			0 => 'Sign In on RateMySpeaker with your Twitter account!',
			1 => 'Make your first rate for someone!', 										//step1
			2 => 'Reward an incredible speaker with a 5-stars rate!',	 					//step2
			3 => 'Sanction a bad speaker with a 1-star rate!',			 					//step3
			4 => 'Tweet your rate!',									 					//step4
			5 => 'Rate three different speakers',						 					//step5
			6 => 'Rate speakers in three different conferences',							//step6
			7 => 'Rate at least 50 speakers!'												//step7
		);
		
		public $value_steps = array(
			0 => 10,
			1 => 10,
			2 => 5,
			3 => 5,
			4 => 25,
			5 => 10,
			6 => 20,
			7 => 15
		);
		
		public function __construct()
		{
		}
		
		public function checkSteps($id_user)
		{
			global $table_prefix;
			
			return mysql_fetch_row(mysql_query("SELECT step1, step2, step3, step4, step5, step6, step7 FROM ".$table_prefix."Profile_Steps WHERE id_user = ".$id_user));
		}
		
		public function setProfileStepsAndScore($steps, $id_user)
		{
			global $table_prefix;
			
			$sql = null ;
			$score = 0 ;
			
			foreach ( $steps as $key => $step )
			{
				if ( $step == 2 )
				{
					$sql .= ' step'.($key+1).' = 1 ,';
					$score += $this->value_steps[$key+1];
				}
			}
			
			if ( !is_null($sql) && !empty($sql))
			{
				// on passe à 1 ce qu'il faut
				$sql = substr($sql,0,-1);
				mysql_query("UPDATE ".$table_prefix."Profile_Steps SET $sql WHERE id_user = ".$id_user);
				
				// on maj ici score	
				mysql_query("UPDATE ".$table_prefix."User SET profile_score = (profile_score + $score ) WHERE id = ".$id_user)or die(mysql_error());
			}
			
			return mysql_result(mysql_query("SELECT profile_score FROM ".$table_prefix."User WHERE id = ".$id_user),0);
		}
		
		public function tryStep2($score)
		{
			return ($score == 5) ? 2 : 0;
		}
		
		public function tryStep3($score)
		{
			error_log("sanction: $score");
			return ($score == 1) ? 2 : 0;
		}
		
		public function tryStep5($id_user)
		{
			global $table_prefix;
			
			return (mysql_result(mysql_query("SELECT nb_ratings FROM ".$table_prefix."User WHERE id = ".$id_user), 0) >= 3) ? 2 : 0;
		}
		
		public function tryStep6($id_user)
		{
			global $table_prefix;
			
			return (mysql_result(mysql_query("SELECT COUNT(DISTINCT id_conf) FROM ".$table_prefix."Rate AS R, ".$table_prefix."SpeakerInConf AS S WHERE R.id_speaker = S.id_speaker AND id_user = ".$id_user), 0) >= 3) ? 2 : 0;
		}
		
		public function tryStep7($id_user)
		{
			global $table_prefix;
			
			return (mysql_result(mysql_query("SELECT nb_ratings FROM ".$table_prefix."User WHERE id = ".$id_user), 0) >= 50) ? 2 : 0;
		}
	
	}
	
?>