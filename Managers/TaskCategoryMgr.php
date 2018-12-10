<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/TaskCategory.php");
class TaskCategoryMgr{
	private static  $taskCategoryMgr;
	private static $dataStore;
	public static function getInstance()
	{
		if (!self::$taskCategoryMgr)
		{
			self::$taskCategoryMgr = new TaskCategoryMgr();
			self::$dataStore = new BeanDataStore(TaskCategory::$className, TaskCategory::$tableName);
		}
		return self::$taskCategoryMgr;
	}
	
	public function saveTaskCategory($taskCategory){
		$id = self::$dataStore->save($taskCategory);
		return $id;
	}
	
	public function getTaskCategoriesForGrid(){
		$taskCategories = $this->findAllArr(true);
		$mainArr["Rows"] = $taskCategories;
		$mainArr["TotalRows"] = $this->getAllCount(true);
		return $mainArr;
	}
	
	public function getAllCount($isApplyFilter){
		$count = self::$dataStore->executeCountQuery(null,$isApplyFilter);
		return $count;
	}
	
	public function findAllArr($isApplyFilter = false){
		$taskCatArr = self::$dataStore->findAllArr($isApplyFilter);
		return $taskCatArr;
	}
	
	public function findBySeq($seq){
		$taskCategory = self::$dataStore->findBySeq($seq);
		return $taskCategory;
	}
	
	public function findAll(){
		$taskCategories = self::$dataStore->findAll();
		return $taskCategories;
	}
	

	public function deleteBySeqs($ids) {
		$flag = self::$dataStore->deleteInList ( $ids );
		return $flag;
	}
}