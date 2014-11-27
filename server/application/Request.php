<?php

class Request{
	
	static function getMode(){
	
		$mode = (empty($_REQUEST['form-mode']))?$_REQUEST['mode']:$_REQUEST['form-mode'];
		
		return $mode;
	}
	
	static function getField(){
	
		$field = $_REQUEST['field'];
		
		return $field;
	}
	
	static function isEmpty(){
	
		$isEmpty = empty($_REQUEST);
		
		return $isEmpty;
	}
	
	static function dispatch($location){
	
		header("location: $location");
		
		exit;
	}
	
	static function getName(){
	
		$name = (empty($_REQUEST['form-id']))?$_REQUEST['action']:$_REQUEST['form-id'];
	
		return $name;
	}
	
	static function getObject(){
	
		return (Object)$_REQUEST;
	}
}
?>