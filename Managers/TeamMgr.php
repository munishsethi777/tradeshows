<?php
require_once($ConstantsArray['dbServerUrl'] ."DataStores/BeanDataStore.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/Team.php");
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/TeamUser.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");

class TeamMgr{
    
    private static $TeamMgr;
    private static $teamDataStore;
    private static $teamUserDataStore;
    public static function getInstance()
    {   
       if (!self::$TeamMgr)
        {
            self::$TeamMgr = new TeamMgr();
            self::$teamDataStore = new BeanDataStore(Team::$className, Team::$tableName);
            self::$teamUserDataStore = new BeanDataStore(TeamUser::$className, TeamUser::$tableName);
        }
        return self::$TeamMgr;
    }
    public function saveTeam($team,$userseqs){
        $teamseq = self::$teamDataStore->save($team);
        $this->deleteTeamUserByTeamSeq($teamseq);
        foreach($userseqs as $userseq){
            $teamuser = new TeamUser();
            $teamuser->setUserSeq($userseq);
            $teamuser->setTeamSeq($teamseq);
            self::$teamUserDataStore->save($teamuser);
        }
        return  $teamseq;
    }
    
    public function deleteTeamUserByTeamSeq($teamseq){
        $col["teamseq"] = $teamseq;
        self::$teamUserDataStore->deleteByAttribute($col);
    }
    public function getTeamsForGrid(){
        $sessionUtil = SessionUtil::getInstance();
        $loggedInUserTimeZone = $sessionUtil->getUserLoggedInTimeZone();
        $teams  = self::$teamDataStore->findAllArr(true);  
        $arr = array();
        foreach($teams as $team){
            $lastModifiedOn = $team["lastmodifiedon"];
            $lastModifiedOn = DateUtil::convertDateToFormatWithTimeZone($lastModifiedOn, "Y-m-d H:i:s", "Y-m-d H:i:s",$loggedInUserTimeZone);
            $team["lastmodifiedon"] = $lastModifiedOn;
            array_push($arr,$team);       
        }     
        $query  = "select count(*) from teams";
        $count  = self::$teamDataStore->executeCountQueryWithSql($query,true);
        $mainArr["Rows"] = $arr;
        $mainArr["TotalRows"] = $count;
        return $mainArr;
        //return $teams;
    }
    public function findBySeq($seq){
        $teamseq = self::$teamDataStore->findBySeq($seq);
        return $teamseq;
    }
    public function getUserSeqsByTeamSeq($teamseq){
        $attr = array();
        $condition = array();
        $attr[0] = "userseq";
        $condition["teamseq"] = $teamseq;
        $userSeqs = self::$teamUserDataStore->executeAttributeQuery($attr, $condition);
        $userSeqArr = array();
        if(!empty( $userSeqs )){
            $userSeqArr  = array_map(create_function('$o', 'return $o["userseq"];'), $userSeqs);
        }
        return $userSeqArr ;
        
    }
    public function deleteBySeqs($ids){
        return self::$teamDataStore->deleteInList($ids);
    }
    public function getUserTeam($userSeq){
        $query = "select t1.* from teamusers t1 inner join teamusers t2 on  t2.teamseq = t1.teamseq and t2.userseq  = $userSeq inner join teams on t1.teamseq = teams.seq where teams.isenable = 1";
        $teams = self::$teamUserDataStore->executeQuery($query,false,true);
        $teamUsersArr = array();
		if($teams){
		    $teamUsersArr = array_map(create_function('$o', 'return $o["userseq"];'), $teams);
		}
		return  $teamUsersArr;
    }
    
  }