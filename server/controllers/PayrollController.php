<?php

class PayrollController{

	function __construct(){
	
		$this->daoFactory = DaoFactory::getInstance();
		$this->payrollDao = $this->daoFactory->getPayrollDao();
		$this->payrollObject = Request::getObject();
	}
	
	private function add(){
	
		$result = PayrollDto::isSuccess($this->payrollDao->addNew($this->payrollObject));	
		
		return $result;
	}
	
	private function update(){
	
		//print_r($this->payrollObject->rs);exit;
		$result = PayrollDto::isSuccess($this->payrollDao->update($this->payrollObject));
		
		return $result;
	}
	
	private function delete(){
	
		$result = PayrollDto::isSuccess($this->payrollDao->delete($this->payrollObject->id));
		
		return $result;
	}

	private function findAll(){
	
		$result = PayrollDto::refactorMany($this->payrollDao->findAll());
		
		return $result;
	}	
	
	private function findById(){
	
		$result = PayrollDto::refactorOne($this->payrollDao->findOne($this->payrollObject->id));
		
		return $result;
	}
	
	private function findByEmployee(){
	
		$result = PayrollDto::refactorOne($this->payrollDao->findByEmployee($this->payrollObject->employee));
		
		return $result;
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
			if(!empty($this->payrollObject->employee))
				$result = $this->findByEmployee();
			else 
				$result = $this->findById();
				
		return $result;		
	}
	
	function __toString(){	

		//try{
		
			$result = $this->getResult();
		//}
		//catch(Exception $e){
		
			//echo $e->getMessage();
		//}
		
		return $result;
	}
	
	
}
?>