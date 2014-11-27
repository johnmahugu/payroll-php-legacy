<?php

class PostController{

	function __construct(){
	
		$this->daoFactory = DaoFactory::getInstance();
		
		$this->deptDao = $this->daoFactory->getDeptDao();
		
		$this->postDao = $this->daoFactory->getPostDao();
		$this->postObject = Request::getObject();
	}
	
	private function add(){
	
		$result = PostDto::isSuccess($this->postDao->addNew($this->postObject));	
		
		return $result;
	}
	
	private function update(){
	
		$result = PostDto::isSuccess($this->postDao->update($this->postObject));
		
		return $result;
	}
	
	private function delete(){
	
		$result = PostDto::isSuccess($this->postDao->delete($this->postObject->id));
		
		return $result;
	}

	private function findAll(){
	
		$result = PostDto::refactorMany($this->postDao->findAll());
		
		return $result;
	}	
	
	private function findById(){
	
		$departments = $this->deptDao->findAll();
		$post = $this->postDao->findOne($this->postObject->id);
		
		$result = PostDto::refactorOne($post,$departments);
		
		return $result;
	}
	
	private function findNames(){
	
		$result = PostDto::refactorNames($this->postDao->findNames());
		
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
				if(empty($this->postObject->id)) 
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