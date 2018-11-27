<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/ShowTaskAssignee.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");
class ShowTaskAssigneeMgr{
	private static  $showTaskAssigneeMgr;
	private static $dataStore;
	public static function getInstance()
	{
		if (!self::$showTaskAssigneeMgr)
		{
			self::$showTaskAssigneeMgr = new ShowTaskAssigneeMgr();
			self::$dataStore = new BeanDataStore(ShowTaskAssignee::$className, ShowTaskAssignee::$tableName);
		}
		return self::$showTaskAssigneeMgr;
	}
	
	public function saveFromRequest($assignees,$showTaskSeq,$taskSeq){
		$assigneesSeqs = $assignees;
		foreach ($assigneesSeqs as $key=>$assignee){
			$assigneeArr = explode("_", $assignee);
			$tSeq = $assigneeArr[0];
			$assigneeSeq = $assigneeArr[1];
			if($tSeq == $taskSeq){
				$showTaskAssignee = new ShowTaskAssignee();
				$showTaskAssignee->setShowTaskSeq($showTaskSeq);
				$showTaskAssignee->setUserSeq($assigneeSeq);
				self::$dataStore->save($showTaskAssignee);
				unset($assignees[$key]);
			}else{
				break;
			}
		}
		return $assignees;
	}
	
	public function deleteByShowSeq($showSeq){
		$query = "delete showtaskassignees.* from showtasks  inner join showtaskassignees on showtasks.seq = showtaskassignees.showtaskseq
where showtasks.showseq = $showSeq";
		self::$dataStore->executeQuery($query);
	}
	
	public function getAllShowTaskAssignee(){
		$query = "select showtasks.taskseq,showtaskassignees.userseq from showtaskassignees inner join showtasks on showtaskassignees.showtaskseq = showtasks.seq";
		$taskAssignes = self::$dataStore->executeQuery($query);
		$taskAssignes = $this->_group_by($taskAssignes, "taskseq");
		return $taskAssignes;
	}
	
	function _group_by($array, $key) {
		$return = array();
		foreach($array as $val) {
			$return[$val[$key]][] = $val["userseq"];
		}
		return $return;
	}
}