<?php

class ArrayList{

	private $arrayEl;
	
	function put($key = null,$value = null){
	
		if(is_null($key) && !is_null($value))
			$this->arrayEl[] = $value;
		else if(!is_null($key) && !is_null($value))
			$this->arrayEl[$key] = $value;
				
		if(empty($this->arrayEl))
			return false;
		else return true;	
	}
	
	function get($key){
	
		return $this->arrayEl[$key];
	}
	
	function getArray(){
	
		return $this->arrayEl;
	}
}
?>