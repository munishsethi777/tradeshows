<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class QCScheduleNotificationType extends BasicEnum{
    const upcoming_inspections_report_weekly = "Upcoming Inspections Report (Weekly)";
    const missing_appointments_report_weekly = "Missing Appointments Report (Weekly)";
    const incompleted_schedules_report_weekly = "Incompleted Schedules Report (Weekly)";
    const pending_qc_approval_report_weekly = "Pending QC Approval Report (Weekly)";
    const qc_planner_report_weekly = "QC Planner Report (Weelky)";
    const qc_approved_rejected_instant = "QC Approved/Rejected (Instant)";
    const qc_bulk_update_log = "QC Bulk Update log (Instant)";
    const qc_rejected_notification_weekly = "QC Rejected Notification (Weekly)";
}