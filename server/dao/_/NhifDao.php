<?php

class NhifDao{
	
	function findAll(){
	
		$nhifRates = Doctrine::getTable('Nhif')->findAll();
		
		return $nhifRates;
	}
	
	function findById($nhifRateId){
	
		$nhifRate = Doctrine::getTable('Nhif')->find($nhifRateId);
		
		return $nhifRate;
	}
	
	function addNew(stdClass $nhifRateObject){
	
		try{
			
			$nhifRate = new Nhif();
			$nhifRate->lbound = $nhifRateObject->lbound;
			$nhifRate->ubound = $nhifRateObject->ubound;
			$nhifRate->amount = $nhifRateObject->amount;
			$nhifRate->save();
			
			return true;
		}
		catch(Exception $e){
		
			return false;
		}	
	}
	
	function update(Array $rsNhifRateObjects){
	
		try{
		
			foreach($rsNhifRateObjects as $rsNhifRateObject){
			
				$nhifRateObject = (object)$rsNhifRateObject;

				$nhifRate = $this->findById($nhifRateObject->id);
				$nhifRate->lbound = $nhifRateObject->lbound;
				$nhifRate->ubound = $nhifRateObject->ubound;
				$nhifRate->amount = $nhifRateObject->amount;
				$nhifRate->save();
			}	
			
			return true;
		}
		catch(Exception $e){
		
			return false;
		}
	}
	
	function delete($nhifRateId){
	
		try{
			
			$nhifRate = $this->findById($nhifRateId);
			$nhifRate->delete();
			
			return true;
		}
		catch(Exception $e){
		
			return false;
		}	
	}
}
?>