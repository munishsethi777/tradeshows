<?php
require_once ("BeanDataStore.php");
require_once ($ConstantsArray['dbServerUrl'] . "BusinessObjects/ContainerSchedule.php");

class ContainerScheduleDataStore extends BeanDataStore
{

    private static $containerScheduleDataStore;
    private static $currentDateInDBFormat;
    private static $select = "select * from containerschedules";

    public static function getInstance()
    {
        if (! self::$containerScheduleDataStore) {
            self::$containerScheduleDataStore = new ContainerScheduleDataStore(ContainerSchedule::$className, ContainerSchedule::$tableName);
            self::$currentDateInDBFormat = DateUtil::getDateInDBFormat();
            return self::$containerScheduleDataStore;
        }
        return self::$containerScheduleDataStore;
    }
   
    //-------Methods for Reports -------
    
    //ETA Report -- Weekly
    public function getETADatesPendingInNextSevenDays(){
        $currentDate = DateUtil::getDateInDBFormat();
        $currentDateWithInterval = DateUtil::getDateInDBFormat(7);
        $ETA_DATE_NEXT_SEVEN_DAYS_QUERY = self::$select . " where etadatetime >= '$currentDate' and etadatetime < '$currentDateWithInterval'";
        $containerSchedules = self::$containerScheduleDataStore->executeObjectQuery($ETA_DATE_NEXT_SEVEN_DAYS_QUERY);
        return $containerSchedules;
    }
    
    //Empty Return Date past the “Empty LFD” -- Weekly
    public function getEmptyReturnDatePastEmptyLFD(){
        $currentDate = DateUtil::getDateInDBFormat();
        $currentDateInterval7Days = DateUtil::getDateInDBFormatWithInterval(7,null,true);
        $query = self::$select . " where emptyreturndate >= '$currentDateInterval7Days' and emptyreturndate < '$currentDate' and emptyreturndate < emptylfddate";
        $containerSchedules = self::$containerScheduleDataStore->executeObjectQuery($query);
        return $containerSchedules;
    }
    
    //Daily Schedule Report - Daily 
    public function getPendingScheduleDeliveryDateForToday(){
        $currentDate = DateUtil::getDateInDBFormat();
        $query = self::$select . " where Date_format(scheduleddeliverydatetime, '%Y-%m-%d') = '$currentDate'";
        $containerSchedules = self::$containerScheduleDataStore->executeObjectQuery($query);
        return $containerSchedules;
    }
    
    //Schedules which no “Alpine Notification Pickup date” -- Daily
    public function getMissingAlpineNotificationDate()
    {
        $currentDate = self::$currentDateInDBFormat;
        $MISSING_ALPINE_NOTIFICATION_DATE_QUERY = self::$select . " where scheduleddeliverydatetime < '$currentDate' and alpinenotificatinpickupdatetime is NULL";
        $containerSchedules = self::$containerScheduleDataStore->executeObjectQuery($MISSING_ALPINE_NOTIFICATION_DATE_QUERY);
        return $containerSchedules;
    }
    
    //Missing IDs Report - Daily
    public function getMissingIDReport(){
        $dateIntervalWith2Days = DateUtil::getDateInDBFormatWithInterval(2,null,true);
        $query = self::$select . " where etadatetime < '$dateIntervalWith2Days' and (isidscomplete is null or isidscomplete = 0)";
        $containerSchedules = self::$containerScheduleDataStore->executeObjectQuery($query);
        return $containerSchedules;
    }
    
    //Missing Terminal Appt date - Daily
    public function getMissingTerminalAppointmentDate()
    {
        $MISSING_TERMINAL_APPOINTMENT_DATE_QUERY = self::$select . " where lfdpickupdate is not NULL and terminalappointmentdatetime is NULL";
        $containerSchedules = self::$containerScheduleDataStore->executeObjectQuery($MISSING_TERMINAL_APPOINTMENT_DATE_QUERY);
        return $containerSchedules;
    }
    
    //Missing Scheduled Delivery - Daily
    public function getMissingScheduleDeliveryDate()
    {
        $MISSING_SCHEDULE_DELIVERY_DATE_QUERY = self::$select . " where terminalappointmentdatetime is not NULL and scheduleddeliverydatetime is NULL";
        $containerSchedules = self::$containerScheduleDataStore->executeObjectQuery($MISSING_SCHEDULE_DELIVERY_DATE_QUERY);
        return $containerSchedules;
    }
    
    //No Confirmation Report - Daily
    public function getMissingConfirmDeliveryDate()
    {
        $currentDate = self::$currentDateInDBFormat;
        $MISSING_SCHEDULE_DELIVERY_DATE_QUERY = self::$select . " where Date_format(scheduleddeliverydatetime, '%Y-%m-%d') = '$currentDate' and confirmeddeliverydatetime is NULL";
        $containerSchedules = self::$containerScheduleDataStore->executeObjectQuery($MISSING_SCHEDULE_DELIVERY_DATE_QUERY);
        return $containerSchedules;
    }
    
//     public function getMissingAlpineNotificationDateForConfirmDelivery() 
//     {
//         $MISSING_ALPINE_NOTIFICATION_DATE_QUERY = self::$select . " where confirmeddeliverydatetime is not NULL and alpinenotificatinpickupdatetime is NULL";
//         $containerSchedules = self::$containerScheduleDataStore->executeObjectQuery($MISSING_ALPINE_NOTIFICATION_DATE_QUERY);
//         return $containerSchedules;
//     }
    //Empty WMS dates
    public function getMissingReceivedDatesInWMS(){
        $query = self::$select . " where confirmeddeliverydatetime is not NULL and (msrfcreateddate is NULL or (issamplesreceived = 1 and samplesreceiveddate is NULL))";
        $containerSchedules = self::$containerScheduleDataStore->executeObjectQuery($query);
        return $containerSchedules;
    }
    
    //Empty OMS dates
    public function getMissingReceivedDatesInOMS(){
        $query = self::$select . " where containerreceivedinwmsdate is not NULL and (containerreceivedinomsdate is NULL or (issamplesreceived = 1 and samplesreceivedinomsdate is NULL))";
        $containerSchedules = self::$containerScheduleDataStore->executeObjectQuery($query);
        return $containerSchedules;
    }
    
    //-------******************* -------
    
}