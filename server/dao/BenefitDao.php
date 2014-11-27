<?php

class BenefitDao{
	
	function findAll(){
	
		$benefits = Doctrine::getTable('Benefit')->findAll();
		
		return $benefits;
	}
	
	function findOne($benefitId){
	
		$benefit = Doctrine::getTable('Benefit')->find($benefitId);
		
		return $benefit;
	}
	
	function findNames(){
	
		$benefits = Doctrine_Query::create()	
		->select('b.name')
		->from('Benefit b')
		->where('b.active = ?',1)
		->execute();	
				
		return $benefits;
	}
	
	function addNew(stdClass $benefitObject){
	
		try{

			$benefit = new Benefit();
			$benefit->name = $benefitObject->name;
			$benefit->descr = $benefitObject->descr;
			$benefit->damt = $benefitObject->amt;
			$benefit->perc = $benefitObject->perc;
			$benefit->deduct = $benefitObject->deduct;
			$benefit->taxable = $benefitObject->taxable;
			$benefit->active = $benefitObject->active;
			$benefit->save();
			
			return true;
		}
		catch(Exception $e){
		
			return false;
		}	
	}
	
	function update(stdClass $benefitObject){
	
		try{
		
			$benefit = $this->findOne($benefitObject->id);
			$benefit->name = $benefitObject->name;
			$benefit->descr = $benefitObject->descr;
			$benefit->damt = $benefitObject->amt;
			$benefit->perc = $benefitObject->perc;
			$benefit->deduct = $benefitObject->deduct;
			$benefit->taxable = $benefitObject->taxable;
			$benefit->active = $benefitObject->active;
			$benefit->save();
			
			return true;
		}
		catch(Exception $e){
		
			return false;
		}
	}
	
	function delete($benefitId){
	
		try{
		
			$benefit = $this->findOne($benefitId);
			$benefit->delete();
			
			return true;
		}
		catch(Exception $e){
		
			return false;
		}
	}
}
?>