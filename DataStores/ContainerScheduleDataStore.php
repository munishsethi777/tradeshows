<?php
require_once ("BeanDataStore.php");
require_once ($ConstantsArray['dbServerUrl'] . "BusinessObjects/ContainerSchedule.php");

class ContainerScheduleDataStore extends BeanDataStore
{

    private static $containerScheduleDataStore;
    private static $currentDateInDBFormat;
    private static $select = "select * from containerschedules";
    private static $timeZone = "America/Los_Angeles";
    private static $timeZoneObj;
    public static function getInstance()
    {
        if (! self::$containerScheduleDataStore) {
            self::$containerScheduleDataStore = new ContainerScheduleDataStore(ContainerSchedule::$className, ContainerSchedule::$tableName);
            self::$currentDateInDBFormat = DateUtil::getDateInDBFormat(0,null,self::$timeZone);
            return self::$containerScheduleDataStore;
        }
        return self::$containerScheduleDataStore;
    }
   
    //-------Methods for Reports -------
    
    //ETA Report -- Weekly
    public function getETADatesPendingInNextSevenDays(){
        $currentDate = DateUtil::getDateInDBFormat(0,null,self::$timeZone);
        $currentDateWithInterval = DateUtil::getDateInDBFormat(6,null,self::$timeZone);
        $ETA_DATE_NEXT_SEVEN_DAYS_QUERY = self::$select . " where etadatetime >= '$currentDate' and etadatetime < '$currentDateWithInterval'";
        $containerSchedules = self::$containerScheduleDataStore->executeObjectQuery($ETA_DATE_NEXT_SEVEN_DAYS_QUERY);
        return $containerSchedules;
    }
    
    //Empty Return Date past the “Empty LFD” -- Weekly
    public function getEmptyReturnDatePastEmptyLFD(){
        $currentDate = DateUtil::getDateInDBFormatWithInterval(1,null,true,self::$timeZone);
        $currentDateInterval7Days = DateUtil::getDateInDBFormatWithInterval(7,null,true,self::$timeZone);
        $query = self::$select . " where emptyreturndate >= '$currentDateInterval7Days' and emptyreturndate <= '$currentDate' and emptyreturndate > emptylfddate";
        $containerSchedules = self::$containerScheduleDataStore->executeObjectQuery($query);
        return $containerSchedules;
    }
    
    //Daily Schedule Report - Daily 
    public function getPendingScheduleDeliveryDateForToday(){
        $currentDate = DateUtil::getDateInDBFormat(0,null,self::$timeZone);
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
        $dateIntervalWith2Days = DateUtil::getDateInDBFormatWithInterval(2,null,true,self::$timeZone);
        $currentDate = self::$currentDateInDBFormat;
        $query = self::$select . " where etadatetime > '$dateIntervalWith2Days' AND etadatetime < '$currentDate' and (isidscomplete is null or isidscomplete = 0)";
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
        $query = self::$select . " where confirmeddeliverydatetime is not NULL and (containerreceivedinwmsdate is NULL or (issamplesreceived = 1 and samplesreceivedinwmsdate is NULL))";
        $containerSchedules = self::$containerScheduleDataStore->executeObjectQuery($query);
        return $containerSchedules;
    }
    
    //Empty OMS dates
    public function getMissingReceivedDatesInOMS(){
        $query = self::$select . " where containerreceivedinwmsdate is not NULL and (containerreceivedinomsdate is NULL or (issamplesreceived = 1 and samplesreceivedinomsdate is NULL))";
        $containerSchedules = self::$containerScheduleDataStore->executeObjectQuery($query);
        return $containerSchedules;
    }
    
    //Due Transmodel notification
    public function getDueTransModalForCurrentMonth(){
        $query = "select count(*) from containerschedules
WHERE MONTH(alpinenotificatinpickupdatetime ) = MONTH(CURRENT_DATE())
AND YEAR(alpinenotificatinpickupdatetime ) = YEAR(CURRENT_DATE()) and emptyreturndate > alpinenotificatinpickupdatetime";
        $containerSchedules = self::$containerScheduleDataStore->executeCountQueryWithSql($query);
        return $containerSchedules;
    }
    
    public function getDueTransModalLast7Days(){
        $query = "SELECT count(*) FROM containerschedules
	        WHERE alpinenotificatinpickupdatetime BETWEEN NOW() - INTERVAL 7 DAY AND NOW() and emptyreturndate > alpinenotificatinpickupdatetime";
        $containerSchedules = self::$containerScheduleDataStore->executeCountQueryWithSql($query);
        return $containerSchedules;
    }
    
    public function getDueTransModalForCurrentYear(){
        $query = "select count(*) from containerschedules
WHERE YEAR(alpinenotificatinpickupdatetime ) = YEAR(CURRENT_DATE()) and emptyreturndate > alpinenotificatinpickupdatetime";
        $containerSchedules = self::$containerScheduleDataStore->executeCountQueryWithSql($query);
        return $containerSchedules;
    }
    
    public function getDueTransModalTerminalAppDateForCurrentMonth(){
        $query = "select count(*) from containerschedules
WHERE MONTH(terminalappointmentdatetime ) = MONTH(CURRENT_DATE())
AND YEAR(terminalappointmentdatetime ) = YEAR(CURRENT_DATE()) and scheduleddeliverydatetime > terminalappointmentdatetime";
        $containerSchedules = self::$containerScheduleDataStore->executeCountQueryWithSql($query);
        return $containerSchedules;
    }
    
    public function getDueTransModalTerminalAppDateLast7Days(){
        $query = "SELECT count(*) FROM containerschedules
	        WHERE terminalappointmentdatetime BETWEEN NOW() - INTERVAL 7 DAY AND NOW() and scheduleddeliverydatetime > terminalappointmentdatetime";
        $containerSchedules = self::$containerScheduleDataStore->executeCountQueryWithSql($query);
        return $containerSchedules;
    }
    
    public function getDueTransModalTerminalAppDateForCurrentYear(){
        $query = "select count(*) from containerschedules
WHERE YEAR(terminalappointmentdatetime ) = YEAR(CURRENT_DATE()) and scheduleddeliverydatetime > terminalappointmentdatetime";
        $containerSchedules = self::$containerScheduleDataStore->executeCountQueryWithSql($query);
        return $containerSchedules;
    }
    public function getAllContainerSchedules(){
        $query = "SELECT * from containerschedules";
        $containerSchedules = self::$containerScheduleDataStore->executeQuery($query);
        return $containerSchedules;
    }
    
    
    //-------******************* -------
    
}