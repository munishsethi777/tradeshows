<?include("SessionCheckUser.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
$session = SessionUtil::getInstance();
$userFullName = $session->getUserLoggedInName();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User | Dashboard</title>
    <?include "ScriptsInclude.php"?>
</head>
<body>
<div id="wrapper">
<?php include("usermenuinclude.php")?>  
	<div id="page-wrapper" class="gray-bg">
		<div class="row border-bottom"></div>
        <div class="row">
			<div class="col-lg-12">
	        	<div class="ibox">
					<div class="ibox-title">
						<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
								<a class="navbar-minimalize minimalize-styl-2 btn btn-info"
									href="#"><i class="fa fa-bars"></i> </a>
									<h4 class="p-h-sm font-normal"> Dashboard</h4>
						</nav>
						
					</div>
					
					
					<div class="row">
	                    <div class="col-sm-15">
	                        <div class="ibox ">
	                            <div class="ibox-title">
	                                <span class="label label-default float-right">Total</span>
	                                <h5>Assigned</h5>
	                            </div>
	                            <div class="ibox-content">
	                                <h1 class="no-margins">567</h1>
	                                <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
	                                <!-- <small>Tasks alloted to you</small> -->
	                            </div>
	                        </div>
	                    </div>
	                    <div class="col-sm-15">
	                        <div class="ibox ">
	                            <div class="ibox-title">
	                                <span class="label label-primary float-right">Moderate</span>
	                                <h5>Completed</h5>
	                            </div>
	                            <div class="ibox-content">
	                                <h1 class="no-margins">200</h1>
	                                <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
	                                <!--<small>Tasks completed by you</small>-->
	                            </div>
	                        </div>
	                    </div>
	                    <div class="col-sm-15">
	                        <div class="ibox ">
	                            <div class="ibox-title">
	                                <span class="label label-danger float-right">High Value</span>
	                                <h5>InProcess</h5>
	                            </div>
	                            <div class="ibox-content">
	                                <h1 class="no-margins">237</h1>
	                                <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
	                                <!--<small>Pending task to be processed</small>-->
	                            </div>
	                        </div>
	                    </div>
	                    <div class="col-sm-15">
	                        <div class="ibox ">
	                            <div class="ibox-title">
	                                <span class="label label-warning float-right">Low value</span>
	                                <h5>Pending</h5>
	                            </div>
	                            <div class="ibox-content">
	                                <h1 class="no-margins">130</h1>
	                                <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div>
	                                <!--<small>Tasks in process.</small>-->
	                            </div>
                        	</div>
                      	</div>
                      	<div class="col-sm-15">
	                        <div class="ibox ">
	                            <div class="ibox-title">
	                                <span class="label label-warning float-right">Low value</span>
	                                <h5>Delayed</h5>
	                            </div>
	                            <div class="ibox-content">
	                                <h1 class="no-margins">130</h1>
	                                <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div>
	                                <!--<small>Tasks in process.</small>-->
	                            </div>
                        	</div>
                      	</div>
        </div>
					
					<div class="row">
						<div class="col-lg-5">
							<div class="ibox">
								<div class="ibox-title">
	                                <h5>Upcoming Shows & Progress</h5>
	                            </div>
								<div class="ibox-content">
							        <ul class="list-group clear-list">
			                            <li class="list-group-item fist-item">
			                                <span class="float-right label label-danger m-l-xs" title="Pending Tasks">02</span> 
			                                <span class="float-right label label-warning m-l-xs"  title="In Process Tasks">03</span>
			                                <span class="float-right label label-primary m-l-xs"  title="Completed Tasks">10</span>
			                                <h4>Nov 30 2018 - Dec 2 2018</h4> <span class="text-muted">The International WorkBoat Show. The Int'l WorkBoat Show.</span>
			                            </li>
			                            
			                            <li class="list-group-item">
			                                <span class="float-right label label-danger m-l-xs" title="Pending Tasks">12</span> 
			                                <span class="float-right label label-warning m-l-xs"  title="In Process Tasks">03</span>
			                                <span class="float-right label label-primary m-l-xs"  title="Completed Tasks">05</span>
			                                <h4>Dec 10 2018 - Dec 12 2018</h4> <span class="text-muted">FRANCHISE EXPO WEST - LOS ANGELES</span>
			                            </li>
			                            
			                            <li class="list-group-item">
			                                <span class="float-right label label-danger m-l-xs" title="Pending Tasks">06</span> 
			                                <span class="float-right label label-warning m-l-xs"  title="In Process Tasks">05</span>
			                                <span class="float-right label label-primary m-l-xs"  title="Completed Tasks">06</span>
			                                <h4>Dec 18 2018 - Dec 19 2018</h4> <span class="text-muted">CareerTech Vision. Career Tech Expo</span>
			                            </li>
			                            
			                            <li class="list-group-item">
			                                <span class="float-right label label-danger m-l-xs" title="Pending Tasks">01</span> 
			                                <span class="float-right label label-warning m-l-xs"  title="In Process Tasks">03</span>
			                                <span class="float-right label label-primary m-l-xs"  title="Completed Tasks">16</span>
			                                <h4>Dec 30 2018 - Jan 2 2019</h4> <span class="text-muted">LA Auto Show. Los Angeles Auto Show.</span>
			                            </li>
			                            
			                            
			                            <li class="list-group-item">
			                                <span class="float-right label label-danger m-l-xs" title="Pending Tasks">13</span> 
			                                <span class="float-right label label-warning m-l-xs"  title="In Process Tasks">03</span>
			                                <span class="float-right label label-primary m-l-xs"  title="Completed Tasks">04</span>
			                                <h4>Jan 4 2019 - Jan 4 2019</h4> <span class="text-muted">Power-Gen International. The Global Power Generation Exhibition & Conference.</span>
			                            </li>
			                            
			                            <li class="list-group-item">
			                                <span class="float-right label label-danger m-l-xs" title="Pending Tasks">00</span> 
			                                <span class="float-right label label-warning m-l-xs"  title="In Process Tasks">10</span>
			                                <span class="float-right label label-primary m-l-xs"  title="Completed Tasks">08</span>
			                                <h4>Jan 12 2019 - Jan 18 2019</h4> <span class="text-muted">Critical Infrastructure Protection and Resilience Americas.</span>
			                            </li>
			                            <li class="list-group-item">
			                                <span class="float-right label label-danger m-l-xs" title="Pending Tasks">00</span> 
			                                <span class="float-right label label-warning m-l-xs"  title="In Process Tasks">10</span>
			                                <span class="float-right label label-primary m-l-xs"  title="Completed Tasks">08</span>
			                                <h4>Jan 12 2019 - Jan 18 2019</h4> <span class="text-muted">Critical Infrastructure Protection and Resilience Americas.</span>
			                            </li>
			                            <li class="list-group-item">
			                                <span class="float-right label label-danger m-l-xs" title="Pending Tasks">00</span> 
			                                <span class="float-right label label-warning m-l-xs"  title="In Process Tasks">10</span>
			                                <span class="float-right label label-primary m-l-xs"  title="Completed Tasks">08</span>
			                                <h4>Jan 12 2019 - Jan 18 2019</h4> <span class="text-muted">Critical Infrastructure Protection and Resilience Americas.</span>
			                            </li>
			                            <li class="list-group-item">
			                                <span class="float-right label label-danger m-l-xs" title="Pending Tasks">00</span> 
			                                <span class="float-right label label-warning m-l-xs"  title="In Process Tasks">10</span>
			                                <span class="float-right label label-primary m-l-xs"  title="Completed Tasks">08</span>
			                                <h4>Jan 12 2019 - Jan 18 2019</h4> <span class="text-muted">Critical Infrastructure Protection and Resilience Americas.</span>
			                            </li>
			                            <li class="list-group-item">
			                                <span class="float-right label label-danger m-l-xs" title="Pending Tasks">00</span> 
			                                <span class="float-right label label-warning m-l-xs"  title="In Process Tasks">10</span>
			                                <span class="float-right label label-primary m-l-xs"  title="Completed Tasks">08</span>
			                                <h4>Jan 12 2019 - Jan 18 2019</h4> <span class="text-muted">Critical Infrastructure Protection and Resilience Americas.</span>
			                            </li>
			                            <li class="list-group-item">
			                                <a class="float-right" href="#">Show All</a>
			                            </li>
			                            
			                        </ul>
					           </div>
			                </div>
		                </div>
		                
		                <div class="col-lg-7">
							<div class="ibox float-e-margins">
                            	<div class="ibox-title">
                                	<h5>Tasks Assigned and Tasks Completed</h5>
	                                <div class="pull-right">
	                                    <div class="btn-group">
	                                        <button type="button" class="btn btn-xs btn-white active">Today</button>
	                                        <button type="button" class="btn btn-xs btn-white">Monthly</button>
	                                        <button type="button" class="btn btn-xs btn-white">Annual</button>
	                                    </div>
	                                </div>
                            	</div>
	                            <div class="ibox-content">
	                                <div class="row">
		                                <div class="col-lg-12">
		                                    <div class="flot-chart">
		                                        <div class="flot-chart-content" id="flot-dashboard-chart"></div>
		                                    </div>
		                                </div>
						           </div>
				                </div>
		                	</div>
		                	
		                	<div class="ibox float-e-margins">
                            	<div class="ibox-title">
                                	<h5>New Shows saved in system</h5>
	                                <div class="pull-right">
	                                    
	                                </div>
                            	</div>
	                            <div class="ibox-content">
	                                <div class="row">
		                                <div class="col-lg-12">
		                                    <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>

                        <th>Show</th>
                        <th>Description </th>
                        <th>Starts </th>
                        <th>Ends </th>
                        <th>Tasks </th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Project <small>This is example of project</small></td>
                        <td>Patrick Smith</td>
                        <td>04/22/2019</td>
                        <td>04/23/2019</td>
                        <td><span class="pie" style="display: none;">0.52/1.561</span><svg class="peity" height="16" width="16"><path d="M 8 8 L 8 0 A 8 8 0 0 1 14.933563796318165 11.990700825968545 Z" fill="#1ab394"></path><path d="M 8 8 L 14.933563796318165 11.990700825968545 A 8 8 0 1 1 7.999999999999998 0 Z" fill="#d7d7d7"></path></svg></td>
                        <td><a href="#"><i class="fa fa-play text-navy"></i></a></td>
                    </tr>
                    <tr>
                        <td>Alpha project</td>
                        <td>Alice Jackson</td>
                        <td>04/29/2019</td>
                        <td>04/30/2019</td>
                        <td><span class="pie" style="display: none;">6,9</span><svg class="peity" height="16" width="16"><path d="M 8 8 L 8 0 A 8 8 0 0 1 12.702282018339787 14.47213595499958 Z" fill="#1ab394"></path><path d="M 8 8 L 12.702282018339787 14.47213595499958 A 8 8 0 1 1 7.999999999999998 0 Z" fill="#d7d7d7"></path></svg></td>
                        <td><a href="#"><i class="fa fa-play text-navy"></i></a></td>
                    </tr>
                    <tr>
                        <td>Betha project</td>
                        <td>John Smith</td>
                        <td>05/04/2019</td>
                        <td>05/08/2019</td>
                        <td><span class="pie" style="display: none;">3,1</span><svg class="peity" height="16" width="16"><path d="M 8 8 L 8 0 A 8 8 0 1 1 0 8.000000000000002 Z" fill="#1ab394"></path><path d="M 8 8 L 0 8.000000000000002 A 8 8 0 0 1 7.999999999999998 0 Z" fill="#d7d7d7"></path></svg></td>
                        <td><a href="#"><i class="fa fa-play text-navy"></i></a></td>
                    </tr>
                    <tr>
                        <td>Gamma project</td>
                        <td>Anna Jordan</td>
                        <td>05/12/2019</td>
                        <td>05/15/2019</td>
                        <td><span class="pie" style="display: none;">4,9</span><svg class="peity" height="16" width="16"><path d="M 8 8 L 8 0 A 8 8 0 0 1 15.48012994148332 10.836839096340286 Z" fill="#1ab394"></path><path d="M 8 8 L 15.48012994148332 10.836839096340286 A 8 8 0 1 1 7.999999999999998 0 Z" fill="#d7d7d7"></path></svg></td>
                        <td><a href="#"><i class="fa fa-play text-navy"></i></a></td>
                    </tr>
                    <tr>
                        <td>Alpha project</td>
                        <td>Alice Jackson</td>
                        <td>05/22/2019</td>
                        <td>05/29/2019</td>
                        <td><span class="pie" style="display: none;">6,9</span><svg class="peity" height="16" width="16"><path d="M 8 8 L 8 0 A 8 8 0 0 1 12.702282018339787 14.47213595499958 Z" fill="#1ab394"></path><path d="M 8 8 L 12.702282018339787 14.47213595499958 A 8 8 0 1 1 7.999999999999998 0 Z" fill="#d7d7d7"></path></svg></td>
                        <td><a href="#"><i class="fa fa-play text-navy"></i></a></td>
                    </tr>
                    <tr>
                        <td>Project <small>This is example of project</small></td>
                        <td>Patrick Smith</td>
                        <td>06/01/2019</td>
                        <td>06/03/2019</td>
                        <td><span class="pie" style="display: none;">0.52/1.561</span><svg class="peity" height="16" width="16"><path d="M 8 8 L 8 0 A 8 8 0 0 1 14.933563796318165 11.990700825968545 Z" fill="#1ab394"></path><path d="M 8 8 L 14.933563796318165 11.990700825968545 A 8 8 0 1 1 7.999999999999998 0 Z" fill="#d7d7d7"></path></svg></td>
                        <td><a href="#"><i class="fa fa-play text-navy"></i></a></td>
                    </tr>
                    <tr>
                        <td>Gamma project</td>
                        <td>Anna Jordan</td>
                        <td>06/20/2019</td>
                        <td>06/23/2019</td>
                        <td><span class="pie" style="display: none;">4,9</span><svg class="peity" height="16" width="16"><path d="M 8 8 L 8 0 A 8 8 0 0 1 15.48012994148332 10.836839096340286 Z" fill="#1ab394"></path><path d="M 8 8 L 15.48012994148332 10.836839096340286 A 8 8 0 1 1 7.999999999999998 0 Z" fill="#d7d7d7"></path></svg></td>
                        <td><a href="#"><i class="fa fa-play text-navy"></i></a></td>
                    </tr>
                   
                    </tbody>
                </table>
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
    <form id="form1" name="form1" method="post" action="adminEditBooking.php">
     	<input type="hidden" id="seq" name="seq"/>
     	<input type="hidden" id="isView" name="isView" value="0"/>
   	</form>
   </body>
   
</html>

	<script type="text/javascript">
	
	 isSelectAll = false;
        $(document).ready(function(){
        	function gd(year, month, day) {
                return new Date(year, month - 1, day).getTime();
            }
            	
        	    var data2 = [
                    [gd(2012, 1, 1), 7], [gd(2012, 1, 2), 6], [gd(2012, 1, 3), 4], [gd(2012, 1, 4), 8],
                    [gd(2012, 1, 5), 9], [gd(2012, 1, 6), 7], [gd(2012, 1, 7), 5], [gd(2012, 1, 8), 4],
                    [gd(2012, 1, 9), 7], [gd(2012, 1, 10), 8], [gd(2012, 1, 11), 9], [gd(2012, 1, 12), 6],
                    [gd(2012, 1, 13), 4], [gd(2012, 1, 14), 5], [gd(2012, 1, 15), 11], [gd(2012, 1, 16), 8],
                    [gd(2012, 1, 17), 8], [gd(2012, 1, 18), 11], [gd(2012, 1, 19), 11], [gd(2012, 1, 20), 6],
                    [gd(2012, 1, 21), 6], [gd(2012, 1, 22), 8], [gd(2012, 1, 23), 11], [gd(2012, 1, 24), 13],
                    [gd(2012, 1, 25), 7], [gd(2012, 1, 26), 9], [gd(2012, 1, 27), 9], [gd(2012, 1, 28), 8],
                    [gd(2012, 1, 29), 5], [gd(2012, 1, 30), 8], [gd(2012, 1, 31), 25]
                ];

                var data3 = [
                    [gd(2012, 1, 1), 800], [gd(2012, 1, 2), 500], [gd(2012, 1, 3), 600], [gd(2012, 1, 4), 700],
                    [gd(2012, 1, 5), 500], [gd(2012, 1, 6), 456], [gd(2012, 1, 7), 800], [gd(2012, 1, 8), 589],
                    [gd(2012, 1, 9), 467], [gd(2012, 1, 10), 876], [gd(2012, 1, 11), 689], [gd(2012, 1, 12), 700],
                    [gd(2012, 1, 13), 500], [gd(2012, 1, 14), 600], [gd(2012, 1, 15), 700], [gd(2012, 1, 16), 786],
                    [gd(2012, 1, 17), 345], [gd(2012, 1, 18), 888], [gd(2012, 1, 19), 888], [gd(2012, 1, 20), 888],
                    [gd(2012, 1, 21), 987], [gd(2012, 1, 22), 444], [gd(2012, 1, 23), 999], [gd(2012, 1, 24), 567],
                    [gd(2012, 1, 25), 786], [gd(2012, 1, 26), 666], [gd(2012, 1, 27), 888], [gd(2012, 1, 28), 900],
                    [gd(2012, 1, 29), 178], [gd(2012, 1, 30), 555], [gd(2012, 1, 31), 993]
                ];


                var dataset = [
                    {
                        label: "Assigned",
                        data: data3,
                        color: "#1ab394",
                        bars: {
                            show: true,
                            align: "center",
                            barWidth: 24 * 60 * 60 * 600,
                            lineWidth:0
                        }

                    }, {
                        label: "Completed",
                        data: data2,
                        yaxis: 2,
                        color: "#1C84C6",
                        lines: {
                            lineWidth:1,
                                show: true,
                                fill: true,
                            fillColor: {
                                colors: [{
                                    opacity: 0.2
                                }, {
                                    opacity: 0.4
                                }]
                            }
                        },
                        splines: {
                            show: false,
                            tension: 0.6,
                            lineWidth: 1,
                            fill: 0.1
                        },
                    }
                ];


                var options = {
                    xaxis: {
                        mode: "time",
                        tickSize: [3, "day"],
                        tickLength: 0,
                        axisLabel: "Date",
                        axisLabelUseCanvas: true,
                        axisLabelFontSizePixels: 12,
                        axisLabelFontFamily: 'Arial',
                        axisLabelPadding: 10,
                        color: "#d5d5d5"
                    },
                    yaxes: [{
                        position: "left",
                        max: 1070,
                        color: "#d5d5d5",
                        axisLabelUseCanvas: true,
                        axisLabelFontSizePixels: 12,
                        axisLabelFontFamily: 'Arial',
                        axisLabelPadding: 3
                    }, {
                        position: "right",
                        clolor: "#d5d5d5",
                        axisLabelUseCanvas: true,
                        axisLabelFontSizePixels: 12,
                        axisLabelFontFamily: ' Arial',
                        axisLabelPadding: 67
                    }
                    ],
                    legend: {
                        noColumns: 1,
                        labelBoxBorderColor: "#000000",
                        position: "nw"
                    },
                    grid: {
                        hoverable: false,
                        borderWidth: 0
                    }
                };

                
                $.plot($("#flot-dashboard-chart"), dataset, options);

            });



        
        function deleteBooking(gridId,deleteURL){
            var selectedRowIndexes = $("#" + gridId).jqxGrid('selectedrowindexes');
            if(selectedRowIndexes.length > 0){
                bootbox.confirm("Are you sure you want to delete selected row(s)?", function(result) {
                    if(result){
                        var ids = [];
                        var imagenames = [];
                        var flag = true;
                        $.each(selectedRowIndexes, function(index , value){
                            if(value != -1){
                                var dataRow = $("#" + gridId).jqxGrid('getrowdata', value);
                                var paymentid = dataRow.transactionid;
                                if(paymentid != null && paymentid != ""){
                                	 alert("Processed bookings cannot be deleted");
                                	 flag = false;
                                	 return;
                                }
                                ids.push(dataRow.seq);
                            }
                        });
                        if(!flag){
                           return;
                        }
                        $.get(deleteURL + "&ids=" + ids,function( data ){
                            if(data != ""){
                                var obj = $.parseJSON(data);
                                var message = obj.message;
                                if(obj.success == 1){

                                    toastr.success(message,'Success');
                                   //$.each(selectedRowIndexes, function(index , value){
                                      //  var id = $("#"  + gridId).jqxGrid('getrowid', value);
                                        var commit = $("#"  + gridId).jqxGrid('deleterow', ids);
                                        $("#"+gridId).jqxGrid('updatebounddata');
                                        $("#"+gridId).jqxGrid('clearselection');
                                    //});
                                }else{
                                    toastr.error(message,'Failed');
                                }
                            }

                        });

                    }
                });
            }else{
                 bootbox.alert("No row selected.Please select row to delete!", function() {});
            }
        }    
        function loadGrid(menus){
            
            var columns = [
			  { text: 'Payment ID', datafield: 'transactionid', width:"10%"}, 			
			  { text: 'id', datafield: 'seq' , hidden:true},
              { text: 'Booked On', datafield: 'bookedon',filtertype: 'date' ,cellsformat: 'd-M-yyyy',width:"12%",cellsalign: 'right'},
              { text: 'Booking Date', datafield: 'bookingdate', filtertype: 'date',cellsformat: 'd-M-yyyy',width:"10%",cellsalign: 'right'},
              { text: 'Slot', datafield: 'timeslots.title',width:"12%",filtertype: 'checkedlist',cellsalign: 'right'},
              { text: 'Menu', datafield: 'menus.title', width:"12%" ,filtertype: 'checkedlist',sortable:false,filteritems:menus},
              { text: 'Customer Name', datafield: 'fullname',width:"12%"},
              { text: 'Email', datafield: 'emailid',width:"18%"},
              { text: 'Mobile', datafield: 'mobilenumber',width:"10%"}
            ]
           
            var source =
            {
                datatype: "json",
                id: 'id',
                pagesize: 20,
                sortcolumn: 'bookedon',
                sortdirection: 'desc',
                datafields: [{ name: 'seq', type: 'integer' },
                            { name: 'bookedon', type: 'datetime' },
                            { name: 'bookingdate', type: 'date' },
                            { name: 'transactionid', type: 'string'},
                            { name: 'timeslots.title', type: 'string'},
                            { name: 'emailid', type: 'string'},
                            { name: 'fullname', type: 'string'},
                            { name: 'mobilenumber', type: 'string'},
                            { name: 'menus.title', type: 'string' }
                            ],                          
                url: 'Actions/BookingAction.php?call=getBookings',
                root: 'Rows',
                cache: false,
                beforeprocessing: function(data)
                {        
                    source.totalrecords = data.TotalRows;
                },
                filter: function()
                {
                    // update the grid and send a request to the server.
                    $("#bookingsgrid").jqxGrid('updatebounddata', 'filter');
                },
                sort: function()
                {
                    // update the grid and send a request to the server.
                    $("#bookingsgrid").jqxGrid('updatebounddata', 'sort');
                }
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            // initialize jqxGrid
            
            $("#bookingsgrid").jqxGrid(
            {
            	width: '100%',
    			height: '75%',
    			source: dataAdapter,
    			filterable: true,
    			showfilterrow: true,
    			sortable: true,
    			autoshowfiltericon: true,
    			columns: columns,
    			pageable: true,
    			altrows: true,
    			enabletooltips: true,
    			columnsresize: true,
    			columnsreorder: true,
    			showstatusbar: true,
    			selectionmode: 'checkbox',
    			virtualmode: true,
    			rendergridrows: function (toolbar) {
                  return dataAdapter.records;     
           		 },
                renderstatusbar: function (statusbar) {
                    // appends buttons to the status bar.
                    var container = $("<div style='overflow: hidden; position: relative; margin: 5px;height:30px'></div>");
                    var reloadButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-refresh'></i><span style='margin-left: 4px; position: relative;'>Reload</span></div>");
                    var addButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-plus-square'></i><span style='margin-left: 4px; position: relative;'>    Add</span></div>");
                    var deleteButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-times-circle'></i><span style='margin-left: 4px; position: relative;'>Delete</span></div>");
                    var editButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-edit'></i><span style='margin-left: 4px; position: relative;'>Edit</span></div>");
                    var viewButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-edit'></i><span style='margin-left: 4px; position: relative;'>View</span></div>");
	

                    container.append(addButton);
                    container.append(viewButton);
                    container.append(editButton);
                    container.append(deleteButton);
                    

                    statusbar.append(container);
                    addButton.jqxButton({  width: 65, height: 18 });
                    deleteButton.jqxButton({  width: 70, height: 18 });
                    editButton.jqxButton({  width: 65, height: 18 });
                    viewButton.jqxButton({  width: 65, height: 18 });

                    // create new row.
                    addButton.click(function (event) {
                        location.href = ("adminEditBooking.php");
                    });
                    // update row.
                    editButton.click(function (event){
                    	var selectedrowindex = $("#bookingsgrid").jqxGrid('selectedrowindexes');
                        var value = -1;
                        indexes = selectedrowindex.filter(function(item) { 
                            return item !== value
                        })
                        if(indexes.length != 1){
                            bootbox.alert("Please Select single row for edit.", function() {});
                            return;    
                        }
                        var row = $('#bookingsgrid').jqxGrid('getrowdata', indexes);
                        $("#seq").val(row.seq);                        
                        $("#form1").submit();    
                    });
                    viewButton.click(function (event){
                    	var selectedrowindex = $("#bookingsgrid").jqxGrid('selectedrowindexes');
                        var value = -1;
                        indexes = selectedrowindex.filter(function(item) { 
                            return item !== value
                        })
                        if(indexes.length != 1){
                            bootbox.alert("Please Select single row for edit.", function() {});
                            return;    
                        }
                        var row = $('#bookingsgrid').jqxGrid('getrowdata', indexes);
                        $("#seq").val(row.seq);
                        $("#isView").val(1);                              
                        $("#form1").submit();    
                    });
                    // delete row.
                    deleteButton.click(function (event) {
                        gridId = "bookingsgrid";
                        deleteUrl = "Actions/BookingAction.php?call=deleteBooking";
                        deleteBooking(gridId,deleteUrl);
                    });
                    reloadButton.jqxButton({  width: 70, height: 18 });
                    reloadButton.click(function (event) {
                        $("#bookingsgrid").jqxGrid({ source: dataAdapter });
                    });
                }
            });
        }

        
</script>