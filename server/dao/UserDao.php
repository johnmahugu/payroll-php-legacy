<?php

class UserDao{

	private $user;
	
	function findAll(){
	
		$users = Doctrine_Query::create()	
		->select('u.username')
		->from('User u')
		->execute();
		
		return $users;
	}
	
	function findById($userId){
	
		$user = Doctrine::getTable('User')->find($userId);
		
		return $user;
	}
	
	function findOne($username,$password){
	
		try{
		
			$this->user = Doctrine_Query::create()
			->from('User u')
			->leftJoin('u.Role r')
			->where('u.username = ?',$username)
			->andWhere('u.password = ?',sha1($password))
			->fetchOne();
			
			return true;
		}
		catch(Exception $e){
		
			return false;
		}
	}
	
	function getCurrent(){
	
		return $this->user;
	}
	
	function addNew(stdClass $userObject){
	
		try{
			
			$user = new User();
			$user->username = $userObject->uname;
			$user->password = sha1($userObject->pword);
			$user->role = $userObject->role;
			$user->save();
			
			return true;
		}
		catch(Exception $e){
		
			return false;
		}	
	}
	
	function update(stdClass $userObject){
	
		try{
		
			$user = $this->findById($userObject->id);
			$user->username = $userObject->uname;
			$user->password = sha1($userObject->pword);
			$user->role = $userObject->role;
			$user->save();
			
			return true;
		}
		catch(Exception $e){
		
			return false;
		}
	}
	
	function delete($userId){
	
		try{
			
			$user = $this->findById($userId);
			$user->delete();
			
			return true;
		}
		catch(Exception $e){
		
			return false;
		}	
	}
}
?>