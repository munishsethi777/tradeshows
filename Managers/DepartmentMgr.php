<?php
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Department.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/UserDepartment.php");
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");

class DepartmentMgr{
	private static $departmentMgr;
	private static $dataStore;
	private static $userDeptDataStore;
	public static function getInstance()
	{
		if (!self::$departmentMgr){
			self::$departmentMgr = new DepartmentMgr();
			self::$dataStore = new BeanDataStore(Department::$className,Department::$tableName);
			self::$userDeptDataStore = new BeanDataStore(UserDepartment::$className,UserDepartment::$tableName);
		}
		return self::$departmentMgr;
	}
	
	public function getAll(){
		$objs = self::$dataStore->findAll();
		return $objs;
	}
	
	public function toArray($department){
		$arr = array();
		$arr["seq"] = $department->getSeq();
		$arr["title"] = $department->getTitle();;
		return $arr;
	}
	public function getAllUserArr($isApplyFilter=false){
		$arr = self::$dataStore->findAllArr($isApplyFilter);
		return $arr;
	}
	
	public function findBySeq($seq){
		$obj = self::$dataStore->findBySeq($seq);
		return $obj;
	}
	public function getUserDepartments($userSeq){
		$colValPair = array();
		$colValPair["userseq"] = $userSeq;
		return self::$userDeptDataStore->executeConditionQuery($colValPair);
	}
	
	public function getUserAssignedDepartments($userSeq){
		$query = "select departments.* from departments inner join userdepartments on departments.seq = userdepartments.departmentseq where userdepartments.userseq = $userSeq";
		$departments = self::$dataStore->executeQuery($query,false,true);
		$departmentsArr = array();
		if($departments){
			$departmentsArr = array_map(create_function('$o', 'return $o["title"];'), $departments);
		}
		return $departmentsArr;
	}
	public function saveUserDepartment($userDepartment){
		self::$userDeptDataStore->save($userDepartment);
	}
	public function deleteUseDepartments($userSeq){
		$colValPair = array();
		$colValPair["userseq"] = $userSeq;
		self::$userDeptDataStore->deleteByAttribute($colValPair);
		
	}
	
}