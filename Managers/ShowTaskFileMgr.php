<?php
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/ShowTaskFile.php");
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/FileUtil.php");

class ShowTaskFileMgr{
	private static $showTaskFileMgr;
	private static $showTaskFileDataStore;
	
	public static function getInstance(){
		if (!self::$showTaskFileMgr)
		{
			self::$showTaskFileMgr = new ShowTaskFileMgr();
			self::$showTaskFileDataStore = new BeanDataStore(ShowTaskFile::$className,ShowTaskFile::$tableName);
		}
		return self::$showTaskFileMgr;
	}
	
	public function saveFilesFromRequest($showTaskSeq){
		$files = $_FILES["files"];
		$isPublicArr = $_REQUEST["ispublic"];
		$fileNames = $files["name"];
		$tempNames = $files["tmp_name"];
		foreach ($fileNames as $key=>$name){
			$filename = $name;
			$fileType = pathinfo($filename, PATHINFO_EXTENSION);
			$showTaskFile = new ShowTaskFile();
			$showTaskFile->setCreatedOn(new DateTime());
			$showTaskFile->setShowTaskSeq($showTaskSeq);
			$isPublic = 0;
			if(array_key_exists($key, $isPublicArr)){
				$isPublic = 1;
			}
			$showTaskFile->setIsPublic($isPublic);
			$showTaskFile->setFileExtension($fileType);
			$showTaskFile->setUserSeq(0);
			$id = $this->saveShowTaskFile($showTaskFile);
			$filename = $id .".". $fileType;
			$uploaddir = $_SERVER["DOCUMENT_ROOT"] . "/tradeshows/documents/";
			FileUtil::uploadFile($tempNames[$key],$uploaddir,$filename);
		}
	}
	
	public function saveShowTaskFile($showTaskFile){
		$id = self::$showTaskFileDataStore->save($showTaskFile);
		return $id;
	}
}