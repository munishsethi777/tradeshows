<?php 
    require_once('../IConstants.inc');
    require_once($ConstantsArray['dbServerUrl'] . "Managers/UserConfigurationMgr.php");
    require_once($ConstantsArray['dbServerUrl'] . "BusinessObjects/UserConfiguration.php");
    require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
    require_once($ConstantsArray['dbServerUrl'] ."Enums/UserConfigurationType.php");

    $success=1;
    $message='';
    $call = "";
    $response = new ArrayObject();
    $arr = array();  
    $sessionUtil = SessionUtil::getInstance();
    $userConfiguration = new UserConfiguration();
    $userConfigurationMgr = UserConfigurationMgr::getInstance();
    if(isset($_GET['call'])){
        $call = $_GET['call'];
    }else{
        $call = $_POST['call'];
    }
    if($call == 'setConfiguration'){
        try{
            $arr = array();
            $userSeq = $sessionUtil->getUserLoggedInSeq();
            $configKey = $_REQUEST['userConfigKey'];
            $configValue = $_REQUEST['userConfigValue'] == null || 
                            $_REQUEST['userConfigValue'] == '0' ? '1' : '0';
            $userConfigurationMgr->setConfiguration($userSeq, $configKey, $configValue);
            $arr['configvalue'] = $configValue;
            $response['data'] = $arr;
        }catch(Exception $e){
            $success = 0;
		    $message  = $e->getMessage();
        }
    }
    if($call == 'getConfiguration'){
        try{
        }catch(Exception $e){
            $success = 0;
		    $message  = $e->getMessage();
        }
    }
    $response['success'] = $success;
    $response['message'] = $message;
    echo json_encode($response);
?>
