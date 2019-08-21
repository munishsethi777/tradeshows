<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/QCScheduleMgr.php");
try{
    $qcScheduleMgr = QCScheduleMgr::getInstance();
    $qcScheduleMgr->exportQCPlannerReport(true);
}catch(Exception $e){
    echo $e->getMessage();
}