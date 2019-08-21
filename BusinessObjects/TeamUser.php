<?php
class TeamUser{
    public static $tableName = "teamusers";
    public static $className = "TeamUser"; 
    private $seq,$teamseq,$userseq;
    
    public function setSeq($seq){
        $this->seq = $seq;
    }
    public function getSeq(){
        return $this->seq;
    }
    
    public function setTeamSeq($teamseq){
        $this->teamseq = $teamseq;
    }
    public function getTeamSeq(){
        return $this->teamseq;
    }
    
    public function setUserSeq($userseq){
        $this->userseq = $userseq;
    }
    public function getUserSeq(){
        return $this->userseq;
    }
    
}
?>