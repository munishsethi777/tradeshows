<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/TaskAssignee.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/UserMgr.php");
class TaskAssigneeMgr{
	private static  $taskAssigneeMgr;
	private static $dataStore;
	public static function getInstance()
	{
		if (!self::$taskAssigneeMgr)
		{
			self::$taskAssigneeMgr = new TaskAssigneeMgr();
			self::$dataStore = new BeanDataStore(TaskAssignee::$className, TaskAssignee::$tableName);
		}
		return self::$taskAssigneeMgr;
	}
	
	public function getAllTaskAssignee(){
		$query = "select taskassignees.taskseq,taskassignees.userseq from taskassignees inner join users on taskassignees.userseq = users.seq";
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
	

	public function saveTaskAssignee($taskAssignee){
		$id = self::$dataStore->save($taskAssignee);
		return $id;
	} 
	
	public function deleteByTaskSeq($taskSeq){
		$colVal["taskseq"] = $taskSeq;
		$flag = self::$dataStore->deleteByAttribute($colVal);
		return $flag;
	}
	
	public function getAssignedUsersByTaskSeq($taskSeq){
		$colVal["taskseq"] = $taskSeq;
		$taskAssignees = self::$dataStore->executeConditionQuery($colVal);
		$userSeqs  = array_map(create_function('$o', 'return $o->getUserSeq();'), $taskAssignees);
		return $userSeqs;
	}
}