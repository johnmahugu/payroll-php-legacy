<?php

abstract class AbstractDto{

	static function encode(Array $array){
	
		return json_encode($array);
	}
	
	static function isSuccess($success){
	
		$EnumSuccess = array('Failed','Succeded');
		
		$message = array('msg'=>$EnumSuccess[$success]);
		
		return self::encode($message);
	}
	
	static function ellipsisize($str,$count = 12){
	
		if(strlen($str)>12){
		
			$strTokenizer = new Tokenizer();
			$strTokenizer->concat(substr($str,0,$count));
			$strTokenizer->concat("....");
			$newStr = (string)$strTokenizer;
		
			return $newStr;
		}	
		else return $str;	
	}
}
?>