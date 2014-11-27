<?php

class EmployeeDto extends AbstractDto{

	static function refactorMany($employees){
		
		$employeesArrResponse['page'] = 1;
		$employeesArrResponse['total'] = $employees->count();
		$EnumActive = array('Inactive','Active');
		
		$i = 1;
		foreach($employees as $employee)
			$employeesArrResponse['rows'][] = array('id'=>$employee->id,'cell'=>array(
			$i++,
			$employee->no,
			$employee->surname,
			$employee->othernames,
			$employee->Post->name,
			/*$employee->address1,
			$employee->address2,
			$employee->phone1,
			$employee->phone2,
			$employee->email1,
			$employee->email2,
			$employee->nssf,
			$employee->nhif,
			$employee->pin,
			$employee->gender,
			$employee->country,
			$employee->city,
			$employee->dob,
			$employee->start,
			$employee->end,
			$employee->status,//marital
			$employee->bankacc,*/
			$EnumActive[$employee->active]));
		
		return self::encode($employeesArrResponse);
	}
	
	static function refactorActive(stdClass $employeeObject){
	
		$active = ($employeeObject->active == 'on')?"1":"0";
		
		return $active;
	}
	
	static function refactorPhoneFirstNo(stdClass $employeeObject){
	
		$employeePhoneNumber = implode("-",array($employeeObject->country_prefix_safcom,
			$employeeObject->service_prefix_safcom,
			$employeeObject->first_suffix_safcom,
			$employeeObject->second_suffix_safcom));
			
		return $employeePhoneNumber;	
	}
	
	static function refactorPhoneSecNo(stdClass $employeeObject){
	
		$employeePhoneNumber = implode("-",array($employeeObject->country_prefix_zain,
			$employeeObject->service_prefix_zain,
			$employeeObject->first_suffix_zain,
			$employeeObject->second_suffix_zain));
			
		return $employeePhoneNumber;	
	}
	
	static function refactorOne($employee,$posts){

		$EnumActive  = array('false','true');
		
		foreach($posts as $post)
			$postsArrResponse[] = array('id'=>$post->id,'name'=>$post->name);

		$arrProvider = array('countryPrefix','servicePrefix','firstSuffix','secondSuffix');
		
		$i = 0;	
		$employeePhoneSections1 = explode("-",$employee->phone1);
		foreach($employeePhoneSections1 as $section1)
			$arrPhoneSections1[$arrProvider[$i++]."Safcom"] = $section1;
		
		$i = 0;	
		$employeePhoneSections2 = explode("-",$employee->phone2);
		foreach($employeePhoneSections2 as $section2)
			$arrPhoneSections2[$arrProvider[$i++]."Zain"] = $section2;
		
		$employeeArrResponse = array('id'=>$employee->id,
			'no'=>$employee->no,
			'surname'=>$employee->surname,
			'othernames'=>$employee->othernames,
			'post'=>$employee->Post->name,
			'address1'=>$employee->address1,
			'address2'=>$employee->address2,
			'phone1'=>$arrPhoneSections1,
			'phone2'=>$arrPhoneSections2,
			'email1'=>$employee->email1,
			'email2'=>$employee->email2,
			'nssf'=>$employee->nssf,
			'nhif'=>$employee->nhif,
			'pin'=>$employee->pin,
			'gender'=>$employee->gender,
			'country'=>$employee->country,
			'city'=>$employee->city,
			'dob'=>$employee->dob,
			'start'=>$employee->start,
			'end'=>$employee->end,
			'status'=>$employee->status,//marital
			'bankacc'=>$employee->bankacc,
			'active'=>$EnumActive[$employee->active],
			'posts'=>$postsArrResponse,
			'paydetails'=>$employee->PayDetails[$employee->PayDetails->count()-1]->id);
		
		return self::encode($employeeArrResponse);
	}
}
?>