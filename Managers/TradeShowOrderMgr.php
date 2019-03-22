<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/TradeShowOrder.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/ExportUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomerMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ItemMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/TradeShowOrderDetail.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/TradeShowOrderDetailMgr.php");


class TradeShowOrderMgr{
	private static  $tradeShowOrderMgr;
	private static $dataStore;
	private $validationErrors;
	private $fieldNames;
	private static $FIELD_COUNT = 15;
	private $orderIdAndOrders;
	public static function getInstance()
	{
		if (!self::$tradeShowOrderMgr)
		{
			self::$tradeShowOrderMgr = new TradeShowOrderMgr();
			self::$dataStore = new BeanDataStore(TradeShowOrder::$className, TradeShowOrder::$tableName);
		}
		return self::$tradeShowOrderMgr;
	}
	
	public function importOrders($file){
		$inputFileName = $file['tmp_name'];
		$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
		$sheet = $objPHPExcel->getActiveSheet();
		$totalRows = $sheet->getHighestRow();
		$sheet->getStyle('K1:K'.$totalRows)->getNumberFormat()->setFormatCode("#,##0.00");
		$sheet->getStyle('L1:L'.$totalRows)->getNumberFormat()->setFormatCode("#,##0.00");
		$maxCell = $sheet->getHighestRowAndColumn();
		$sheetData = $sheet->rangeToArray('A1:' . $maxCell['column'] . $maxCell['row']);
		return $this->validateAndSaveFile($sheetData,false,null);
	}
	
	
	public function saveTradeShowOrder($item){
		$id = self::$dataStore->save($item);
		return $id;
	}
	
	
	public function validateAndSaveFile($sheetData,$isUpdate,$updateItemNos){
		$message = "";
		$this->fieldNames = $sheetData[0];
		$this->orderIdAndOrders = array();
		$orderAlreadyExists = 0;
		$success = 1;
		$messages = "";
		if(self::$FIELD_COUNT == count($this->fieldNames)){
			$mainJson = array();
			$json = array();
			$mainJson["success"] = 1;
			$mainJson["messages"] = "";
			$exstingsItemNos = array();
			$tradeShowOrderArr = array();
			$count = 1;
			foreach ($sheetData as $key=>$data){
				if($key == 0){
					continue;
				}
				if(!array_filter($data)) {
					continue;
				}
				$tradeShowOrderAndDetail = $this->getTradeShowOrderObj($data);
				array_push($tradeShowOrderArr, $tradeShowOrderAndDetail);
				if(!empty($this->validationErrors)){
					$messages .= "<b>Row No. $key has following validation Errors </b><p>" . $this->validationErrors . "</p>";
					$success = 0;
				}
				$count++;
			}
		}else{
			$messages .= "Please import the correct file";
			$success = 0;
		}
		$response = array();
		$response["message"] = $messages;
		$response["success"] = $success;
		$response["itemalreadyexists"] = $orderAlreadyExists;
		if(empty($messages)){
			$response = $this->saveArr($tradeShowOrderArr);
		}
		return $response;
	}
	
	private function validateNumeric($val,$fieldName){
		$message = "";
		$val = str_replace(",", "", $val);
		if(!is_numeric($val)){
			$message = "  - '$fieldName' should be numeric a value!<br>";
		}
		return $message;
	}
	
	private function validateEmpty($val,$fieldName){
		$message = "";
		if(empty($val)){
			$message = "  - '$fieldName' is required<br>";
		}
		return $message;
	}
	public function exportOrders(){
		$orders = $this->getDataForExport();
		ExportUtil::exportOrders($orders);
	}
	
	public function getDataForExport(){
		$query = "select items.description,items.itemno, customers.customerid,customers.customername ,tradeshoworders.* , tradeshoworderdetails.* from tradeshoworders 
inner join tradeshoworderdetails on tradeshoworders.seq = tradeshoworderdetails.orderseq
inner join customers on tradeshoworders.customerseq = customers.seq
inner join items on tradeshoworderdetails.itemseq = items.seq";
		$orders = self::$dataStore->executeQuery($query);
		return $orders;
	}
	
	private function getTradeShowOrderObj($data){
		$customerMgr = CustomerMgr::getInstance();
		$itemMgr = ItemMgr::getInstance();
		$tradeShowOrder = new TradeShowOrder();
		$tradeShowOrderDetail = new TradeShowOrderDetail();
		$date = $data[0];
		$customerId = $data[1];
		$saleRep = $data[3];
		$saleOrderNo = $data[4];
		$soType = $data[5];
		$itemNo = $data[6];
		$description = $data[7];
		$wareHouse = $data[8];
		$qtyOrder = $data[9];
		$price = $data[10];
		$soAmt = $data[11];
		$shipDt = $data[12];
		$custPo = $data[13];
		$itemNote = $data[14];
		$tradeShowSeq = $_POST["tradeshowseq"];
		$tradeShowOrder->setTradeShowSeq($tradeShowSeq);
		$message = "";
		if(!empty($date)){
			$dateObj = DateUtil::StringToDateByGivenFormat("m-d-y", $date);
			if(!$dateObj){
				$dateObj = DateUtil::StringToDateByGivenFormat("n/j/y", $date);
			}
			if(!$dateObj){
				$message .= "-".$this->fieldNames[0] . " -  invalid date<br>";
			}
			$tradeShowOrder->setOrderDate($dateObj);
		}else{
			$message .= "-".$this->fieldNames[0] . " invalid date!<br>";
		}
		if(!empty($customerId)){
			$customerSeq = $customerMgr->findSeqByCustomerId($customerId);
			if(empty($customerSeq)){
				$message .= "-"."Customer id '$customerId' does not exists in database!<br>";
			}else{
				$tradeShowOrder->setCustomerSeq($customerSeq);
			}	
		}else{
			$message .= "-"."Customer id is required!<br>";
		}
		
		if(!empty($saleRep)){
			$message .= $this->validateNumeric($saleRep, $this->fieldNames[3]);
			$tradeShowOrder->setSaleRep($saleRep);
		}
		$tradeShowOrder->setSalesOrderNumber($saleOrderNo);
		$tradeShowOrder->setSoType($soType);
		if(!empty($itemNo)){
			$itemSeq = $itemMgr->findSeqByItemNo($itemNo);
			if(!empty($itemSeq)){
				$tradeShowOrderDetail->setItemSeq($itemSeq);
			}else{
				$message .= "-"."Item No '$itemNo' does not exists in database!<br>";
			}
		}else{
			$message .= "-"."Item No. is required!<br>";
		}
		$tradeShowOrderDetail->setItemNote($itemNote);
		$tradeShowOrderDetail->setWarehouse($wareHouse);
		$tradeShowOrderDetail->setPrice($price);
		$tradeShowOrderDetail->setSoAmount($soAmt);
		$tradeShowOrderDetail->setQuantity($qtyOrder);
		if(!empty($shipDt)){
			$shipDt = trim($shipDt);
			$shipDt = DateUtil::StringToDateByGivenFormat("m/d/Y", $shipDt);
			$tradeShowOrder->setShipDt($shipDt);
		}		
		$tradeShowOrder->setCustPo($custPo);
		$this->validationErrors = $message;
		$tradeShowOrderAndDetail["orders"] = $tradeShowOrder;
		$tradeShowOrderAndDetail["detail"] = $tradeShowOrderDetail;
		return $tradeShowOrderAndDetail;
		
	}
	
	
	private function saveArr($tradShowOrderArr){
		$hasError = false;
		$messages = "";
		$itemNoAlreadyExists = 0;
		$savedItemCount = 0;
		$existingItemIds = array();
		$success = 1;
		$orderDetailMgr = TradeShowOrderDetailMgr::getInstance();
		foreach ($tradShowOrderArr as $tradShowOrderAndDetail){
			try {
					$tradShowOrder = $tradShowOrderAndDetail["orders"];
					$orderNo = $tradShowOrder->getSalesOrderNumber();
					if(isset($this->orderIdAndOrders[$orderNo])){
						$tradShowOrder = $this->orderIdAndOrders[$orderNo];
					}else{
						$id = $this->saveTradeShowOrder($tradShowOrder);
						$tradShowOrder->setSeq($id);
						$this->orderIdAndOrders[$orderNo] = $tradShowOrder;
					}
					$tradShowOrderDetail = $tradShowOrderAndDetail["detail"];
					$tradShowOrderDetail->setOrderSeq($tradShowOrder->getSeq());
					$orderDetailMgr->saveOrderDetail($tradShowOrderDetail);
					$savedItemCount++;		
			}
			catch ( Exception $e) {
				$trace = $e->getTrace();
				if($trace[0]["args"][0][1] == "1062"){
					$itemNoAlreadyExists++;
					array_push($existingItemIds, $itemNo);
				}else{
					$messages .= $e->getMessage();
				}
				$hasError = true;
				$success = 0;
			}
		}
		if(!$hasError){
			$messages = "Tradeshow orders Imported Successfully!";
		}
		$response["message"] = $messages;
		$response["success"] = $success;
		$response["itemalreadyexists"] = $itemNoAlreadyExists;
		$response["savedItemCount"] = $savedItemCount;
		$response["existingItemIds"] = $existingItemIds;
		return $response;
	}
	
	public function getOrdersForGrid($tradeShowSeq){
		$query = "SELECT tradeshoworders.*,customers.customername FROM tradeshoworders
inner join customers on tradeshoworders.customerseq = customers.seq
where tradeshoworders.tradeshowseq = $tradeShowSeq";
		$orders = self::$dataStore->executeQuery($query,true);
		$mainArr["Rows"] = $orders;
		$mainArr["TotalRows"] = $this->getAllCount($tradeShowSeq,true);
		return $mainArr;
	}
	
	public function getAllCount($tradeShowSeq,$isApplyFilter){
		$query = "SELECT count(*) FROM tradeshoworders
inner join customers on tradeshoworders.customerseq = customers.seq
where tradeshoworders.tradeshowseq = $tradeShowSeq";
		$count = self::$dataStore->executeCountQueryWithSql($query,$isApplyFilter);
		return $count;
	}
	
	public function findAllArr($isApplyFilter = false){
		$ordersArr = self::$dataStore->findAllArr($isApplyFilter);
		return $ordersArr;
	}
	
	
	
}