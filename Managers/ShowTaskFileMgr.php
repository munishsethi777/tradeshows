<?php
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/ShowTaskFile.php");
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");

class ShowTaskFileMgr{
	private static $showTaskFileMgr;
	private static $showTaskFileDataStore;
	
	public static function getInstance(){
		if (!self::$showTaskFileMgr)
		{
			self::$showTaskFileMgr = new AdminMgr();
			self::$showTaskFileDataStore = new BeanDataStore(ShowTaskFile::$className,ShowTaskFile::$tableName);
		}
		return self::$showTaskFileMgr;
	}
	
	public function toArray($admin){
		$adminArr = array();
		$adminArr["seq"] = $admin->getSeq();
		$adminArr["username"] = $admin->getUserName();
		$adminArr["name"] = $admin->getName();
		return $adminArr;
	}
}