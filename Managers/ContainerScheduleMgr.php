<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/ContainerSchedule.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/ExportUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once $ConstantsArray['dbServerUrl'] .'PHPExcel/IOFactory.php';
require_once $ConstantsArray['dbServerUrl'] .'Managers/ClassCodeMgr.php';


class ContainerScheduleMgr{
	private static $containerScheduleMgr;
	private static $dataStore;
	public static function getInstance()
	{
		if (!self::$containerScheduleMgr)
		{
			self::$containerScheduleMgr = new ContainerScheduleMgr();
			self::$dataStore = new BeanDataStore(ContainerSchedule::$className, ContainerSchedule::$tableName);
		}
		return self::$containerScheduleMgr;
	}
	
	public function save($containerSchedule){
    	self::$dataStore->save($containerSchedule);
    }
    
    
	
	public function getGraphicLogsForGrid(){
		$query = "select users.fullname,classcode,graphicslogs.* from graphicslogs left join classcodes on graphicslogs.classcodeseq = classcodes.seq left join users on graphicslogs.userseq = users.seq";
		$rows = self::$dataStore->executeQuery($query,true);
		$mainArr["Rows"] = $rows;
		$mainArr["TotalRows"] = $this->getAllCount(true);
		return $mainArr;
	}
	
	public function getAllCount($isApplyFilter){
		$query = "select count(*) from graphicslogs left join classcodes on graphicslogs.classcodeseq = classcodes.seq left join users on graphicslogs.userseq = users.seq";
		$count = self::$dataStore->executeCountQueryWithSql($query,$isApplyFilter);
		return $count;
	}
	
	public function findAllArr($isApplyFilter = false){
		$itemArr = self::$dataStore->findAllArr($isApplyFilter);
		return $itemArr;
	}
	
	
	public function findBySeq($seq){
		$graphicLog = self::$dataStore->findBySeq($seq);
		$graphicLog->setUSAOfficeEntryDate($this->getDateStr($graphicLog->getUSAOfficeEntryDate()));
		$graphicLog->setEstimatedShipDate($this->getDateStr($graphicLog->getEstimatedShipDate()));
		$graphicLog->setEstimatedGraphicsDate($this->getDateStr($graphicLog->getEstimatedGraphicsDate()));
		$graphicLog->setChinaOfficeEntryDate($this->getDateStr($graphicLog->getChinaOfficeEntryDate()));
		$graphicLog->setConfirmedPOShipDate($this->getDateStr($graphicLog->getConfirmedPOShipDate()));
		$graphicLog->setJeopardyDate($this->getDateStr($graphicLog->getJeopardyDate()));
		$graphicLog->setFinalGraphicsDueDate($this->getDateStr($graphicLog->getFinalGraphicsDueDate()));
		$graphicLog->setApproxGraphicsChinaSentDate($this->getDateStr($graphicLog->getApproxGraphicsChinaSentDate()));
		$graphicLog->setGraphicArtistStartDate($this->getDateStr($graphicLog->getGraphicArtistStartDate()));
		$graphicLog->setGraphicCompletionDate($this->getDateStr($graphicLog->getGraphicCompletionDate()));
		$graphicLog->setDraftDate($this->getDateStr($graphicLog->getDraftDate()));
		$graphicLog->setBuyerReviewReturnDate($this->getDateStr($graphicLog->getBuyerReviewReturnDate()));
		$graphicLog->setManagerReviewReturnDate($this->getDateStr($graphicLog->getManagerReviewReturnDate()));
		return $graphicLog;
	}
	
	public function deleteByIds($ids){
		return self::$dataStore->deleteInList($ids);
	}
	
	
	
	
	
	
	 
}