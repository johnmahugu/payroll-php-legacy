<?php

class PayrollDao{

	function findById($payDetailsId){
	
		$employeePayDetails = Doctrine::getTable('PayDetails')->find($payDetailsId);
		
		return $employeePayDetails;
	}
	
	function findByEmployee($employeeId){
	
		$employeePayDetails = Doctrine::getTable('PayDetails')->findByEmployee($employeeId);
		$employeePayDetail = $employeePayDetails[$employeePayDetails->count()-1];
		
		return $employeePayDetail;
	}
	
	function addNew(stdClass $payDetailObject){
	
		try{

			$payDetails = new PayDetails();
			$payDetails->employee = $payDetailObject->employee;
			$payDetails->gross_salary = $payDetailObject->salary;
			//$payDetails->has_nhif = PayrollDto::EnumBool($payDetailObject->nhif);
			$payDetails->save();
			
			foreach($payDetailObject->benefits as $benefit){
			
				$payBenefit = new PayBenefit();
				$payBenefit->pay_details = $payDetails->id;
				$payBenefit->benefit = $benefit;
				$payBenefit->save();
			}
			
			return true;
		}
		catch(Exception $e){
		
			return false;
		}
	}
	
	function update(stdClass $payDetailObject){
	
		try{

			$payDetails = $this->findById($payDetailObject->id);
			$payDetails->employee = $payDetailObject->employee;
			$payDetails->gross_salary = $payDetailObject->salary;
			//$payDetails->has_nhif = PayrollDto::EnumBool($payDetailObject->nhif);
			$payDetails->save();
			
			$payDetails->PayBenefit->delete();
			
			foreach($payDetailObject->benefits as $benefit){
			
				$payBenefit = new PayBenefit();
				$payBenefit->pay_details = $payDetails->id;
				$payBenefit->benefit = $benefit;
				$payBenefit->save();
			}
				
			return true;
		}
		catch(Exception $e){
		
			return false;
		}
	}
}
?>