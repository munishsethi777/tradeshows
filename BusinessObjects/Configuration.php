<?php
class Configuration{
	private $configkey,$configvalue;
	
	public static $SMTP_USERNAME = "smtpusername";
	public static $SMTP_PASSWORD = "smtppassword";
	public static $SMTP_HOST = "smtphost";
	
	public static $tableName = "configurations";
	public static $className = "configuration";
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