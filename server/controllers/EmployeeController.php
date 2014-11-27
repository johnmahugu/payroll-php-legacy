<?php

class EmployeeController{

	function __construct(){
	
		$this->daoFactory = DaoFactory::getInstance();
		$this->employeeObject = Request::getObject();
		
		$this->employeeDao = $this->daoFactory->getEmployeeDao();
		$this->postDao = $this->daoFactory->getPostDao();
	}
	
	private function add(){
	
		$result = EmployeeDto::isSuccess($this->employeeDao->addNew($this->employeeObject));	
		
		return $result;
	}
	
	private function update(){
	
		$result = EmployeeDto::isSuccess($this->employeeDao->update($this->employeeObject));
		
		return $result;
	}
	
	private function delete(){
	
		$result = EmployeeDto::isSuccess($this->employeeDao->delete($this->employeeObject->id));
		
		return $result;
	}

	private function findAll(){
	
		$result = EmployeeDto::refactorMany($this->employeeDao->findAll());
		
		return $result;
	}	
	
	private function findById(){
	
		$posts = $this->postDao->findAll();
		$employee = $this->employeeDao->findOne($this->employeeObject->id);
		
		$result = EmployeeDto::refactorOne($employee,$posts);
		
		return $result;
	}
	
	// private function findNames(){
	
		//$result = EmployeeDto::refactorNames($this->employeeDao->findNames());
		
		// return $result;
	// }
	
	private function findEmployeesByBenefit(){
	
		$result = EmployeeDto::refactorMany($this->employeeDao->findEmployeesByBenefit($this->employeeObject->benefitId));
		
		return $result;
	}
	
	private function getResult(){
	
		$mode = Request::getMode();
		$field = Request::getField();
		
		if(!empty($field))
			if($field == 'paybenefitid')
				$result = $this->findEmployeesByBenefit();
			else
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
				if(empty($this->employeeObject->id)) 
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