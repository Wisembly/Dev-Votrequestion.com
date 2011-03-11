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
		
		public function setProfileScore($steps)
		{
			$value = self::$value_steps[0];
			
			for ($i = 0; $i < 8; $i++)
			{
				if (self::$steps[$i] == 1) $value += self::$value_steps[$i + 1];
			}
			
			mysql_query("UPDATE ".$table_prefix."User SET profile_score = ".$value);
		}
	
	}
	
?>