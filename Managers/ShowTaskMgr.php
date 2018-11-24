<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/ShowTask.php");
class ShowTaskMgr{
	private static  $ShowTaskMgr;
	private static $dataStore;
	private static $sessionUtil;
	public static function getInstance()
	{
		if (!self::$ShowTaskMgr)
		{
			self::$ShowTaskMgr = new ShowTaskMgr();
			self::$dataStore = new BeanDataStore(ShowTask::$className, ShowTask::$tableName);
		}
		return self::$ShowTaskMgr;
	}
	
	public function saveShowTask($ShowTaskObject,$connection){
		self::$dataStore->saveObject($ShowTaskObject, $connection);
	}
}
