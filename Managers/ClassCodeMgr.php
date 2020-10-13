<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/ClassCode.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/ClassCodeImportUtil.php");


class ClassCodeMgr{
	private static  $classCodeMgr;
	private static $dataStore;
	public static function getInstance()
	{
		if (!self::$classCodeMgr)
		{
			self::$classCodeMgr = new ClassCodeMgr();
			self::$dataStore = new BeanDataStore(ClassCode::$className, ClassCode::$tableName);
		}
		return self::$classCodeMgr;
	}
	
	public function saveCode($classCode){
		return self::$dataStore->save($classCode);
	}
	
	public function findAll(){
		return self::$dataStore->findAll();
	}
	
	public function findBySeq($seq){
		$classCode = self::$dataStore->findBySeq($seq);
		return $classCode;
	}
	
	public function findAllForDropDown(){
		$sql = "Select * from classcodes order by classcode ASC";
		$classCodes = self::$dataStore->executeObjectQuery($sql);
		$arr = array();
		foreach ($classCodes as $classCode){
			$code = $classCode->getClassCode();
			$seq = $classCode->getSeq();
			$arr[$seq] = $code;
		}
		return $arr;
	}
	
	public function deleteBySeqs($ids){
		return self::$dataStore->deleteInList($ids);
	}
	
	public function getClassCodesForGrid(){
// 		$query = "select users.fullname,users.qccode,classcodes.* from classcodes left join users on classcodes.userseq = users.seq";
		$query = "select userusers.fullname,qcusers.qccode as qccode,pousers.qccode as poqccode,classcodes.* from classcodes left join users userusers on classcodes.userseq = userusers.seq left join users qcusers on classcodes.qcuser=qcusers.seq left join users pousers on classcodes.poinchargeuser=pousers.seq";
		$sessionUtil = SessionUtil::getInstance();
		$loggedInUserTimeZone = $sessionUtil->getUserLoggedInTimeZone();
		$classCodes = self::$dataStore->executeQuery($query,true);
		$arr = array();
		foreach($classCodes as $classcode){
		    $lastModifiedOn = $classcode["lastmodifiedon"];
		    $lastModifiedOn = DateUtil::convertDateToFormatWithTimeZone($lastModifiedOn, "Y-m-d H:i:s", "Y-m-d H:i:s",$loggedInUserTimeZone);
		    $classcode["lastmodifiedon"] = $lastModifiedOn;
		    array_push($arr,$classcode);	    
		}
		$mainArr["Rows"] = $arr;
		
		$query = "select count(*) from classcodes left join users on classcodes.userseq = users.seq";
		$count = self::$dataStore->executeCountQueryWithSql($query,true);
		$mainArr["TotalRows"] = $count;
		
		return $mainArr;
	}
    	
	public function findByClassCode($classCode){
		$colVal["classcode"] = $classCode;
		$classCode = self::$dataStore->executeConditionQuery($colVal);
		if(!empty($classCode)){
			return $classCode[0];
		}
		return null;
	}
	public function importClassCode($file){
		$classCodeImportUtil = ClassCodeImportUtil::getInstance();
		return $classCodeImportUtil->importClassCodes($file);
	}
	
	public function saveOrUpdateArr($colValuePair,$ommitFieldsWhileUpdateArr){
		$sql = "INSERT INTO classcodes(";
		$inserter = array();
		$conditioner = array();
		$duplicator = array();
		foreach($colValuePair as $key => $value){
			if(!empty($value)){
				array_push($inserter,$key);
			}
		}
		foreach($colValuePair as $key => $value){
			if(!empty($value)){
				if($key == "lastmodifiedon" or $key == "createdon"){
					array_push($conditioner,"'" . $value . "'");
				}else{
				array_push($conditioner,$value);}
			}
		}
		foreach($colValuePair as $key => $value){
			if(!empty($value) and !(in_array($key,$ommitFieldsWhileUpdateArr))){
				if($key == "lastmodifiedon" or $key == "createdon"){
					array_push($dupilcator,$key . "= '" . $value . "'");
				}else{
				array_push($dupilcator,$key . "=" . $value);
			}
			}
		}
		$sql .= implode(",",$inserter) . ") values(" . implode(",",$conditioner) . ") ON DUPLICATE KEY UPDATE " . implode(",",$duplicator);
		$classCode = self::$dataStore->executeQuery($sql);
		return $classCode;

	}
	
	public function getClassCodeSeqs($userSeq,$userRole){
	    $query = null;
	    if($userRole == Permissions::qc){
	        $query = "SELECT seq FROM `classcodes` where qcuser = ".$userSeq;
	    }else{
	        $query = "SELECT seq FROM `classcodes` where poinchargeuser = ".$userSeq;
	    }
	      $classCodeSeqs = self::$dataStore->executeQuery($query,false,true);
	      $seqs = array();
	      foreach($classCodeSeqs as $seq){
	          array_push($seqs,$seq['seq']);
	      }
	      $seqs = implode(",", $seqs);
	      return $seqs; 
	}
}