<?php

class NhifDto extends AbstractDto{
	
	static function refactorMany($nhifRates){
		
		$nhifRatesArrResponse['page'] = 1;
		$nhifRatesArrResponse['total'] = $nhifRates->count();
		
		$i = 1;
		foreach($nhifRates as $nhifRate)
			$nhifRatesArrResponse['rows'][] = array('id'=>$nhifRate->id,'cell'=>array($i++,$nhifRate->lbound,$nhifRate->ubound,$nhifRate->amount));
		
		return self::encode($nhifRatesArrResponse);
	}
	
	static function refactorOne($nhifRate){
	
		$nhifRateArrResponse = array('id'=>$nhifRate->id,'lbound'=>$nhifRate->lbound,'ubound'=>$nhifRate->ubound,'amount'=>$nhifRate->amount);
		
		return self::encode($nhifRateArrResponse);
	}
}

?>
