<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Task.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
class TaskMgr{
	private static  $TaskMgr;
	private static $dataStore;
	private static $sessionUtil;
	public static function getInstance()
	{
		if (!self::$TaskMgr)
		{
			self::$TaskMgr = new TaskMgr();
			self::$dataStore = new BeanDataStore(Task::$className, Task::$tableName);
		}
		return self::$TaskMgr;
	}
	
	public function getAll(){
		$query = "SELECT tasks.*,taskcategories.title as category FROM `tasks` inner join taskcategories on tasks.taskcategoryseq = taskcategories.seq";
		$tasks = self::$dataStore->executeQuery($query);
		$key = "category";
		$tasks = $this->_group_by($tasks, $key);
		$startDateObj = DateUtil::StringToDateByGivenFormat("m-d-Y", $startDate);
		$calculatedTasks = $this->calculateStartEndDate($tasks, $startDateObj);
		return $calculatedTasks;
	}
	private $allTasksArr;
	function calculateStartEndDate($categoryTasks,$startDate){
		$categoryTasksArr = array();
		$this->allTasksArr = array();
		foreach ($categoryTasks as $key=>$tasks){
			$tasksArr = array();
			foreach ($tasks as $task){
				$dates = $this->getStartEndDates($_GET["startDate"],$task,0,false);
				$task["startDate"] = $dates["startdate"];
				$task["endDate"] = $dates["enddate"];
				array_push($tasksArr, $task);
				array_push($this->allTasksArr, $task);
			}
			$categoryTasksArr[$key] = $tasksArr;
		}
		return $categoryTasksArr;
	}
	
	function getStartEndDates($startDateStr,$currentTask,$parentDaysRequired,$isParent){
		$dates = array();
		$parentSeq = $currentTask["parenttaskseq"];
		if(empty($parentSeq) || $isParent){
			$daysRequired = $currentTask["daysrequired"];
			$startRefDay = $currentTask["startdatereferencedays"] ;
			$startFromDate = DateUtil::StringToDateByGivenFormat("m-d-Y", $startDateStr);
			$endDate = DateUtil::StringToDateByGivenFormat("m-d-Y", $startDateStr);
			if(!$isParent){
				$startFromDate->modify('-' . $startRefDay .  ' day');
				$endRefDay = $startRefDay - $daysRequired;
				$endDate->modify('-' . $endRefDay .  ' day');
			}else{
				$endDate->modify('+' . $parentDaysRequired .  ' day');
			}
			$startDateStr = $startFromDate->format("m-d-Y");
			$endDateStr = $endDate->format("m-d-Y");
			$dates["startdate"] = $startDateStr;
			$dates["enddate"]=$endDateStr;
			return $dates;
		}else{
			$parentTask = $this->getParentTask($parentSeq);
			$daysRequired = $parentTask["daysrequired"];
			$startDateStr = $parentTask["endDate"];
			$dates = $this->getStartEndDates($startDateStr,$parentTask,$daysRequired,true);
			return $dates;
		}
	}
	
	private function getParentTask($parentSeq){
		$key = array_search($parentSeq, array_column($this->allTasksArr, 'seq'));
		return $this->allTasksArr[$key];
	}
	
	function _group_by($array, $key) {
		$return = array();
		foreach($array as $val) {
			$return[$val[$key]][] = $val;
		}
		return $return;
	}
}