<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/ClassCode.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");


class ClassCodeMgr{
	private static  $classCodeMgr;
	private static $dataStore;
	public static function getInstance()
	{
		if (!self::$classCodeMgr)
		{
			self::$classCodeMgr = new ClassCodeMgr();
			self::$dataStore = new BeanDataStore(ClassCode::$className, ClassCode::$tableName);
		}
		return self::$classCodeMgr;
	}
	
	public function saveCode($classCode){
		return self::$dataStore->save($classCode);
	}
	
	public function findAll(){
		return self::$dataStore->findAll();
	}
	
	public function findBySeq($seq){
		$classCode = self::$dataStore->findBySeq($seq);
		return $classCode;
	}
	
	public function findAllForDropDown(){
		$sql = "Select * from classcodes order by classcode ASC";
		$classCodes = self::$dataStore->executeObjectQuery($sql);
		$arr = array();
		foreach ($classCodes as $classCode){
			$code = $classCode->getClassCode();
			$seq = $classCode->getSeq();
			$arr[$seq] = $code;
		}
		return $arr;
	}
	
	public function deleteBySeqs($ids){
		return self::$dataStore->deleteInList($ids);
	}
	
	public function getClassCodesForGrid(){
		$query = "select users.fullname,classcodes.* from classcodes left join users on classcodes.userseq = users.seq";
		$sessionUtil = SessionUtil::getInstance();
		$loggedInUserTimeZone = $sessionUtil->getUserLoggedInTimeZone();
		$classCodes = self::$dataStore->executeQuery($query,true);
		$arr = array();
		foreach($classCodes as $classcode){
		    $lastModifiedOn = $classcode["lastmodifiedon"];
		    $lastModifiedOn = DateUtil::convertDateToFormatWithTimeZone($lastModifiedOn, "Y-m-d H:i:s", "Y-m-d H:i:s",$loggedInUserTimeZone);
		    $classcode["lastmodifiedon"] = $lastModifiedOn;
		    array_push($arr,$classcode);	    
		}
		$mainArr["Rows"] = $arr;
		
		$query = "select count(*) from classcodes left join users on classcodes.userseq = users.seq";
		$count = self::$dataStore->executeCountQueryWithSql($query,true);
		$mainArr["TotalRows"] = $count;
		
		return $mainArr;
	}
	
	public function findByClassCode($classCode){
		$colVal["classcode"] = $classCode;
		$classCode = self::$dataStore->executeConditionQuery($colVal);
		if(!empty($classCode)){
			return $classCode[0];
		}
		return null;
	}
}