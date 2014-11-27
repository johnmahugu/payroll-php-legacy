<?php

class RoleDao{
	
	function findAll(){
	
		$roles = Doctrine::getTable('Role')->findAll();
		
		return $roles;
	}
	
	function findOne($roleId){
	
		$role = Doctrine::getTable('Role')->find($roleId);
		
		return $role;
	}
	
	function findNames(){
	
		$roles = Doctrine_Query::create()	
		->select('r.name')
		->from('Role r')
		->execute();	
				
		return $roles;
	}
	
	function addNew(stdClass $roleObject){
	
		try{
			
			$role = new Role();
			$role->name = $roleObject->name;
			$role->descr = $roleObject->descr;
			$role->save();
			
			return true;
		}
		catch(Exception $e){
		
			return false;
		}	
	}
	
	function update(stdClass $roleObject){
	
		try{
		
			$role = $this->findOne($roleObject->id);
			$role->name = $roleObject->name;
			$role->descr = $roleObject->descr;
			$role->save();
			
			return true;
		}
		catch(Exception $e){
		
			return false;
		}
	}
	
	function delete($roleId){
	
		try{
		
			$role = $this->findOne($roleId);
			$role->delete();
			
			return true;
		}
		catch(Exception $e){
		
			return false;
		}
	}
}
?>