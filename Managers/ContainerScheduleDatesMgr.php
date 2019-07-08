<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/ContainerScheduleDate.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");

class ContainerScheduleDatesMgr{
	private static $containerScheduleDatesMgr;
	private static $dataStore;
	
	public static function getInstance(){
		if (!self::$containerScheduleDatesMgr){
			self::$containerScheduleDatesMgr = new ContainerScheduleDatesMgr();
			self::$dataStore = new BeanDataStore(ContainerScheduleDate::$className, ContainerScheduleDate::$tableName);
		}
		return self::$containerScheduleDatesMgr;
	}
	
	public function save($containerScheduleDate){
    	self::$dataStore->save($containerScheduleDate);
    }
    
}