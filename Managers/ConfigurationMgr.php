<?php
require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/Configuration.php");
require_once($ConstantsArray['dbServerUrl']. "DataStores/BeanDataStore.php");
class ConfigurationMgr{
		private static $configurationMgr;
		private static $configurationDataStore;
		
		
		public static function getInstance(){
			if (!self::$configurationMgr){
				self::$configurationMgr = new ConfigurationMgr();
				self::$configurationDataStore = new BeanDataStore(Configuration::$className,Configuration::$tableName);
			}
			return self::$configurationMgr;
		}
		
		public function saveConfiguration($configKey,$configValue){
		    $existingConfiguration = $this->getConfigurationObject($configKey);
		    $id = 0;
		    if(!empty($existingConfiguration)){
		        $id = $existingConfiguration->getSeq();
		    }
		    $config = new Configuration();
		    $config->setSeq($id);
		    $config->setConfigKey($configKey);
		    $config->setConfigValue($configValue);
		    $id = self::$configurationDataStore->save($config);
		    return $id;
		}
		
		public function getConfiguration($configKey,$defaultValue=null){
			$colValuePair['configkey'] = $configKey;
			$configuration = self::$configurationDataStore->executeConditionQuery($colValuePair);
			if($configuration == null){
				return $defaultValue;
			}else{
				return $configuration[0]->getConfigValue();
			}	
		}
		public function getConfigurationInList($configKeys,$defaultValue=null){
		    $colValuePair = array('configkey' => $configKeys);
		    $configurations = self::$configurationDataStore->executeInList($colValuePair);
		    if(empty($configurations)){
		        return $defaultValue;
		    }else{
		        $configurationsArr = array();
		        foreach ($configurations as $configuration){
		            $configurationsArr[$configuration['configkey']] = $configuration['configvalue'];
		        }
		        return $configurationsArr;
		    }
		}
		
		public function getConfigurationObject($configKey){
		    $colValuePair['configkey'] = $configKey;
		    $configuration = self::$configurationDataStore->executeConditionQuery($colValuePair);
		    if(!empty($configuration)){
		        return $configuration[0];
		    }
		    return null;
		}
		
		public function getCronConfigs(){
		    $cronConfigKeys = array(Configuration::$CRON_BACKUP_LAST_EXE,
		        Configuration::$CRON_BEGINNING_DAILY_LAST_EXE,
		        Configuration::$CRON_BEGINNING_WEEKLY_LAST_EXE,
		        Configuration::$CRON_END_DAILY_LAST_EXE,
		        Configuration::$CRON_END_WEEKLY_LAST_EXE,
		        Configuration::$CRON_PENDING_QC_APPROVAL_LAST_EXE,
		        Configuration::$CRON_SEND_QC_PLANNER_REPORT_LAST_EXE,
		        Configuration::$PENDING_QCSCHEDULE_CRON_LAST_EXE);
		    $cronConfigKeys = "'" . implode("','", $cronConfigKeys) . "'";
		    $cronConfigs = $this->getConfigurationInList($cronConfigKeys);
		    return $cronConfigs;
		}
}