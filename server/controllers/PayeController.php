<?php

class PayeController{

	function __construct(){
	
		$this->daoFactory = DaoFactory::getInstance();
		$this->payeDao = $this->daoFactory->getPayeDao();
		$this->payeObject = Request::getObject();
	}
	
	private function add(){
	
		$result = PayeDto::isSuccess($this->payeDao->addNew($this->payeObject));	
		
		return $result;
	}
	
	private function update(){
	
		//print_r($this->payeObject->rs);exit;
		$result = PayeDto::isSuccess($this->payeDao->update($this->payeObject->rs));
		
		return $result;
	}
	
	private function delete(){
	
		$result = PayeDto::isSuccess($this->payeDao->delete($this->payeObject->id));
		
		return $result;
	}

	private function findAll(){
	
		$result = PayeDto::refactorMany($this->payeDao->findAll());
		
		return $result;
	}	
	
	private function findById(){
	
		$result = PayeDto::refactorOne($this->payeDao->findOne($this->payeObject->id));
		
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
			if(empty($this->payeObject->id)) 
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