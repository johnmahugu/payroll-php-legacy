<?php

class UserController{

	function __construct(){
	
		$this->daoFactory = DaoFactory::getInstance();
		$this->userObject = Request::getObject();
		
		$this->userDao = $this->daoFactory->getUserDao();
		$this->roleDao = $this->daoFactory->getRoleDao();
		
	}
	
	private function add(){
	
		$result = UserDto::isSuccess($this->userDao->addNew($this->userObject));	
		
		return $result;
	}
	
	private function delete(){
	
		$result = UserDto::isSuccess($this->userDao->delete($this->userObject->id));	
		
		return $result;
	}
	
	private function update(){
	
		$result = UserDto::isSuccess($this->userDao->update($this->userObject));
		
		return $result;
	}

	private function findAll(){
	
		$result = UserDto::refactorMany($this->userDao->findAll());
		
		return $result;
	}	
	
	private function findById(){

		$user = $this->userDao->findById($this->userObject->id);
		$roles = $this->roleDao->findAll();
		
		$result = UserDto::refactorOne($user,$roles);
		
		return $result;
	}
	
	private function findNames(){

	}
	
	private function getResult(){
	
		$mode = Request::getMode();
		$field = Request::getField();
		
		if(!empty($mode))
			if($mode == 'new')
				$result = $this->add();
			else if($mode == 'delete')
				$result = $this->delete();
			else
				$result = $this->update();
		else
			if(empty($this->userObject->id)) 
				$result = $this->findAll();
			else 
				$result = $this->findById();
				
		return $result;		
	}
	
	function __toString(){	
	//function toString(){	

		$result = $this->getResult();

		return $result;
	}
	
	
}
?>