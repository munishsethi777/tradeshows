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
    const QC_BULK_UPDATE_NOTIFICATION = "QCBulkUpdateNotification";
    const CONTAINER_SCHEDULE_DATE_CHANGE_NOTIFICATION =  "ContainerScheduleDateChangeNotification";
    const CONTAINER_SCHEDULE_EMPTY_RETURN_DATE =  "ContainerScheduleEmptyReturnDatePastEmptyLFDReport";
    const CONTAINER_SCHEDULE_EMPTY_WAREHOUSE_UPDATED = "ContainerScheduleEmptyWarehouse";
    const CONTAINER_SCHEDULE_PENDING_EMPTY_ALPINE_NOTIFICATION_PICKUP_DATE= "ContainerScheduleEmptyAlpineNotificationPickupDate";
    const CONTAINER_SCHEDULE_MISSING_IDS = "ContainerScheduleMissingIDReport";
    const CONTAINER_SCHEDULE_MISSING_TERMINAL_APPT_DATE = "ContainerScheduleMissingTerminalAppointmentDateReport";
    const CONTAINER_SCHEDULE_MISSING_SCHEDULE_DELIVERY_DATE = "ContainerScheduleMissingScheduleDeliveryDateReport";
    const CONTAINER_SCHEDULE_MISSING_CONFIRM_DELIVERY_DATE = "ContainerScheduleMissingConfirmDeliveryDateReport";
    const CONTAINER_SCHEDULE_MISSING_RECEIVED_DATE_WMS = "ContainerScheduleMissingReceivedDatesInWMSReport";
    const CONTAINER_SCHEDULE_MISSING_RECEIVED_DATE_OMS = "ContainerScheduleMissingReceivedDatesInOMSReport";
    const CONTAINER_SCHEDULE_ETA_REPORT = "ContainerScheduleETAReport";
    const CONTAINER_SCHEDULE_PENDING_SCHEDULE_DELIVERY_DATE = "ContainerSchedulePendingSchedleDeliveryDate";
    const CONTAINER_SCHEDULE_ETA_NOTES_UPDATED = "ContainerScheduleETANotesUpdated";
    const CONTAINER_SCHEDULE_EMPTY_RETURN_NOTES_UPDATED = "ContainerScheduleEmtyReturnNotesUpdated";
    const CONTAINER_SCHEDULE_ALPINE_NOTES_UPDATED = "ContainerScheduleAlpineNotesUpdated";
    const CONTAINER_SCHEDULE_WAREHOUSE_UPDATED = "ContainerScheduleWarehouseUpdated";

    const GRAPHIC_LOG_NOTES_UPDATED = "GraphicLogNotesUpdated";
    const QC_APPROVED_REJECT_NOTIFICATION = "QCApprovedRejectNotification";
    const CONTAINER_SCHEDULE_CHANGE_TERMINAL_APPOINTMENT_DATE = "ContainerScheduleChangeTerminalAppointmentDate";
    const CONTAINER_SCHEDULE_CHANGE_REQUESTED_DELIVERY_DATE = "ContainerScheduleChangeRequestedDeliveryDate";
    
    const CONTAINER_SCHEDULE_CHARGE_BACK_ = "ContainerScheduleFinancialImpactToTransmodel";
    
    const GRAPHIC_LOG_PROJECT_DUE_REPORT =  "GraphicLogProjectDueReport";
    const GRAPHIC_LOG_PROJECT_OVERDUE_REPORT =  "GraphicLogProjectOverDueReport";
    const GRAPHIC_LOG_PROJECT_COMPLETED_LAST_WEEK_REPORT =  "GraphicLogProjectCompletedLastWeek";
    const GRAPHIC_LOG_PROJECT_IN_BUYER_REVIEW =  "GraphicLogProjectInBuyerReview";
    const GRAPHIC_LOG_PROJECT_IN_ROBBY_REVIEW =  "GraphicLogProjectInRobbyReview";
    const GRAPHIC_LOG_PROJECT_IN_MANAGER_REVIEW =  "GraphicLogProjectInManagerReview";
    const GRAPHIC_LOG_PROJECT_MISSING_INFO_FROM_CHINA =  "GraphicLogProjectMissingInfoFromChina";
    const GRAPHIC_LOG_PROJECT_DUE_FOR_TODAY_REPORT =  "GraphicLogProjectDueForTodayReport";
    const GRAPHIC_LOG_PROJECT_DUE_FOR_LESS_THAN_20_DAYS_REPORT =  "GraphicLogProjectDueLessThan20FromEntryDate";
    const GRAPHIC_LOG_PROJECT_DUE_FOR_LESS_THAN_20_DAYS_FROM_TODAY =  "GraphicLogProjectDueLessThan20FromToday";
    const GRAPHIC_LOG_PROJECT_MISSING_INFO_FROM_CHINA_DAILY =  "GraphicLogProjectMissingInfoFromChinaDaily";
    const GRAPHIC_LOG_PROJECT_PAST_DUE_WITH_MISSING_INFO_FROM_CHINA =  "GraphicLogProjectPastDueWithMissingInfoFromChina";
}