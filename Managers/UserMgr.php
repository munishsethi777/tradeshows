<?php
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/User.php");
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/UserType.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/UserRole.php");


class UserMgr{
	private static $userMgr;
	private static $userDataStore;
	private static $userRoleDataStore;
	public static function getInstance()
	{
		if (!self::$userMgr){
			self::$userMgr = new UserMgr();
			self::$userDataStore = new BeanDataStore(User::$className,User::$tableName);
			self::$userRoleDataStore = new BeanDataStore(UserRole::$className,UserRole::$tableName);
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
		$adminArr["usertype"] = $user->getUserType();
		return $adminArr;
	}
	public function getUsersForGrid(){
		$users = $this->getAllUsersForGrid();
		$mainArr["Rows"] = $users;
		$mainArr["TotalRows"] = $this->getAllCountForGrid();
		return $mainArr;
	}
	
	public function getAllCountForGrid(){
		$seesionUtil = SessionUtil::getInstance();
		$loggedInUserSeq = $seesionUtil->getUserLoggedInSeq();
		$query = "select count(*) from users where seq != $loggedInUserSeq";
		$count = self::$userDataStore->executeCountQueryWithSql($query,true);
		return $count;
	}
	
	public function getAllUsersForGrid(){
		$seesionUtil = SessionUtil::getInstance();
		$loggedInUserSeq = $seesionUtil->getUserLoggedInSeq();
		$query = "select * from users where seq != $loggedInUserSeq";
		$arr = self::$userDataStore->executeQuery($query,true);
		return $arr;
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
	
	public function getQCUsersArrForDD(){//Deprecated
		$sql = "SELECT users.* from users inner join userroles on userroles.userseq = users.seq and userroles.role = 'QC' and users.isenabled = 1";
		$users = self::$userDataStore->executeObjectQuery($sql);
		$arr = array();
		foreach($users as $user){
			$arr[$user->getSeq()] = $user->getQCCode();
		}
		return $arr;
	}
	
	public function getGraphicDesignersArrForDD(){//Deprecated
		$sql = "SELECT users.* from users inner join userroles on userroles.userseq = users.seq and userroles.role = 'GRAPHIC_DESIGNER' and users.isenabled = 1";
		$users = self::$userDataStore->executeObjectQuery($sql);
		$arr = array();
		foreach($users as $user){
			$arr[$user->getSeq()] = $user->getFullName();
		}
		return $arr;
	}
	
	public function getSupervisorsForQCReport(){
		$sql = "SELECT * FROM users 
inner join userdepartments on userdepartments.userseq = users.seq and users.issendnotifications = 1 
inner join userroles on users.seq = userroles.userseq 
where userdepartments.departmentseq = 1 and userroles.role = 'SUPERVISOR'";
		$users = self::$userDataStore->executeObjectQuery($sql);
		return $users;
	}
	public function getQCsForQCReport(){
		$sql = "SELECT * FROM users 
inner join userdepartments on userdepartments.userseq = users.seq and users.issendnotifications = 1 
inner join userroles on users.seq = userroles.userseq 
where userdepartments.departmentseq = 1 and userroles.role = 'QC'";
		$users = self::$userDataStore->executeObjectQuery($sql);
		return $users;
	}
	public function getUserRoles($userSeq){
		$colValPair = array();
		$colValPair["userseq"] = $userSeq;
		return self::$userRoleDataStore->executeConditionQuery($colValPair);
	}
	public function getUserRolesArr($userSeq){
		$userRoles = array();
		$colValPair = array();
		$colValPair["userseq"] = $userSeq;
		$userRolesObjs =  self::$userRoleDataStore->executeConditionQuery($colValPair);
		foreach ($userRolesObjs as $userRoleObj){
			array_push($userRoles, $userRoleObj->getRole());
		}
		return $userRoles;
	}
	public function saveUserRole($userRole){
		self::$userRoleDataStore->save($userRole);
	}
	public function deleteUseRoles($userSeq){
		$colValPair = array();
		$colValPair["userseq"] = $userSeq;
		self::$userRoleDataStore->deleteByAttribute($colValPair);
	
	}
	
}