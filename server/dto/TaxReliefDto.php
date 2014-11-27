<?php

class TaxReliefDto extends AbstractDto{
	
	static function refactorNames($nhifRates){
	
		foreach($taxReliefRates as $taxReliefRate)
			$taxReliefRateNamesArrResponse[] = array('id'=>$taxReliefRate->id,'name'=>$taxReliefRate->name);
		
		return self::encode($taxReliefRateNamesArrResponse);
	}
	
	static function refactorMany($taxReliefRates){
		
		$taxReliefRatesArrResponse['page'] = 1;
		$taxReliefRatesArrResponse['total'] = $taxReliefRates->count();
		
		$EnumBool = array('False','True');
		
		$i = 1;
		foreach($taxReliefRates as $taxReliefRate)
			$taxReliefRatesArrResponse['rows'][] = array('id'=>$taxReliefRate->id,'cell'=>array($i++,$taxReliefRate->name,$taxReliefRate->monthly,$taxReliefRate->annual,$EnumBool[$taxReliefRate->active]));
		
		return self::encode($taxReliefRatesArrResponse);
	}
	
	static function refactorOne($taxReliefRate){
	
		$EnumBool = array('False','True');
	
		$taxReliefRateArrResponse = array('id'=>$taxReliefRate->id,'name'=>$taxReliefRate->name,'monthly'=>$taxReliefRate->monthly,'annual'=>$taxReliefRate->annual,'active'=>$EnumBool[$taxReliefRate->active]);
		
		return self::encode($taxReliefRateArrResponse);
	}
	
	static function refactorBool($strBool){
	
		$EnumReverseBool = array('True'=>1,'False'=>0);
		
		return (integer)$EnumReverseBool[$strBool];
	}
}

?>
