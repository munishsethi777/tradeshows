<?php 
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Team.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/TeamMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
$response = new ArrayObject();
$call = "";
$success = 1;
$message = "";
$redirect = "";
if(isset($_GET["call"])){
    $call = $_GET["call"];
}else{
    $call = $_POST["call"];
}
$teamMgr = TeamMgr::getInstance();
$sessionUtil = SessionUtil::getInstance();
$team = new Team();
if($call == "saveTeam"){
    try{
        $message = "Team saved successfully.";
        $team->from_array($_REQUEST);  
        $team->setCreatedby($sessionUtil->getUserLoggedInSeq());
        $team->setCreatedon(new DateTime());
        $team->setLastmodifiedon(new DateTime());
        $userseqs = $_REQUEST['users'];
        if(isset($_REQUEST["isenable"])){
            $team->setIsEnable(1);
        }else {
            $team->setIsEnable(0);
        }
        $teamMgr->saveTeam($team,$userseqs);
        
       }catch(Exception $e){
        $success = 0;
        $message  = $e->getMessage();
    }
}

if($call == "getAllTeam"){ 
    $json = $teamMgr->getTeamsForGrid();
    echo json_encode($json);
     return;   
}

if($call == "deleteTeams"){
    $ids = $_GET["ids"];
    try{
        $flag = $teamMgr->deleteBySeqs($ids);
        $message = "Teams Deleted successfully";
    }catch(Exception $e){
        $success = 0;
        $message = $e->getMessage();
        if(strpos($message,"delete_team") !== false){
            $message = "Teams cannot be deleted because it is already in use !";
        }
    }
    
}

$response["success"] = $success;
$response["message"] = $message;
$response["url"] = $redirect;
echo json_encode($response);
return;

?>