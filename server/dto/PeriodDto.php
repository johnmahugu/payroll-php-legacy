<?php

class PeriodDto extends AbstractDto{
	
	// static function refactorNames($periods){
	
		// foreach($periods as $period)
			// $periodNamesArrResponse[] = array('id'=>$period->id,'start'=>$period->start);
		
		// return self::encode($periodNamesArrResponse);
	// }
	
	static function refactorMany($periods){
		
		$EnumActive = array('False','True');	
		$periodsArrResponse['page'] = 1;
		$periodsArrResponse['total'] = $periods->count();
		
		$i = 1;
		foreach($periods as $period)
			$periodsArrResponse['rows'][] = array('id'=>$period->id,'cell'=>array($i++,$period->start,$period->end,$period->status,$EnumActive[$period->active]));
		
		return self::encode($periodsArrResponse);
	}
	
	static function refactorOne($period){
	
		$periodArrResponse = array('id'=>$period->id,'start'=>$period->start,'end'=>$period->end,'status'=>$period->status,'active'=>$period->active);
		
		return self::encode($periodArrResponse);
	}
}

?>
