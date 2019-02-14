<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/TradeShowOrderDetail.php");
class TradeShowOrderDetailMgr{
	private static  $TradeShowOrderDetailMgr;
	private static $dataStore;
	public static function getInstance()
	{
		if (!self::$TradeShowOrderDetailMgr)
		{
			self::$TradeShowOrderDetailMgr = new TradeShowOrderDetailMgr();
			self::$dataStore = new BeanDataStore(TradeShowOrderDetail::$className, TradeShowOrderDetail::$tableName);
		}
		return self::$TradeShowOrderDetailMgr;
	}
	
	public function saveOrderDetail($orderDetail){
		$id = self::$dataStore->save($orderDetail);
		return $id;
	}
	
	public function getOrderDetailForGrid($orderSeq){
			$query = "SELECT items.itemno,tradeshoworderdetails.* FROM tradeshoworderdetails 
inner join items on tradeshoworderdetails.itemseq = items.seq
where orderseq = $orderSeq";
			$orderDetail = self::$dataStore->executeQuery($query,true);
			$mainArr["Rows"] = $orderDetail;
			$mainArr["TotalRows"] = $this->getAllCount($orderSeq,true);
			return $mainArr;
		}
		
		public function getAllCount($orderSeq,$isApplyFilter){
			$query = "SELECT count(*) FROM tradeshoworderdetails 
inner join items on tradeshoworderdetails.itemseq = items.seq
where orderseq = $orderSeq";
			$count = self::$dataStore->executeCountQueryWithSql($query,$isApplyFilter);
			return $count;
		} 
	}