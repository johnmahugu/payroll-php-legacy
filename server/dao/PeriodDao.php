<?php

class PeriodDao{
	
	function findAll(){
	
		$periods = Doctrine::getTable('Period')->findAll();
		
		return $periods;
	}
	
	function findOne($periodId){
	
		$period = Doctrine::getTable('Period')->find($periodId);
		
		return $period;
	}
	
	// function findNames(){
	
		// $roles = Doctrine_Query::create()	
		// ->select('r.name')
		// ->from('Period r')
		// ->execute();	
				
		// return $roles;
	// }
	
	private function deactivateAll(){
	
		$periods = $this->findAll();
		foreach($periods as $period){
		
			$period->active = (integer)false;
			$period->mby = $_SESSION['userId'];
			$period->mdate = date('Y-m-d H:i:s');
			$period->save();
		}	
	}
	
	function addNew(stdClass $periodObject){
	
		try{

			if((bool)$periodObject->active)
				$this->deactivateAll();
				
			$period = new Period();
			$period->start = $periodObject->start;
			$period->end = $periodObject->end;
			$period->status = $periodObject->status;
			$period->active = (integer)$periodObject->active;	
			$period->mby = $_SESSION['userId'];
			$period->cby = $_SESSION['userId'];
			$period->mdate = date('Y-m-d H:i:s');
			$period->cdate = date('Y-m-d H:i:s');
			$period->save();
			
			return true;
		}
		catch(Exception $e){
		
			//echo $e->getMessage();
			return false;
		}	
	}
	
	function update(stdClass $periodObject){
	
		try{
		
			if((bool)$periodObject->active)
				$this->deactivateAll();
				
			$period = $this->findOne($periodObject->id);
			$period->start = $periodObject->start;
			$period->end = $periodObject->end;
			$period->status = $periodObject->status;
			$period->active = (integer)$periodObject->active;
			$period->mby = $_SESSION['userId'];
			$period->mdate = date('Y-m-d H:i:s');
			$period->save();
			
			return true;
		}
		catch(Exception $e){
		
			return false;
		}
	}
	
	function delete($periodId){
	
		try{
		
			$period = $this->findOne($periodId);
			$period->delete();
			
			return true;
		}
		catch(Exception $e){
		
			return false;
		}
	}
}
?>