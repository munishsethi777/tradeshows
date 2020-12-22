<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class UserConfigurationType extends BasicEnum{
    const AnalyticsIMDivExpanded = "Analytics IM Div Expanded";
    const AnalyticsQCDivExpanded = "Analytics QC Div Expanded";
    const AnalyticsGraphicsDivExpanded = "Analytics Graphics Div Expanded";
    const AnalyticsContainersDivExpanded = "Analytics Containers Div Expanded";
}