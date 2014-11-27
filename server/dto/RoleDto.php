<?php

class RoleDto extends AbstractDto{
	
	static function refactorNames($roles){
	
		foreach($roles as $role)
			$roleNamesArrResponse[] = array('id'=>$role->id,'name'=>$role->name);
		
		return self::encode($roleNamesArrResponse);
	}
	
	static function refactorMany($roles){
		
		$rolesArrResponse['page'] = 1;
		$rolesArrResponse['total'] = $roles->count();
		
		$i = 1;
		foreach($roles as $role)
			$rolesArrResponse['rows'][] = array('id'=>$role->id,'cell'=>array($i++,$role->name,self::ellipsisize($role->descr)));
		
		return self::encode($rolesArrResponse);
	}
	
	static function refactorOne($role){
	
		$roleArrResponse = array('id'=>$role->id,'name'=>$role->name,'descr'=>$role->descr);
		
		return self::encode($roleArrResponse);
	}
}

?>
