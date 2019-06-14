<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/ItemSpecificationVersion.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
class ItemSpecificationVersionMgr{
	private static  $ItemSpecificationVersionMgr;
	private static $dataStore;
	public static function getInstance()
	{
		if (!self::$ItemSpecificationVersionMgr)
		{
			self::$ItemSpecificationVersionMgr = new ItemSpecificationVersionMgr();
			self::$dataStore = new BeanDataStore(ItemSpecificationVersion::$className, ItemSpecificationVersion::$tableName);
		}
		return self::$ItemSpecificationVersionMgr;
	}
	
	public function saveVersion($itemSpecificationVersion,$conn){
		self::$dataStore->saveObject($itemSpecificationVersion,$conn);
	}
	
	public function getItemSpecificationVersion($existingIS,$itemSpecification){
		$sessionUtil = SessionUtil::getInstance();
		$userSeq = $sessionUtil->getUserLoggedInSeq();
		$itemSpecificationVersion = new ItemSpecificationVersion();
		$itemSpecificationClass = new ReflectionClass ( ItemSpecification::$className );
		$obectMethods = get_class_methods(current($itemSpecificationClass));
		$methods = array_filter($obectMethods, function($method) {
       		 return strpos($method, 'get') !== false;
   		});
		$flag = false;
		$count = 0;
		foreach ( $methods as $methodName ){
			if ($methodName != "from_array" && $methodName != "createFromRequest") {
				if ($count > 0) {
					$reflect = new ReflectionMethod ( $existingIS, $methodName );
					$setter = "set" . substr ( $methodName, 3 );
					if ($reflect->isPublic ()) {
						$existingVal = call_user_func ( array (
								$existingIS,
								$methodName
						
						) );
						$currentVal = call_user_func ( array (
								$itemSpecification,
								$methodName
						) );
						if(! $currentVal instanceof  DateTime){
							if($existingVal != $currentVal){
								call_user_func( array ($itemSpecificationVersion,$setter),$currentVal);
								$flag = true;
							}
						}
					}
				}
			}
			$count++;
		}
		if($flag){
			$itemSpecificationVersion->setItemNo($itemSpecification->getItemNo());
			$itemSpecificationVersion->setUserSeq($userSeq);
			$itemSpecificationVersion->setCreatedOn(new DateTime());
			$itemSpecificationVersion->setLastModifiedOn(new DateTime());
			return $itemSpecificationVersion;
		}else{
			return null;
		}
	}
}