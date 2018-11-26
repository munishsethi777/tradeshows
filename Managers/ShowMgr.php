<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Show.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ShowTaskMgr.php");
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
	
	public function saveShow($showObject){
		$id = self::$dataStore->save($showObject);
		if(!empty($id)){
			$showTaskManager = ShowTaskMgr::getInstance();
			$showTaskManager->deleteByShowSeq($id);
			$showTaskManager->saveShowTaskFromRequest($id);
		}
	}
	

	
	public function getShowsForGrid($isApplyFilter = false){
		$shows = $this->findAllArr($isApplyFilter);
		$mainArr["Rows"] = $shows;
		$mainArr["TotalRows"] = $this->getAllShowsCount($isApplyFilter);
		return $mainArr;
	}

	public function getAllShowsCount($isApplyFilter){
		$count = self::$dataStore->executeCountQuery(null,$isApplyFilter);
		return $count;
	}
	
	public function findAllArr($isApplyFilter = false){
		$showArr = self::$dataStore->findAllArr($isApplyFilter);
		return $showArr;
	}
	
	public function findBySeq($seq){
		$show = self::$dataStore->findBySeq($seq);
		return $show;
	}
	
}
