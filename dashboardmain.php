<?include("sessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Dashboard</title>
    <?include "ScriptsInclude.php"?>
    <style type="text/css">
    	h1{font-size:38pt}
    	a{color:white}
    </style>
</head>
<body>
<div id="wrapper">
	<div id="page-wrapper" class="gray-bg" style="margin:0px">
		<div class="row border-bottom"></div>
        <div class="row m-t-xl">
			<div class="col-lg-8 col-lg-offset-2">
	        	<div class="ibox">
					
					
					<div class="ibox-content m-t-sm m-b-sm">
						<div class="row">
							<div class="col-lg-4">
		                        <div class="widget bg-danger text-center  p-h-xl">
		                        	<div class="row">
		                        		<a href="adminManageQCSchedules.php">
		                        		<h1 class="m-t-xs font-bold"><i class="fa fa-clock-o"></i></h1>
		                                <span>Schedule Management</span></a>
		                            </div>
								</div>
	                        </div>
							
							<div class="col-lg-4">
		                        <div class="widget bg-warning text-center p-h-xl">
		                        	<div class="row">
		                        		<a href="adminManageItemSpecifications.php">
		                        		<h1 class="m-t-xs font-bold"><i class="fa fa-cubes"></i></h1>
		                                <span>Master Sheet Management</span></a>
		                            </div>
								</div>
	                        </div>
	                        
	                        
	                        <div class="col-lg-4">
		                        <div class="widget bg-info text-center  p-h-xl">
		                        	<div class="row">
		                        		<a href="adminShowList.php">
		                        		<h1 class="m-t-xs font-bold"><i class="fa fa-calendar"></i></h1>
		                                <span>Show Management</span></a>
		                            </div>
								</div>
	                        </div>
	                    </div>
            		</div>
	                
	                
	            </div>
        	</div>
       </div>
    </div>

   </body>
   
</html>
