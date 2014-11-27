<?php

class BenefitDto extends AbstractDto{
	
	static $isTrue = array('False','True');
	static $isActive = array('Inactive','Active');
	
	static function refactorNames($benefits){
	
		foreach($benefits as $benefit)
			$benefitNamesArrResponse[] = array('id'=>$benefit->id,'name'=>$benefit->name);
		
		return self::encode($benefitNamesArrResponse);
	}
	
	static function refactorMany($benefits){
		
		$benefitsArrResponse['page'] = 1;
		$benefitsArrResponse['total'] = $benefits->count();
		
		$i = 1;
		foreach($benefits as $benefit)
			$benefitsArrResponse['rows'][] = array('id'=>$benefit->id,'cell'=>array($i++,$benefit->name,$benefit->damt,$benefit->descr,self::$isTrue[$benefit->perc],self::$isTrue[$benefit->deduct],self::$isTrue[$benefit->taxable],self::$isActive[$benefit->active]));
		
		return self::encode($benefitsArrResponse);
	}
	
	static function refactorOne($benefit){
		
		$benefitArrResponse = array('id'=>$benefit->id,'name'=>$benefit->name,$benefit->damt,'descr'=>$benefit->descr,'perc'=>self::$isTrue[$benefit->perc],'deduct'=>self::$isTrue[$benefit->deduct],'taxable'=>self::$isTrue[$benefit->taxable],'active'=>self::$isActive[$benefit->active]);
		
		return self::encode($benefitArrResponse);
	}
}

?>
