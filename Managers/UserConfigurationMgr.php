<?php
    require_once($ConstantsArray['dbServerUrl']. "BusinessObjects/UserConfiguration.php");
    require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");

    class UserConfigurationMgr{
        private static $userConfigurationMgr;
        private static $dataStore;
    
        public static function getInstance(){
            if (!self::$userConfigurationMgr){
                self::$userConfigurationMgr = new UserConfigurationMgr();
                self::$dataStore = new BeanDataStore(UserConfiguration::$className,UserConfiguration::$tableName);
            }
            return self::$userConfigurationMgr;
        }
        public function save($userConfiguration){
            // $sql = "INSERT INTO userconfigurations ()";
            return self::$dataStore->save($userConfiguration);
        }
        public function setConfiguration($userSeq,$configKey,$configValue){
            $query = "INSERT INTO userconfigurations (userseq, configkey, configvalue) 
                    VALUES ($userSeq, '$configKey', '$configValue') ON DUPLICATE KEY UPDATE 
                    configValue = '$configValue'";
            self::$dataStore->executeQuery($query);
        }
        public function getConfigurationValue($userSeq,$configKey){
            $colValuePair = array();
            $colValuePair['userseq'] = $userSeq;
            $colValuePair['configkey'] = $configKey; 
            $userConfigurationArray = self::$dataStore->executeConditionQuery($colValuePair);
            if(count($userConfigurationArray) > 0){
                return $userConfigurationArray[0]->getConfigValue();
            }
            return null;
        }
    }
?>