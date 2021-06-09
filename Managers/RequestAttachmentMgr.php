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
require_once($ConstantsArray['dbServerUrl'] ."StringConstants.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/RequestMgr.php");

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
        $id = self::$dataStore->save($requestAttachment);
        if($id){
            $requestMgr = RequestMgr::getInstance();
            $attr = array("lastmodifiedon" => new DateTime());
			$condition = array("seq" => $requestAttachmentArr['requestseq']);
            $requestMgr->updateByAttribute($attr,$condition);
        }
        RequestReportUtil::sendFileAddedOnRequestNotification($requestAttachmentArr['requestseq'],$requestAttachmentArr['attachmenttitle']);
        return $id;
    }
    public function attachmentHtml($requestAttachments){
        $requestAttachments = array_reverse($requestAttachments);
        $sessionUtil = SessionUtil::getInstance();
        $loggedInUserTimeZone = $sessionUtil->getUserLoggedInTimeZone();
        $attachmentHtml = "";
        $i=1;
        foreach($requestAttachments as $requestAttachment){
            if($requestAttachment['attachmentfilename'] != '' && file_exists(StringConstants::REQUEST_ATTACHMENTS_PATH . $requestAttachment['attachmentfilename'])){
                $thumbnailType = "fa fa-file";
                if($requestAttachment['attachmenttype'] == 'image/jpeg'){
                    $thumbnailType = "fa fa-file-image-o";
                }elseif($requestAttachment['attachmenttype'] == 'application/vnd'){
                    $thumbnailType = "fa fa-file-excel-o";
                }elseif($requestAttachment['attachmenttype'] == 'application/pdf'){
                    $thumbnailType = "fa fa-file-pdf-o";
                }elseif($requestAttachment['attachmenttype'] == 'application/pdf'){
                    $thumbnailType = "fa fa-file-pdf-o";
                }elseif($requestAttachment['attachmenttype'] == 'text/plain'){
                    $thumbnailType = "fa fa-file-text";
                }
                $attachmentHtml .= "<div id='attachmentsMainOuter". $requestAttachment['seq'] ."' class='col-lg-2 p-sm m-sm bg-muted border attachmentsMainOuter'>";
                $attachmentHtml .= "<span class='attachmentCrossBtn'><i class='fa fa-times-circle' onclick=deleteAttachment('". $requestAttachment['seq'] ."','" . $requestAttachment['attachmentfilename'] . "','". $requestAttachment['requestseq'] ."')></i></span>";
                $attachmentHtml .= "<div class='row text-center'>";
                // $attachmentHtml .= "<div class='col-lg-12 p-5 '><img style='border-radius:8px' width='100%' src='images/requestattachments/" . $requestAttachment['attachmentfilename'] . "' /></div>";
                $attachmentHtml .="<div class='col-lg-12 p-5 '><a target='_blank' href='".StringConstants::REQUEST_ATTACHMENTS_FOLDER_PATH . $requestAttachment['attachmentfilename'] ."'><i class='". $thumbnailType ."' style='font-size:25px'></i></a></div>";
                $attachmentHtml .= "<div id='attachmentTitle".$requestAttachment['seq']."' class='col-lg-12' style='word-wrap:anywhere'>" . $requestAttachment['attachmenttitle'] . "</div>";
                $attachmentHtml .= "<div class='col-lg-12'>" . DateUtil::convertDateToFormatWithTimeZone($requestAttachment['createdon'],"Y-m-d H:i:s","m-d-Y h:i:s A",$loggedInUserTimeZone) . "</div>";
                $attachmentHtml .= "</div></div>";
                $i++;
            }
        }
        return $attachmentHtml;
    }
    public function deleteAttachment($attachmentSeq,$attachmentName){
        $return = false;
        if(unlink(StringConstants::REQUEST_ATTACHMENTS_PATH . $attachmentName)){
            $return = self::$dataStore->deleteBySeq($attachmentSeq);
        }
        return $return;
    }
    public function getAttachmentFileNamesByRequestSeqs($seqs){
        $sql = "SELECT requestattachments.attachmentfilename FROM `requestattachments` where requestseq IN($seqs)";
        $attachmentFileNames = self::$dataStore->executeQuery($sql,false,true);
        return $attachmentFileNames;
    }
}
?>