<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/BasicEnum.php");
class EmailLogType extends BasicEnum{  
    const QC_UPCOMING_INSPECTION_SCHEDULE       = "UpcomingInspectionSchedule";
    const QC_UPCOMING_INSPECTION       = "UpcomingInspections";
    const QC_UPCOMING_INSPECTION_APPOINTMENT    = "UpcomingInspectionAppointment";
    const QC_MISSING_APPOINTMENT_NOTIFICATION   = "MissingAppoitment";
    const QC_INCOMPLETED_SCHEDULES_NOTIFICATION = "LateInspectionReport";
    const GRAPHIC_APPROVAL                      = "GraphicApproval";
    const SV_UPCOMING_INSPECTION_SCHEDULE       = "SvUpcomingInspectionSchedule";
    const SV_UPCOMING_INSPECTION_APPOINTMENT    = "SvUpcomingInspectionAppointment";
    const SV_MISSING_APPOINTMENT_NOTIFICATION   = "SvMissingAppointmentNotification";
    const SV_INCOMPLETED_SCHEDULES_NOTIFICATION = "SvIncompletedSchedulesNotification";
    const QC_SCHEDULE_FOR_PLAN_REPORT           = "QcScheduleForPlanReport";
    const PENDING_QC_APPROVAL                   = "PendingQcApproval";
    const CONTAINER_SCHEDULE_DATE_CHANGE_NOTIFICATION =  "ContainerScheduleDateChangeNotification";
    const CONTAINER_SCHEDULE_EMPTY_RETURN_DATE =  "ContainerScheduleEmptyReturnDatePastEmptyLFDReport";
    const CONTAINER_SCHEDULE_PENDING_EMPTY_ALPINE_NOTIFICATION_PICKUP_DATE= "ContainerScheduleEmptyAlpineNotificationPickupDate";
    const CONTAINER_SCHEDULE_MISSING_IDS = "ContainerScheduleMissingIDReport";
    const CONTAINER_SCHEDULE_MISSING_TERMINAL_APPT_DATE = "ContainerScheduleMissingTerminalAppointmentDateReport";
    const CONTAINER_SCHEDULE_MISSING_SCHEDULE_DELIVERY_DATE = "ContainerScheduleMissingScheduleDeliveryDateReport";
    const CONTAINER_SCHEDULE_MISSING_CONFIRM_DELIVERY_DATE = "ContainerScheduleMissingConfirmDeliveryDateReport";
    const CONTAINER_SCHEDULE_MISSING_RECEIVED_DATE_WMS = "ContainerScheduleMissingReceivedDatesInWMSReport";
    const CONTAINER_SCHEDULE_MISSING_RECEIVED_DATE_OMS = "ContainerScheduleMissingReceivedDatesInOMSReport";
    const CONTAINER_SCHEDULE_ETA_REPORT = "ContainerScheduleETAReport";
    const CONTAINER_SCHEDULE_PENDING_SCHEDULE_DELIVERY_DATE = "ContainerSchedulePendingSchedleDeliveryDate";
    const GRAPHIC_LOG_NOTES_UPDATED = "GraphicLogNotesUpdated";
    const QC_APPROVED_REJECT_NOTIFICATION = "QCApprovedRejectNotification";
}