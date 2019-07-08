<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/ContainerScheduleNote.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");


class ContainerScheduleNotesMgr{
	private static $containerScheduleNotesMgr;
	private static $dataStore;
	public static function getInstance(){
		if (!self::$containerScheduleNotesMgr){
			self::$containerScheduleNotesMgr = new ContainerScheduleNotesMgr();
			self::$dataStore = new BeanDataStore(ContainerScheduleNote::$className, ContainerScheduleNote::$tableName);
		}
		return self::$containerScheduleNotesMgr;
	}
	
	public function save($containerScheduleNote){
    	self::$dataStore->save($containerScheduleNote);
    }
    
}