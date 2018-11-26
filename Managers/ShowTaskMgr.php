<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/ShowTask.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
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
	
	public function deleteByShowSeq($showSeq){
		$colVal["showseq"] = $showSeq;
		self::$dataStore->deleteByAttribute($colVal);
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
	
	public function getTaskByShowSeq($showSeq){
		$query = "select tasks.seq,tasks.daysrequired,tasks.parenttaskseq,tasks.title,tasks.taskcategoryseq,taskcategories.title as categorytitle ,showtasks.startdate,showtasks.enddate from showtasks inner join tasks on showtasks.taskseq = tasks.seq inner join taskcategories on tasks.taskcategoryseq = taskcategories.seq 
where showtasks.showseq = $showSeq";
		$showTasks = self::$dataStore->executeQuery($query);
		$showTasks = $this->_group_by($showTasks, "categorytitle");
		return $showTasks;
	}
	
	function _group_by($array, $key) {
		$return = array();
		foreach($array as $val) {
			$startDate = $val["startdate"];
			$endDate = $val["enddate"];
			$startDate = DateUtil::StringToDateByGivenFormat("Y-m-d", $startDate);
			$endDate = DateUtil::StringToDateByGivenFormat("Y-m-d", $endDate);
			$startDateStr = $startDate->format("m-d-Y");
			$endDateStr = $endDate->format("m-d-Y");
			$val["startDate"] = $startDateStr;
			$val["endDate"] = $endDateStr;
			$return[$val[$key]][] = $val;
		}
		return $return;
	}
}
