<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class GraphicLogsNotificationType extends BasicEnum{
    const projects_completed_last_week_weekly = "Projects Completed Last Week (Weekly)";
    const projects_over_due_till_now_weekly = "Projects Over Due till now (Weekly)";
    const projects_in_buyer_review_weekly = "Projects In Buyer Review (Weekly)";
    const projects_in_manager_review_weekly = "Projects In Manager Review (Weekly)";
    const projects_in_robby_review_weekly = "Projects In Robby Review (Weekly)";
    const projects_missing_info_from_china_weekly = "Projects Missing Info From China (Weekly)";
    const project_passed_due_with_missing_info_from_china_daily = "Project Passed Due with Missing Info From China (Daily)";
    const projects_due_for_today_daily = "Project Due for Today (Daily)";
    const projects_due_less_than_20_days_from_entry_date_daily = "Proects Due less than 20 days from entry date (Daily)";
    const projects_due_less_than_20_days_from_today_daily = "Projects Due Less than 20 days from today (Daily)";
    const projects_missing_info_from_china_daily = "Projects Missing Info from China (Daily)";
    const graphic_logs_status_change_instant = "Graphic Logs Status change (Instant)";
    const graphic_logs_notes_update_instant = "Graphic Logs Notes Update (Instant)";
    const final_graphics_due_date_changed_instant = "Final Graphics Due Date Changed (Instant)";
}