<?php

class UserDto extends AbstractDto{

	static function refactorMany($users){
		
		$usersArrResponse['page'] = 1;
		$usersArrResponse['total'] = $users->count();
		
		$i = 1;
		foreach($users as $user)
			$usersArrResponse['rows'][] = array('id'=>$user->id,'cell'=>array($i++,$user->username,$user->Role->name));
		
		return self::encode($usersArrResponse);
	}
	
	static function refactorOne($user,$roles){

		foreach($roles as $role)
			$rolesArrResponse[] = array('id'=>$role->id,'name'=>$role->name);
			
		$userArrResponse = array('id'=>$user->id,'name'=>$user->username,'role'=>$user->Role->name,'roles'=>$rolesArrResponse);
		
		return self::encode($userArrResponse);
	}
}
?>