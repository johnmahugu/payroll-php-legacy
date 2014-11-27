<?php

class PayeDao{
	
	function findAll(){
	
		$PayeRates = Doctrine::getTable('Paye')->findAll();
		
		return $PayeRates;
	}
	
	function findById($PayeRateId){
	
		$payeRate = Doctrine::getTable('Paye')->find($PayeRateId);
		
		return $payeRate;
	}
	
	function addNew(stdClass $payeRateObject){
	
		try{
			
			$payeRate = new Paye();
			$payeRate->mlbound = $payeRateObject->mlbound;
			$payeRate->mubound = $payeRateObject->mubound;
			$payeRate->albound = $payeRateObject->albound;
			$payeRate->aubound = $payeRateObject->aubound;
			$payeRate->rate = $payeRateObject->rate;
			$payeRate->amount = $payeRateObject->amount;
			$payeRate->save();
			
			return true;
		}
		catch(Exception $e){
		
			return false;
		}	
	}
	
	function update(Array $rsPayeRateObjects){
	
		try{
		
			foreach($rsPayeRateObjects as $rsPayeRateObject){
			
				$payeRateObject = (Object)$rsPayeRateObject;
				
				$payeRate = $this->findById($payeRateObject->id);
				$payeRate->mlbound = $payeRateObject->mlbound;
				$payeRate->mubound = $payeRateObject->mubound;
				$payeRate->albound = $payeRateObject->albound;
				$payeRate->aubound = $payeRateObject->aubound;
				$payeRate->rate = $payeRateObject->rate;
				$payeRate->save();
			}
			
			return true;
		}
		catch(Exception $e){
		
			return false;
		}
	}
	
	function delete($PayeRateId){
	
		try{
			
			$payeRate = $this->findById($PayeRateId);
			$payeRate->delete();
			
			return true;
		}
		catch(Exception $e){
		
			return false;
		}	
	}
}
?>