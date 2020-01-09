<?php
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/User.php");
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/UserType.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/UserRole.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/Permissions.php");

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
	public function getAllSupervisorsAndUsers(){
	    $supervisor = UserType::SUPERVISOR;
	    $user = UserType::USER;
	    $query = "select * from users where usertype = '$supervisor' or usertype = '$user'";
	    $users = self::$userDataStore->executeObjectQuery($query);
	    return $users;
	}
	
	public function getAllUsersByType($usertype){ 
	    $conditionVal["usertype"] = $usertype;
	    $user = self::$userDataStore->executeConditionQuery($conditionVal);
	    return $user;
	}
	
	public function ChangePassword($password){
		$sessionUtil = SessionUtil::getInstance();
		$userSeq = $sessionUtil->getUserLoggedInSeq();
		$attr["password"] = $password;
		$condition["seq"] = $userSeq;
		self::$userDataStore->updateByAttributesWithBindParams($attr,$condition);
	}
	
	public function resetPassword($password,$username){
	    $attr = array("password" => $password);
	    $condition = array("email" => $username);
	    return self::$userDataStore->updateByAttributesWithBindParams($attr,$condition);
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
		$seesionUtil = SessionUtil::getInstance();
		$loggedInUserTimeZone = $seesionUtil->getUserLoggedInTimeZone();
		$arr = array();
		foreach ($users as $user){
			$roles = $user["roles"];
			$roleArr = array();
			if(!empty($roles)){
				$roles = explode(",",$roles);
				foreach ($roles as $role){
					$roleValue = Permissions::getValue($role);
					array_push($roleArr,$roleValue);
				}
				$user["roles"] = implode(",",$roleArr);
			}
			$lastModifiedOn = $user["lastmodifiedon"];
			$lastModifiedOn = DateUtil::convertDateToFormatWithTimeZone($lastModifiedOn, "Y-m-d H:i:s", "Y-m-d H:i:s",$loggedInUserTimeZone);
			$user["lastmodifiedon"] = $lastModifiedOn;
			$lastLoggedInDate =  $user["lastloggedindate"];
			$lastLoggedInDate = DateUtil::convertDateToFormatWithTimeZone($lastLoggedInDate, "Y-m-d H:i:s", "Y-m-d H:i:s",$loggedInUserTimeZone);
			$user["lastloggedindate"] = $lastLoggedInDate;
			
			array_push($arr,$user);
		}
		$mainArr["Rows"] = $arr;
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
		$query = "SELECT GROUP_CONCAT(userroles.role) as roles, users.* FROM `users` left join userroles on users.seq = userroles.userseq where users.seq != $loggedInUserSeq group by users.seq";
		//$query = "select * from users where seq != $loggedInUserSeq";		
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
	
	public function FindByUserName($userName){
	    $condition = array("email" => $userName);
	    $user = self::$userDataStore->executeConditionQuery($condition);
	    if(!empty($user)){
	        return $user[0];
	    }
	    return null;
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
		$sql = "SELECT users.* FROM users 
inner join userdepartments on userdepartments.userseq = users.seq and users.issendnotifications = 1 
where userdepartments.departmentseq = 1 and users.usertype = 'SUPERVISOR'";
		$users = self::$userDataStore->executeObjectQuery($sql);
		return $users;
	}
	public function getQCsForQCReport(){
		$sql = "SELECT users.* FROM users 
inner join userdepartments on userdepartments.userseq = users.seq and users.issendnotifications = 1 
where userdepartments.departmentseq = 1 and users.usertype = 'USER'";
		$users = self::$userDataStore->executeObjectQuery($sql);
		return $users;
	}
	
	public function getUsersForSendQcPlannerReport(){
	    $sql = "SELECT users.* FROM users
inner join userdepartments on userdepartments.userseq = users.seq and users.issendnotifications = 1
where userdepartments.departmentseq = 1 and (users.usertype = 'SUPERVISOR' or users.usertype = 'USER')";
	    $users = self::$userDataStore->executeObjectQuery($sql);
	    return $users;
	}
	
	public function getUserssByRoleAndDepartment($roleName,$departmentSeq){
	    $sql = "SELECT users.* FROM users
inner join userdepartments on userdepartments.userseq = users.seq and users.issendnotifications = 1
inner join userroles on users.seq = userroles.userseq
where userdepartments.departmentseq = $departmentSeq and (users.usertype = 'SUPERVISOR' or users.usertype = 'USER') and userroles.role = '$roleName'";
	    $users = self::$userDataStore->executeObjectQuery($sql);
	    return $users;
	}
	
	public function getAllUsersWithRoles($userType = null){
	    $sql = "select users.*,userroles.role from users inner join userroles on users.seq = userroles.userseq where users.issendnotifications = 1";
	    if(!empty($userType)){
	        $sql .= " and users.usertype = '$userType'";
	    }
	    $users = self::$userDataStore->executeObjectQuery($sql);
	    $users = $this->_group_by($users);
	    return $users;
	}
	
	public function groupByUserType($users){
	    $return = array();
	    foreach($users as $val) {
	        $return[$val->getUserType()][] = $val;
	    }
	    return $return;
	}
	
	function _group_by($array) {
	    $return = array();
	    foreach($array as $val) {
	        $return[$val->role][] = $val;
	    }
	    return $return;
	}
	
	public function getAllUsersForGraphicLogs(){
	    $usaTeam = Permissions::getName(Permissions::usa_team);
	    $chinaTeam = Permissions::getName(Permissions::china_team);
	    $graphicDesigner = Permissions::getName(Permissions::graphic_designer);
	    $sql = "SELECT users.* FROM users
inner join userdepartments on userdepartments.userseq = users.seq and users.issendnotifications = 1
inner join userroles on users.seq = userroles.userseq
where userdepartments.departmentseq = 2 and (users.usertype = 'SUPERVISOR' or users.usertype = 'USER') and (userroles.role = '$usaTeam' or userroles.role = '$chinaTeam' or userroles.role = '$graphicDesigner')";
	    $users = self::$userDataStore->executeObjectQuery($sql);
	    return $users;
	}
	
	public function getAdminForSendReport(){
	    $colval = array();
	    $colval["usertype"] = 'ADMIN';
	    $admin =  self::$userDataStore->executeConditionQuery($colval);
	    if(!empty($admin)){
	        return $admin[0];
	    }
	    return null;
	}
	
	public function getUsersForGraphicNotesUpdatedReport($roleName){
		$sql = "SELECT userdepartments.departmentseq,userroles.role,users.* FROM users inner join userdepartments on userdepartments.userseq = users.seq and 
 users.issendnotifications = 1 inner join userroles on users.seq = userroles.userseq where userdepartments.departmentseq = 2 
 and userroles.role != '$roleName' and userroles.role != 'qc' group by users.seq";
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
	public function getUserRolesValuesArr($userSeq){
		$userRoles = array();
		$colValPair = array();
		$colValPair["userseq"] = $userSeq;
		$userRolesObjs =  self::$userRoleDataStore->executeConditionQuery($colValPair);
		foreach ($userRolesObjs as $userRoleObj){
			$roleValue = Permissions::getValue($userRoleObj->getRole());
			array_push($userRoles, $roleValue);
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
	
	public function getSupervisorsAndGraphicDesignerForDD(){
		$supervisor = UserType::SUPERVISOR;
		$graphicDesigner = UserType::GRAPHIC_DESIGNER;
		$query = "select users.* from users where users.usertype = '$supervisor' or users.usertype = '$graphicDesigner'";
		$users = self::$userDataStore->executeObjectQuery($query);
		$arr = array();
		foreach ($users as $user){
			$arr[$user->getSeq()] = $user->getFullName();
		}
		return $arr;
	}
	
	public function getChinaTeamUsersForDD(){
		$china_permission = Permissions::getName(Permissions::china_team);
		$query = "SELECT userdepartments.departmentseq,userroles.role,users.* FROM users inner join userdepartments on userdepartments.userseq = users.seq and 
 users.issendnotifications = 1 inner join userroles on users.seq = userroles.userseq where userdepartments.departmentseq = 2 and userroles.role = '$china_permission'";
		$users = self::$userDataStore->executeObjectQuery($query);
		$arr = array();
		foreach ($users as $user){
			$arr[$user->getSeq()] = $user->getFullName();
		}
		return $arr;
	}
	
	public function getSupervisors(){
	    $colValPair = array();
	    $colValPair['usertype'] = UserType::SUPERVISOR;
	    $colValPair['isenabled'] = 1;
	    $users = self::$userDataStore->executeConditionQuery($colValPair);
	    $arr = array();
	    foreach ($users as $user){
	        $arr[$user->getSeq()] = $user->getFullName();
	    }
	    return $arr;
	}
	
	public function updateLastLoggedInDate($seq){
	    $colVal = array("lastloggedindate"=>new DateTime());
	    $condition = array("seq" => $seq);
	    self::$userDataStore->updateByAttributesWithBindParams($colVal,$condition);
	}
}