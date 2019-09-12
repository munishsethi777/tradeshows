<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class EmailLogType extends BasicEnum{  
    const QC_UPCOMING_INSPECTION_SCHEDULE       = "UpcomingInspectionSchedule";  
    const QC_UPCOMING_INSPECTION_APPOINTMENT    = "UpcomingInspectionAppointment";
    const QC_MISSING_APPOINTMENT_NOTIFICATION   = "MissingAppoitment";
    const QC_INCOMPLETED_SCHEDULES_NOTIFICATION = "IncompletedSchedules";
    const GRAPHIC_APPROVAL                      = "GraphicApproval";
    const SV_UPCOMING_INSPECTION_SCHEDULE       = "SvUpcomingInspectionSchedule";
    const SV_UPCOMING_INSPECTION_APPOINTMENT    = "SvUpcomingInspectionAppointment";
    const SV_MISSING_APPOINTMENT_NOTIFICATION   = "SvMissingAppointmentNotification";
    const SV_INCOMPLETED_SCHEDULES_NOTIFICATION = "SvIncompletedSchedulesNotification";
    const QC_SCHEDULE_FOR_PLAN_REPORT           = "QcScheduleForPlanReport";
    const PENDING_QC_APPROVAL                   = "PendingQcApproval";
    const CONTAINER_SCHEDULE_DATE_CHANGE_NOTIFICATION =  "ContainerScheduleDateChangeNotification";
     
}