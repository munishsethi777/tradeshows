<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Show.php");
class ShowMgr{
	private static  $showMgr;
	private static $dataStore;
	private static $sessionUtil;
	public static function getInstance()
	{
		if (!self::$showMgr)
		{
			self::$showMgr = new ShowMgr();
			self::$dataStore = new BeanDataStore(Show::$className, Show::$tableName);
		}
		return self::$showMgr;
	}
	
	public function saveShow($showObject,$showTaskObject){
		$connection = self::$dataStore->getConnection();
		self::$dataStore->saveObject($showObject, $connection);
		$showTaskMgr = ShowTaskTaskMgr::getInstance();
		$showTaskMgr->saveShowTask($ShowTaskObject, $connection);
		$connection->commit();	
	}
}
