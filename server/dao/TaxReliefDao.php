<?php

class TaxReliefDao{
	
	function findAll(){
	
		$taxReliefRates = Doctrine::getTable('Relief')->findAll();
		
		return $taxReliefRates;
	}
	
	function findById($taxReliefRateId){
	
		$taxReliefRate = Doctrine::getTable('Relief')->find($taxReliefRateId);
		
		return $taxReliefRate;
	}
	
	function addNew(stdClass $taxReliefRateObject){
	
		try{
			
			$taxReliefRate = new Relief();
			$taxReliefRate->name = $taxReliefRateObject->name;
			$taxReliefRate->monthly = $taxReliefRateObject->monthly;
			$taxReliefRate->annual = $taxReliefRateObject->annual;
			$taxReliefRate->active = TaxReliefDto::refactorBool($taxReliefRateObject->active);
			$taxReliefRate->save();
			
			return true;
		}
		catch(Exception $e){
		
			return false;
		}	
	}
	
	function update(Array $rsTaxReliefRateObjects){
	
		try{
		
			foreach($rsTaxReliefRateObjects as $rsTaxReliefRateObject){
			
				$taxReliefRateObject = (Object)$rsTaxReliefRateObject;
				
				$taxReliefRate = $this->findById($taxReliefRateObject->id);
				$taxReliefRate->name = $taxReliefRateObject->name;
				$taxReliefRate->monthly = $taxReliefRateObject->monthly;
				$taxReliefRate->annual = $taxReliefRateObject->annual;
				$taxReliefRate->active = TaxReliefDto::refactorBool($taxReliefRateObject->active);
				$taxReliefRate->save();
			}
			
			return true;
		}
		catch(Exception $e){
		
			return false;
		}
	}
	
	function delete($taxReliefRateId){
	
		try{
			
			$taxReliefRate = $this->findById($taxReliefRateId);
			$taxReliefRate->delete();
			
			return true;
		}
		catch(Exception $e){
		
			return false;
		}	
	}
}
?>