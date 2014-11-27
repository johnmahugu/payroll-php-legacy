<?php

class EmployeeDao{

	function findAll(){
	
		$employees = Doctrine::getTable('Employee')->findAll();
		
		return $employees;
	}
	
	function findOne($employeeId){
	
		$employee = Doctrine::getTable('Employee')->find($employeeId);
		
		return $employee;
	}
	
	function findEmployeesByBenefit($benefitId){
	
		$employees = Doctrine_Query::create()
		->select('e.*')
		->from('Employee e')
		->leftJoin('e.PayDetails pd')
		->leftJoin('pd.PayBenefit pb')
		->where('pb.benefit = ?',$benefitId)
		->execute();
		
		return $employees;
	}
	
	function addNew(stdClass $employeeObject){
		
		$employees = $this->findAll();	
		$employeeCount = $employees->count()+1;
			
		try{
		
			$employee = new Employee();
			$employee->no = sprintf('EMP%s',$employeeCount);
			$employee->surname = $employeeObject->surname;
			$employee->othernames = $employeeObject->othernames;
			$employee->post = $employeeObject->post;
			$employee->address1 = $employeeObject->address1;
			$employee->address2 = $employeeObject->address2;
			$employee->phone1 = EmployeeDto::refactorPhoneFirstNo($employeeObject);
			$employee->phone2 = EmployeeDto::refactorPhoneSecNo($employeeObject);
			$employee->email1 = $employeeObject->email1;
			$employee->email2 = $employeeObject->email2;
			$employee->nssf = $employeeObject->nssf;
			$employee->nhif = $employeeObject->nhif;
			$employee->pin = $employeeObject->pin;
			$employee->gender = $employeeObject->gender;
			$employee->country = $employeeObject->country;
			$employee->city = $employeeObject->city;
			$employee->dob = $employeeObject->dob;
			$employee->start = $employeeObject->start;
			$employee->end = $employeeObject->end;
			$employee->status = $employeeObject->status;
			$employee->bankacc = $employeeObject->bankacc;
			$employee->active = EmployeeDto::refactorActive($employeeObject);
			$employee->save();
			
			return true;
		}
		catch(Exception $e){
		
			//echo $e->getMessage();
			
			return false;
		}
	}
	function update(stdClass $employeeObject){
		
		try{
		
			$employee = $this->findOne($employeeObject->id);
			$employee->no = $employeeObject->empno;
			$employee->surname = $employeeObject->surname;
			$employee->othernames = $employeeObject->othernames;
			$employee->post = $employeeObject->post;
			$employee->address1 = $employeeObject->address1;
			$employee->address2 = $employeeObject->address2;
			$employee->phone1 = EmployeeDto::refactorPhoneFirstNo($employeeObject);
			$employee->phone2 = EmployeeDto::refactorPhoneSecNo($employeeObject);
			$employee->email1 = $employeeObject->email1;
			$employee->email2 = $employeeObject->email2;
			$employee->nssf = $employeeObject->nssf;
			$employee->nhif = $employeeObject->nhif;
			$employee->pin = $employeeObject->pin;
			$employee->gender = $employeeObject->gender;
			$employee->country = $employeeObject->country;
			$employee->city = $employeeObject->city;
			$employee->dob = $employeeObject->dob;
			$employee->start = $employeeObject->start;
			$employee->end = $employeeObject->end;
			$employee->status = $employeeObject->status;
			$employee->bankacc = $employeeObject->bankacc;
			$employee->active = EmployeeDto::refactorActive($employeeObject);
			$employee->save();
			
			return true;	
		}
		catch(Exception $e){
		
			return false;
		}
	}
	
	function delete($employeeId){
	
		try{
		
			$employee = $this->findOne($employeeId);
			$employee->delete();
			
			return true;	
		}
		catch(Exception $e){
		
			return false;
		}
	}
}
?>