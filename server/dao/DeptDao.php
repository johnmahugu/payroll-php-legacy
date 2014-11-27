<?php

class DeptDao{

	function findAll(){
	
		$depts = Doctrine::getTable('Department')->findAll();
		
		return $depts;
	}
	
	function findOne($deptId){
	
		$dept = Doctrine::getTable('Department')->find($deptId);
		
		return $dept;
	}
	
	function findNames(){
	
		$depts = Doctrine_Query::create()	
		->select('d.name')
		->from('Department d')
		->execute();	
				
		return $depts;
	}
	
	function addNew(stdClass $deptObject){
		
		try{
		
			$dept = new Department();
			$dept->name = $deptObject->name;
			$dept->descr = $deptObject->descr;
			$dept->save();
			
			return true;
		}
		catch(Exception $e){
		
			return false;
		}
	}
	
	function update(stdClass $deptObject){
	
		try{
		
			$dept = $this->findOne($deptObject->id);
			$dept->name = $deptObject->name;
			$dept->descr = $deptObject->descr;
			$dept->save();
			
			return true;
		}
		catch(Exception $e){
		
			return false;
		}
	}
	
	function delete($deptId){
		
		try{
		
			$dept = $this->findOne($deptId);
			$dept->delete();
			
			return true;
		}
		catch(Exception $e){
		
			return false;
		}
	}
}
?>