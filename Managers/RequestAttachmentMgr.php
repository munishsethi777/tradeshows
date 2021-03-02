<?php
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/RequestAttachment.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/RequestLog.php");
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Enums/RequestPriorityTypes.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/RequestTypeMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/RequestStatusMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/RequestLogMgr.php");

class RequestAttachmentMgr{
	private static $requestAttachmentMgr;
	private static $dataStore;
    private static $selectSql = "SELECT * from requestattachments";
	public static function getInstance()
	{
		if (!self::$requestAttachmentMgr){
			self::$requestAttachmentMgr = new RequestAttachmentMgr();
			self::$dataStore = new BeanDataStore(RequestAttachment::$className,RequestAttachment::$tableName);
		}
		return self::$requestAttachmentMgr;
	}
	public function findBySeq($seq){
		$request = self::$dataStore->findBySeq($seq);
		return $request;
	}
	public function findArrBySeq($seq){
	    $request = self::$dataStore->findArrayBySeq($seq);
	    return $request;
	}
    public function findByRequestSeq($seq){
        $query = self::$selectSql . " WHERE requestseq = " . $seq;
        $requestSpecsFieldArray = self::$dataStore->executeQuery($query,false,true);
        return $requestSpecsFieldArray;
    }
    public function save($requestAttachmentArr){
        $requestAttachment = new RequestAttachment();
        $requestAttachment->setRequestSeq($requestAttachmentArr['requestseq']);
        $requestAttachment->setAttachmentFileName($requestAttachmentArr['attachmentfilename']);
        $requestAttachment->setAttachmentBytes($requestAttachmentArr['attachmentbytes']);
        $requestAttachment->setAttachmentType($requestAttachmentArr['attachmenttype']);
        $requestAttachment->setCreatedOn($requestAttachmentArr['createdon']);
        $requestAttachment->setCreatedBy($requestAttachmentArr['loggedinuserseq']);
        $requestAttachment->setAttachmentTitle($requestAttachmentArr['attachmenttitle']);
        return self::$dataStore->save($requestAttachment);
    }
    public function attachmentHtml($requestAttachments){
        $attachmentHtml = "";
        $i=1;
        foreach($requestAttachments as $requestAttachment){
            if($requestAttachment['attachmentfilename'] != ''){
                $thumbnailType = "fa fa-file";
                if($requestAttachment['attachmenttype'] == 'image/jpeg'){
                    $thumbnailType = "fa fa-file-image-o";
                }elseif($requestAttachment['attachmenttype'] == 'application/vnd'){
                    $thumbnailType = "fa fa-file-excel-o";
                }elseif($requestAttachment['attachmenttype'] == 'application/pdf'){
                    $thumbnailType = "fa fa-file-pdf-o";
                }
                elseif($requestAttachment['attachmenttype'] == 'application/pdf'){
                    $thumbnailType = "fa fa-file-pdf-o";
                }elseif($requestAttachment['attachmenttype'] == 'text/plain'){
                    $thumbnailType = "fa fa-file-text";
                }
                $attachmentHtml .= "<div class='col-lg-2 p-3'>";
                $attachmentHtml .= "<div class='row'>";
                // $attachmentHtml .= "<div class='col-lg-12 p-5 '><img style='border-radius:8px' width='100%' src='images/requestattachments/" . $requestAttachment['attachmentfilename'] . "' /></div>";
                $attachmentHtml .="<div class='col-lg-12 p-5 '><a target='_blank' href='images/requestattachments/" . $requestAttachment['attachmentfilename'] ."'><i class='". $thumbnailType ."' style='font-size:100px'></i></a></div>";
                $attachmentHtml .= "<div class='col-lg-12' style='word-wrap:anywhere'>" . $requestAttachment['attachmenttitle'] . "</div>";
                $attachmentHtml .= "<div class='col-lg-12'>" . $requestAttachment['createdon'] . "</div>";
                $attachmentHtml .= "</div></div>";
                $i++;
            }
        }
        return $attachmentHtml;
    }
}
?>