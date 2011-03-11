<?php

	class ProfileSteps
	{
	
		public $lib_steps = array(
			0 => 'Sign In on RateMySpeaker with your Twitter account!',
			1 => 'Make your first rate for someone!', 										//step1
			2 => 'Reward an incredible speaker with a 5-stars rate!',	 					//step2
			3 => 'Sanction a bad speaker with a 1-star rate!',			 					//step3
			4 => 'Tweet your rate! - <b>coming soon!</b>',				 					//step4
			5 => 'Rate three different speakers',						 					//step5
			6 => 'Rate speakers in three different conferences',							//step6
			7 => 'After at least 10 rates, have an average rating score of 4!',				//step7
			8 => 'Have three Twitter friends using RateMySpeaker - <b>coming soon!</b>' 	//step8
		);
		
		public $value_steps = array(
			0 => 10,
			1 => 10,
			2 => 5,
			3 => 5,
			4 => 20,
			5 => 10,
			6 => 15,
			7 => 5,
			8 => 20
		);
		
		public function __construct()
		{
		}
		
		public function checkSteps($id_user)
		{
			global $table_prefix;
			
			return mysql_fetch_row(mysql_query("SELECT step1, step2, step3, step4, step5, step6, step7, step8 FROM ".$table_prefix."Profile_Steps WHERE id_user = ".$id_user));
		}
		
		public function setProfileSteps($steps, $id_user)
		{
			global $table_prefix;
			
			mysql_query("UPDATE ".$table_prefix."Profile_Steps SET step1 = ".$steps[0].", step2 = ".$steps[1].", step3 = ".$steps[2].", step4 = ".$steps[3].", step5 = ".$steps[4].", step6 = ".$steps[5].", step7 = ".$steps[6].", step8 = ".$steps[7]." WHERE id_user = ".$id_user);
		}
		
		public function setProfileScore($steps)
		{
			global $table_prefix;
			
			$value = $this->value_steps[0];
			
			for ($i = 0; $i < 8; $i++)
			{
				if ($steps[$i] == 1) $value += $this->value_steps[$i + 1];
			}
			
			mysql_query("UPDATE ".$table_prefix."User SET profile_score = ".$value);
		}
		
		public function tryStep1($step)
		{
			return ($step == 0) ? 1 : 0;
		}
		
		public function tryStep2($step, $score)
		{
			return ($step == 0 && $score == 5) ? 1 : 0;
		}
		
		public function tryStep3($step, $score)
		{
			return ($step == 0 && $score == 1) ? 1 : 0;
		}
		
		public function tryStep5($step, $id_user)
		{
			global $table_prefix;
			
			return ($step == 0 && mysql_result(mysql_query("SELECT nb_ratings FROM ".$table_prefix."User WHERE id_user = ".$id_user), 0) >= 3) ? 1 : 0;
		}
		
		public function tryStep6($step, $id_user)
		{
			global $table_prefix;
			
			return ($step == 0 && mysql_result(mysql_query("SELECT COUNT(DISTINCT id_conf) FROM ".$table_prefix."Rate AS R, ".$table_prefix."SpeakerInConf AS S WHERE R.id_speaker = S.id_speaker AND id_user = ".$id_user), 0) >= 3) ? 1 : 0;
		}
		
		public function tryStep7($step, $id_user)
		{
			global $table_prefix;
			
			return ($step == 0 && mysql_result(mysql_query("SELECT COUNT(id_user) FROM ".$table_prefix."User WHERE id_user = ".$id_user." AND nb_ratings >= 10 AND current_score >= 4"), 0) > 0) ? 1 : 0;
		}
	
	}
	
?>