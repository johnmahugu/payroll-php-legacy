<?php

class Dispatcher{

	function __construct($name){
	
		$ucfName = ucfirst($name);
		
		$strTokenizer = new Tokenizer();
		$strTokenizer->concat($ucfName);
		$strTokenizer->concat("Controller");
		
		$clazz = (string)$strTokenizer;
		
		$c = new $clazz;
		
		echo new $clazz;
		
	}
}
?>