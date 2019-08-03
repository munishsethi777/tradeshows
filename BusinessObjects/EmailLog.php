<?php 
class Emaillog{
      public static $tableName = "emaillogs";
      public static $className = "Emaillog";
      
      private $seq,$logtype,$emailid,$createdon,$sendon,$senton,$failuremsg,$attempts,$userseq;
     
      public function setSeq($seq_){
          $this->seq = $seq_;
      }
      public function getSeq(){
          return $this->seq;
      }
      public function setLogtype($val){
          $this->Logtype = $val;
      }
      public function getLogtype(){
          return $this->Logtype;
      }
      public function setEmailid($val){
          $this->emailid = $val;
      }
      public function getEmailid(){
          return $this->emailid;
      }
      public function setCreatedon($val){
          $this->createdon = $val;
      }
      public function getCreatedon(){
           return $this->createdon;
      }
      public function setSendon($val){
          $this->sendon = $val;
      }
      public function getSendon(){
          return $this->sendon;
      }
      public function setSenton($val){
          $this->senton = $val;
      }
      public function getSenton(){
          return $this->senton;
      }
      public function setFailuremsg($val){
          $this->failuremsg = $val;
      }
      public function getFailuremsg(){
          return $this->failuremsg;
      }
      public function setAttempts($val){
          $this->attempts = $val;
      }
      public function getAttempts(){
          return $this->attempts;
      }
      public function setUserseq($val){
       $this->userseq = $val;   
      }
      public function getUserseq(){
          return $this->userseq;
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