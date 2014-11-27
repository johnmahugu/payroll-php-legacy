<?php

class RoleController{

	function __construct(){
	
		$this->daoFactory = DaoFactory::getInstance();
		$this->roleDao = $this->daoFactory->getRoleDao();
		$this->roleObject = Request::getObject();
	}
	
	private function add(){
	
		$result = RoleDto::isSuccess($this->roleDao->addNew($this->roleObject));	
		
		return $result;
	}
	
	private function update(){
	
		$result = RoleDto::isSuccess($this->roleDao->update($this->roleObject));
		
		return $result;
	}
	
	private function delete(){
	
		$result = RoleDto::isSuccess($this->roleDao->delete($this->roleObject->id));
		
		return $result;
	}

	private function findAll(){
	
		$result = RoleDto::refactorMany($this->roleDao->findAll());
		
		return $result;
	}	
	
	private function findById(){
	
		$result = RoleDto::refactorOne($this->roleDao->findOne($this->roleObject->id));
		
		return $result;
	}
	
	private function findNames(){
	
		$result = RoleDto::refactorNames($this->roleDao->findNames());
		
		return $result;
	}
	
	private function getResult(){
	
		$mode = Request::getMode();
		$field = Request::getField();
		
		if(!empty($field))
			$result = $this->findNames();
		else
			if(!empty($mode))
				if($mode == 'new')
					$result = $this->add();
				else if($mode == 'delete')				
					$result = $this->delete();
				else
					$result = $this->update();
			else
				if(empty($this->roleObject->id)) 
					$result = $this->findAll();
				else 
					$result = $this->findById();
				
		return $result;		
	}
	
	function __toString(){	

		$result = $this->getResult();

		return $result;
	}
	
	
}
?>