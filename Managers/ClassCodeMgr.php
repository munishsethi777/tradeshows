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
	
	public function findAll(){
		return self::$dataStore->findAll();
	}
	
	public function findAllForDropDown(){
		$classCodes = $this->findAll();
		$arr = array();
		foreach ($classCodes as $classCode){
			$code = $classCode->getClassCode();
			$arr[$code] = $code;
		}
		return $arr;
	}
}