<?php

	class ProfileSteps
	{
	
		public $lib_steps = array(
			0 => 'Signin',
			1 => 'First rate', 			//step1
			2 => 'Five-stars rate', 	//step2
			3 => 'One-star rate', 		//step3
			4 => 'Tweet', 				//step4
			5 => 'Three rates', 		//step5
			6 => 'Three confs',			//step6
			7 => 'All speakers conf', 	//step7
			8 => 'Three friends' 		//step8
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
			return mysql_fetch_row(mysql_query("SELECT step1, step2, step3, step4, step5, step6, step7, step8 FROM ".$table_prefix."profile_steps WHERE id_user = ".$id_user));
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