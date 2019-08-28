<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/TaskCategory.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Item.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/ExportUtil.php");
require_once $ConstantsArray['dbServerUrl'] . 'PHPExcel/IOFactory.php';
require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");
class ItemMgr{
	private static  $ItemMgr;
	private static $dataStore;
	private $dataTypeErrors;
	private $fieldNames;
	private static $FIELD_COUNT = 25;
	public static function getInstance()
	{
		if (!self::$ItemMgr)
		{
			self::$ItemMgr = new ItemMgr();
			self::$dataStore = new BeanDataStore(Item::$className, Item::$tableName);
		}
		return self::$ItemMgr;
	}
	  
    public function saveItem($conn,$item){
    	self::$dataStore->saveObject($item, $conn);
    }
    
    public function updateOject($conn,$item,$condition){
    	self::$dataStore->updateObject($item, $condition, $conn);
    }
	
	public function importItems($file,$isUpdate,$updateItemNos){
		$inputFileName = $file['tmp_name'];
		$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
		$sheet = $objPHPExcel->getActiveSheet();
		$maxCell = $sheet->getHighestRowAndColumn();
		$sheetData = $sheet->rangeToArray('A1:' . $maxCell['column'] . $maxCell['row']);
		return $this->validateAndSaveFile($sheetData,$isUpdate,$updateItemNos);
	}
	
	public function exportItems(){
		$items = self::$dataStore->findAll();
		ExportUtil::exportItems($items);
	}
	
	public function validateAndSaveFile($sheetData,$isUpdate,$updateItemNos){
		$message = "";
		$this->fieldNames = $sheetData[0];
		$itemNoAlreadyExists = 0;
		$success = 1;
		$messages = "";
		if(self::$FIELD_COUNT == count($this->fieldNames)){
			$mainJson = array();
			$json = array();
			$mainJson["success"] = 1;
			$mainJson["messages"] = "";
			$exstingsItemNos = array();
			$itemArr = array();
			foreach ($sheetData as $key=>$data){
				if($key == 0){
					continue;
				}
				if(!array_filter($data)) {
					continue;
				}
				$item = $this->getItemObj($data);
				$itemNo = $item->getItemNo();
				array_push($itemArr, $item);
				if(!empty($this->dataTypeErrors)){
					$messages .= "<b>Item $itemNo has following validation Errors </b><p>" . $this->dataTypeErrors . "</p>";
					$success = 0;
				}
			}
		}else{
		    $messages .= StringConstants::IMPORT_CORRECT_FILE;
			$success = 0;
		}
		$response = array();
		$response["message"] = $messages;
		$response["success"] = $success;
		$response["itemalreadyexists"] = $itemNoAlreadyExists;
		if(empty($messages)){
			$response = $this->saveArr($itemArr, $isUpdate,$updateItemNos);
		}
		return $response;
	}
	
	private function saveArr($itemArr,$isUpdate,$updateItemNos){
		$db_New = MainDB::getInstance();
		$conn = $db_New->getConnection();
		$conn->beginTransaction();
		$hasError = false;
		$messages = "";
		$itemNoAlreadyExists = 0;
		$savedItemCount = 0;
		$existingItemIds = array();
		$success = 1;
		foreach ($itemArr as $item){
			$itemNo = $item->getItemNo();
			try {
				if(!$isUpdate){
					$this->saveItem($conn, $item);
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
		    $messages = StringConstants::ITEMS_IMPORTED_SUCCESSFULLY;
		}
		$response["message"] = $messages;
		$response["success"] = $success;
		$response["itemalreadyexists"] = $itemNoAlreadyExists;
		$response["savedItemCount"] = $savedItemCount;
		$response["existingItemIds"] = $existingItemIds;
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
	
	private function getItemObj($data){
		$itemNumber = $data[0];
		$description = $data[1];
		$class = $data[2];
		$dept = $data[3];
		$status = $data[4];
		$unit = $data[5];
		$pc = $data[6];
		$disc = $data[7];
		$inStockQty = $data[8];
		$allocQty = $data[9];
		$soQty = $data[10];
		$avQty = $data[11];
		$poQty = $data[12];
		$owQty = $data[13];
		$projQty = $data[14];
		$ytdSoldQty = $data[15];
		$lastYearSoldQty = $data[16];
		$comdShip = $data[17];
		$showSpecial = $data[18];
		$distributer = $data[19];
		$dealerPrice = $data[20];
		$crztDisSp = $data[21];
		$qtyWt = $data[22];
		$mlnStock = $data[23];
		$itemCost = $data[24];
		$this->dataTypeErrors = "";	
		$item = new Item();
		if(!empty($itemNumber)){
			$item->setItemNo($itemNumber);
		}
		if(!empty($description)){
			$item->setDescription($description);
		}
		if(!empty($class)){
			$item->setClass($class);
		}
		if(!empty($dept)){
			$item->setDept($dept);
		}
		if(!empty($status)){
			$item->setStatus($status);
		}
		if(!empty($unit)){
			$item->setUnit($unit);
		}
		if(!empty($pc)){
			$this->dataTypeErrors .= $this->validateNumeric($pc, $this->fieldNames[6]);
			$item->setPccs($pc);
		}
		if(!empty($disc)){
			$this->dataTypeErrors .= $this->validateNumeric($disc, $this->fieldNames[7]);
			$item->setDisc($disc);
		}
		if(!empty($inStockQty)){
			$this->dataTypeErrors .= $this->validateNumeric($inStockQty, $this->fieldNames[9]);
			$item->setInStockQty($inStockQty);
		}
		if(!empty($allocQty)){
			$this->dataTypeErrors .= $this->validateNumeric($allocQty, $this->fieldNames[10]);
			$item->setAllocQty($allocQty);
		}
		if(!empty($soQty)){
			$this->dataTypeErrors .= $this->validateNumeric($soQty, $this->fieldNames[11]);
			$item->setSoQty($soQty);
		}
		if(!empty($avQty)){
			$this->dataTypeErrors .= $this->validateNumeric($avQty, $this->fieldNames[12]);
			$item->setAvQty($avQty);
		}
		if(!empty($owQty)){
			$this->dataTypeErrors .= $this->validateNumeric($owQty, $this->fieldNames[13]);
			$item->setOwQty($owQty);
		}
		if(!empty($projQty)){
			$this->dataTypeErrors .= $this->validateNumeric($projQty, $this->fieldNames[14]);
			$item->setProjQty($projQty);
		}
		if(!empty($ytdSoldQty)){
			$this->dataTypeErrors .= $this->validateNumeric($ytdSoldQty, $this->fieldNames[15]);
			$item->setYtdSoldQty($ytdSoldQty);
		}
		if(!empty($lastYearSoldQty)){
			$this->dataTypeErrors .= $this->validateNumeric($lastYearSoldQty, $this->fieldNames[16]);
			$item->setLastYearSoldQty($lastYearSoldQty);
		}
		if(!empty($comdShip)){
			$this->dataTypeErrors .= $this->validateNumeric($comdShip, $this->fieldNames[17]);
			$item->setComdShip($comdShip);
		}
		if(!empty($showSpecial)){
			$this->dataTypeErrors .= $this->validateNumeric($showSpecial, $this->fieldNames[18]);
			$item->setShowSpecial($showSpecial);
		}
		if(!empty($distributer)){
			$this->dataTypeErrors .= $this->validateNumeric($distributer, $this->fieldNames[19]);
			$item->setDistributor($distributer);
		}
		if(!empty($dealerPrice)){
			$this->dataTypeErrors .= $this->validateNumeric($dealerPrice, $this->fieldNames[20]);
			$item->setDealerPrice($dealerPrice);
		}
		if(!empty($crztDisSp)){
			$this->dataTypeErrors .= $this->validateNumeric($crztDisSp, $this->fieldNames[21]);
			$item->setCrzyDissp($crztDisSp);
		}
		if(!empty($qtyWt)){
			$this->dataTypeErrors .= $this->validateNumeric($qtyWt, $this->fieldNames[22]);
			$item->setQtyWt($qtyWt);
		}
		if(!empty($mlnStock)){
			$this->dataTypeErrors .= $this->validateNumeric($mlnStock, $this->fieldNames[23]);
			$item->setMinStk($mlnStock);
		}
		if(!empty($itemCost)){
			$this->dataTypeErrors .= $this->validateNumeric($itemCost, $this->fieldNames[24]);
			$item->setItemCost($itemCost);
		}
		$item->setLastModifiedOn(new DateTime());
		$item->setCreatedOn(new DateTime());
		$item->setIsEnabled(1);
		return $item;
	}
	
	public function getItemsForGrid(){
		$items = $this->findAllArr(true);
		$mainArr["Rows"] = $items;
		$mainArr["TotalRows"] = $this->getAllCount(true);
		return $mainArr;
	}
	
	public function getAllCount($isApplyFilter){
		$count = self::$dataStore->executeCountQuery(null,$isApplyFilter);
		return $count;
	}
	
	public function findAllArr($isApplyFilter = false){
		$itemArr = self::$dataStore->findAllArr($isApplyFilter);
		return $itemArr;
	}
	
	public function findSeqByItemNo($itemNo){
		$condition["itemno"] = $itemNo;
		$attr[0] = "seq";
		$item = self::$dataStore->executeAttributeQuery($attr, $condition);
		if(!empty($item)){
			return $item[0][0];
		}
		return null;
	}
	public function findBySeq($seq){
		$item = self::$dataStore->findArrayBySeq($seq);
		return $item;
	}
	
	
	 
}