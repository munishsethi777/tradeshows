<?include("sessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."BusinessObjects/GraphicsLog.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/GraphicLogMgr.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DropdownUtil.php");
$graphicLog = new GraphicsLog(); 
$graphicLogMgr = GraphicLogMgr::getInstance();
$readOnlyPO = "";
$hasWrapTag = "";
$hasHangTag = "";
$hasPrivate = "";
if(isset($_POST["id"])){
	$seq = $_POST["id"];
 	$graphicLog = $graphicLogMgr->findBySeq($seq);
 	//$readOnlyPO = "readonly";
 	if($graphicLog->getIsCustomWrapTagNeeded() == 1){
 		$hasWrapTag = "checked";
 	}
 	if($graphicLog->getIsCustomHangTagNeeded() == 1){
 		$hasHangTag = "checked";
 	}
 	if($graphicLog->getIsPrivateLabel() == 1){
 		$hasPrivate = "checked";
 	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin | Graphic Log</title>
<?include "ScriptsInclude.php"?>
<style type="text/css">
.col-form-label{
	font-weight:400 !important;
}
.areaTitle{
	margin:0px 0px 0px 15px !important;
	color:#1ab394;
	font-size:15px;
}
.bg-white{
	background-color:rgb(252,252,252);
}
.bg-muted{
}
.outterDiv{
	border-bottom:1px silver dashed;
	padding:20px 10px;
}
</style>
</head>
<body>
    <div id="wrapper">
    <?php include("adminmenuInclude.php")?>  
    <div id="page-wrapper" class="gray-bg">
	    <div class="row border-bottom">
	    	<div class="col-lg-12">
	         <div class="ibox">
	         	<div class="ibox-title">
                   	 <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
						<a class="navbar-minimalize minimalize-styl-2 btn btn-primary "
							href="#"><i class="fa fa-bars"></i> </a>
							<h5 class="pageTitle">Create/Edit Graphic Log</h5>
					</nav>
                 </div>
                 <div class="ibox-content">
                 	<?include "progress.php"?>
                 	 <form id="createGraphicLogForm" method="post" action="Actions/GraphicLogAction.php" class="m-t-lg">
                     	<input type="hidden" id ="call" name="call"  value="saveGraphicLog"/>
                        <input type="hidden" id ="seq" name="seq"  value="<?php echo $graphicLog->getSeq()?>"/>
                        <div class="bg-white1 p-xs outterDiv">
                        	<div class="form-group row">
	                       		<label class="col-lg-3 col-form-label bg-primary">To be Filled by USA Office</label>
	                        </div>
                        	 <div class="form-group row">
	                       		    
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Date Entered :</label>
	                        	<div class="col-lg-4">
	                        		<div class="input-group date">
                                		<input type="text" required  id="usaofficeentrydate" maxLength="250" value="<?php echo $graphicLog->getUSAOfficeEntryDate()?>" name="usaofficeentrydate" class="form-control dateControl" <?php echo $readOnlyPO?>>
	                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	                            	</div>
	                            </div>
	                            
	                        </div>
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">PO :</label>
	                        	<div class="col-lg-4">
	                            	<input type="text"  maxLength="250" value="<?php echo $graphicLog->getPO()?>" name="po" class="form-control" <?php echo $readOnlyPO?>>
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Estd PO Shipdate :</label>
	                        	<div class="col-lg-4">
	                        		<div class="input-group date">
                                		<input type="text" maxLength="250" onchange="setDates(this.value)" value="<?php echo $graphicLog->getEstimatedShipDate()?>" name="estimatedshipdate" id="estimatedshipdate" class="form-control  dateControl" <?php echo $readOnlyPO?>>
	                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	                            	</div>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Class Code : </label>
	                        	<div class="col-lg-4">
	                            	<input type="text" maxLength="250" value="<?php echo $graphicLog->getClassCode()?>" name="classcode" class="form-control" <?php echo $readOnlyPO?>>
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Estd Graphics DueDate :</label>
	                        	<div class="col-lg-4">
	                        		<div class="input-group date">
                                		<input type="text" maxLength="250" value="<?php echo $graphicLog->getEstimatedGraphicsDate()?>" name="estimatedgraphicsdate" id="estimatedgraphicsdate" class="form-control  dateControl" <?php echo $readOnlyPO?>>
	                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	                            	</div>
	                            	
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Item Number :</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" required  maxLength="250" value="<?php echo $graphicLog->getSKU()?>" name="sku" class="form-control" <?php echo $readOnlyPO?>>
	                            </div>
	                        </div>
	                        <div class="form-group row i-checks">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Type of Graphics :</label>
	                        	<div class="col-lg-4">
	                            	<?php 
			                           	$select = DropDownUtils::getGraphicTypes("graphictype", "showGraphicFields()", $graphicLog->getGraphicType(),false,true);
			                            echo $select;
	                             	?>
	                             	<div id="graphicFields" style="display:none">
		                             	<div class="col-sm-4">
		                             		<label class="col-lg-2 col-form-label">Length</label>
		                             		<input type="text" placeholder="Length"  value="<?php echo $graphicLog->getGraphicLength()?>" name="graphiclength"  id="graphiclength" class="form-control">
		                             	</div>
		                             	<div class="col-sm-4">
		                             		<label class="col-lg-2 col-form-label">Width</label>
		                             		<input type="text"  placeholder="Width"  value="<?php echo $graphicLog->getGraphicWidth()?>" name="graphicwidth" id="graphicwidth" class="form-control">
		                             	</div>
		                             	<div class="col-sm-4">
		                             		<label class="col-lg-2 col-form-label">Height</label>
		                             		<input type="text"  placeholder="Height"  value="<?php echo $graphicLog->getGraphicHeight()?>" name="graphicheight" id="graphicheight" class="form-control">
		                             	</div>
	                             	</div>
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Type of Tags :</label>
	                        	<div class="col-lg-4">
	                            	<?php 
			                           	$select = DropDownUtils::getTagTypes("tagtype", "showTagFields()", $graphicLog->getTagType(),false,true);
			                            echo $select;
	                             	?>
	                             	<div id="tagFields" style="display:none">
		                             	<div class="col-sm-4">
		                             		<label class="col-lg-2 col-form-label">Length</label>
		                             		<input type="text" placeholder="Length" value="<?php echo $graphicLog->getTagLength()?>" name="taglength" id="taglength" class="form-control">
		                             	</div>
		                             	<div class="col-sm-4">
		                             		<label class="col-lg-2 col-form-label">Width</label>
		                             		<input type="text"  placeholder="Width"  value="<?php echo $graphicLog->getTagWidth()?>" name="tagwidth" id="tagwidth" class="form-control">
		                             	</div>
		                             	<div class="col-sm-4">
		                             		<label class="col-lg-2 col-form-label">Height</label>
		                             		<input type="text"  placeholder="Height"  value="<?php echo $graphicLog->getTagHeight()?>" name="tagheight" id="tagheight" class="form-control">
		                             	</div>
	                             	</div>
	                            </div>
<!-- 	                            <label class="col-lg-2 col-form-label bg-formLabel">Cstm Hangtag Needed :</label> -->
<!-- 	                        	<div class="col-lg-4">
	                        		<input type="checkbox" <?php //echo $hasHangTag?> name="iscustomhangtagneeded"/> -->
	                            	<!-- <input type="text" required maxLength="250" value="<?php //echo $graphicLog->getIsCustomHangTagNeeded()?>" name="iscustomhangtagneeded" class="form-control" <?php echo $readOnlyPO?>>
<!-- 	                            	--> 
<!-- 	                            </div> -->
	                        </div>
<!-- 	                        <div class="form-group row i-checks"> -->
<!-- 	                       		<label class="col-lg-offset-6 col-lg-2 col-form-label bg-formLabel">Cstm Wraptag Needed :</label> -->
<!-- 	                        	<div class="col-lg-4"> 
	                        		<input type="checkbox" <?php //echo $hasWrapTag?> name="iscustomwraptagneeded"/>-->
<!-- 	                            </div> -->
<!-- 	                        </div> -->
	                        <div class="form-group row i-checks">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Customer Name :</label>
	                        	<div class="col-lg-4">
	                            	<input type="text" required  maxLength="250" value="<?php echo $graphicLog->getCustomerName()?>" name="customername" class="form-control" <?php echo $readOnlyPO?>>
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Private Label (Y/N) :</label>
	                        	<div class="col-lg-4">
	                        		<input type="checkbox" <?php echo $hasPrivate?> name="isprivatelabel"/>
	                           </div>
	                        </div>
	                         <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">USA Notes to Graphics :</label>
	                        	<div class="col-lg-10">
	                            	<textarea class="col-lg-12 col-form-label" rows="3" name="usanotes" ><?php echo $graphicLog->getUSANotes()?></textarea>
	                            </div>
	                        </div>                        
	                    </div>
	                    
	                    
	                     <div class="bg-white1 p-xs outterDiv">
                        	<div class="form-group row">
	                       		<label class="col-lg-3 col-form-label bg-primary">To be filled by Graphics (US) Team</label>
	                        </div>
                        	<div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Assigned Designer :</label>
	                        	<div class="col-lg-4">
	                            	<input type="text"  id="qc" maxLength="250" value="<?php echo $graphicLog->getGraphicArtist()?>" name="graphicartist" class="form-control" <?php echo $readOnlyPO?>>
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Start Date :</label>
	                        	<div class="col-lg-4">
	                        		<div class="input-group date">
                                		<input type="text" id="classcode" maxLength="250" value="<?php echo $graphicLog->getGraphicArtistStartDate()?>" name="graphicartiststartdate" class="form-control  dateControl" <?php echo $readOnlyPO?>>
	                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	                            	</div>
	                           	</div>
	                        </div>
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Graphic Status :</label>
	                        	<div class="col-lg-4">
	                            	<input type="text"  id="qc" maxLength="250" value="<?php echo $graphicLog->getGraphicStatus()?>" name="graphicstatus" class="form-control" <?php echo $readOnlyPO?>>
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Completion Date :</label>
	                        	<div class="col-lg-4">
	                        		<div class="input-group date">
                                		<input type="text" id="classcode" maxLength="250" value="<?php echo $graphicLog->getGraphicCompletionDate()?>" name="graphiccompletiondate" class="form-control dateControl" <?php echo $readOnlyPO?>>
                                		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	                            	</div>
	                            	
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Appx Completion Date :</label>
	                        	<div class="col-lg-4">
	                        		<div class="input-group date">
                                		<input type="text" id="approxgraphicschinasentdate" maxLength="250" value="<?php echo $graphicLog->getApproxGraphicsChinaSentDate()?>" name="approxgraphicschinasentdate" class="form-control dateControl" <?php echo $readOnlyPO?>>
                                		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	                            	</div>
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Duration :</label>
	                        	<div class="col-lg-4">
	                            	<input type="number" id="classcode" maxLength="250" value="<?php echo $graphicLog->getDuration()?>" name="duration" class="form-control" <?php echo $readOnlyPO?>>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Notes to China Office :</label>
	                        	<div class="col-lg-10">
	                            	<textarea class="col-lg-12 col-form-label" rows="3" name="chinanotes" ><?php echo $graphicLog->getChinaNotes()?></textarea>
	                            </div>
	                        </div> 
	                    </div>
	                    <div class="bg-white1 p-xs outterDiv">
                        	<div class="form-group row">
	                       		<label class="col-lg-3 col-form-label bg-primary">To be filled by China Team </label>
	                        </div>
                        	<div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Entry Date :</label>
	                        	<div class="col-lg-4">
	                        		<div class="input-group date">
                                		<input onchange="callChinaEntryDate(this.value)"  type="text" maxLength="250" value="<?php echo $graphicLog->getChinaOfficeEntryDate()?>" name="chinaofficeentrydate" id="chinaofficeentrydate" class="form-control dateControl" <?php echo $readOnlyPO?>>
                                		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	                            	</div>
	                            	
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Final Graphics Due Date :</label>
	                        	<div class="col-lg-4">
	                        		<div class="input-group date">
	                            		<input type="text" maxLength="250" value="<?php echo $graphicLog->getFinalGraphicsDueDate()?>" name="finalgraphicsduedate" id="finalgraphicsduedate" class="form-control dateControl" <?php echo $readOnlyPO?>>
	                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	                            	</div>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Confirmed PO Ship Date :</label>
	                        	<div class="col-lg-4">
	                        		<div class="input-group date">
		                            	<input type="text" maxLength="250" value="<?php echo $graphicLog->getConfirmedPOShipDate()?>" name="confirmedposhipdate" class="form-control dateControl" <?php echo $readOnlyPO?>>
		                            	<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	                            	</div>
	                            </div>
	                        </div>
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Dimensions of Graphics :</label>
	                        </div>
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Notes to US Office:</label>
	                        	<div class="col-lg-10">
	                            	<textarea class="col-lg-12 col-form-label" rows="3" name="graphicstochinanotes" ><?php echo $graphicLog->getGraphicsToChinaNotes()?></textarea>
	                            </div>
	                        </div> 
	                    </div>
	                  
	                    
                        <div class="bg-white p-xs">
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label"></label>
	                        	<div class="col-lg-2">
		                        	<button class="btn btn-primary" onclick="saveQCSchedule()" type="button" style="width:85%">
	                                	Save
		                          	</button>
		                        </div>
		                        <div class="col-lg-2">
		                          	<a class="btn btn-default" href="adminManageGraphicLogs.php" type="button" style="width:85%">
	                                	Cancel
		                          	</a>
		                        </div>
		                    </div>
	                    </div>
	                    
	                   </form>
                	 </div>           
	         	</div>
	    	</div>
       	<div class="row">
       	 	
        </div>
     </div>   	
    </div>
    </div>
</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
	$('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
	   	radioClass: 'iradio_square-green',
	});
	$('.dateControl').datetimepicker({
	    timepicker:false,
	    format:'m-d-Y',
	    scrollMonth : false,
		scrollInput : false
	})
	showTagFields();
	showGraphicFields();
});
function showTagFields(){
	value = $("#tagtype").val();
	if(value == "custom"){
		$("#tagFields").show();
		$("#taglength").attr("required","required");
		$("#tagwidth").attr("required","required");
		$("#tagheight").attr("required","required");
	}else{
		$("#tagFields").hide();
		$("#taglength").removeAttr("required");
		$("#tagwidth").removeAttr("required");
		$("#tagheight").removeAttr("required");
	}
}
function showGraphicFields(){
	value = $("#graphictype").val();
	if(value == "custom"){
		$("#graphicFields").show();
		$("#graphiclength").attr("required","required");
		$("#graphicwidth").attr("required","required");
		$("#graphicheight").attr("required","required");
	}else{
		$("#graphicFields").hide();
		$("#graphiclength").removeAttr("required");
		$("#graphicwidth").removeAttr("required");
		$("#graphicheight").removeAttr("required");
	}
}
function setDates(estimatedshipdateStr){
	if(estimatedshipdateStr == ""){
		$("#estimatedgraphicsdate").val("");
		$("#finalgraphicsduedate").val("");
		return;
	}
	var estimatedshipdate = getDate(estimatedshipdateStr);
	estimatedGraphicsDays = 30;
	var estimatedgraphicsdate = subtractDays(estimatedshipdate,estimatedGraphicsDays);
	estimatedgraphicsdateStr = dateToStr(estimatedgraphicsdate);
	$("#estimatedgraphicsdate").val(estimatedgraphicsdateStr);
	$("#finalgraphicsduedate").val(estimatedgraphicsdateStr);

	if($("#chinaofficeentrydate").val() != ""){
		callChinaEntryDate($("#chinaofficeentrydate").val());
	}
}
function callChinaEntryDate(chinaEntryDate){
	if(chinaEntryDate == ""){
		if($("#estimatedshipdate").val() != ""){
			setDates($("#estimatedshipdate").val());
			return;
		}
	}
	
	var chinaEntryDate = getDate(chinaEntryDate);
	finalgraphicsduedateDays = 20;
	var finalgraphicsduedate = addDays(chinaEntryDate,finalgraphicsduedateDays);
	finalgraphicsduedateStr = dateToStr(finalgraphicsduedate);
	$("#finalgraphicsduedate").val(finalgraphicsduedateStr);
}
function saveQCSchedule(){
	if($("#createGraphicLogForm")[0].checkValidity()) {
		showHideProgress()
		$('#createGraphicLogForm').ajaxSubmit(function( data ){
		   showHideProgress();
		   var flag = showResponseToastr(data,null,null,"ibox");
		   if(flag){
			   window.setTimeout(function(){window.location.href = "adminManageGraphicLogs.php"},100);
		   }
	    })	
	}else{
		$("#createGraphicLogForm")[0].reportValidity();
	}
}
function getDate(dateString) {
    var parts = dateString.split('-');
    var month = parts[0] - 1;
    var day = parts[1];
    var year = parts[2]
    var dateObj = new Date(year,month,day);
    return dateObj;
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
function addDays(date, days) {
   date.setDate(date.getDate() + days);
   return date;
}
function subtractDays(date, days) {
	 var sDate = date;
	 sDate.setDate(sDate.getDate() - days);
	 return sDate;
}
</script>