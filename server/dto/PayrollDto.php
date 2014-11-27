<?php

class PayrollDto extends AbstractDto{
	
	static function refactorMany($payrollDetails){
		
		$payrollDetailsArrResponse['page'] = 1;
		$payrollDetailsArrResponse['total'] = $payrollDetails->count();
		
		$i = 1;
		foreach($payrollDetails as $payrollDetails)
			$payrollDetailsArrResponse['rows'][] = array('id'=>$payrollDetails->id,'cell'=>array($i++,$payrollDetails->id,$payrollDetails->employee,$payrollDetails->gross_salary));
		
		return self::encode($payrollDetailsArrResponse);
	}
	
	// static function EnumBool($isDeductable){
		
		// $strBool = array('Deduct'=>'1','Exempt'=>'0');
		
		// return $strBool[$isDeductable];
	// }
	
	static function refactorOne($payrollDetails){
	
		$payrollDetailsArrResponse = array('id'=>$payrollDetails->id,'employee'=>$payrollDetails->employee,'salary'=>$payrollDetails->gross_salary,'benefits'=>$payrollDetails->PayBenefit->toArray());
		
		return self::encode($payrollDetailsArrResponse);
	}
}

?>
