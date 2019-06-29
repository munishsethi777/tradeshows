<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/ClassCodeMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
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
		$message = "Class Code saved successfully.";
		$classCode = new ClassCode();
		$classCode->createFromRequest($_REQUEST);
		if(!empty($classCode->getSeq())){
			$message = "Class Code updated successfully.";
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
			$message = "Class code already exists !";
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
	try{
		$flag = $classCodeMgr->deleteBySeqs($ids);
		$message = "Class Codes Deleted successfully";
	}catch(Exception $e){
		$success = 0;
		$message = $e->getMessage();
		if(strpos($message,"delete_code") !== false){
			$message = "Class code cannot be deleted because it is already in use !";
		}
	}
}
$response["success"] = $success;
$response["message"] = $message;
echo json_encode($response);
return;
?>