<?php
require_once($ConstantsArray['dbServerUrl'] ."Enums/ShowTaskStatus.php");
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
                $query = $query . " ORDER BY" . " " . $sortfield . " DESC";
            }
            else if ($sortorder == "asc")
            {
                $query = $query . " ORDER BY" . " " . $sortfield . " ASC";
            }            
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
  
  public static function applyFilter($query,$isApplyLimit = true){
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
                    $where .= ")AND(";
                }
                else if ($tmpdatafield == $filterdatafield)
                {
                    if ($tmpfilteroperator == 0)
                    {
                        $where .= " AND ";
                    }
                    else $where .= " OR ";    
                }
                
                // build the "WHERE" clause depending on the filter's condition, value and datafield.
                switch($filtercondition)
                {
                    case "NOT_EMPTY":
                    case "NOT_NULL":
                        $where .= " " . $filterdatafield . " NOT LIKE '" . "" ."'";
                        break;
                    case "EMPTY":
                    case "NULL":
                        $where .= " " . $filterdatafield . " LIKE '" . "" ."'";
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
                    		if($filtervalue != ShowTaskStatus::delay && $filtervalue != ShowTaskStatus::pending){
                    			$filtervalue = ShowTaskStatus::getName($filtervalue);
                    			$where .= " " . $filterdatafield . " = '" . $filtervalue ."'";
                    		}else{
                    			$date = new DateTime();
                    			$date = $date->format("Y-m-d");
                    			if($filtervalue != ShowTaskStatus::pending){
                    				$where .= " ($filterdatafield = 'pending' or  $filterdatafield = 'inprocess') And enddate < '$date'";
                    			}else{
                    				$where .= " $filterdatafield = 'pending' And enddate > '$date'";
                    			}
                    			
                    		}
                    	}else{
                    		$where .= " " . $filterdatafield . " = '" . $filtervalue ."'";
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
                    	if($filterdatafield == "startdate" || $filterdatafield == "enddate"){
                    		 $date = DateUtil::StringToDateByGivenFormat("m-d-Y", $filtervalue);
                    		 $filtervalue = $date->format("Y-m-d");  
                    	}
                        $where .= " " . $filterdatafield . " >= '" . $filtervalue ."'";
                        break;
                    case "LESS_THAN_OR_EQUAL":
               			if($filterdatafield == "startdate" || $filterdatafield == "enddate"){
                    		 $date = DateUtil::StringToDateByGivenFormat("m-d-Y", $filtervalue);
                    		 $filtervalue = $date->format("Y-m-d");  
                    	}
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
            $query = $query . $where; 
           
            
        }
      }
      //apply Sorting
       $query = FilterUtil::appendSorting($query);
        
      //apply limit
      if($isApplyLimit){
        $query = FilterUtil::appendLimit($query);
      }
      
      return $query;
  }
}
?>
