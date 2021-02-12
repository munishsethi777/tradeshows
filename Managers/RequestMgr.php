<?php
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Request.php");
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
class RequestMgr{
	private static $requestMgr;
	private static $requestDataStore;
	public static function getInstance()
	{
		if (!self::$requestMgr){
			self::$requestMgr = new RequestMgr();
			self::$requestDataStore = new BeanDataStore(Requests::$className,Requests::$tableName);
		}
		return self::$requestMgr;
	}
	public function findArrBySeq($seq){
	    $request = self::$requestDataStore->findArrayBySeq($seq);
	    return $request;
	}
	public function getAllRequestsForGrid(){
		$seesionUtil = SessionUtil::getInstance();
		$query = "select * from requests";
		$arr = self::$requestDataStore->executeQuery($query,true);
		return $arr;
	}
	public function getRequestsforGrid(){
		$requests = $this->getAllRequestsForGrid();
		$seesionUtil = SessionUtil::getInstance();
		$requestStartDate = $seesionUtil->getStartDate();
		$arr = array();

	}
}
?>