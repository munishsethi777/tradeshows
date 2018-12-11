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
	
	
	public function deleteTaskFiles($showTaskSeq){
		$selectedFiles = $this->getFilesArrByShowTask($showTaskSeq);
		if(!empty($selectedFiles)){
			$fileSeqs  = array_map(create_function('$o', 'return $o["seq"];'), $selectedFiles);
			$slectedFilesSeqs = $_REQUEST["selectedFileSeqs"];
			if(empty($slectedFilesSeqs)){
				$slectedFilesSeqs = array();
			}
			$fileSeqsForDelete = array_diff($fileSeqs, $slectedFilesSeqs);
			if(!empty($fileSeqsForDelete)){
				$fileSeqsForDelete = implode(",", $fileSeqsForDelete);
				$this->deleteInList($fileSeqsForDelete);
			}
		}
	}
	public function saveFilesFromRequest($showTaskSeq){
		$this->deleteTaskFiles($showTaskSeq);
		if(empty($_FILES)){
			return;
		}
		$files = $_FILES["files"];
		$fileNames = $files["name"];
		$isPublicArr = $_REQUEST["ispublic"];
		$tempNames = $files["tmp_name"];
		foreach ($fileNames as $key=>$name){
			$showTaskFile = new ShowTaskFile();
			$filename = $name;
			$fileType = pathinfo($filename, PATHINFO_EXTENSION);
			$showTaskFile->setTitle($filename);
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
	
	public function getFilesArrByShowTask($showTaskSeq){
		$query = "select * from showtaskfiles where showtaskseq = $showTaskSeq";
		$files = self::$showTaskFileDataStore->executeQuery($query);
		return $files;
	}
	
	public function deleteInList($fileSeqs){
		$flag = self::$showTaskFileDataStore->deleteInList($fileSeqs);
		return $flag;
	}
}