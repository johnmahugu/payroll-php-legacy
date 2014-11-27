<?php

class DeptController{

	function __construct(){
	
		$this->daoFactory = DaoFactory::getInstance();
		$this->deptDao = $this->daoFactory->getDeptDao();
		$this->deptObject = Request::getObject();
	}
	
	private function add(){
	
		$result = DeptDto::isSuccess($this->deptDao->addNew($this->deptObject));	
		
		return $result;
	}
	
	private function update(){
	
		$result = DeptDto::isSuccess($this->deptDao->update($this->deptObject));
		
		return $result;
	}
	
	private function delete(){
	
		$result = DeptDto::isSuccess($this->deptDao->delete($this->deptObject->id));
		
		return $result;
	}

	private function findAll(){
	
		$result = DeptDto::refactorMany($this->deptDao->findAll());
		
		return $result;
	}	
	
	private function findById(){
	
		$result = DeptDto::refactorOne($this->deptDao->findOne($this->deptObject->id));
		
		return $result;
	}
	
	private function findNames(){
	
		$result = DeptDto::refactorNames($this->deptDao->findNames());
		
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
				if(empty($this->deptObject->id)) 
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