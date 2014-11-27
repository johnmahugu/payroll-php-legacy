<?php

class BenefitController{

	function __construct(){
	
		$this->daoFactory = DaoFactory::getInstance();
		$this->benefitDao = $this->daoFactory->getBenefitDao();
		$this->benefitObject = Request::getObject();
	}
	
	private function add(){
	
		$result = BenefitDto::isSuccess($this->benefitDao->addNew($this->benefitObject));	
		
		return $result;
	}
	
	private function update(){
	
		$result = BenefitDto::isSuccess($this->benefitDao->update($this->benefitObject));
		
		return $result;
	}
	
	private function delete(){
	
		$result = BenefitDto::isSuccess($this->benefitDao->delete($this->benefitObject->id));
		
		return $result;
	}

	private function findAll(){
	
		$result = BenefitDto::refactorMany($this->benefitDao->findAll());
		
		return $result;
	}	
	
	private function findById(){
	
		$result = BenefitDto::refactorOne($this->benefitDao->findOne($this->benefitObject->id));
		
		return $result;
	}
	
	private function findNames(){
	
		$result = BenefitDto::refactorNames($this->benefitDao->findNames());
		
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
				if(empty($this->benefitObject->id)) 
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