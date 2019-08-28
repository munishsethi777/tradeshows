<?php
require_once ("MainDB.php");
require_once ($ConstantsArray ['dbServerUrl'] . "log4php/Logger.php");
require_once ($ConstantsArray ['dbServerUrl'] . "Utils/FilterUtil.php");
Logger::configure ( $ConstantsArray ['dbServerUrl'] . "log4php/log4php.xml" );
class BeanDataStore {
	private $className;
	private $tableName;
	private $loggedInAdminSeq;
	private $loggedInUserSeq;
	private $sessionUtil;
	private $logger;
	private $dataStoreLogger;
	public function __construct($className_, $tableName) {
		$this->className = $className_;
		$this->tableName = $tableName;
		$this->sessionUtil = SessionUtil::getInstance ();
		$this->loggedInUserSeq = $this->sessionUtil->getUserLoggedInSeq();
		$this->logger = Logger::getLogger ( "logger" );
		$this->dataStoreLogger = Logger::getLogger ( "dataStoreLogger" );
	}
	private function key_implode($array) {
		$fields = array ();
		foreach ( $array as $field => $val ) {
			if (is_null ( $val )) {
				$fields [] = "$field = NULL";
			} else {
				$fields [] = "$field = '$val'";
			}
		}
		$result = join ( ', ', $fields );
		return $result;
	}
	public function save($object) {
	    $id = null;
		try {
			$columnValueArry [] = array ();
			$columns [] = array ();
			$count = 0;
			$class = new ReflectionClass ( $this->className );
			$methods = $class->getMethods ( ReflectionMethod::IS_PUBLIC );
			$id = $object->getSeq ();
			foreach ( $methods as $method ) {
				$methodName = $method->name;
				if (! $this->startsWith ( $methodName, "set" ) && $methodName != "setNAForLockedField" && $methodName != "from_array" && $methodName != "createFromRequest") {
					if ($count > 0) {
						$reflect = new ReflectionMethod ( $object, $methodName );
						if ($reflect->isPublic ()) {
							$val = call_user_func ( array (
									$object,
									$methodName 
							) );
							$column = strtolower ( substr ( $methodName, 3 ) );
							$columns [] = $column;
							$value = call_user_func ( array (
									$object,
									$methodName 
							) );
							if ($value instanceof DateTime) {
								if($column == "createdon" && $id > 0){
									continue;
								}
								$value = $value->format ( 'Y-m-d H:i:s' );
							}
							// if($id > 0){
							// $value = "'" . $value . "'";
							// }
							$columnValueArry [$column] = $value;
						}
					}
					$count ++;
				}
			}
			unset ( $columnValueArry [0] );
			unset ( $columns [0] );
			$SQL = "";
			$db_New = MainDB::getInstance ();
			$conn = $db_New->getConnection ();
			$logMsg = "New " . $this->className . " object saved ";
			if ($id > 0) { // update query
				$columnString = implode ( '=?,', array_keys ( $columnValueArry ) );
				$columnString .= "=?";
				$SQL = "Update " . strtolower ( $this->tableName ) . " set " . $columnString . " where seq = " . $id;
				$STH = $conn->prepare ( $SQL );
				$STH->execute ( array_values ( $columnValueArry ) );
				$logMsg = "Update " . $this->className . " object ";
			} else { // Insert Query
				$columnString = implode ( ',', array_keys ( $columnValueArry ) );
				$valueString = implode ( ',', array_fill ( 0, count ( $columnValueArry ), '?' ) );
				$SQL = "INSERT INTO " . $this->tableName . " ({$columnString}) VALUES ({$valueString})";
				$STH = $conn->prepare ( $SQL );
				$STH->execute ( array_values ( $columnValueArry ) );
				$id = $conn->lastInsertId ();
			}
			$this->throwException ( $STH->errorInfo () );
		} catch ( Exception $e ) {
		    $this->logger->error ( "Error occured in BeanDataStore:" . $e );
		    $logMsg .= json_encode($columnValueArry) . ". logged in user - " . $this->loggedInUserSeq;
		    $this->logger->error($logMsg);
			throw $e ;
		}
		$logMsg .= json_encode($columnValueArry) . ". ID - " . $id . ". logged in user - " . $this->loggedInUserSeq;
		$this->dataStoreLogger->info($logMsg);
		return $id;
	}
	
	public function getConnection(){
		$db_New = MainDB::getInstance ();
		$conn = $db_New->getConnection ();
		$conn->beginTransaction();
		return $conn;
	}
	
	// RollBack
	public function saveObject($object, $conn) {
		$columnValueArry [] = array ();
		$columns [] = array ();
		$count = 0;
		$class = new ReflectionClass ( $this->className );
		$methods = $class->getMethods ( ReflectionMethod::IS_PUBLIC );
		$id = $object->getSeq();
		try {
			
			foreach ( $methods as $method ) {
				$methodName = $method->name;
				if (! $this->startsWith ( $methodName, "set" ) && $methodName != "from_array" && $methodName != "createFromRequest") {
					if ($count > 0) {
						$reflect = new ReflectionMethod ( $object, $methodName );
						if ($reflect->isPublic ()) {
							$val = call_user_func ( array (
									$object,
									$methodName 
							) );
							$column = strtolower ( substr ( $methodName, 3 ) );
							$columns [] = $column;
							$value = call_user_func ( array (
									$object,
									$methodName 
							) );
							if ($value instanceof DateTime) {
								if($column == "createdon" && $id > 0){
									continue;
								}
								$value = $value->format ( 'Y-m-d H:i:s' );
							}
							$columnValueArry [$column] = $value;
						}
					}
				}
				$count ++;
			}
			unset ( $columnValueArry [0] );
			unset ( $columns [0] );
			$SQL = "";
			$logMsg = "New " . $this->className . " object saved ";
			$db_New = MainDB::getInstance ();
			if ($id > 0) { // update query
			    $columnString = implode ( '=?,', array_keys ( $columnValueArry ) );
			    $columnString .= "=?";
			    $SQL = "Update " . strtolower ( $this->tableName ) . " set " . $columnString . " where seq = " . $id;
			    $STH = $conn->prepare ( $SQL );
			    $STH->execute ( array_values ( $columnValueArry ) );
			    $logMsg = "Update " . $this->className . " object ";
			} else { // Insert Query
				$columnString = implode ( ',', array_keys ( $columnValueArry ) );
				$valueString = implode ( ',', array_fill ( 0, count ( $columnValueArry ), '?' ) );
				$SQL = "INSERT INTO " . $this->tableName . " ({$columnString}) VALUES ({$valueString})";
				$STH = $conn->prepare ( $SQL );
				$STH->execute ( array_values ( $columnValueArry ) );
				$id = $conn->lastInsertId ();
				
			}
			$this->throwException ( $STH->errorInfo () );
			
		} catch ( Exception $e ) {
		    $this->logger->error ( "Error occured in BeanDataStore:" . $e );
		    $logMsg .= json_encode($columnValueArry) . ". logged in user - " . $this->loggedInUserSeq;
		    $this->logger->error($logMsg);
			throw $e;
		}
		$logMsg .= json_encode($columnValueArry) . ". ID - " . $id . ". logged in user - " . $this->loggedInUserSeq;
		$this->dataStoreLogger->info($logMsg);
		return $id;
	}
	
	
	function updateObject($object,$condiationPair,$conn){
		$columnValueArry [] = array ();
		$columns [] = array ();
		$count = 0;
		$class = new ReflectionClass ( $this->className );
		$methods = $class->getMethods ( ReflectionMethod::IS_PUBLIC );
		$id = $object->getSeq();
		try {
			foreach ( $methods as $method ) {
				$methodName = $method->name;
				if (! $this->startsWith ( $methodName, "set" ) && $methodName != "from_array" && $methodName != "createFromRequest") {
					if ($count > 0) {
						$reflect = new ReflectionMethod ( $object, $methodName );
						if ($reflect->isPublic ()) {
							$val = call_user_func ( array (
									$object,
									$methodName
							) );
							$column = strtolower ( substr ( $methodName, 3 ) );
							$columns [] = $column;
							$value = call_user_func ( array (
									$object,
									$methodName
							) );
							if ($value instanceof DateTime) {
								if($column == "createdon"){
									continue;
								}
								$value = $value->format ( 'Y-m-d H:i:s' );
							}
							$columnValueArry [$column] = $value;
						}
					}
					$count ++;
				}
			}
			unset ( $columnValueArry [0] );
			unset ( $columns [0] );
			$SQL = "";
			$logMsg = $this->className . " object Updated ";
			$db_New = MainDB::getInstance ();
			$paramValueArr = array();
			
			$attr_arr = array();
			foreach ( $columnValueArry as $key => $value ) {
				$attr_arr [] = $key . " = ?";
				array_push($paramValueArr, $value);
			}
			foreach ( $condiationPair as $key => $value ) {
				$query_array [] = $key . ' = ?';
				if ($value instanceof DateTime) {
				    $value = $value->format ( 'Y-m-d H:i:s' );
				}
				array_push($paramValueArr, $value);
			}
			$columnString = implode ( " , ", $attr_arr );
			$SQL = "Update " . strtolower ( $this->tableName ) . " set " . $columnString ;
			if ($condiationPair != null) {
				$SQL .= " WHERE " . implode ( " AND ", $query_array );
			}
			$STH = $conn->prepare ( $SQL );
			$STH->execute ($paramValueArr);
			$this->throwException ( $STH->errorInfo () );
		} catch ( Exception $e ) {
		    $this->logger->error ( "Error occured in BeanDataStore:" . $e );
		    $logMsg .= json_encode($columnValueArry);
		    $this->logger->error($logMsg . ". logged in user - " . $this->loggedInUserSeq);
			throw $e;
		}
		$logMsg .= json_encode($columnValueArry) . ". ID - " . $id . ". logged in user - " . $this->loggedInUserSeq;
		$this->dataStoreLogger->info($logMsg);
		return $id;
	}
	
	function findAllArr($isApplyFilter = false) {
		try {
			$db = MainDB::getInstance ();
			$conn = $db->getConnection ();
			$sql = "select * from " . $this->tableName;
			if ($isApplyFilter) {
				$sql = FilterUtil::applyFilter ( $sql );
			}
			$STH = $conn->prepare ( $sql );
			$STH->execute ();
			$objList = $STH->fetchAll (PDO::FETCH_ASSOC);
			$this->throwException ( $STH->errorInfo () );
			return $objList;
		} catch ( Exception $e ) {
			$this->logger->error ( "Error occured :" . $e );
			throw $e;
		}
	}
	
	function findAll($isApplyFilter = false) {
		try {
			$db = MainDB::getInstance ();
			$conn = $db->getConnection ();
			$sql = "select * from " . $this->tableName;
			if ($isApplyFilter) {
				$sql = FilterUtil::applyFilter ( $sql );
			}
			$STH = $conn->prepare ( $sql );
			$STH->execute ();
			$objList = $STH->fetchAll ( PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->className );
			$this->throwException ( $STH->errorInfo () );
			return $objList;
		} catch ( Exception $e ) {
			$this->logger->error ( "Error occured :" . $e );
			throw $e;
		}
	}
	function findAllByCompany($isApplyFilter = false) {
		try {
			$sql = "select ". $this->tableName.".* from " . $this->tableName . " where companyseq =" . $this->companySeq;
			if ($isApplyFilter) {
				$sql = FilterUtil::applyFilter ( $sql );
			}
			$db = MainDB::getInstance ();
			$conn = $db->getConnection ();
			$STH = $conn->prepare ( $sql );
			$STH->execute ();
			$objList = $STH->fetchAll ( PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->className );
			$this->throwException ( $STH->errorInfo () );
			return $objList;
		} catch ( Exception $e ) {
			$this->logger->error ( "Error occured :" . $e );
			throw $e ;
		}
	}
	function findBySeq($seq) {
		try {
			$db = MainDB::getInstance ();
			$conn = $db->getConnection ();
			$STH = $conn->prepare ( "select * from " . $this->tableName . " where seq = " . $seq );
			$STH->execute ();
			$obj = $STH->fetchObject ( $this->className );
			$this->throwException ( $STH->errorInfo () );
			return $obj;
		} catch ( Exception $e ) {
			$this->logger->error ( "Error occured :" . $e );
			throw $e ;
		}
	}
	function findArrayBySeq($seq) {
		try {
			$db = MainDB::getInstance ();
			$conn = $db->getConnection ();
			$STH = $conn->prepare ( "select * from " . $this->tableName . " where seq = " . $seq );
			$STH->execute ();
			$obj = $STH->fetch(PDO::FETCH_ASSOC);
			$this->throwException ( $STH->errorInfo () );
			return $obj;
		} catch ( Exception $e ) {
			$this->logger->error ( "Error occured :" . $e );
			throw $e;
		}
	}
	public function deleteBySeq($seq) {
		try {
			$db = MainDB::getInstance ();
			$conn = $db->getConnection ();
			$STH = $conn->prepare ( "delete from " . $this->tableName . " where seq = " . $seq );
			$STH->execute ();
			$this->throwException ( $STH->errorInfo () );
		} catch ( Exception $e ) {
			$this->logger->error ( "Error occured :" . $e );
			throw $e ;
		}
	}
	
	public function deleteInList($ids) {
	    $flag = false;
		try {
			$db = MainDB::getInstance ();
			$conn = $db->getConnection ();
			$query = "delete from " . $this->tableName . " where seq in(" . $ids . ")" ;
			$STH = $conn->prepare ( "delete from " . $this->tableName . " where seq in(" . $ids . ")" );
			$flag = $STH->execute ();
			$this->throwException ( $STH->errorInfo () );
			$flag = true;
		} catch ( Exception $e ) {
			$this->logger->error ( "Error occured :" . $e );
			throw $e ;
		}
		$this->logger->info("Deleted " . $this->className . " object successfully : " . $query . ". Deleted Flag: " . $flag);
		return $flag;
	}
	
	public function deleteByAttribute($colValuePair = null) {
		try {
			foreach ( $colValuePair as $key => $value ) {
				$query_array [] = " $key in ('$value') ";
			}
			$query = "delete FROM " . $this->tableName;
			if ($colValuePair != null) {
				$query .= " WHERE " . implode ( " AND ", $query_array );
			}
			$db = MainDB::getInstance ();
			$conn = $db->getConnection ();
			$STH = $conn->prepare ( $query );
			$STH->execute ();
			$this->throwException ( $STH->errorInfo () );
		} catch ( Exception $e ) {
			$this->logger->error ( "Error occured :" . $e );
			throw  $e ;
		}
	}
	public function deleteAll() {
		try {
			$db = MainDB::getInstance ();
			$conn = $db->getConnection ();
			$STH = $conn->prepare ( "delete from " . $this->tableName );
			$STH->execute ();
			$this->throwException ( $STH->errorInfo () );
		} catch ( Exception $e ) {
			$this->logger->error ( "Error occured :" . $e );
			throw $e ;
		}
	}
	public function deleteAllByCompany() {
		try {
			$db = MainDB::getInstance ();
			$conn = $db->getConnection ();
			$STH = $conn->prepare ( "delete from " . $this->tableName . " where companyseq = " . $this->companySeq );
			$STH->execute ();
			$this->throwException ( $STH->errorInfo () );
		} catch ( Exception $e ) {
			$this->logger->error ( "Error occured :" . $e );
			throw $e ;
		}
	}
	public function executeConditionQuery($colValuePair, $isApplyFilter = false) {
		try {
			$query_array = array ();
			$paramValueArr = array ();
			foreach ( $colValuePair as $key => $value ) {
				if ($value != null || $value==0) {
					$query_array [] = $this->tableName.".".$key . ' = ?' ;
					array_push ( $paramValueArr, $value );
				}
			}
			$query = "SELECT ".$this->tableName.".* FROM " . $this->tableName;
			
			if (count ( $query_array ) > 0) {
				$query .= " WHERE " . implode ( " AND ", $query_array );
			}
			if ($isApplyFilter) {
				$query = FilterUtil::applyFilter ( $query );
			}
			$db = MainDB::getInstance ();
			$conn = $db->getConnection ();
			$STH = $conn->prepare ( $query );
			$STH->execute ($paramValueArr);
			$this->throwException ( $STH->errorInfo () );
			$objList = $STH->fetchAll ( PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->className );
			return $objList;
		} catch ( Exception $e ) {
			$this->logger->error ( "Error occured :" . $e );
			throw $e ;
		}
	}
	
	
	public function executeInListQuery($colValues, $isApplyFilter = false) {
		try {
			$colName = $colValues;
			if (is_array ( $colValues )) {
				$colName = key ( $colValues );
			}
			$query = "SELECT ".$this->tableName.".* FROM " . $this->tableName . " where ".$this->tableName.".$colName in($colValues[$colName])";
			if ($isApplyFilter) {
				$query = FilterUtil::applyFilter ( $query );
			}
			$db = MainDB::getInstance ();
			$conn = $db->getConnection ();
			$STH = $conn->prepare ( $query );
			$STH->execute ();
			$this->throwException ( $STH->errorInfo () );
			$objList = $STH->fetchAll ( PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->className );
			return $objList;
		} catch ( Exception $e ) {
			$this->logger->error ( "Error occured :" . $e );
			throw $e ;
		}
	}
	public function executeInList($colValues, $isApplyFilter = false) {
		try {
			$colName = $colValues;
			if (is_array ( $colValues )) {
				$colName = key ( $colValues );
			}
			$query = "SELECT * FROM " . $this->tableName . " where $colName in($colValues[$colName])";
			if ($isApplyFilter) {
				$query = FilterUtil::applyFilter ( $query );
			}
			$db = MainDB::getInstance ();
			$conn = $db->getConnection ();
			$STH = $conn->prepare ( $query );
			$STH->execute ();
			$this->throwException ( $STH->errorInfo () );
			$objList = $STH->fetchAll ();
			return $objList;
		} catch ( Exception $e ) {
			$this->logger->error ( "Error occured :" . $e );
			throw  $e ;
		}
	}
	public function updateByAttributes($colValuePair, $conditionPair = null) {
		try {
			foreach ( $conditionPair as $key => $value ) {
				$query_array [] = $key . ' = ' . "'" . $value . "'";
			}
			foreach ( $colValuePair as $key => $value ) {
				if ($value instanceof DateTime) {
					$value = $value->format ( 'Y-m-d H:i:s' );
				}
				$attribute_array [] = $key . ' = ' . "'" . $value . "'";
			}
			$query = "update " . $this->tableName . " set " . implode ( " , ", $attribute_array );
			if ($conditionPair != null) {
				$query .= " WHERE " . implode ( " AND ", $query_array );
			}
			$db = MainDB::getInstance ();
			$conn = $db->getConnection ();
			$STH = $conn->prepare ( $query );
			$STH->execute ();
			$this->throwException ( $STH->errorInfo () );
			return true;
		} catch ( Exception $e ) {
			$this->logger->error ( "Error occured :" . $e );
			throw $e ;
		}
	}
	public function updateByAttributesWithBindParams($colValuePair, $condiationPair = null) {
		try {
			$paramValueArr = array ();
			$flag = false;
			foreach ( $colValuePair as $key => $value ) {
				if ($value instanceof DateTime) {
					$value = $value->format ( 'Y-m-d H:i:s' );
				}
				$attribute_array [] = $key . ' = ?';
				array_push ( $paramValueArr, $value );
			}
			foreach ( $condiationPair as $key => $value ) {
				$query_array [] = $key . ' = ?';
				array_push ( $paramValueArr, $value );
			}
			$query = "update " . $this->tableName . " set " . implode ( " , ", $attribute_array );
			if ($condiationPair != null) {
				$query .= " WHERE " . implode ( " AND ", $query_array );
			}
			$db = MainDB::getInstance ();
			$conn = $db->getConnection ();
			$STH = $conn->prepare ( $query );
			$STH->execute ( $paramValueArr );
			$this->throwException ( $STH->errorInfo () );
			$flag =  true;
		} catch ( Exception $e ) {
			$this->logger->error ( "Error occured :" . $e );
			throw $e ;
		}
		$logMsg = "Update Attributes - Query = ". $query . " Params - ". json_encode($paramValueArr) . ". logged in user - " . $this->loggedInUserSeq;
		$this->dataStoreLogger->info($logMsg);
		return $flag;
	}
	public function executeCountQuery($colValuePair = null, $isApplyFilter = false) {
		try {
			$query = "SELECT  COUNT(DISTINCT ".$this->tableName.".seq) FROM " . $this->tableName;
			if ($colValuePair != null) {
				foreach ( $colValuePair as $key => $value ) {
					$query_array [] = $this->tableName .".".$key . ' = ' . "'" . $value . "'";
				}
				$query .= " WHERE " . implode ( " AND ", $query_array );
			}
			if ($isApplyFilter) {
				$query = FilterUtil::applyFilter ( $query, false );
			}
			$db = MainDB::getInstance ();
			$conn = $db->getConnection ();
			$STH = $conn->prepare ( $query );
			$STH->execute ();
			$this->throwException ( $STH->errorInfo () );
			$result = $STH->fetch ( PDO::FETCH_NUM );
			$count = intval ( $result [0] );
			return $count;
		} catch ( Exception $e ) {
			$this->logger->error ( "Error occured :" . $e );
			throw  $e ;
		}
	}
	
	
	
	public function executeCountQueryWithSql($query, $isApplyFilter = false,$isGroupBy = false) {
		try {
			$db = MainDB::getInstance ();
			$conn = $db->getConnection ();
			if ($isApplyFilter) {
				$query = FilterUtil::applyFilter ( $query, false,$isGroupBy );
			}
			$STH = $conn->prepare ( $query );
			$STH->execute ();
			$this->throwException ( $STH->errorInfo () );
			$result = $STH->fetch ( PDO::FETCH_NUM );
			$count = intval ( $result [0] );
			return $count;
		} catch ( Exception $e ) {
			$this->logger->error ( "Error occured :" . $e );
			throw $e ;
		}
	}
	public function executeQuery($query, $isApplyFilter = false, $ommitIntegerArrayElements =false,$isGroupBy = false) {
		try {
			$db = MainDB::getInstance ();
			$conn = $db->getConnection ();
			if ($isApplyFilter) {
				$query = FilterUtil::applyFilter ( $query,true,$isGroupBy );
			}
			$sth = $conn->prepare ( $query );
			$sth->execute ();
			$this->throwException ( $sth->errorInfo () );
			$objList = null;
			if($ommitIntegerArrayElements){
				$objList = $sth->fetchAll(PDO::FETCH_ASSOC);
			}else{
				$objList = $sth->fetchAll();
			}
			return $objList;
		} catch ( Exception $e ) {
			$this->logger->error ( "Error occured :" . $e );
			throw $e ;
		}
	}
	public function insertWithQuery($query,$isApplyFilter=false) {
		try {
			$db = MainDB::getInstance ();
			$conn = $db->getConnection ();
			if ($isApplyFilter) {
				$query = FilterUtil::applyFilter ( $query );
			}
			$sth = $conn->prepare ( $query );
			$sth->execute ();
			$this->throwException ( $sth->errorInfo () );
			$id = $conn->lastInsertId();
			return $id;
		} catch ( Exception $e ) {
			$this->logger->error ( "Error occured :" . $e );
			throw $e ;
		}
	}
	public function executeObjectQuery($query, $isApplyFilter = false) {
		$objList = null;
		try {
			$db = MainDB::getInstance ();
			$conn = $db->getConnection ();
			$sth = $conn->prepare ( $query );
            if ($isApplyFilter) {
				$query = FilterUtil::applyFilter ( $query );
			}
			$sth->execute ();
			$this->throwException ( $sth->errorInfo () );
			$objList = $sth->fetchAll ( PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->className );
		} catch ( Exception $e ) {
			$this->logger->error ( "Error occured :" . $e );
			throw  $e ;
		}
		return $objList;
	}
	public function executeAttributeQuery($attributes, $colValuePair, $isApplyFilter = false) {
		try {
			$paramValueArr = array();
			$query_array = array();
			foreach ( $colValuePair as $key => $value ) {
				if ($value != '') {
					$query_array [] = $key . ' = ' . "?";
					array_push ( $paramValueArr, $value );
				}
			}
			$columns = implode ( ", ", $attributes );
			$query = "SELECT " . $columns . " FROM " . $this->tableName . " WHERE " . implode ( " AND ", $query_array );
			if ($isApplyFilter) {
				$query = FilterUtil::applyFilter ( $query, false );
			}
			$db = MainDB::getInstance ();
			$conn = $db->getConnection ();
			$sth = $conn->prepare ( $query );
			$sth->execute ($paramValueArr);
			$this->throwException ( $sth->errorInfo () );
			$objList = $sth->fetchAll ();
			return $objList;
		} catch ( Exception $e ) {
			$this->logger->error ( "Error occured :" . $e );
			throw $e ;
		}
	}
	public function throwException($error) {
	    if ($error [2] != "") {
		    throw new Exception ( $error [2] );
		}
	}
	function startsWith($haystack, $needle) {
		$length = strlen ( $needle );
		return (substr ( $haystack, 0, $length ) === $needle);
	}
	function endsWith($haystack, $needle) {
		$length = strlen ( $needle );
		if ($length == 0) {
			return true;
		}
		return (substr ( $haystack, - $length ) === $needle);
	}
}
?>
