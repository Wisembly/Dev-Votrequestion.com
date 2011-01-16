<?php

Class Token
{
	private $token;
	private $bool_token = false;
	private $salt;
	
	// crée et stoke le token si n'existe pas. Le récupère sinon.
	public function __construct()
	{
		if ( !isset($_COOKIE['balloon_token']) && !isset($_SESSION['balloon_token']) ) 
		{
			$user_ip = $_SERVER['REMOTE_ADDR'] ;
			$user_agent = $_SERVER['HTTP_USER_AGENT'];
			$user_connect_time = time();
			$this->salt = uniqid();

			$this->token = md5($user_ip.$user_agent.$user_connect_time.$this->salt) ;

			setcookie('balloon_token',$this->token) ;
			$_SESSION['balloon_token'] = $this->token;
			$this->bool_token = true ;
		} 
		else 
		{
			$this->token = isset($_COOKIE['balloon_token']) ? $_COOKIE['balloon_token'] : (isset($_SESSION['balloon_token']) ? $_SESSION['balloon_token'] : false) ;
			$this->bool_token = ($this->token != false) ? true : false ;
		}
	}
	
	public function hasToken()
	{
		return $this->bool_token;
	}
	
	// récupération du token
	public function getToken()
	{
		return $this->token;
	}
}

?>