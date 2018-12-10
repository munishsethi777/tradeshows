<?php
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/User.php");
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");

class UserMgr{
	private static $userMgr;
	private static $userDataStore;
	
	public static function getInstance()
	{
		if (!self::$userMgr){
			self::$userMgr = new UserMgr();
			self::$userDataStore = new BeanDataStore(User::$className,User::$tableName);
		}
		return self::$userMgr;
	}
	
	public function logInUser($username, $password){
		$conditionVal["email"] = $username;
		$user = self::$userDataStore->executeConditionQuery($conditionVal);
		if(!empty($user)){
			return $user[0];
		}
		return null;
	}
	
	public function getAllUsers(){
		$admins = self::$userDataStore->findAll();
		return $admins;
	}
	
	public function ChangePassword($password){
		$sessionUtil = SessionUtil::getInstance();
		$adminSeq = $sessionUtil->getAdminLoggedInSeq();
		$attr["password"] = $password;
		$condition["seq"] = $adminSeq;
		$sql = "update users set password = '$password'";
		self::$userDataStore->executeQuery($sql);
	}
	
	public function toArray($user){
		$adminArr = array();
		$adminArr["seq"] = $user->getSeq();
		$adminArr["email"] = $user->getEmail();
		$adminArr["name"] = $user->getFullName();
		return $adminArr;
	}
	
	public function getAllUserArr(){
		$users = self::$userDataStore->findAllArr();
		return $users;
	}
	
	public function saveUser($user){
		$id = self::$userDataStore->save($user);
		return $id;
	}
}