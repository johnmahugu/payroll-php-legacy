<?php

class NhifController{

	function __construct(){
	
		$this->daoFactory = DaoFactory::getInstance();
		$this->nhifDao = $this->daoFactory->getNhifDao();
		$this->nhifObject = Request::getObject();
	}
	
	private function add(){
	
		$result = NhifDto::isSuccess($this->nhifDao->addNew($this->nhifObject));	
		
		return $result;
	}
	
	private function update(){
	
		$result = NhifDto::isSuccess($this->nhifDao->update($this->nhifObject->rs));
	
		return $result;
	}
	
	private function delete(){
	
		$result = NhifDto::isSuccess($this->nhifDao->delete($this->nhifObject->id));
		
		return $result;
	}

	private function findAll(){
	
		$result = NhifDto::refactorMany($this->nhifDao->findAll());
		
		return $result;
	}	
	
	private function findById(){
	
		$result = NhifDto::refactorOne($this->nhifDao->findOne($this->nhifObject->id));
		
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
			if(empty($this->nhifObject->id)) 
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