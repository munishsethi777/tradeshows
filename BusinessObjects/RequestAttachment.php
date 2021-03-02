<?php
    class RequestAttachment{

        private $seq, $requestseq, $attachmentfilename, $createdon, $createdby,$attachmenttitle,$attachmenttype,$attachmentbytes;

        public static $className = "RequestAttachment";
        public static $tableName = "requestattachments";

        public function setSeq($seq){
            $this->seq = $seq;
        }
        public function getSeq(){
            return $this->seq;
        }
        public function setRequestSeq($requestseq){
            $this->requestseq = $requestseq;
        }
        public function getRequestSeq(){
            return $this->requestseq;
        }
        public function setAttachmentFileName($attachmentFileName){
            $this->attachmentfilename = $attachmentFileName;
        }
        public function getAttachmentFileName(){
            return $this->attachmentfilename;
        }
        public function setCreatedOn($createdon){
            $this->createdon = $createdon;
        }
        public function getCreatedOn(){
            return $this->createdon;
        }
        public function setCreatedBy($createdby){
            $this->createdby = $createdby;
        }
        public function getCreatedBy(){
            return $this->createdby;
        }
        public function setAttachmentTitle($attachentTitle){
            $this->attachmenttitle = $attachentTitle;
        }
        public function getAttachmentTitle(){
            return $this->attachmenttitle;
        }
        public function setAttachmentBytes($attachmentBytes){
            $this->attachmentbytes = $attachmentBytes;
        }
        public function getAttachmentBytes(){
            return $this->attachmentbytes;
        }
        public function setAttachmentType($attachmentType){
            $this->attachmenttype = $attachmentType;
        }
        public function getAttachmentType(){
            return $this->attachmenttype;
        }
        public function createFromRequest($request){
            if (is_array($request)){
                $this->from_array($request);
            }
            return $this;
        }
        public function from_array($array){
            foreach(get_object_vars($this) as $attrName => $attrValue){
                $flag = property_exists(self::$className, $attrName);
                $isExists = array_key_exists($attrName, $array);
                if($flag && $isExists){
                    $datePos = strpos(strtolower ($attrName),'date');
                    $value = $array[$attrName];
                    if($datePos !== false && !empty($value)){
                        $dateValue = DateUtil::StringToDateByGivenFormat("m-d-Y", $value);
                        if($dateValue){
                            $value = $dateValue;
                        }
                    }
                    if(!empty($value)){
                        $this->{$attrName} = $value;
                    }else{
                        $this->{$attrName} = null;
                    }
                }
            }
        }  
    }
?>