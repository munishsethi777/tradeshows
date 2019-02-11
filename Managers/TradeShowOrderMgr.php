<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/TradeShowOrder.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/ExportUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/CustomerMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ItemMgr.php");
class TradeShowOrderMgr{
	private static  $tradeShowOrderMgr;
	private static $dataStore;
	private $validationErrors;
	private $fieldNames;
	private static $FIELD_COUNT = 15;
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
	
	
	public function saveTradeShowOrder($conn,$item){
		self::$dataStore->saveObject($item, $conn);
	}
	
	public function validateAndSaveFile($sheetData,$isUpdate,$updateItemNos){
		$message = "";
		$this->fieldNames = $sheetData[0];
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
				$tradeShowOrder = $this->getTradeShowOrderObj($data);
				$itemNo = $tradeShowOrder->getItemSeq();
				array_push($tradeShowOrderArr, $tradeShowOrder);
				if(!empty($this->validationErrors)){
					$messages .= "<b>Row No. $count has following validation Errors </b><p>" . $this->validationErrors . "</p>";
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
			$response = $this->saveArr($tradeShowOrderArr, $isUpdate,$updateItemNos);
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
	
	private function getTradeShowOrderObj($data){
		$customerMgr = CustomerMgr::getInstance();
		$itemMgr = ItemMgr::getInstance();
		$tradeShowOrder = new TradeShowOrder();
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
		$message = "";
		if(!empty($date)){
			$date = DateUtil::StringToDateByGivenFormat("d-m-Y", $date);
			if(!$date){
				$message .= "-".$this->fieldNames[0] . " -  invalid date<br>";
			}
			$tradeShowOrder->setOrderDate($date);
		}else{
			$message .= "-".$this->fieldNames[0] . " invalid date!<br>";
		}
		if(!empty($customerId)){
			$customerSeq = $customerMgr->findSeqByCustomerId($customerId);
			if(empty($customerSeq)){
				$message .= "-"."Customer id '$customerId' does not exists in database!<br>";
			}else{
				$tradeShowOrder->setCustomerSeq($customerId);
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
				$tradeShowOrder->setItemSeq($itemSeq);
			}else{
				$message .= "-"."Item No '$itemNo' does not exists in database!<br>";
			}
		}else{
			$message .= "-"."Item No. is required!<br>";
		}
		$tradeShowOrder->setItemNote($itemNote);
		$tradeShowOrder->setDescription($description);
		$tradeShowOrder->setWareHouse($wareHouse);
		$tradeShowOrder->setQtyOrder($qtyOrder);
		$tradeShowOrder->setPrice($price);
		$tradeShowOrder->setSoAmt($soAmt);
		if(!empty($shipDt)){
			$shipDt = trim($shipDt);
			$shipDt = DateUtil::StringToDateByGivenFormat("m/d/Y", $shipDt);
			$tradeShowOrder->setShipDt($shipDt);
		}		
		$tradeShowOrder->setCustPo($custPo);
		$tradeShowOrder->setItemNote($itemNote);
		$this->validationErrors = $message;
		return $tradeShowOrder;
	}
	
	
	private function saveArr($tradShowOrderArr,$isUpdate,$updateItemNos){
		$db_New = MainDB::getInstance();
		$conn = $db_New->getConnection();
		$conn->beginTransaction();
		$hasError = false;
		$messages = "";
		$itemNoAlreadyExists = 0;
		$savedItemCount = 0;
		$existingItemIds = array();
		$success = 1;
		foreach ($tradShowOrderArr as $tradShowOrder){
			try {
				if(!$isUpdate){
					$this->saveTradeShowOrder($conn, $tradShowOrder);
					$savedItemCount++;
				}else{
					if(in_array($itemNo, $updateItemNos)){
						$condition["itemno"] = $itemNo;
						$this->updateOject($conn, $item, $condition);
					}
				}
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
		$conn->commit();
		if(!$hasError){
			$messages = "Items Imported Successfully!";
		}
		$response["message"] = $messages;
		$response["success"] = $success;
		$response["itemalreadyexists"] = $itemNoAlreadyExists;
		$response["savedItemCount"] = $savedItemCount;
		$response["existingItemIds"] = $existingItemIds;
		return $response;
	}
	
	public function getOrdersForGrid(){
		$orders = $this->findAllArr(true);
		$mainArr["Rows"] = $orders;
		$mainArr["TotalRows"] = $this->getAllCount(true);
		return $mainArr;
	}
	
	public function getAllCount($isApplyFilter){
		$count = self::$dataStore->executeCountQuery(null,$isApplyFilter);
		return $count;
	}
	
	public function findAllArr($isApplyFilter = false){
		$ordersArr = self::$dataStore->findAllArr($isApplyFilter);
		return $ordersArr;
	}
	
	
	
}