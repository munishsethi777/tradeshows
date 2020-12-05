<?php 
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class ReportingDataMethodNames extends BasicEnum{
    const graphiclog_projects_completed_count = "getProjectsCompletedCount";
    const graphiclog_projects_over_due_till_now_count = "getProjectsOverDueTillNowCount";
    const graphiclog_projects_in_buyer_review_count = "getProjectsInBuyerReviewCount";
    const graphiclog_projects_in_manager_review_count = "getProjectsInManagerReviewCount";
    const graphiclog_projects_in_robby_review_count = "getProjectsInRobbyReviewCount";
    const graphiclog_project_missing_info_from_china_count = "getProjectMissingInfoFromChinaCount";
    const graphiclog_project_passed_due_with_missing_info_from_china_count = "getProjectPassedDueWithMissingInfoFromChinaCount";
    const graphiclog_project_due_for_today_count = "getProjectsDueForTodayCount";
    const graphiclog_project_due_less_than_20_days_from_entry_date_count = "getProjectDueLessThan20DaysFromEntryDateCount";
    const graphiclog_project_due_less_than_20_days_from_today_count = "getProjectDueLessThan20DaysFromTodayCount";
    const qc_schedules_final_missing_appointments = "getMissingAppoitmentForFinalInspectionDate";
    const qc_schedules_middle_missing_appointments = "getMissingAppoitmentForMiddleInspectionDate";
    const qc_schedules_first_missing_appointments = "getMissingAppoitmentForFirstInspectionDate";
    const qc_schedules_final_incompleted_schedules = "getMissingActualFinalInspectionDate";
    const qc_schedules_middle_incompleted_schedules = "getMissingActualMiddleInspectionDate";
    const qc_schedules_first_incompleted_schedules = "getMissingActualFirstInspectionDate";
    const qc_schedules_pending_qc_approvals = "getPendingQcForApprovals";
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
    // Instruction Manual Cron Methods
    const instruction_manual_total_projects_open = "getInstructionManualProjectsOpenCount";
    const instruction_manual_total_projects_completed = "getInstructionManualProjectsCompletedCount";
    const instruction_manual_total_projects_overdue = "getInstructionManualProjectsOverdueCount";
    const instruction_manual_total_projects_in_supervisor_review = "getInstructionManualProjectsInSupervisorReviewCount";
    const instruction_manual_total_projects_in_manager_review = "getInstructionManualProjectsInManagerReviewCount";
    const instruction_manual_total_projects_in_buyer_review = "getInstructionManualProjectsInBuyerReviewCount";
    const instruction_manual_total_projects_due_today = "getInstructionManualProjectsDueToday";
    const instruction_manual_total_projects_due_in_next_14_days = "getInstructionManualProjectsDueInNext14Days";
    const instruction_manual_total_projects_due_less_than_14_days_from_entry = "getInstructionManualProjectsDueLessThan14DaysFromEntry";
    const instruction_manual_total_projects_not_started = "getInstructionManualProjectsNotStarted";    
}
?>