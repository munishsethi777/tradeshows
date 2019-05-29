<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/TaskCategory.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/ItemSpecification.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ItemSpecificationMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ItemSpecificationVersionMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/ExportUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once $ConstantsArray['dbServerUrl'] . 'PHPExcel/IOFactory.php';

class ItemSpecificationMgr{
	private static $ItemSpecificationMgr;
	private static $ItemSpecificationVersionMgr;
	private static $dataStore;
	private $dataTypeErrors;
	private $fieldNames;
	private static $FIELD_COUNT = 66;
	
	public static function getInstance()
	{
		if (!self::$ItemSpecificationMgr)
		{
			self::$ItemSpecificationMgr = new ItemSpecificationMgr();
			self::$ItemSpecificationVersionMgr = ItemSpecificationVersionMgr::getInstance();
			self::$dataStore = new BeanDataStore(ItemSpecification::$className, ItemSpecification::$tableName);
		}
		return self::$ItemSpecificationMgr;
	}
	  
    public function saveFromForm($itemSpecifications){
    	if(empty($itemSpecifications->getHasLight())){
    		$itemSpecifications->setLightType(null);
    		$itemSpecifications->setTotalLumens(0);
    	}
    	if(empty($itemSpecifications->getHasBattery())){
    		$itemSpecifications->setBatteryType(null);
    		$itemSpecifications->setBatteryQuantity(null);
    	}
    	if(empty($itemSpecifications->getHasElectricity())){
    		$itemSpecifications->setElectricityType(null);
    	}
    	$totalPercent = $this->getTotalMatiralPercent($itemSpecifications);
    	$itemSpecifications->setMaterialTotalPercent($totalPercent);
    	$itemSpecificationsArr = array(0=>$itemSpecifications);
    	$response = $this->saveArr($itemSpecificationsArr);
    	return $response;
    }
	 
    
    private function getTotalMatiralPercent($itemSpecifications){
    	$percent1 = $itemSpecifications->getMaterial1Percent();
    	$percent2 = $itemSpecifications->getMaterial2Percent();
    	$percent3 = $itemSpecifications->getMaterial3Percent();
    	$percent4 = $itemSpecifications->getMaterial4Percent();
    	$percent5 = $itemSpecifications->getMaterial5Percent();
    	$totalPercent = $percent1 + $percent2 + $percent3 + $percent4 + $percent5;
    	return $totalPercent;
    }
    
    public function saveItem($conn,$itemSpecification){
    	self::$dataStore->saveObject($itemSpecification, $conn);
    	$itemSpecificationVersionMgr = self::$ItemSpecificationVersionMgr;
    	$itemSpecificationVersion = new ItemSpecificationVersion();
    	$itemSpecificationVersion->from_array($itemSpecification);
    	$itemSpecificationVersion->setSeq(0);
    	$itemSpecificationVersionMgr->saveVersion($itemSpecificationVersion,$conn);
    }
    	
    public function updateOject($conn,$itemSpecification,$condition){
    	$existingIS = $this->findByItemNo($itemSpecification->getItemNo());
    	self::$dataStore->updateObject($itemSpecification, $condition, $conn);
    	if(!empty($itemSpecification)){
    		$itemSpecificationVersionMgr = self::$ItemSpecificationVersionMgr;
    		$itemSpecificationVersion = $itemSpecificationVersionMgr->getItemSpecificationVersion($existingIS,$itemSpecification);
    		if(!empty($itemSpecificationVersion)){
    			$itemSpecificationVersionMgr->saveVersion($itemSpecificationVersion,$conn);
    		}
    	}
    }
	
	public function importItems($file){
		$inputFileName = $file['tmp_name'];
		$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
		$sheets = $objPHPExcel->getAllSheets();
		$sheet = $sheets[0];
		$maxCell = $sheet->getHighestRowAndColumn();
		$range = 'A1:' . $maxCell['column'] . $maxCell['row'];
		$sheetData = $sheet->rangeToArray($range); 
		return $this->validateAndSaveFile($sheetData);
	}
	
	public function exportItemSpecifications($queryString){
		$output = array();
		parse_str($queryString, $output);
		$_GET = array_merge($_GET,$output);
		$itemSpecifications = self::$dataStore->findAll(true);
		ExportUtil::exportItemSpecifications($itemSpecifications);
	}
	
	public function validateAndSaveFile($sheetData){
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
			$itemSpecificationArr = array();
			foreach ($sheetData as $key=>$data){
				if($key < 1){
					continue;
				}
				$itemSpecification = $this->getItemSpecificationObj($data);
				$itemNo = $itemSpecification->getItemNo();
				array_push($itemSpecificationArr, $itemSpecification);
				if(!empty($this->dataTypeErrors)){
					$messages .= "<b>Item $itemNo has following validation Errors </b><p>" . $this->dataTypeErrors . "</p>";
					$success = 0;
				}
			}
		}else{
			$messages .= "Please import the correct file";
			$success = 0;
		}
		$response = array();
		$response["message"] = $messages;
		$response["success"] = $success;
		$response["itemalreadyexists"] = $itemNoAlreadyExists;
		if(empty($messages)){
			$response = $this->saveArr($itemSpecificationArr);
		}
		return $response;
	}
	
	private function saveArr($itemArr){
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
				if(empty($item->getSeq())){
					$this->saveItem($conn, $item);	
					$savedItemCount++;
				}else{
					$condition["itemno"] = $item->getItemNo();
					$this->updateOject($conn, $item, $condition);
				}
			}
			catch ( Exception $e) {
				$trace = $e->getTrace();
				if($trace[0]["args"][0][1] == "1062"){
					$condition["itemno"] = $item->getItemNo();
					$this->updateOject($conn, $item, $condition);
				}else{
					$messages .= $e->getMessage();
					$hasError = true;
					$success = 0;
				}	
			}
		}
		if(!$hasError){
			$conn->commit();
			$messages = "Items Imported Successfully!";
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
	
	private function getItemSpecificationObj($data){
		$itemNumber = $data[0];
		$oms = $data[1];
		$description1 = $data[2];
		$length1 = $data[3];
		$width1 = $data[4];
		$height1 = $data[5];
		
		$description2 = $data[6];
		$length2 = $data[7];
		$width2 = $data[8];
		$height2 = $data[9];
		
		$description3 = $data[10];
		$length3 = $data[11];
		$width3 = $data[12];
		$height3 = $data[13];
		
		$mastercarton1length = $data[14];
		$mastercarton1width = $data[15];
		$mastercarton1height = $data[16];
		
		$mastercarton2length = $data[17];
		$mastercarton2width = $data[18];
		$mastercarton2height = $data[19];
		$msdescription = $data[20];
		
		$port = $data[21];
		$countryoforigin = $data[22];
		$material1 = $data[23];
		$material1percent = $data[24];
		$material2 = $data[25];
		$material2percent = $data[26];
		$material3 = $data[27];
		$material3percent = $data[28];
		$material4 = $data[29];
		$material4percent = $data[30];
		$material5 = $data[31];
		$material5percent = $data[32];
		
		$materialtotalpercent = $data[33];
		$light = $data[34];
		$haslight = 0;
		$lighttype = null;
		if($light != "N"){
			$lighttype = $light;
			$haslight = 1;
		}
		$totallumens = $data[35];
		$hasbattery = $data[36];
		if($hasbattery != "N"){
			$hasbattery = 1;
		}else{
			$hasbattery = 0;
		}
		$batteryquantity = $data[37];
		$batterytype = $data[38];
		$haselectricity = $data[39];
		if($haselectricity != "N"){
			$haselectricity = 1;
		}else{
			$haselectricity = 0;
		}
		$electricitytype = $data[40];
		$cordlengthfeet = $data[41];
		$hasassembly = $data[42];
		if($hasassembly != "N"){
			$hasassembly = 1;
		}else{
			$hasassembly = 0;
		}
		$manualpath = $data[43];
		$part1 = $data[44];
		$part2 = $data[45];
		$part3 = $data[46];
		$part4 = $data[47];
		$part5 = $data[48];
		$cordlengthmeter = $data[49];
		$pumpwattage = $data[50];
		$pumpvolts = $data[51];
		$pumpcordlength = $data[52];
		$transformerwattage = $data[53];
		$transformervolts = $data[54];
		$transformercordlength = $data[55];
		$watercapacity = $data[56];
		$feature1 = $data[57];
		$feature2 = $data[58];
		$feature3 = $data[59];
		$feature4 = $data[60];
		$feature5 = $data[61];
		$feature6 = $data[62];
		$feature7 = $data[63];
		$updatedby = $data[64];
		$troy = $data[65];
		$sessionUtil = SessionUtil::getInstance();
		$userSeq = $sessionUtil->getAdminLoggedInSeq();
		$createOn = new DateTime();
		$lastModifiedOn = new DateTime();
		
		$this->dataTypeErrors = "";	
		$itemSpecification = new ItemSpecification();
		if(!empty($itemNumber)){
			$itemSpecification->setItemNo($itemNumber);
		}
		if(!empty($description1)){
			$itemSpecification->setItem1Description($description1);
		}
		if(!empty($oms)){
			$itemSpecification->setOms($oms);
		}
		if(!empty($length1)){
			$itemSpecification->setItem1Length($length1);
		}
		if(!empty($width1)){
			$itemSpecification->setItem1Width($width1);
		}
		if(!empty($height1)){
			$itemSpecification->setItem1Height($height1);
		}
		if(!empty($description2)){
			$itemSpecification->setItem2Description($description2);
		}
		if(!empty($length2)){
			$itemSpecification->setItem2Length($length2);
		}
		if(!empty($width2)){
			$itemSpecification->setItem2Width($width2);
		}
		if(!empty($height2)){
			$itemSpecification->setItem2Height($height2);
		}
		
		if(!empty($description3)){
			$itemSpecification->setItem3Description($description3);
		}
		if(!empty($length2)){
			$itemSpecification->setItem3Length($length2);
		}
		if(!empty($width3)){
			$itemSpecification->setItem3Width($width3);
		}
		if(!empty($height3)){
			$itemSpecification->setItem3Height($height3);
		}
		
		if(!empty($mastercarton1length)){
			$itemSpecification->setMasterCarton1Length($mastercarton1length);
		}
		if(!empty($mastercarton1width)){
			$itemSpecification->setMasterCarton1Width($mastercarton1width);
		}
		if(!empty($mastercarton1height)){
			$itemSpecification->setMasterCarton1Height($mastercarton1height);
		}
		if(!empty($mastercarton2length)){
			$itemSpecification->setMasterCarton2Length($mastercarton2length);
		}
		if(!empty($mastercarton2width)){
			$itemSpecification->setMasterCarton2Width($mastercarton2width);
		}
		if(!empty($mastercarton2height)){
			$itemSpecification->setMasterCarton2Height($mastercarton2height);
		}
		if(!empty($msdescription)){
			$itemSpecification->setMSDescription($msdescription);
		}
		if(!empty($port)){
			$itemSpecification->setPort($port);
		}
		if(!empty($countryoforigin)){
			$itemSpecification->setCountryOfOrigin($countryoforigin);
		}
		if(!empty($material1)){
			$itemSpecification->setMaterial1($material1);
		}
		if(!empty($material1percent)){
			$itemSpecification->setMaterial1Percent($material1percent);
		}
		if(!empty($material2)){
			$itemSpecification->setMaterial2($material2);
		}
		if(!empty($material2percent)){
			$itemSpecification->setMaterial2Percent($material2percent);
		}
		if(!empty($material3)){
			$itemSpecification->setMaterial3($material3);
		}
		if(!empty($material3percent)){
			$itemSpecification->setMaterial3Percent($material3percent);
		}
		if(!empty($material4)){
			$itemSpecification->setMaterial4($material4);
		}
		if(!empty($material4percent)){
			$itemSpecification->setMaterial4Percent($material4percent);
		}
		if(!empty($material5)){
			$itemSpecification->setMaterial5($material5);
		}
		if(!empty($material5percent)){
			$itemSpecification->setMaterial5Percent($material5percent);
		}
		if(!empty($materialtotalpercent)){
			$itemSpecification->setMaterialTotalPercent($materialtotalpercent);
		}
		$itemSpecification->setHasLight($haslight);
		$itemSpecification->setLightType($lighttype);
		if(!empty($totallumens)){
			$itemSpecification->setTotalLumens($totallumens);
		}
		$itemSpecification->setHasBattery($hasbattery);
		if(!empty($hasbattery)){
			$itemSpecification->setBatteryType($batterytype);
		}
		$itemSpecification->setHasElectricity($haselectricity);
		if(!empty($electricitytype)){
			$itemSpecification->setElectricityType($electricitytype);
		}
		if(!empty($cordlengthfeet)){
			$itemSpecification->setCordLengthFeet($cordlengthfeet);
		}
		if(!empty($manualpath)){
			$itemSpecification->setManualPath($manualpath);
		}
		if(!empty($part1)){
			$itemSpecification->setPart1($part1);
		}
		if(!empty($part2)){
			$itemSpecification->setPart2($part2);
		}
		if(!empty($part3)){
			$itemSpecification->setPart3($part3);
		}
		if(!empty($part4)){
			$itemSpecification->setPart4($part4);
		}
		if(!empty($part5)){
			$itemSpecification->setPart5($part5);
		}
		if(!empty($cordlengthmeter)){
			$itemSpecification->setCordLengthMeter($cordlengthmeter);
		}
		if(!empty($pumpwattage)){
			$itemSpecification->setPumpWattage($pumpwattage);
		}
		if(!empty($pumpvolts)){
			$itemSpecification->setPumpVolts($pumpvolts);
		}
		if(!empty($pumpcordlength)){
			$itemSpecification->setPumpCordLength($pumpcordlength);
		}
		if(!empty($transformerwattage)){
			$itemSpecification->setTransformerWattage($transformerwattage);
		}
		if(!empty($transformervolts)){
			$itemSpecification->setTransformerVolts($transformervolts);
		}
		if(!empty($transformercordlength)){
			$itemSpecification->setTransformerCordLength($transformercordlength);
		}
		if(!empty($watercapacity)){
			$itemSpecification->setWaterCapacity($watercapacity);
		}
		if(!empty($feature1)){
			$itemSpecification->setFeature1($feature1);
		}
		if(!empty($feature2)){
			$itemSpecification->setFeature2($feature2);
		}
		if(!empty($feature3)){
			$itemSpecification->setFeature3($feature3);
		}
		if(!empty($feature4)){
			$itemSpecification->setFeature4($feature4);
		}
		if(!empty($feature5)){
			$itemSpecification->setFeature5($feature5);
		}
		if(!empty($feature6)){
			$itemSpecification->setFeature6($feature6);
		}
		if(!empty($feature7)){
			$itemSpecification->setFeature7($feature7);
		}
		if(!empty($updatedby)){
			$itemSpecification->setUpdatedBy($updatedby);
		}
		if(!empty($troy)){
			$itemSpecification->setTroy($troy);
		}
		$itemSpecification->setHasAssembly($hasassembly);
		$itemSpecification->setLastModifiedOn(new DateTime());
		$itemSpecification->setCreatedOn(new DateTime());
		$itemSpecification->setUserSeq($userSeq);
		return $itemSpecification;
	}
	
	public function getItemsgetItemsForGrid(){
		$items = $this->findAllWithVersions(true);
		$mainArr["Rows"] = $items;
		$mainArr["TotalRows"] = $this->getAllCount(true);
		return $mainArr;
	}
	
	public function getAllCount($isApplyFilter){
		$count = self::$dataStore->executeCountQuery(null,$isApplyFilter);
		return $count;
	}
	
	public function findAllWithVersions($isApplyFilter = false){
		$query = "SELECT count(itemspecificationverions.itemno) as versions ,itemspecifications.* FROM `itemspecifications` 
left join itemspecificationverions on itemspecifications.itemno = itemspecificationverions.itemno
group by itemspecificationverions.itemno";
		$itemSpecifications = self::$dataStore->executeQuery($query,$isApplyFilter);
		$mainArr = array();
		foreach ($itemSpecifications as $itemSpecification){
			$arr = array();
			$arr["seq"] = $itemSpecification["seq"];
			$arr["itemspecifications.itemno"] = $itemSpecification["itemno"];
			$arr["itemspecifications.item1description"] = $itemSpecification["item1description"];
			$arr["versions"] = $itemSpecification["versions"];
			$arr["itemspecifications.countryoforigin"] = $itemSpecification["countryoforigin"];
			$arr["itemspecifications.oms"] = $itemSpecification["oms"];
			$arr["itemspecifications.createdon"] = $itemSpecification["createdon"];
			$arr["itemspecifications.lastmodifiedon"] = $itemSpecification["lastmodifiedon"];
			array_push($mainArr, $arr);
		}
		return $mainArr;
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
	public function findByItemNo($itemNo){
		$condition["itemno"] = $itemNo;
		$item = self::$dataStore->executeConditionQuery($condition);
		if(!empty($item)){
			return $item[0];
		}
		return null;
	}
	public function findBySeq($seq){
		$item = self::$dataStore->findArrayBySeq($seq);
		return $item;
	}
	
	public function getBySeq($seq){
		$item = self::$dataStore->findBySeq($seq);
		return $item;
	}
	
	public function deleteItemSpecificationWithVersions($ids){
		$query = "DELETE itemspecifications , itemspecificationverions  FROM itemspecifications  INNER JOIN itemspecificationverions  
WHERE itemspecifications.itemno= itemspecificationverions.itemno and itemspecifications.seq in($ids)";
		self::$dataStore->executeQuery($query);
	}
	
	
	 
}