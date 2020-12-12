<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/ShowTaskStatus.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
  class FilterUtil{
      public static function getFilters(){
        $pagenum = intval($_GET['pagenum']);
        $pagesize = intval($_GET['pagesize']);
        $start = $pagenum;
        if($pagenum > 1){
             $start = $pagenum * $pagesize;    
        }       
        $filter["start"] = $start;
        $filter["limit"] = $pagesize;
        return $filter;
      }
  
  private static function appendLimit($query){
   if(isset($_GET['pagenum'])){
        $pagenum = intval($_GET['pagenum']);
        $pagesize = intval($_GET['pagesize']);
        $start = $pagenum;
        //if($pagenum > 1){
             $start = $pagenum * $pagesize;    
       // }       
        $query = $query . " limit " . $start . "," . $pagesize;
    }elseif(isset($_POST['pagenum'])){
	    	$pagenum = intval($_POST['pagenum']);
	    	$pagesize = intval($_POST['pagesize']);
	    	$start = $pagenum;
	    	//if($pagenum > 1){
	    	$start = $pagenum * $pagesize;
	    	// }
	    	$query = $query . " limit " . $start . "," . $pagesize;
    }
    return $query;        
  }
  
  private static function limit ( $request )
	{
		$limit = '';
		if ( isset($request['start']) && $request['length'] != -1 ) {
			$limit = "LIMIT ".intval($request['start']).", ".intval($request['length']);
		}
		return $limit;
	}
  
  private static function appendSorting($query){
    if (isset($_GET['sortdatafield']))
    {
        $sortfield = $_GET['sortdatafield'];
        $sortorder = $_GET['sortorder'];     
        if ($sortfield != NULL)
        {
        	if ($sortorder == "desc")
        	{
        		$query = $query . " ORDER BY" . " ";
        	}
        	else if ($sortorder == "asc")
        	{
        		$query = $query . " ORDER BY" . " ";
        	}
        	$sortfield = explode(",",$sortfield);
        	$srtStr = "";
        	foreach($sortfield as $fields){
	            if ($sortorder == "desc")
	            {
	                $srtStr .= $fields . " DESC ,";
	            }
	            else if ($sortorder == "asc")
	            {
	                $srtStr .= $fields  . " ASC,";
	            }     
        	}
        	$srtStr = rtrim($srtStr,',');
        	$query = $query . " " . $srtStr;
        }
    }  
    return $query;  
  }
  
  static function order ( $request, $columns )
  {
  	$order = '';
  	if ( isset($request['order']) && count($request['order']) ) {
  		$orderBy = array();
  		$dtColumns = self::pluck( $columns, 'dt' );
  		for ( $i=0, $ien=count($request['order']) ; $i<$ien ; $i++ ) {
  			// Convert the column index into the column data property
  			$columnIdx = intval($request['order'][$i]['column']);
  			$requestColumn = $request['columns'][$columnIdx];
  			$columnIdx = array_search( $requestColumn['data'], $dtColumns );
  			$column = $columns[ $columnIdx ];
  			if ( $requestColumn['orderable'] == 'true' ) {
  				$dir = $request['order'][$i]['dir'] === 'asc' ?
  				'ASC' :
  				'DESC';
  				$orderBy[] = '`'.$column['db'].'` '.$dir;
  			}
  		}
  		if ( count( $orderBy ) ) {
  			$order = 'ORDER BY '.implode(', ', $orderBy);
  		}
  	}
  	return $order;
  }
  
  public static function applyFilter($query,$isApplyLimit = true, $isGroupBy = false){
    // filter data.
    if (isset($_GET['filterscount']))
    {
        $filterscount = $_GET['filterscount'];
        
        if ($filterscount > 0)
        {
            if (strpos(strtolower ($query),'where') !== false) {
                $where = " AND (";
            }else{
                 $where = " WHERE (";    
            }
           
            $tmpdatafield = "";
            $tmpfilteroperator = "";
            for ($i=0; $i < $filterscount; $i++)
            {
                // get the filter's value.
                $filtervalue = $_GET["filtervalue" . $i];
                // get the filter's condition.
                $filtercondition = $_GET["filtercondition" . $i];
                // get the filter's column.
                $filterdatafield = $_GET["filterdatafield" . $i];
                // get the filter's operator.
                $filteroperator = $_GET["filteroperator" . $i];
                
                if ($tmpdatafield == "")
                {
                    $tmpdatafield = $filterdatafield;            
                }
                else if ($tmpdatafield <> $filterdatafield)
                {
                    if($_GET[$tmpdatafield."operator"] == "and"){
                    	$tmpfilteroperator = 0;
                    }
                	if($tmpfilteroperator == 0){
                        $where .= ")AND(";
                    }else{
                    	$where .= " OR ";
                    }
                	
                }
                else if ($tmpdatafield == $filterdatafield)
                {
                    if ($tmpfilteroperator == 0)
                    {
                        $where .= " AND ";
                    }
                    else $where .= " OR ";    
                }
                //graphic status type is an enum
                if($filterdatafield == "graphicstatus"){
                	$filtervalue = GraphicStatusType::getName($filtervalue);
                }
                
                // build the "WHERE" clause depending on the filter's condition, value and datafield.
                switch($filtercondition)
                {
                    case "NOT_EMPTY":
                    case "NOT_NULL":
                        $where .= " " . $filterdatafield . " is NOT NULL";
                        break;
                    case "EMPTY":
                    case "NULL":
                        $where .= " " . $filterdatafield . " is NULL";
                        break;
                    case "CONTAINS_CASE_SENSITIVE":
                        $where .= " BINARY  " . $filterdatafield . " LIKE '%" . $filtervalue ."%'";
                        break;
                    case "CONTAINS":
                    	$where .= " " . $filterdatafield . " LIKE '%" . $filtervalue ."%'";
                        break;
                    case "DOES_NOT_CONTAIN_CASE_SENSITIVE":
                        $where .= " BINARY " . $filterdatafield . " NOT LIKE '%" . $filtervalue ."%'";
                        break;
                    case "DOES_NOT_CONTAIN":
                        $where .= " " . $filterdatafield . " NOT LIKE '%" . $filtervalue ."%'";
                        break;
                    case "EQUAL_CASE_SENSITIVE":
                        $where .= " BINARY " . $filterdatafield . " = '" . $filtervalue ."'";
                        break;
                    case "EQUAL":
                    	if($filterdatafield == "status"){
                    		if($filtervalue == ShowTaskStatus::completed){
                    			$filtervalue = ShowTaskStatus::getName($filtervalue);
                    			$where .= " " . $filterdatafield . " = '" . $filtervalue ."'";
                    		}else{
                    			$date = new DateTime();
                    			$date = $date->format("Y-m-d");
                    			if($filtervalue == ShowTaskStatus::delay){
                    				$where .= " ($filterdatafield = 'pending' or  $filterdatafield = 'inprocess') And enddate < '$date'";
                    			}else if($filtervalue == ShowTaskStatus::pending){
                    				$where .= " $filterdatafield = 'pending' And enddate > '$date'";
                    			}else if($filtervalue == ShowTaskStatus::inprocess){
                    				$where .= " $filterdatafield = 'inprocess' And enddate > '$date'";
                    			}
                    			
                    		}
                    	}elseif($filterdatafield == "instructionmanuallogstatus"){
                            $filtervalue = InstructionManualLogStatus::getName($filtervalue);
                            $where .= " " . $filterdatafield . " = '" . $filtervalue ."'";
                            break;
                        }else{
                    		if($filterdatafield == "fullname"){
                    			if($filtervalue == "Admin"){
                    				$where .= " $filterdatafield is NULL";
                    			}else{
                    				$where .= " " . $filterdatafield . " = '" . $filtervalue ."'";
                    			}
                    		}else{
                    			$where .= " " . $filterdatafield . " = '" . $filtervalue ."'";
                    		}
                    		
                    	}
                        break;
                    case "NOT_EQUAL_CASE_SENSITIVE":
                        $where .= " BINARY " . $filterdatafield . " <> '" . $filtervalue ."'";
                        break;
                    case "NOT_EQUAL":
                        $where .= " " . $filterdatafield . " <> '" . $filtervalue ."'";
                        break;
                    case "GREATER_THAN":
                        $where .= " " . $filterdatafield . " > '" . $filtervalue ."'";
                        break;
                    case "LESS_THAN":
                        $where .= " " . $filterdatafield . " < '" . $filtervalue ."'";
                        break;
                    case "GREATER_THAN_OR_EQUAL":
                    	$date = strpos(strtolower ($filterdatafield),'date');
                    	$startDatePos = strpos(strtolower ($filterdatafield),'startdate');
                    	$endDatePos = strpos(strtolower ($filterdatafield),'enddate');
                    	$createdOnPos = strpos(strtolower ($filterdatafield),'createdon');
                    	$lastModifiedPos = strpos(strtolower ($filterdatafield),'lastmodifiedon');
                    	//$shipDatePos = strpos(strtolower ($filterdatafield),'shipdate');
                    	$dateObj = true;
                    	if($startDatePos !== false || $endDatePos !== false || $date !== false){
                    		 $dateObj = DateUtil::StringToDateByGivenFormat("m-d-Y", $filtervalue);
                    		 if(!$dateObj){
                    		 	$dateObj = DateUtil::StringToDateByGivenFormat("m-d-Y H:i A",$filtervalue);
                    		 }
                    		 if(!$dateObj){
                    		 	$dateObj = DateUtil::StringToDateByGivenFormat("D M d Y H:i:s e+",$filtervalue);
                    		 }
                    		 if($dateObj){
                    		 	$filtervalue = $dateObj->format("Y-m-d");
                    		 }
                    	}
                    	if($createdOnPos !== false || $lastModifiedPos !== false || !$dateObj){
                    		$dateObj = DateUtil::StringToDateByGivenFormat("m-d-Y", $filtervalue);
                    		if(!$dateObj){
                    			$dateObj = DateUtil::StringToDateByGivenFormat("m-d-Y H:i A",$filtervalue);
                    		}
                    		if(!$dateObj){
                    			$dateObj = DateUtil::StringToDateByGivenFormat("m-d-Y H:i:s",$filtervalue);
                    		}
                    		if(!$dateObj){
                    			$dateObj = DateUtil::StringToDateByGivenFormat("D M d Y H:i:s e+",$filtervalue);
                    		}
                    		if($dateObj){
                    			$dateObj->setTime(0,0);
                    			$filtervalue = $dateObj->format("Y-m-d H:i:s");
                    		}
                    	}
//                     	if($shipDatePos !== false){
//                     		$date = DateUtil::StringToDateByGivenFormat("m-d-Y", $filtervalue);
//                     		$filtervalue = $date->format("Y-m-d");
//                     	}
                        $where .= " " . $filterdatafield . " >= '" . $filtervalue ."'";
                        break;
                    case "LESS_THAN_OR_EQUAL":
                    	$date = strpos(strtolower ($filterdatafield),'date');
                    	$startDatePos = strpos(strtolower ($filterdatafield),'startdate');
                    	$endDatePos = strpos(strtolower ($filterdatafield),'enddate');
                    	$createdOnPos = strpos(strtolower ($filterdatafield),'createdon');
                    	$lastModifiedPos = strpos(strtolower ($filterdatafield),'lastmodifiedon');
                    	$shipDatePos = strpos(strtolower ($filterdatafield),'shipdate');
                    	$dateObj = true;
                    	if($startDatePos !== false || $endDatePos !== false || $date !== false){
               				 $dateObj = DateUtil::StringToDateByGivenFormat("m-d-Y", $filtervalue);
                    		 if(!$dateObj){
                    		 	$dateObj = DateUtil::StringToDateByGivenFormat("m-d-Y H:i A",$filtervalue);
                    		 }
                    		 if(!$dateObj){
                    		 	$dateObj = DateUtil::StringToDateByGivenFormat("D M d Y H:i:s e+",$filtervalue);
                    		 }
                    		 if($dateObj){
                    		 	$filtervalue = $dateObj->format("Y-m-d");
                    		 }
                    	}
                    	if($createdOnPos !== false || $lastModifiedPos !== false || !$dateObj){
                    		$dateObj = DateUtil::StringToDateByGivenFormat("m-d-Y", $filtervalue);
                    		if(!$dateObj){
                    			$dateObj = DateUtil::StringToDateByGivenFormat("m-d-Y H:i A",$filtervalue);
                    		}
                    		if(!$dateObj){
                    			$dateObj = DateUtil::StringToDateByGivenFormat("m-d-Y H:i:s",$filtervalue);
                    		}
                    		if(!$dateObj){
                    			$dateObj = DateUtil::StringToDateByGivenFormat("D M d Y H:i:s e+",$filtervalue);
                    		}
                    		if($dateObj){
                    			$dateObj->setTime(23,59);
                    			$filtervalue = $dateObj->format("Y-m-d H:i:s");
                    		}
                    	}
//                     	if($shipDatePos !== false){
//                     		$date = DateUtil::StringToDateByGivenFormat("m-d-Y", $filtervalue);
//                     		$filtervalue = $date->format("Y-m-d");
//                     	}
                        $where .= " " . $filterdatafield . " <= '" . $filtervalue ."'";
                        break;
                    case "STARTS_WITH_CASE_SENSITIVE":
                        $where .= " BINARY " . $filterdatafield . " LIKE '" . $filtervalue ."%'";
                        break;
                    case "STARTS_WITH":
                        $where .= " " . $filterdatafield . " LIKE '" . $filtervalue ."%'";
                        break;
                    case "ENDS_WITH_CASE_SENSITIVE":
                        $where .= " BINARY " . $filterdatafield . " LIKE '%" . $filtervalue ."'";
                        break;
                    case "ENDS_WITH":
                        $where .= " " . $filterdatafield . " LIKE '%" . $filtervalue ."'";
                        break;
                }
                                
                if ($i == $filterscount - 1)
                {
                    $where .= ")";
                }
                
                $tmpfilteroperator = $filteroperator;
                $tmpdatafield = $filterdatafield;            
            }
            // build the query.
            $groupByPos = strpos(strtolower ($query),'group by');
            $groupBy = "";
            if(!$isGroupBy){
	            if ($groupByPos !== false) {
	            	$q = substr($query, 0,$groupByPos). " ";
	            	$groupBy = substr($query,$groupByPos) ;
	            	$query = $q;
	            }
            }
            $query = $query . $where ." " . $groupBy;
        }
      }
      //apply Sorting 
      //apply limit
      if($isApplyLimit){
      	$query = FilterUtil::appendSorting($query);
        $query = FilterUtil::appendLimit($query);
      }
      
      return $query;
  }
}
?>
