<?php

class PostDao{

	function findAll(){
	
		$posts = Doctrine::getTable('Post')->findAll();
		
		return $posts;
	}
	
	function findOne($postId){
	
		$post = Doctrine::getTable('Post')->find($postId);
		
		return $post;
	}
	
	function findNames(){
	
		$posts = Doctrine_Query::create()	
		->select('p.name')
		->from('Post p')
		->execute();	
				
		return $posts;
	}
	
	function addNew(stdClass $postObject){
		
		try{
		
			$post = new Post();
			$post->name = $postObject->name;
			$post->descr = $postObject->descr;
			$post->department = $postObject->dept;
			$post->save();
			
			return true;
		}
		catch(Exception $e){
		
			return false;
		}
	}
	
	function update(stdClass $postObject){
	
		try{
		
			$post = $this->findOne($postObject->id);
			$post->name = $postObject->name;
			$post->descr = $postObject->descr;
			$post->department = $postObject->dept;
			$post->save();
			
			return true;
		}
		catch(Exception $e){
		
			return false;
		}
	}
	
	function delete($postId){
	
		try{
		
			$post = $this->findOne($postId);
			$post->delete();
			
			return true;
		}
		catch(Exception $e){
		
			return false;
		}
	}
}
?>