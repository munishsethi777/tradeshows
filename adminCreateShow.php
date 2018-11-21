<?//include("SessionCheck.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Bookings</title>
    <?include "ScriptsInclude.php"?>
</head>
<body>
    <div id="wrapper">
    <?php include("adminmenuInclude.php")?>  
        <div id="page-wrapper" class="gray-bg">
	        <div class="row border-bottom">
	        </div>
        	<div class="row">
	            <div class="col-lg-12">
	                <div class="ibox">
	                    <div class="ibox-title">
	                    	 <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
								<a class="navbar-minimalize minimalize-styl-2 btn btn-primary "
									href="#"><i class="fa fa-bars"></i> </a>
									<h5 class="pageTitle">Create New Show</h5>
							</nav>
	                        
	                    </div>
	                    <div class="ibox-content">
	                    	
	                        <form id="bookingForm" method="post" action="Actions/BookingAction.php" class="m-t-lg">
	                        		<input type="hidden" id ="call" name="call"  value="saveBookingsFromAdmins"/>
	                       			<div class="form-group row">
	                       				<label class="col-lg-2 col-form-label">Show Title</label>
	                                    <div class="col-lg-8">
	                                    	<input type="text" id="title" name="title" required placeholder="Enter Show Title" class="form-control">
	                                    </div>
	                               </div>
	                               		<div class="form-group row">
	                               			<label class="col-lg-2 col-form-label">Show Description</label>
	                                		<div class="col-lg-8">
	                               				<input type="text" id="description" name="description" required 
			                                    placeholder="Enter Show Description" class="form-control">
		                                    </div>
		                                </div>
		                                <div class="form-group row">
		                                	<label class="col-lg-2 col-form-label">Start Date</label>
		                                    <div class="col-lg-3">
			                       				<input type="text" id="startDate" name="startDate" required 
			                                    placeholder="Enter Start Date" class="form-control">
		                                    </div>
		                                	<label class="col-lg-2 col-form-label">End Date</label>
		                                    <div class="col-lg-3">
			                       				<input type="text" id="startDate" name="startDate" required 
			                                    placeholder="Enter Start Date" class="form-control">
		                                    </div>
		                                </div>
		                                
                                	<hr>
                                 	<div class="form-group row">
                                 		<label class="col-lg-2 col-form-label"></label>
                                		<div class="col-lg-2">
	                                		<button class="btn btn-primary" onclick="submitBookingForm()" type="button" style="width:80%">
	                                			Save Booking
		                                	</button>
		                                </div>
		                                <div class="col-lg-2" style="text-align: right">
	                                		<button class="btn btn-default" onclick="submitBookingForm()" type="button" style="width:80%">
	                                			Cancel
		                                	</button>
	                                	</div>
	                                	
                                	</div>
                       			</form>
	                        
	                        
	                        	<div class="panel-body">
	                                <div class="panel-group" id="accordion">
	                                    <div class="panel panel-default">
	                                        <div class="panel-heading">
	                                            <h5 class="panel-title">
	                                                <a data-toggle="collapse" data-parent="#accordion" href="#div1" class="collapsed" aria-expanded="false">
	                                                SHOW INFORMATION</a>
	                                            </h5>
	                                        </div>
	                                        <div id="div1" class="panel-collapse in collapse" style="">
	                                            <div class="panel-body">
	                                                	<div class="form-group row">
					                                 		<label class="col-lg-3 col-form-label">Title</label>
					                                		<label class="col-lg-3 col-form-label">Assignees</label>
					                                		<label class="col-lg-2 col-form-label">StartDate</label>
					                                		<label class="col-lg-2 col-form-label">EndDate</label>
					                                		<label class="col-lg-2 col-form-label">Comments</label>
					                                	</div>
					                                	<div class="form-group row">
					                                 		<div class="col-lg-3 col-form-label">
																	<input type="text" name="title" class="form-control">
															</div>
															<div class="col-lg-3 col-form-label">
																	<input type="text" name="assignees" class="form-control">
															</div>
															<div class="col-lg-2 col-form-label">
																	<input type="text" name="startdate" class="form-control">
															</div>
															<div class="col-lg-2 col-form-label">
																	<input type="text" name="enddate" class="form-control">
															</div>
															<div class="col-lg-2 col-form-label">
																	<input type="text" name="comments" class="form-control">
															</div>
					                                	</div>
					                                	
					                                	<div class="form-group row">
					                                 		<div class="col-lg-3 col-form-label">
																	<input type="text" name="title" class="form-control">
															</div>
															<div class="col-lg-3 col-form-label">
																	<input type="text" name="assignees" class="form-control">
															</div>
															<div class="col-lg-2 col-form-label">
																	<input type="text" name="startdate" class="form-control">
															</div>
															<div class="col-lg-2 col-form-label">
																	<input type="text" name="enddate" class="form-control">
															</div>
															<div class="col-lg-2 col-form-label">
																	<input type="text" name="comments" class="form-control">
															</div>
					                                	</div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    
	                                    <div class="panel panel-default">
	                                        <div class="panel-heading">
	                                            <h5 class="panel-title">
	                                                <a data-toggle="collapse" data-parent="#accordion" href="#div2" class="collapsed" aria-expanded="false">
	                                                SHOW INFORMATION</a>
	                                            </h5>
	                                        </div>
	                                        <div id="div2" class="panel-collapse collapse" style="">
	                                            <div class="panel-body">
	                                                	<div class="form-group row">
					                                 		<label class="col-lg-3 col-form-label">Title</label>
					                                		<label class="col-lg-3 col-form-label">Assignees</label>
					                                		<label class="col-lg-2 col-form-label">StartDate</label>
					                                		<label class="col-lg-2 col-form-label">EndDate</label>
					                                		<label class="col-lg-2 col-form-label">Comments</label>
					                                	</div>
					                                	<div class="form-group row">
					                                 		<div class="col-lg-3 col-form-label">
																	<input type="text" name="title" class="form-control">
															</div>
															<div class="col-lg-3 col-form-label">
																	<input type="text" name="assignees" class="form-control">
															</div>
															<div class="col-lg-2 col-form-label">
																	<input type="text" name="startdate" class="form-control">
															</div>
															<div class="col-lg-2 col-form-label">
																	<input type="text" name="enddate" class="form-control">
															</div>
															<div class="col-lg-2 col-form-label">
																	<input type="text" name="comments" class="form-control">
															</div>
					                                	</div>
					                                	
					                                	<div class="form-group row">
					                                 		<div class="col-lg-3 col-form-label">
																	<input type="text" name="title" class="form-control">
															</div>
															<div class="col-lg-3 col-form-label">
																	<input type="text" name="assignees" class="form-control">
															</div>
															<div class="col-lg-2 col-form-label">
																	<input type="text" name="startdate" class="form-control">
															</div>
															<div class="col-lg-2 col-form-label">
																	<input type="text" name="enddate" class="form-control">
															</div>
															<div class="col-lg-2 col-form-label">
																	<input type="text" name="comments" class="form-control">
															</div>
					                                	</div>
	                                            </div>
	                                        </div>
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