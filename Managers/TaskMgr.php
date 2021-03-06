<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Task.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/TaskAssignee.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/TaskAssigneeMgr.php");

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
	public function saveTask($task,$assignees){
		$id = self::$dataStore->save($task);
		if(!empty($id)){
			$taskAssigneeMgr = TaskAssigneeMgr::getInstance();
			$taskAssigneeMgr->deleteByTaskSeq($id);
			foreach ($assignees as $assignee){
				$taskAssignee = new TaskAssignee();
				$taskAssignee->setTaskSeq($id);
				$taskAssignee->setUserSeq($assignee);
				$taskAssigneeMgr->saveTaskAssignee($taskAssignee);
			}
		}
		return $id;
	}
	public function getAll(){
		$query = "SELECT tasks.*,taskcategories.title as category FROM `tasks` inner join taskcategories on tasks.taskcategoryseq = taskcategories.seq where tasks.iscustom is NULL or tasks.iscustom = 0";
		$tasks = self::$dataStore->executeQuery($query);
		$key = "category";
		$tasks = $this->_group_by($tasks, $key);
		$calculatedTasks = $this->calculateStartEndDate($tasks);
		$userMgr = UserMgr::getInstance();
		$users = $userMgr->getAllUserArr();
		$taskAssigneeMgr = TaskAssigneeMgr::getInstance();
		$mainArr["tasks"] = $calculatedTasks;
		$mainArr["users"] = $users;
		$mainArr["taskAssignees"] = $taskAssigneeMgr->getAllTaskAssignee();
		return $mainArr;
	}
	
	public function getShowTasksByUser($showSeq,$userSeq,$isUpcomingtask = 0){
		$query = "select distinct(showtasks.seq),tasks.title,showtasks.startdate,showtasks.enddate,showtasks.status from showtasks
		inner join showtaskassignees on showtaskassignees.showtaskseq = showtasks.seq
		inner join tasks on showtasks.taskseq = tasks.seq
		where showtasks.showseq = $showSeq";
		if($userSeq != null){
			$date = new DateTime();
			$dateStr = $date->format("Y-m-d");
			$query .= " and showtaskassignees.userseq = $userSeq";
			if(!empty($isUpcomingtask)){
				$query .= " and startdate >= '$dateStr'";
			}else{
				$query .= " and enddate < '$dateStr'";
			}
		}
		//$query .= " group by showtasks.seq";
		
		$tasks = self::$dataStore->executeQuery($query,true);
		$taskArr = array();
		foreach ($tasks as $task){
			$status = $task["status"];
			if($status != "completed"){
				$endDate = $task['enddate'];
				$endDate = DateUtil::StringToDateByGivenFormat("Y-m-d", $endDate);
				if($endDate < new DateTime()){
					$status = "delay";	
				}
				
			}
			$status = ShowTaskStatus::getValue($status);
			$task["status"] = $status;
			array_push($taskArr, $task);
		}
		$mainArr["Rows"] = $taskArr;
		$mainArr["TotalRows"] = $this->getShowTaskCount($showSeq, $userSeq,$isUpcomingtask);
		return $mainArr;
		
	}
	private function getShowTaskCount($showSeq,$userSeq,$isUpcomingTask){
		$query = "select count(*) from showtasks left join tasks on showtasks.taskseq = tasks.seq where showtasks.showseq = $showSeq";
		if($userSeq != null){
			$query = "select count(*) from showtasks
			inner join showtaskassignees on showtaskassignees.showtaskseq = showtasks.seq
			inner join tasks on showtasks.taskseq = tasks.seq
			where showtasks.showseq = $showSeq and showtaskassignees.userseq = $userSeq";
			$date = new DateTime();
			$dateStr = $date->format("Y-m-d");
			if(!empty($isUpcomingTask)){
				$query .= " and startdate >= '$dateStr'";
			}else{
				$query .= " and enddate <= '$dateStr'";
			}
		}
		$count = self::$dataStore->executeCountQueryWithSql($query,true);
		return $count;
	}
	
	private $allTasksArr;
	function calculateStartEndDate($categoryTasks){
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
	
	public function deleteBySeqs($ids) {
		$flag = self::$dataStore->deleteInList ( $ids );
		if($flag){
			$ids = explode(",", $ids);
			$taskAssigneeMgr = TaskAssigneeMgr::getInstance();
			foreach ($ids as $id){
				$taskAssigneeMgr->deleteByTaskSeq($id);
			}
		}
		return $flag;
	}
	
	function findBySeq($seq){
		$task = self::$dataStore->findBySeq($seq);
		return $task;
	}
	
	function findAll(){
		$tasks = self::$dataStore->findAll();
		return $tasks;
	}
	
	public function getTasksForGrid(){
		$query = "select tasks.*,taskcategories.title as taskcategory from tasks inner join taskcategories on tasks.taskcategoryseq = taskcategories.seq ";
		$tasks = self::$dataStore->executeQuery($query,true);
		$mainArr["Rows"] = $tasks;
		$mainArr["TotalRows"] = $this->getAllCount(true);
		return $mainArr;
	}
	
	public function getAllCount($isApplyFilter){
		$count = self::$dataStore->executeCountQuery(null,$isApplyFilter);
		return $count;
	}
}