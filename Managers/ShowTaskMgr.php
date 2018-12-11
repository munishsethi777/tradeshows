<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/ShowTask.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ShowTaskAssigneeMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/TaskMgr.php");
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
		$id = self::$dataStore->save($ShowTaskObject);
		return $id;
	}
	
	public function deleteByShowSeq($showSeq){
		$colVal["showseq"] = $showSeq;
		self::$dataStore->deleteByAttribute($colVal);
	}
	public function saveShowTaskFromRequest($showId){
		$categorySeqs = $_REQUEST["category"];
		$showTaskAssignee = ShowTaskAssigneeMgr::getInstance();
		$taskMgr = TaskMgr::getInstance();
		foreach ($categorySeqs as $categorySeq){
			$titles = $_REQUEST[$categorySeq."_title"];
			$taskSeqs = $_REQUEST[$categorySeq."_taskSeq"];
			$startDates = $_REQUEST[$categorySeq."_startdate"];
			$endDates = $_REQUEST[$categorySeq."_enddate"];
			$selectedAssignees = $_REQUEST[$categorySeq."_selectedAssignees"];
			$showTask = new ShowTask();
			foreach ($titles as $key=>$title){
				$taskSeq = $taskSeqs[$key];
				if(empty($taskSeq)){
					$task = new Task();
					$task->setTitle($title);
					$task->setTaskCategorySeq($categorySeq);
					$task->setStartDateReferenceDays(0);
					$task->setDaysRequired(0);
					$task->setParentTaskSeq(0);
					$task->setDescription($title);
					$task->setIsCustom(1);
					$taskSeq = $taskMgr->saveTask($task);
				}
				$showTask->setTaskSeq($taskSeq);
				$startDate = DateUtil::StringToDateByGivenFormat('m-d-Y', $startDates[$key]);
				$endDate = DateUtil::StringToDateByGivenFormat('m-d-Y', $endDates[$key]);
				$showTask->setStartDate($startDate);
				$showTask->setEndDate($endDate);
				$showTask->setStatus("pending");
				$showTask->setShowSeq($showId);
				$id = $this->saveShowTask($showTask);
				$assignees = $selectedAssignees[$key];
				$showTaskAssignee->saveAssignees($id, $assignees);
			}
		}
	}

	public function updateShowTaskCommentsStatus($showTask){
		$colVal = array();
		$colVal["status"] = $showTask->getStatus();
		$colVal["comments"] = $showTask->getComments();
		
		$colValCondition = array();
		$colValCondition["seq"] = $showTask->getSeq();
		
		return self::$dataStore->updateByAttributes($colVal,$colValCondition);
	}
	public function getShowTaskDetails($showTaskSeq){
		$query = "SELECT shows.title as showtitle,showtasks.seq,tasks.title,tasks.description,showtasks.startdate,showtasks.enddate,showtasks.comments,showtasks.status FROM `showtasks`
inner join tasks on tasks.seq = showtasks.taskseq inner join shows on showtasks.showseq = shows.seq where showtasks.seq = $showTaskSeq";
		$taskDetails = self::$dataStore->executeQuery($query);
		return $taskDetails;
	}
	
	public function getTaskByShowJson($showSeq){
		$colVal["showseq"] = $showSeq;
		$showTasks = self::$dataStore->executeConditionQuery($colVal);
		return json_encode($showTasks);
	}

	public function getShowTaskDataByShowSeq($showSeq){
		$query = "select tasks.seq,tasks.daysrequired,tasks.parenttaskseq,tasks.title,tasks.taskcategoryseq,taskcategories.title as categorytitle ,showtasks.startdate,showtasks.enddate from showtasks inner join tasks on showtasks.taskseq = tasks.seq inner join taskcategories on tasks.taskcategoryseq = taskcategories.seq 
where showtasks.showseq = $showSeq";
		$showTasks = self::$dataStore->executeQuery($query);
		$showTasks = $this->_group_by($showTasks, "categorytitle");
		$mainArr["tasks"] = $showTasks;
		$userMgr = UserMgr::getInstance();
		$users = $userMgr->getAllUserArr();
		$mainArr["users"] = $users;
		$showTaskAssigneeMgr = ShowTaskAssigneeMgr::getInstance();
		$showTaskAssignes = $showTaskAssigneeMgr->getAllShowTaskAssignee();
		$mainArr["taskAssignees"] = $showTaskAssignes;
		return $mainArr;
	}
	
	public function getShowTaskWithAssignee($showSeq){
		$query = "select users.seq,users.email,users.fullname,tasks.title,showtasks.startdate,showtasks.enddate from shows
		inner join showtasks on shows.seq = showtasks.showseq inner join tasks on showtasks.taskseq = tasks.seq inner join showtaskassignees on showtasks.seq = showtaskassignees.showtaskseq
		inner join users on showtaskassignees.userseq = users.seq where shows.seq = $showSeq";
		$showTaskAssignees = self::$dataStore->executeQuery($query);
		$showTaskAssignees = $this->_group_by($showTaskAssignees, "seq");
		return $showTaskAssignees;
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
