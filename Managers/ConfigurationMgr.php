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
		
		public function getConfiguration($configKey,$defaultValue=null){
			$colValuePair['configkey'] = $configKey;
			$configuration = self::$configurationDataStore->executeConditionQuery($colValuePair);
			if($configuration == null){
				return $defaultValue;
			}else{
				return $configuration[0]->getConfigValue();
			}	
		}	
}