<?php

class LoginDto{

	static function status($boolVal){
	
		if(is_null($boolVal))
			$boolVal = 0;
			
		$loginStatus = array('loggedout','loggedin');
		
		$message = array('msg'=>$loginStatus[$boolVal]);
		
		return json_encode($message);
	}
}
?>