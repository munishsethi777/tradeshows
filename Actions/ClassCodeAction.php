<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/ClassCodeMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/QCScheduleMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");
$success = 1;
$message ="";
$call = "";
$response = new ArrayObject();
if(isset($_GET["call"])){
	$call = $_GET["call"];
}else{
	$call = $_POST["call"];
}
$classCodeMgr = ClassCodeMgr::getInstance();
$sessionUtil = SessionUtil::getInstance();
if($call == "saveClassCode"){
	try{
	    $message = StringConstants::CLASS_CODE_SAVED_SUCCESSFULLY;  
		$classCode = new ClassCode();
		$classCode->createFromRequest($_REQUEST);
		if(!empty($classCode->getSeq())){
		    $message = StringConstants::CLASS_CODE_UPDATE_SUCCESSFULLY; 
		}
		$classCode->setUserSeq($sessionUtil->getUserLoggedInSeq());
		if(isset($_REQUEST["isenabled"])){
			$classCode->setIsEnabled(1);
		}else {
			$classCode->setIsEnabled(0);
		}
		$classCode->setCreatedOn(new DateTime());
		$classCode->setLastModifiedOn(new DateTime());
		$id = $classCodeMgr->saveCode($classCode);
	}catch(Exception $e){
		$success = 0;
		$message  = $e->getMessage();
		if(strpos($message,"Duplicate entry") !== false){
		    $message = StringConstants::CLASS_CODE_ALREADY_EXISTS; 
		}
		
	}
}
if($call == "getClassCodes"){
	$json = $classCodeMgr->getClassCodesForGrid();
	echo json_encode($json);
	return;
}
if($call == "deleteClassCode"){
	$ids = $_GET["ids"];
	$ids = explode(",",$ids);
	$failed_id = array();
	foreach($ids as $id){
		try{
			$qcScheduleMgr = QCScheduleMgr::getInstance();
			$flag = $classCodeMgr->deleteBySeqs($id);
			if(count($failed_id) == 0){
				$message = StringConstants::CLASS_CODE_DELETED_SUCCESSFULLY;
			} 
		}catch(Exception $e){
			$success = 0;
			$object = $classCodeMgr->findBySeq($id);
			$failed_id[] = $object->getClassCode();
			$message = "Failed to delete";
			if(strpos($message,"delete_code") !== false){
				$message = StringConstants::CLASS_CODE_CANNOT_DELETED;
			}
		}
	}
	if(!(count($failed_id) ==0)){
		$message = implode(',',$failed_id) . " " . $message;
	}
}
if($call == "importClassCode"){
	if(isset($_FILES["file"])){
		$response = $classCodeMgr->importClassCode($_FILES["file"]);
		echo json_encode($response);
		return;
	}
}
$response["success"] = $success;

$response["message"] = $message;
echo json_encode($response);
return;
?>