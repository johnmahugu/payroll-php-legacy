<?php

class Tokenizer{

	private $str;

	function concat($token){
	
		$this->str .= $token;
	}
	
	function __toString(){
	
		return $this->str;
	}
}

?>