<?php
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/ShowTaskFile.php");
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/FileUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");

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
			$slectedFilesSeqs = array();
			if(isset($_REQUEST["selectedFileSeqs"])){
				$slectedFilesSeqs = $_REQUEST["selectedFileSeqs"];
			}
			$fileSeqsForDelete = array_diff($fileSeqs, $slectedFilesSeqs);
			if(!empty($fileSeqsForDelete)){
				$fileSeqsForDelete = implode(",", $fileSeqsForDelete);
				$this->deleteInList($fileSeqsForDelete,$selectedFiles);
			}
		}
	}
	public function saveFilesFromRequest($showTaskSeq){
		$this->deleteTaskFiles($showTaskSeq);
		if(empty($_FILES)){
			return;
		}
		$sessionUtil = SessionUtil::getInstance();
		$isUserSession = $sessionUtil->isSessionUser();
		$userSeq = 0;
		if($isUserSession){
			$userSeq = $sessionUtil->getUserLoggedInSeq();
		}
		$files = $_FILES["files"];
		$fileNames = $files["name"];
		$isPublicArr = array();
		if(isset($_REQUEST["ispublic"])){
			$isPublicArr = $_REQUEST["ispublic"];
		}
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
			$showTaskFile->setUserSeq($userSeq);
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
	
	public function deleteInList($fileSeqs,$selectedFiles){
		$flag = self::$showTaskFileDataStore->deleteInList($fileSeqs);
		if($flag){
			$fileSeqs = explode(",", $fileSeqs);
			foreach ($selectedFiles as $file){
				$fileName = $file["seq"] . "." . $file["fileextension"];
				$path = $_SERVER["DOCUMENT_ROOT"] . "/tradeshows/documents/" . $fileName;
				FileUtil::deletefile($path);
			}
		}
		return $flag;
	}
	
	public function getTasksFilesByShow($showSeq){
		$sql = "select showtaskfiles.seq, tasks.title ttitle, showtaskfiles.title ftitle,showtaskfiles.fileextension,DATE_FORMAT(showtaskfiles.createdon,'%b %d %Y %h:%i %p') createdon,users.fullname from shows
		inner join showtasks on showtasks.showseq = shows.seq
		inner join tasks on tasks.seq = showtasks.taskseq
		inner join showtaskfiles on showtaskfiles.showtaskseq = showtasks.seq
		inner join users on users.seq = showtaskfiles.userseq
		where shows.seq = $showSeq
		ORDER by tasks.title asc";
		$arr = self::$showTaskFileDataStore->executeQuery($sql);
		return $arr;
	}
}