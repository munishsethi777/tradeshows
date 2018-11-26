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
	
	public function saveShowTask($ShowTaskObject){
		self::$dataStore->save($ShowTaskObject);
		
	}
	
	public function saveShowTaskFromRequest($showId){
		$categorySeqs = $_REQUEST["category"];
		foreach ($categorySeqs as $categorySeq){
			$titles = $_REQUEST[$categorySeq."_title"];
			$taskSeqs = $_REQUEST[$categorySeq."_taskSeq"];
			$startDates = $_REQUEST[$categorySeq."_startdate"];
			$endDates = $_REQUEST[$categorySeq."_enddate"];
			$showTask = new ShowTask();
			foreach ($titles as $key=>$title){
				$showTask->setTaskSeq($taskSeqs[$key]);
				$startDate = DateUtil::StringToDateByGivenFormat('m-d-Y', $startDates[$key]);
				$endDate = DateUtil::StringToDateByGivenFormat('m-d-Y', $endDates[$key]);
				$showTask->setStartDate($startDate);
				$showTask->setEndDate($endDate);
				$showTask->setStatus("pending");
				$showTask->setShowSeq($showId);
				$this->saveShowTask($showTask);
			}
		}
	}
	
	public function getTaskByShow($showSeq){
		$colVal["showseq"] = $showSeq;
	}
}
