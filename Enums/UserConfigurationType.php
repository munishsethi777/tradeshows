<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class UserConfigurationType extends BasicEnum{
    const AnalyticsIMDivExpanded = "AnalyticsIMDivExpanded";
    const IMDefaultFilterSelection = "IMDefaultFilterSelection";
    const AnalyticsQCDivExpanded = "AnalyticsQCDivExpanded";
    const AnalyticsGraphicsDivExpanded = "AnalyticsGraphicsDivExpanded";
    const AnalyticsContainersDivExpanded = "AnalyticsContainersDivExpanded";
}