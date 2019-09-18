<?php
class Configuration{
	private $configkey,$configvalue,$seq;
	
	public static $SMTP_USERNAME = "smtpusername";
	public static $SMTP_PASSWORD = "smtppassword";
	public static $SMTP_HOST = "smtphost";
	public static $CRON_PENDING_QC_APPROVAL_LAST_EXE = "cronPendingQCApprovalLastExecution";
	public static $PENDING_QCSCHEDULE_CRON_LAST_EXE = "pendingQCScheduleCronLastExecution";
	public static $CRON_SEND_QC_PLANNER_REPORT_LAST_EXE = "cronSendQcPlannerReportLastExecution";
	public static $CRON_BACKUP_LAST_EXE = "backupsLastExecution";
	public static $CRON_BEGINNING_WEEKLY_LAST_EXE = "cronBeginningWeeklyReportLastExecution";
	public static $CRON_BEGINNING_DAILY_LAST_EXE = "cronBeginningDailyReportLastExecution";
	public static $CRON_END_WEEKLY_LAST_EXE = "cronEndWeeklyReportLastExecution";
	public static $CRON_END_DAILY_LAST_EXE = "cronEndDailyReportLastExecution";
	
	public static $QC_IMPORT_UPDATE_PASSWORD = "qcimportpassword";
	
	public static $tableName = "configurations";
	public static $className = "configuration";
	
	public function setSeq($seq_){
	    $this->seq = $seq_;
	}
	public function getSeq(){
	    return $this->seq;
	}
	public function setConfigKey($configKey){
		$this->configkey = $configKey;
	}
	public function getConfigKey(){
		return $this->configkey;
	}

	public function setConfigValue($configValue){
		$this->configvalue = $configValue;
	}
	public function getConfigValue(){
		return $this->configvalue;
	}
}