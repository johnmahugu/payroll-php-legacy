<?php

class DeptDto extends AbstractDto{

	static function refactorNames($depts){
	
		foreach($depts as $dept)
			$deptNamesArrResponse[] = array('id'=>$dept->id,'name'=>$dept->name);
		
		return self::encode($deptNamesArrResponse);
	}
	
	static function refactorMany($departments){
		
		$departmentsArrResponse['page'] = 1;
		$departmentsArrResponse['total'] = $departments->count();
		
		$i = 1;
		foreach($departments as $department)
			$departmentsArrResponse['rows'][] = array('id'=>$department->id,'cell'=>array($i++,$department->name,$department->descr));
		
		return self::encode($departmentsArrResponse);
	}
	
	static function refactorOne($department){
			
		$departmentArrResponse = array('id'=>$department->id,'name'=>$department->name,'descr'=>$department->descr);
		
		return self::encode($departmentArrResponse);
	}
}
?>