<?include("SessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ShowMgr.php");

$showMgr = ShowMgr::getInstance();
$shows = $showMgr->getAllShows();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Public Files Repository</title>
    <?include "ScriptsInclude.php"?>
</head>
<body>
<div id="wrapper">
<?php include("adminmenuInclude.php")?>
<?php include("includePublicRepository.php")?>  
</div>