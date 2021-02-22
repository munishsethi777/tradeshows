<?php 
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class ReportingDataMethodNames extends BasicEnum{
    // Graphiclog Cron Enums 
    const graphiclog_all_count = "getGraphiclogAll";
    const graphiclog_projects_completed_count = "getProjectsCompleted";
    const graphiclog_projects_over_due_till_now_count = "getProjectsOverDueTillNow";
    const graphiclog_projects_in_buyer_review_count = "getProjectsInBuyerReview";
    const graphiclog_projects_in_manager_review_count = "getProjectsInManagerReview";
    const graphiclog_projects_in_robby_review_count = "getProjectsInRobbyReview";
    const graphiclog_project_missing_info_from_china_count = "getProjectMissingInfoFromChina";
    const graphiclog_project_passed_due_with_missing_info_from_china_count = "getProjectPassedDueWithMissingInfoFromChina";
    const graphiclog_project_due_for_today_count = "getProjectsDueForToday";
    const graphiclog_project_due_less_than_20_days_from_entry_date_count = "getProjectDueLessThan20DaysFromEntryDate";
    const graphiclog_project_due_less_than_20_days_from_today_count = "getProjectDueLessThan20DaysFromToday";
    // Graphiclog Cron Enums Ends here---------
    // Qc Schedules Cron Enums
    const qc_schedules_all_count = "getAllQcSchedules";
    const qc_schedules_final_missing_appointments = "getAllMissingAppoitmentForFinalInspectionDate";
    const qc_schedules_middle_missing_appointments = "getAllMissingAppoitmentForMiddleInspectionDate";
    const qc_schedules_first_missing_appointments = "getAllMissingAppoitmentForFirstInspectionDate";
    const qc_schedules_final_incompleted_schedules = "getAllMissingActualFinalInspectionDate";
    const qc_schedules_middle_incompleted_schedules = "getAllMissingActualMiddleInspectionDate";
    const qc_schedules_first_incompleted_schedules = "getAllMissingActualFirstInspectionDate";
    const qc_schedules_pending_qc_approvals = "getAllPendingQcForApprovals";
    // Qc Schedules Cron Enums Ends here
    // Container Schedules Cron Methods Enum --------------
    const container_schedules_all_count = "getAllContainerSchedules";
    const container_schedules_eta_report_count = "getETADatesPendingInNextSevenDays";
    const container_schedules_empty_return_date_past_empty_lfd_count = "getEmptyReturnDatePastEmptyLFD";
    const container_schedules_pending_schedule_delivery_date_count = "getPendingScheduleDeliveryDateForToday";
    const container_schedules_missing_terminal_appointment_date_count = "getMissingTerminalAppointmentDate";
    const container_schedules_empty_alpine_notification_pickup_date_count = "getMissingAlpineNotificationDate";
    const container_schedules_missing_confirmed_delivery_date_count = "getMissingConfirmDeliveryDate";
    const container_schedules_missing_id_count = "getMissingIDReport";
    const container_schedules_missing_received_dates_in_oms_count = "getMissingReceivedDatesInOMS";
    const container_schedules_missing_received_dates_in_wms_count = "getMissingReceivedDatesInWMS";
    const container_schedules_missing_schedule_delivery_date_count = "getMissingScheduleDeliveryDate";
    // Container Schedules Cron Methods Enum ends here --------------
    // Instruction Manual Cron Methods Enum
    const instruction_manual_all_count = "getAllLogs";
    const instruction_manual_total_projects_open = "getAllOpenLogs";
    const instruction_manual_total_projects_completed = "getAllCompleteLogs";
    const instruction_manual_total_projects_overdue = "getAllOverDueLogs";
    const instruction_manual_total_projects_in_supervisor_review = "getAllSupervisorReviewLogs";
    const instruction_manual_total_projects_in_manager_review = "getAllManagerReviewLogs";
    const instruction_manual_total_projects_in_buyer_review = "getAllBuyerReviewLogs";
    const instruction_manual_total_projects_due_today = "getAllDueTodayLogs";
    const instruction_manual_total_projects_due_in_next_14_days = "getAllDueInNext14DaysLogs";
    const instruction_manual_total_projects_due_less_than_14_days_from_entry = "getAllDueLessThan14DaysFromEntryLogs";
    const instruction_manual_total_projects_not_started = "getAllNotStartedLogs";
    // Instruction Manual Cron Methods ends here--------------------
}
?>