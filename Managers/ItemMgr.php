<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/TaskCategory.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Item.php");
include $ConstantsArray['dbServerUrl'] . 'PHPExcel/IOFactory.php';
class ItemMgr{
	private static  $ItemMgr;
	private static $dataStore;
	public static function getInstance()
	{
		if (!self::$ItemMgr)
		{
			self::$ItemMgr = new ItemMgr();
			self::$dataStore = new BeanDataStore(Item::$className, Item::$tableName);
		}
		return self::$ItemMgr;
	}
	
	  public function SaveUsersWithRollBack($item){
                                                               
      } 
      
    public function saveItem($conn,$item){
    	self::$dataStore->saveObject($item, $conn);
    }
	
	public function importItems($file){
		$inputFileName = $file['tmp_name'];
		$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
		$sheet = $objPHPExcel->getActiveSheet();
		$maxCell = $sheet->getHighestRowAndColumn();
		$sheetData = $sheet->rangeToArray('A1:' . $maxCell['column'] . $maxCell['row']);
		return $this->validateAndSaveFile($sheetData);
	}
	
	public function validateAndSaveFile($sheetData){
		$message = "";
		$fieldNames = $sheetData[0];
		$mainJson = array();
		$json = array();
		$mainJson["success"] = 1;
		$mainJson["messages"] = "";
		$itemArr = array();
		$db_New = MainDB::getInstance();
		$conn = $db_New->getConnection();
		$conn->beginTransaction();
		$messages = "";
		foreach ($sheetData as $key=>$data){
			if($key == 0){
				continue;
			}
			$item = $this->getItemObj($data);
			array_push($itemArr, $item);
			try {
				$this->saveItem($conn, $item);
			} catch ( Exception $e) {
				$messages = "Error on Line no " . $key + 1 . " - " . $e->getMessage() ."<br/>";
			}
		}
		if(empty($messages)){
			$conn->commit();
		}else{
			$conn->rollback();
		}
		return $messages;
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
			
		$item = new Item();
		$item->setItemNo($itemNumber);
		$item->setDescription($description);
		$item->setClass($class);
		$item->setDept($dept);
		$item->setStatus($status);
		$item->setUnit($unit);
		$item->setPccs($pc);
		$item->setDisc($disc);
		$item->setInStockQty($inStockQty);
		$item->setAllocQty($allocQty);
		$item->setSoQty($soQty);
		$item->setAvQty($avQty);
		$item->setPoQty($poQty);
		$item->setOwQty($owQty);
		$item->setProjQty($projQty);
		$item->setYtdSoldQty($ytdSoldQty);
		$item->setLastYearSoldQty($lastYearSoldQty);
		$item->setComdShip($comdShip);
		$item->setShowSpecial($showSpecial);
		$item->setDistributor($distributer);
		$item->setDealerPrice($dealerPrice);
		$item->setCrzyDissp($crztDisSp);
		$item->setQtyWt($qtyWt);
		$item->setMinStk($mlnStock);
		$item->setItemCost($itemCost);
		$item->setLastModifiedOn(new DateTime());
		$item->setCreatedOn(new DateTime());
		$item->setIsEnabled(1);
		return $item;
	}
	 
}