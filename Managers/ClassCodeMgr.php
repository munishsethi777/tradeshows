<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/ClassCode.php");

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
		$classCodes = $this->findAll();
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
		$classCodes = self::$dataStore->executeQuery($query,true);
		$mainArr["Rows"] = $classCodes;
		
		$query = "select count(*) from classcodes left join users on classcodes.userseq = users.seq";
		$count = self::$dataStore->executeCountQueryWithSql($query,true);
		$mainArr["TotalRows"] = $count;
		
		return $mainArr;
	}
}