<?php 
require_once('IConstants.inc');
//require_once($ConstantsArray['dbServerUrl'] ."Utils/MailUtil.php");
//MailUtil::sendSmtpMail("test subject","body","munishsethi777@gmail.com");

?>
<html>
<head>
<title>Booking</title>
	<?include "ScriptsInclude.php"?>
	<style>
		.xdsoft_datetimepicker{
			width: 100%;
		}
		.xdsoft_datetimepicker .active{
			width:97%;
		}
		.xdsoft_datetimepicker .xdsoft_label{
			z-index:0 !important;
		}
		.datediv1{
			display:none;
		}
		.progressCol{
			width: 16.66%;
		}
		
		
		@media all  
			and (max-width: 768px) {
		  	.datediv2, .tableHeaders, .dateCol{
			    display: none;
			 }
		  	.datediv1 {
		    	display: block;
		  	}
		  	.progressCol{
		  		width: 30%;
		  	}
		  	.inmodal .modal-header {
				padding: 20px 15px;
				text-align: center;
			}
			.modal-body {
				padding: 10px 30px 10px 20px;
			}
			.inmodal .modal-title {
				font-size: 20px;
			}
		}
	</style>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
 <div id="wrapper">
	<div class="wrapper wrapper-content animated fadeIn">
       <div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins ">
					<div class="ibox-title">
						<h5>
							FLY DINING<small> select your bookings</small>
						</h5>
					</div>
					<div style="margin-top:10px">
						<div class="col-sm-3 datediv1">
                       		<input type="text" onchange="javascript:loadData(this.value)" 
                       		name="bookingDate" id="bookingDate" class="form-control bookingDate" style="width:100%"> 	
                    	</div>
						
                    	<div class="col-sm-9" id="dataDiv">
                       		
                    	</div>

                    	<div class="col-sm-3 datediv2" >
                       		<input type="text" onchange="javascript:loadData(this.value)" 
                       		name="bookingDate" id="bookingDate" class="form-control bookingDate" style="width:100%"> 	
                    	</div>

                    </div>
                    
				</div>
			</div>
		</div>
   	</div>
 </div>	

	
						<form role="form" id="bookingForm" method="post" action="bookingsummary.php" class="form-inline">
							<input type="hidden" id ="timeslotseq" name="timeslotseq" />
							<input type="hidden" id ="selectedDate" name="selectedDate" />
							<input type="hidden" id ="menuMembers" name="menuMembers" />
							<input type="hidden" id ="isTestMode" name="isTestMode" value="1"/>
							<div class="modal inmodal" id="myModal4" tabindex="-1" role="dialog"  aria-hidden="true">
							    <div class="modal-dialog">
                                    <div class="modal-content animated fadeIn">
	                                        <div class="modal-header">
	                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	                                            <h4 class="modal-title">How Many Persons?</h4>
	                                        </div>
	                                        <div class="modal-body">
	                                        	<div id="personCounts" class="row i-checks text-center"></div>
	                                        		
										    </div>
	                                        <div id = "footerDiv" class="modal-footer"></div>
	                                    </div>
	                                </div>
	                            </div>
                            </form>
</body>
</html>
 <script src="scripts/FormValidators/BookingFormValidations.js"></script> 
<script type="text/javascript">
$(document).ready(function(){ 
	currDate = new Date();
	minDate = new Date();
	//if(currDate.getHours() >= 13){
		//currDate.setDate(currDate.getDate() + 1);
		//minDate.setDate(minDate.getDate() + 1);
	//}
	
	$('.bookingDate').datetimepicker({
        timepicker:false,
        inline: true,
        sideBySide: true,
        format:'d-m-Y',
        useCurrent:false,
        defaultDate:currDate,
        minDate:minDate,
    });
	currDate = getCurrentDate(currDate);
	loadData(currDate);
});
function loadData(selectedDate){
	var from = selectedDate.split("-")
	var d = new Date(from[2], from[1] - 1, from[0])
	
	var weekday=new Array(7);
	weekday[0]="Sunday";
	weekday[1]="Monday";
	weekday[2]="Tuesday";
	weekday[3]="Wednesday";
	weekday[4]="Thursday";
	weekday[5]="Friday";
	weekday[6]="Saturday";
	var n = weekday[d.getDay()];
	
	$.getJSON("Actions/TimeSlotAction.php?call=getTimeSlots&selectedDate="+selectedDate, function(data){
		  //var data = $.parseJSON(jsonString)
			var html = getHeaders();
			if(data.length == 0){
				html += "<center style='margin-top:10px;'>No Timeslots available for booking, please select some other date</center>";
			}
		 $.each( data, function( key, val ) {
	 		html += '<div class="row ibox-content">';
			html += '<div class="col-xs-2 dateCol">'+selectedDate+ '<br><small class="text-muted">'+n+'</small>' +'</div>';
			html += '<div class="col-xs-3 timeslotCol">'+val.timeslot;
			html += '<br/><small class="text-muted">'+ val.description  +'</small></div>';
			var fair = "";
			var menuList = val.menu; 
			var menuArr = [];
			var menuSeqs = [];
			$.each( menuList, function( k, menu ) {
				fair += "Rs. " + menu.rate +"<small class='text-muted'> ("+menu.menutitle+")</small><br>";	
				menuArr[k] = menu.menutitle;
				menuSeqs[k] = menu.menuseq
	 		});
			html += '<div class="col-xs-3 fairCol">' + fair + '</div>';
			html += '<div class="col-xs-2 text-center progressCol"><div class="progress progress-mini">';
			progressBarClass = "bg-primary";
			if(val.availableInPercent > 0 && val.availableInPercent <=25){
				progressBarClass = "bg-danger";
			}else if(val.availableInPercent > 25 && val.availableInPercent <=75){
				progressBarClass = "bg-warning";
			}
			if(val.seatsAvailable == 0){
				val.availableInPercent = 0;
            }
			html += '<div style="width: '+val.availableInPercent+'%" class="'+progressBarClass+' progress-bar"></div></div>';
			html += '<small class="text-muted buttonCol">'+ val.seatsAvailable  +' Seats</small></div>';
			if(val.seatsAvailable == 0){
				html += '<div class="col-xs-2"><button class="btn btn-muted btn-xs">Sold out</button></div>';	
			}else{
				html += '<div class="col-xs-2"><button class="btn btn-primary btn-xs" onclick="bookNow('+val.seq+ ',' + val.seatsAvailable+',\'' +  menuSeqs + '\',\'' +  menuArr + '\',\'' +  selectedDate + '\')">Book Now</button></div>';
			}
			html += '</div>';
		});
	 	$("#dataDiv").html(html);
	});	 	
}
function setPersonCount(menuSeq,count){
	$("."+menuSeq+"personButton").removeClass("btn-primary");
	if($(".hiddenMenuSeq"+ menuSeq).val() != count){
		buttonClassName = "#personCount"+ menuSeq +"-"+count;
		$(buttonClassName).addClass("btn-primary");//set colored button
		$(".hiddenMenuSeq"+ menuSeq).val(count);//set hidden prop count
	}else{
		$(".hiddenMenuSeq"+ menuSeq).val(0);
	}
	
}
function bookNow(timeSlotSeq,seats,menuSeqs,menuTitles,selectedDate){
	$("#timeslotseq").val(timeSlotSeq);
	$("#selectedDate").val(selectedDate);
	var menuSeqArr = menuSeqs.split(",");
	var menuTitleArr = menuTitles.split(",");
	$("#personCounts").html("");
	$("#footerDiv").html("");
	var html = "";

	$.each( menuSeqArr, function( key, seq ) {
		html += '<input type="hidden" name="hiddenMenuSeq'+seq+'" class="hiddenMenuSeq'+seq+'" value="0"/>';
		html += '<div class="row m-sm">';
			html += '<div class="row p-xs text-muted"><h3>'+menuTitleArr[key]+'</h3></div>';
			html += '<div class="row">';
			for(var i = 1; i <= seats; i++) {
				html += '<div class="col-xs-1" style="margin-bottom:16px;">';
			 	html += '<button class="btn btn-xs btn-muted '+seq+'personButton" id="personCount'+ seq +'-'+i+'" onClick="setPersonCount('+ seq +','+i+')">';
			 	html += i;
				html += '</button></div>';
			}
			html += '</div>';
		html += '</div>';
	});

	$("#personCounts").html(html);
	var str = "";
	$("#menuDiv").html("");
	var footerButtons = '<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>';
   	footerButtons += '<button type="button" id="saveBtn" onClick="javascript:submitBookingForm('+seats+ ',\'' +  menuSeqs + '\')" class="btn btn-primary">Continue</button>';
    $("#footerDiv").html(footerButtons);
	$("#menuDiv").html(str);
	$('#myModal4').modal('show');
}

function setValue(){
	$("input.menuCount:text").val("");
	var personCount = $('#personCount:checked').val();
	var selectedMenuTitleSeq = $('#menuTitleRadio:checked').val();
	$("#"+selectedMenuTitleSeq+"_menuCountText").val(personCount);
}

function submitBookingForm(seats,menuSeqs){
	var text = "";
    var personCounts = {};
    var menuSeqArr = menuSeqs.split(",");
    var totalPersons = 0;
	$.each( menuSeqArr, function( key, seq ) {
		personMenuCount = $(".hiddenMenuSeq"+seq).val();
		//personMenuCount = $("#"+seq+"_menuCountText").val();
		if(personMenuCount != ""){
			personCounts[seq]= personMenuCount;
			totalPersons += parseInt(personMenuCount);
		}
	}) 
	if(totalPersons == 0){
		alert("Select some seats");
		return;
	}
	if(totalPersons > seats){
        alert("Total Seats available for this slot are "+seats+" only.");
        return;
    }
   var jsonS = JSON.stringify(personCounts);
   $('#menuMembers').val(jsonS)
   $("#bookingForm").submit();
}
function IsNumeric(val) {
    return Number(parseFloat(val)) === val;
}
function getCurrentDate(dateObj){
	//var dateObj = new Date();
	var dd = dateObj.getDate();
	var mm = dateObj.getMonth()+1; //January is 0!
	var yyyy = dateObj.getFullYear();
	if(dd<10) {
	    dd = '0'+dd
	} 
	if(mm<10) {
	    mm = '0'+mm
	} 
	today = dd + '-' + mm + '-' + yyyy;
	return today;
}
function getHeaders(){
	var html = '<div class="row ibox-content tableheaders">'
	html += '<div class="col-xs-2">Date</div>';
	html += '<div class="col-xs-3">Slot Time</div>';
	html += '<div class="col-xs-3">Fare</div>';
	html += '<div class="col-xs-2 text-center">Seats Available</div>'
	html += '<div class="col-xs-2">Action</div>'
	html += '</div>';
	return html;
}

</script> 
