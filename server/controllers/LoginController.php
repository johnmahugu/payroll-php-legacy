<?php

class LoginController{

	function __construct(){
	
		$this->daoFactory = DaoFactory::getInstance();
		$this->loginObject = Request::getObject();
		
		$this->userDao = $this->daoFactory->getUserDao();		
	}
	
	function authenticate(){
	
		if(empty($this->loginObject->username) || empty($this->loginObject->password))
			$userExists = false;
		else
			$userExists = $this->userDao->findOne($this->loginObject->username,$this->loginObject->password);
		
		$user = $this->userDao->getCurrent();
		
		$_SESSION['isLoggedIn'] = false;
		$_SESSION['username'] = $user->username;
		$_SESSION['userId'] = $user->id;
		$_SESSION['userRoleId'] = $user->Role->id;
		$_SESSION['userRole'] = $user->Role->name;
		
		if(empty($user->id))
			$result = UserDto::isSuccess(false);
		else{
		
			$result = UserDto::isSuccess($userExists);
			$_SESSION['isLoggedIn'] = true;
		}	
		
		return $result;
	}
	
	function isLoggedIn(){
		
		$result = LoginDto::status($_SESSION['isLoggedIn']);
		
		return $result;
	}
	
	function logOut(){
	
		unset($_SESSION['isLoggedIn']);
		unset($_SESSION['username']);
		unset($_SESSION['userRoleId']);
		unset($_SESSION['userRole']);
		unset($_SESSION['userId']);
		
		$result = LoginDto::status($_SESSION['isLoggedIn']);
		
		return $result;
	}
	
	private function getResult(){
	
		$mode = Request::getMode();
		$field = Request::getField();
		
		if(empty($mode))
			$result = $this->authenticate();
		else if($mode == 'isloggedin')	
			$result = $this->isLoggedIn();
		else if($mode == 'logout')	
			$result = $this->logOut();
				
		return $result;		
	}
	
	function __toString(){	
	//function toString(){	

		$result = $this->getResult();

		return $result;
	}
}
?>
