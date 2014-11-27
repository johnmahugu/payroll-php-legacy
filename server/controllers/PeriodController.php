<?php

class PeriodController{

	function __construct(){
	
		$this->daoFactory = DaoFactory::getInstance();
		$this->periodDao = $this->daoFactory->getPeriodDao();
		$this->periodObject = Request::getObject();
	}
	
	private function add(){
	
		$result = PeriodDto::isSuccess($this->periodDao->addNew($this->periodObject));	
		
		return $result;
	}
	
	private function update(){
	
		$result = PeriodDto::isSuccess($this->periodDao->update($this->periodObject));
		
		return $result;
	}
	
	private function delete(){
	
		$result = PeriodDto::isSuccess($this->periodDao->delete($this->periodObject->id));
		
		return $result;
	}

	private function findAll(){
	
		$result = PeriodDto::refactorMany($this->periodDao->findAll());
		
		return $result;
	}	
	
	private function findById(){
	
		$result = PeriodDto::refactorOne($this->periodDao->findOne($this->periodObject->id));
		
		return $result;
	}
	
	// private function findNames(){
	
		// $result = PeriodDto::refactorNames($this->periodDao->findNames());
		
		// return $result;
	// }
	
	private function getResult(){
	
		$mode = Request::getMode();
		$field = Request::getField();
		
		// if(!empty($field))
			// $result = $this->findNames();
		// else
		
		if(!empty($mode))
			if($mode == 'new')
				$result = $this->add();
			else if($mode == 'delete')				
				$result = $this->delete();
			else
				$result = $this->update();
		else
			if(empty($this->periodObject->id)) 
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