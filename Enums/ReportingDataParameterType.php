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
    const qc_schedules_final_missing_appointments = "Final Missing Appointments";
    const qc_schedules_middle_missing_appointments = "Middle Missing Appointments";
    const qc_schedules_first_missing_appointments = "First Missing Appointments";
    const qc_schedules_final_incompleted_schedules = "Final Incompleted Schedules";
    const qc_schedules_middle_incompleted_schedules = "Middle Incompleted Schedules";
    const qc_schedules_first_incompleted_schedules = "First Incompleted Schedules";
    const qc_schedules_pending_qc_approvals = "Pending QC Approvals";
    const container_schedules_eta_report_count = "ETA Report";
    const container_schedules_empty_return_date_past_empty_lfd_count = "Empty Return Date Past Empty LFD";
    const container_schedules_pending_schedule_delivery_date_count = "Pending Schedule Delivery Date";
    const container_schedules_missing_terminal_appointment_date_count = "Missing Terminal Appointment Date";
    const container_schedules_empty_alpine_notification_pickup_date_count = "Empty Alpine Notification Pickup Date";
    const container_schedules_missing_confirmed_delivery_date_count = "Missing Confirmed Delivery Date";
    const container_schedules_missing_id_count = "Missing Id";
    const container_schedules_missing_received_dates_in_oms_count = "Missing Received Dates In OMS";
    const container_schedules_missing_received_dates_in_wms_count = "Missing Received Dates In WMS";
    const container_schedules_missing_schedule_delivery_date_count = "Missing Schedule Delivery Date";
    // Instruction Manual Parameters
    const instruction_manual_total_projects_open = "Logs Open";
    const instruction_manual_total_projects_completed = "Logs Completed";
    const instruction_manual_total_projects_overdue = "Logs Overdue";
    const instruction_manual_total_projects_in_supervisor_review = "Logs In Supervisor Review";
    const instruction_manual_total_projects_in_manager_review = "Logs In Manager Review";
    const instruction_manual_total_projects_in_buyer_review = "Logs In Buyer Review";
    const instruction_manual_total_projects_due_today = "Logs Due Today";
    const instruction_manual_total_projects_due_in_next_14_days = "Logs due In Next 14 Days";
    const instruction_manual_total_projects_due_less_than_14_days_from_entry = "Due < 14 Days from Entry";
    const instruction_manual_total_projects_not_started = "Logs Not Started";
}
?>