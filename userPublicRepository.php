<?include("SessionCheckUser.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ShowMgr.php");

$session = SessionUtil::getInstance();
$userSeq = $session->getUserLoggedInSeq();
$showMgr = ShowMgr::getInstance();
$shows = $showMgr->getUpcomingShowsByUser($userSeq);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User | Upcoming Tasks Management</title>
    <?include "ScriptsInclude.php"?>
</head>
<body>
<div id="wrapper">
<?php include("usermenuinclude.php")?>
<?php include("includePublicRepository.php")?>  
</div>
