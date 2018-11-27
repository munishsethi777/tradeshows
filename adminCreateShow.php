<?
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Managers/ShowMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ShowTaskMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
$show = new Show();
$startDate = "";
$endDate = "";
$seq = 0;
if(isset($_POST["id"]) && !empty($_POST["id"] )){
	$seq = $_POST["id"];
	$showManager = ShowMgr::getInstance();
	$show = $showManager->findBySeq($seq);
	$startDate = DateUtil::StringToDateByGivenFormat("Y-m-d H:i:s", $show->getStartDate());
	$endDate = DateUtil::StringToDateByGivenFormat("Y-m-d H:i:s", $show->getEndDate());
	$startDate = $startDate->format("m-d-Y");
	$endDate = $endDate->format("m-d-Y");
	$showTaskMgr = ShowTaskMgr::getInstance();
}
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
	                    	
	                        <form id="taskForm" method="post" action="Actions/ShowAction.php" class="m-t-lg">
	                        		<input type="hidden" id ="call" name="call"  value="saveShow"/>
	                        		<input type="hidden" id ="seq" name="seq"  value="<?php echo $seq?>"/>
	                        		<div class="form-group row">
	                       				<label class="col-lg-2 col-form-label">Show Title</label>
	                                    <div class="col-lg-8">
	                                    	<input type="text" id="title" value="<?php echo $show->getTitle()?>" name="title" required placeholder="Enter Show Title" class="form-control">
	                                    </div>
	                               </div>
	                               		<div class="form-group row">
	                               			<label class="col-lg-2 col-form-label">Show Description</label>
	                                		<div class="col-lg-8">
	                               				<input type="text" value="<?php echo $show->getDescription()?>" id="description" name="description" required 
			                                    placeholder="Enter Show Description" class="form-control">
		                                    </div>
		                                </div>
		                                <div class="form-group row">
		                                	<label class="col-lg-2 col-form-label">Start Date</label>
		                                    <div class="col-lg-3">
			                       				<input type="text" id="startDate" value="<?php echo $startDate?>" name="startdate" required 
			                                    placeholder="Enter Start Date" class="form-control datePicker">
		                                    </div>
		                                	<label class="col-lg-2 col-form-label datePicker">End Date</label>
		                                    <div class="col-lg-3">
			                       				<input type="text" value="<?php echo $endDate?>" id="endDate" name="enddate" required 
			                                    placeholder="Enter Start Date" class="form-control datePicker">
		                                    </div>
		                                </div>
		                                
                                	<hr>
                                 	<div class="form-group row">
                                 		<label class="col-lg-2 col-form-label"></label>
                                		<div class="col-lg-2">
	                                		<button class="btn btn-primary" onclick="generateTasks()" type="button" style="width:85%">
	                                			Generate Dates
		                                	</button>
		                                </div>
		                                <div class="col-lg-2">
	                                		<button class="btn btn-primary" onclick="saveShow()" type="button" style="width:80%">
	                                			Save Tasks
		                                	</button>
		                                </div>
		                                <div class="col-lg-2" style="text-align: right">
	                                		<button class="btn btn-default" onclick="" type="button" style="width:80%">
	                                			Cancel
		                                	</button>
	                                	</div>
	                                	
                                	</div>
                                	<div class="panel-body">
	                                <div class="panel-group" id="accordion">
	                                </div>
	                            </div>
                       			</form>
	                        </div>
	                </div>
	            </div>
        	</div>
       </div>
    </div>
   </body>
</html>
<script type="text/javascript">
$(document).ready(function(){
	$('.datePicker').datetimepicker({
	    timepicker:false,
	    format:'m-d-Y'
	});
	loadShowTasks();
});

	function loadShowTasks(){
		var seq = "<?php echo $seq?>";
		if(seq != "0"){
			var url = 'Actions/ShowTaskAction.php?call=getShowTasks&showSeq=<?php echo $seq?>';
			populateTasks(url);
		}
	}
	function generateTasks(){
		var startDate = $("#startDate").val();
		var url = 'Actions/TaskAction.php?call=getAllTasks&startDate="+startDate='+startDate;
		populateTasks(url)
	}
	function populateTasks(url){
		$.get(url, function(data){
			data = $.parseJSON(data);
			var html =""
			var tasks = data.tasks;
			var i = 1;
			$.each( tasks, function( k, taskDetail ) {	
				var categorySeq = taskDetail[0].taskcategoryseq;
				html += '<input type="hidden" value="'+categorySeq+'" id ="category" name="category[]"/>';
				html += getHtml(k,taskDetail,i);
				i++;
			});	
			$("#accordion").html(html);
			 $('.datePicker').datetimepicker({
		         timepicker:false,
		         format:'m-d-Y'
		     });
		});
	}
	

	function getHtml(categoryTitle,tasksData,i){
		var html = '<div class="panel panel-default">';
        	html += '<div class="panel-heading">';
        	html += '<h5 class="panel-title">';
            html += '<a data-toggle="collapse" data-parent="#accordion" href="#div'+i+'" class="collapsed" aria-expanded="false">'+categoryTitle+'</a>';
        	html += '</h5></div>';
    		html += '<div id="div'+i+'" class="panel-collapse collapse" style="">';
        	html += '<div class="panel-body">';
            html += '<div class="form-group row">';
            html += '<label class="col-lg-4 col-form-label">Title</label>';
            html += '<label class="col-lg-4 col-form-label">Assignees</label>';
            html += '<label class="col-lg-2 col-form-label">StartDate</label>';
            html += '<label class="col-lg-2 col-form-label">EndDate</label>';
            html += '</div>';
            var childHtml = "";
            $.each( tasksData, function( k, taskDetail ) {
                var seq = taskDetail.seq;
                var parentTaskSeq = taskDetail.parenttaskseq;
                var categorySeq = taskDetail.taskcategoryseq;
                var daysRequired = taskDetail.daysrequired;
                childHtml += '<input type="hidden" id="'+seq+'_daysRequired" name="'+categorySeq+'_daysRequired[]"  value="'+daysRequired+'"/>';
                childHtml += '<input type="hidden" name="'+categorySeq+'_taskSeq[]"  value="'+seq+'"/>';
                childHtml += '<div class="form-group row">';
            	childHtml += '<div class="col-lg-4 col-form-label">';
            	childHtml += taskDetail.startdatereferencedays + '-' + taskDetail.seq + '<input type="text" value="(' +  taskDetail.parenttaskseq + ')' +taskDetail.title + '" name="'+categorySeq+'_title[]" class="form-control"><br>';
            	childHtml += '</div>';
            	childHtml += '<div class="col-lg-4 col-form-label">';
            	childHtml += '<input type="text" value="'+taskDetail.assignee+'" name="'+categorySeq+'_assignees[]" class="form-control"><br>';
            	childHtml += '</div>';
            	childHtml += '<div class="'+parentTaskSeq+'_dates">';
            	childHtml += '<div class="col-lg-2 col-form-label">';
            	childHtml += '<input type="text" value="'+taskDetail.startDate+'" id="'+seq+'_startDate" onchange="updateDates('+seq+',' + 0+')" name="'+categorySeq+'_startdate[]" class="form-control datePicker">';
            	childHtml += '</div>';
            	childHtml += '<div class="col-lg-2 col-form-label">';
            	childHtml += '<input type="text" value="'+taskDetail.endDate+'" id="'+seq+'_endDate" name="'+categorySeq+'_enddate[]" class="form-control datePicker">';
            	childHtml += '</div>';
            	childHtml += '</div>';
            	childHtml += '</div>';
            });
            html += childHtml;
            html += "</div></div></div></div></div>";
            return html;  
	}

	function saveShow(){
		$('#taskForm').ajaxSubmit(function( data ){
	        alert("Action Completed Successfully");
	    })	
	}
	
	function updateDates1(taskSeq,isChild){
		if(isChild == 0){
			changeEndDateValue(taskSeq);
		}
		$('input[name="'+taskSeq+'_startdate[]"]').each(function() {
			var id = this.id;
			var arr = id.split('_');
			id = arr[0];
			var daysRequired = $("#"+id+"_daysRequired").val();
			daysRequired = parseInt(daysRequired);
			var startDateStr = $("#"+taskSeq+"_endDate").val();
			var startDate = getDate(startDateStr);
			startDateStr = dateToStr(startDate);
			$("#"+id+"_startDate").val(startDateStr);
			var endDate = addDays(startDate,daysRequired);
			startDateStr = dateToStr(endDate);
			$("#"+id+"_endDate").val(startDateStr);
			updateDates(id,1);				
		});						
	}

	function updateDates(taskSeq,isChild){
		if(isChild == 0){
			changeEndDateValue(taskSeq);
		}
		$('.'+taskSeq + '_dates').each(function() {
			$(this).find('input').each(function() {
				var id = this.id;
				var arr = id.split('_');
				id = arr[0];
				var daysRequired = $("#"+id+"_daysRequired").val();
				daysRequired = parseInt(daysRequired);
				var startDateStr = $("#"+taskSeq+"_endDate").val();
				var startDate = getDate(startDateStr);
				startDateStr = dateToStr(startDate);
				$("#"+id+"_startDate").val(startDateStr);
				var endDate = addDays(startDate,daysRequired);
				startDateStr = dateToStr(endDate);
				$("#"+id+"_endDate").val(startDateStr);
				updateDates(id,1);	
		    });
		});					
	}
	

	
	function changeEndDateValue(taskSeq){
		var daysRequired = $("#"+taskSeq+"_daysRequired").val();
		daysRequired = parseInt(daysRequired);
		var startDateStr = $("#"+taskSeq+"_startDate").val();
		var startDate = getDate(startDateStr);
		var startDate = addDays(startDate,daysRequired);
		startDateStr = dateToStr(startDate);
		$("#"+taskSeq+"_endDate").val(startDateStr);
	}
	function getDate(dateString) {
        var parts = dateString.split('-');
        var month = parts[0] - 1;
        var day = parts[1];
        var year = parts[2]
        var dateObj = new Date(year,month,day);
        return dateObj;
    }
	function addDays(date, days) {
	   date.setDate(date.getDate() + days);
	   return date;
	}

	function dateToStr(date){
		var dd = date.getDate();
		var mm = date.getMonth() + 1; //January is 0!

		var yyyy = date.getFullYear();
		if (dd < 10) {
		  dd = '0' + dd;
		} 
		if (mm < 10) {
		  mm = '0' + mm;
		} 
		var dateStr = mm + '-' +  dd + '-' + yyyy;
		return dateStr;
	}
		
	</script>