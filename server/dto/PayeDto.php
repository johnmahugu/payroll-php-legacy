<?php

class PayeDto extends AbstractDto{
	
	static function refactorMany($payeRates){
		
		$payeRatesArrResponse['page'] = 1;
		$payeRatesArrResponse['total'] = $payeRates->count();
		
		$i = 1;
		foreach($payeRates as $payeRate)
			$payeRatesArrResponse['rows'][] = array('id'=>$payeRate->id,'cell'=>array($i++,$payeRate->mlbound,$payeRate->mubound,$payeRate->albound,$payeRate->aubound,$payeRate->rate));
		
		return self::encode($payeRatesArrResponse);
	}
	
	static function refactorOne($payeRate){
	
		$payeRateArrResponse = array('id'=>$payeRate->id,'mlbound'=>$payeRate->mlbound,'mubound'=>$payeRate->mubound,'albound'=>$payeRate->albound,'aubound'=>$payeRate->aubound,'rate'=>$payeRate->rate);
		
		return self::encode($payeRateArrResponse);
	}
}

?>
