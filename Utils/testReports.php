<?php
require_once('../IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Utils/GraphicLogReportUtil.php");
//GraphicLogReportUtil::sendProjectsDueForWeekReport();
//GraphicLogReportUtil::sendProjectsOverDueTillNow();
//GraphicLogReportUtil::sendProjectsCompletedLastWeek();
//GraphicLogReportUtil::sendProjectsInBuyerReview();
//GraphicLogReportUtil::sendProjectsInManagerReview();
//GraphicLogReportUtil::sendProjectsInRobbyReview();
//GraphicLogReportUtil::sendProjectsMissingInfoFromChina(true);
//GraphicLogReportUtil::sendProjectsMissingInfoFromChina();
//GraphicLogReportUtil::sendProjectsPastDueWithMissingInfoFromChina();
//GraphicLogReportUtil::sendProjectsDueForToday();
//GraphicLogReportUtil::sendProjectsDueLessThan20DaysFromEntryDate();
GraphicLogReportUtil::sendProjectsDueLessThan20DaysFromToday();