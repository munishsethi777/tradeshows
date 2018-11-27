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
	
	public function updateShowTaskCommentsStatus($showTask){
		$colVal = array();
		$colVal["status"] = $showTask->getStatus();
		$colVal["comments"] = $showTask->getComments();
		
		$colValCondition = array();
		$colValCondition["seq"] = $showTask->getSeq();
		
		self::$dataStore->updateByAttributes($colVal,$colValCondition);
	}
	public function getShowTaskDetails($showTaskSeq){
		$query = "SELECT showtasks.seq,tasks.title,tasks.description,showtasks.startdate,showtasks.enddate,showtasks.comments,showtasks.status FROM `showtasks`
inner join tasks on tasks.seq = showtasks.taskseq where showtasks.seq = $showTaskSeq";
		$taskDetails = self::$dataStore->executeQuery($query);
		return $taskDetails;
	}
	
	public function getTaskByShowJson($showSeq){
		$colVal["showseq"] = $showSeq;
		$showTasks = self::$dataStore->executeConditionQuery($colVal);
		return json_encode($showTasks);
	}
}
