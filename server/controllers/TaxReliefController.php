<?php

class TaxReliefController{

	function __construct(){
	
		$this->daoFactory = DaoFactory::getInstance();
		$this->taxReliefDao = $this->daoFactory->getTaxReliefDao();
		$this->taxReliefObject = Request::getObject();
	}
	
	private function add(){
	
		$result = TaxReliefDto::isSuccess($this->taxReliefDao->addNew($this->taxReliefObject));	
		
		return $result;
	}
	
	private function update(){
	
		$result = TaxReliefDto::isSuccess($this->taxReliefDao->update($this->taxReliefObject->rs));
		
		return $result;
	}
	
	private function delete(){
	
		$result = TaxReliefDto::isSuccess($this->taxReliefDao->delete($this->taxReliefObject->id));
		
		return $result;
	}

	private function findAll(){
	
		$result = TaxReliefDto::refactorMany($this->taxReliefDao->findAll());
		
		return $result;
	}	
	
	private function findById(){
	
		$result = TaxReliefDto::refactorOne($this->taxReliefDao->findById($this->taxReliefObject->id));
		
		return $result;
	}
	
	private function findNames(){
	
		$result = TaxReliefDto::refactorNames($this->taxReliefDao->findNames());
		
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
				if(empty($this->taxReliefObject->id)) 
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