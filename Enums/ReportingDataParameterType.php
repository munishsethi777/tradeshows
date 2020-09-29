<?php 
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class ReportingDataParameterType extends BasicEnum{
    const graphiclog_projects_completed_count = "Graphic Log Projects Completed Count";
    const graphiclog_projects_over_due_till_now_count = "Graphic Log Projects Over Due Till Now Count";
    const graphiclog_projects_in_buyer_review_count = "Graphic Log Projects In Buyer Review Count";
    const graphiclog_projects_in_manager_review_count = "Graphic Log Projects In Manager Review Count";
    const graphiclog_projects_in_robby_review_count = "Graphic Log Projects In Robby Review Count";
    const graphiclog_project_missing_info_from_china_count = "Graphic Log Project Missing Info From China Count";
    const graphiclog_project_passed_due_with_missing_info_from_china_count = "Graphic Log Project Passed Due With Missing Info From China Count";
    const graphiclog_project_due_for_today_count = "Graphic Log Project Due For Today Count";
    const graphiclog_project_due_less_than_20_days_from_entry_date_count = "Graphic Log Project Due Less Than 20 Days From Entry Date Count";
    const graphiclog_project_due_less_than_20_days_from_today_count = "Graphic Log Project Due less Than 20 Days From Today Count";
}
?>