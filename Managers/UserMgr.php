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
		$userSeq = $sessionUtil->getUserLoggedInSeq();
		$attr["password"] = $password;
		$condition["seq"] = $userSeq;
		self::$userDataStore->updateByAttributesWithBindParams($attr,$condition);
	}
	
	public function toArray($user){
		$adminArr = array();
		$adminArr["seq"] = $user->getSeq();
		$adminArr["email"] = $user->getEmail();
		$adminArr["name"] = $user->getFullName();
		return $adminArr;
	}
	public function getUsersForGrid(){
		$users = $this->getAllUserArr(true);
		$mainArr["Rows"] = $users;
		$mainArr["TotalRows"] = self::$userDataStore->executeCountQuery(null,true);
		return $mainArr;
	}

	public function getAllUserArr($isApplyFilter=false){
		$users = self::$userDataStore->findAllArr($isApplyFilter);
		return $users;
	}
	
	public function saveUser($user){
		$id = self::$userDataStore->save($user);
		return $id;
	}
	public function isPasswordExist($password){
		$sessionUtil = SessionUtil::getInstance();
		$userSeq = $sessionUtil->getUserLoggedInSeq();
		$params["password"] = $password;
		$params["seq"] = $userSeq;
		$count = self::$userDataStore->executeCountQuery($params);
		return $count > 0;
	}
	public function save($conn,$item){
		self::$userDataStore->saveObject($item);
	}
	public function findBySeq($seq){
		$user = self::$userDataStore->findBySeq($seq);
		return $user;
	}
	public function deleteBySeqs($ids) {
		$flag = self::$userDataStore->deleteInList ( $ids );
		return $flag;
	}
	
	public function getQCUsersArrForDD(){
		$params["isenabled"] = 1;
		$params["isqc"] = 1;
		$users = self::$userDataStore->executeConditionQuery($params);
		$arr = array();
		foreach($users as $user){
			$arr[$user->getSeq()] = $user->getQCCode();
		}
		return $arr;
	}
	
}