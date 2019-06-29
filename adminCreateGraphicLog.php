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
	line-height: 1.2 !important;
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
	                            <label class="col-lg-2 col-form-label bg-formLabel">Estimated PO Shipdate :</label>
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
 	                            	<input type="hidden" maxLength="250" name="classcode" id="classcode">
	                            	<?php 
				                           	$select = DropDownUtils::getClassCodes("classcodeseq", "", $graphicLog->getClassCodeSeq(),false);
				                            echo $select;
	                             		?>
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Estimated Graphics DueDate :</label>
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
			                           	$select = DropDownUtils::getGraphicTypes("graphictype[]", "showGraphicFields()", $graphicLog->getGraphicType(),false,true);
			                            echo $select;
	                             	?>
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
		                             		<input type="number" min="0" step=".1" value="<?php echo $graphicLog->getTagLength()?>" name="taglength" id="taglength" class="form-control positive-integer">
		                             	</div>
		                             	<div class="col-sm-4">
		                             		<label class="col-lg-2 col-form-label">Width</label>
		                             		<input type="number" min="0" step=".1"  value="<?php echo $graphicLog->getTagWidth()?>" name="tagwidth" id="tagwidth" class="form-control positive-integer">
		                             	</div>
		                             	<div class="col-sm-4">
		                             		<label class="col-lg-2 col-form-label">Height</label>
		                             		<input type="number" min="0"  step=".1" value="<?php echo $graphicLog->getTagHeight()?>" name="tagheight" id="tagheight" class="form-control positive-integer">
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
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Customer Name :</label>
	                        	<div class="col-lg-4">
<!-- 	                            	<input type="text" required  maxLength="250" name="customername" class="form-control"> -->
	                            	<select class="customers form-control" id="customername" name="customername" <?php echo $readOnlyPO?>>
	                            		<?php if(!empty($graphicLog->getCustomerName())){?>
	                            				<option selected value="<?php echo $graphicLog->getCustomerName()?>"><?php echo $graphicLog->getCustomerName()?></option>
	                            		<?php }?>
									</select>
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Private Label (Y/N) :</label>
	                        	<div class="col-lg-4">
	                        		<input type="checkbox" class="i-checks form-control" <?php echo $hasPrivate?> id="isprivatelabel" name="isprivatelabel"/>
	                        		
	                        		<div style="margin-top:5px;display:none" id="labelTypeDiv">
										<?php 
				                           	$select = DropDownUtils::getLabelTypes("labeltype", "showLabelFields()", $graphicLog->getLabelType(),false);
				                            echo $select;
	                             		?>
		                             	<div id="labelFields" style="display:none">
			                             	<div class="col-sm-4">
			                             		<label class="col-lg-2 col-form-label">Length</label>
			                             		<input type="number" min="0" step=".1"  value="<?php echo $graphicLog->getLabelLength()?>" name="labellength" id="labellength" class="positive-integer form-control">
			                             	</div>
			                             	<div class="col-sm-4">
			                             		<label class="col-lg-2 col-form-label">Width</label>
			                             		<input type="number" min="0" step=".1"    value="<?php echo $graphicLog->getLabelWidth()?>" name="labelwidth" id="labelwidth" class="form-control positive-integer">
			                             	</div>
			                             	<div class="col-sm-4">
			                             		<label class="col-lg-2 col-form-label">Height</label>
			                             		<input type="number" step=".1"   value="<?php echo $graphicLog->getLabelHeight()?>" name="labelheight" id="labelheight" class="form-control positive-integer">
			                             	</div>
		                             	</div>
	                             	</div>
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
	                        <div id="graphicFields" style="display:none">
		                        <div class="form-group row">
		                       		<label class="col-lg-2 col-form-label bg-formLabel">Dimensions of Graphics :</label>
		                        </div>
		                        <div class="form-group row">
		                       		<label class="col-lg-2 col-form-label bg-formLabel">Length:</label>
		                        	<div class="col-lg-2">
		                            	<input type="number" min="0" step=".1" value="<?php echo $graphicLog->getGraphicLength()?>" name="graphiclength"  id="graphiclength" class="form-control positive-integer">
			                        </div>
		                            <label class="col-lg-2 col-form-label bg-formLabel">Width:</label>
		                        	<div class="col-lg-2">
		                            	<input type="number" min="0" step=".1" value="<?php echo $graphicLog->getGraphicWidth()?>" name="graphicwidth" id="graphicwidth" class="form-control positive-integer">
		                            </div>
		                            <label class="col-lg-2 col-form-label bg-formLabel">Height:</label>
		                        	<div class="col-lg-2">
		                            	<input type="number" min="0" step=".1" value="<?php echo $graphicLog->getGraphicHeight()?>"  name="graphicheight" id="graphicheight" class="form-control positive-integer">
		                            </div>
		                        </div>
	                        </div>
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Notes to US Office:</label>
	                        	<div class="col-lg-10">
	                            	<textarea class="col-lg-12 col-form-label" rows="3" name="graphicstochinanotes" ><?php echo $graphicLog->getGraphicsToChinaNotes()?></textarea>
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
	                        		<?php 
										$select = DropDownUtils::getGraphicDesigersUsers("graphicartist", null,$graphicLog->getGraphicArtist(),false,true);
		                        		echo $select;
	                        			if($isSessionQC){?>
	                        				<input type="hidden" id="qcuserhidden" value="<?php echo $graphicLog->getGraphicArtist()?>" name="graphicartist">
	                        			<?php }
                             		?>
	                        	
	                        	</div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Start Date :</label>
	                        	<div class="col-lg-4">
	                        		<div class="input-group date">
                                		<input type="text" id="graphicartiststartdate"   maxLength="250" value="<?php echo $graphicLog->getGraphicArtistStartDate()?>" name="graphicartiststartdate" class="form-control  datepicker" <?php echo $readOnlyPO?>>
	                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	                            	</div>
	                           	</div>
	                        </div>
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Graphic Status :</label>
	                        	<div class="col-lg-4">
	                            	<?php 
				                           	$select = DropDownUtils::getGraphicStatusTypes("graphicstatus", "", $graphicLog->getGraphicStatus(),false);
				                            echo $select;
	                             		?>
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Submitted to China Date:</label>
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
                                		<input type="text"  id="approxgraphicschinasentdate" maxLength="250" value="<?php echo $graphicLog->getApproxGraphicsChinaSentDate()?>" name="approxgraphicschinasentdate" class="form-control datepicker" <?php echo $readOnlyPO?>>
                                		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	                            	</div>
	                            </div>
	                            <label class="col-lg-2 col-form-label bg-formLabel">Duration :</label>
	                        	<div class="col-lg-4">
	                            	<input type="number" min="0" step=".1" id="duration" maxLength="250" value="<?php echo $graphicLog->getDuration()?>" name="duration" class="form-control positive-integer" <?php echo $readOnlyPO?>>
	                            </div>
	                        </div>
	                         <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Draft Date :</label>
	                        	<div class="col-lg-4">
	                        		<div class="input-group date">
                                		<input type="text"  id="draftdate" maxLength="250" value="<?php echo $graphicLog->getDraftDate()?>" name="draftdate" class="form-control datepicker" <?php echo $readOnlyPO?>>
                                		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	                            	</div>
	                            </div>
	                            	<label class="col-lg-2 col-form-label bg-formLabel">Buyer's Review Return Date :</label>
		                        	<div class="col-lg-4">
		                            	<div class="input-group date">
	                                		<input type="text"  id="buyerreviewreturndate" maxLength="250" value="<?php echo $graphicLog->getBuyerReviewReturnDate()?>" name="buyerreviewreturndate" class="form-control datepicker" <?php echo $readOnlyPO?>>
	                                		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		                            	</div>
		                            </div>
	                         </div>
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Manager's Review Return Date:</label>
	                       		<div class="col-lg-4">
		                        	<div class="input-group date">
	                                	<input type="text"  id="managerreviewreturndate" maxLength="250" value="<?php echo $graphicLog->getManagerReviewReturnDate()?>" name="managerreviewreturndate" class="form-control datepicker" <?php echo $readOnlyPO?>>
	                                	<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		                            </div>
	                            </div>
	                        </div> 
	                        <div class="form-group row">
	                       		<label class="col-lg-2 col-form-label bg-formLabel">Notes to China Office :</label>
	                        	<div class="col-lg-10">
	                            	<textarea class="col-lg-12 col-form-label" rows="3" name="chinanotes" ><?php echo $graphicLog->getChinaNotes()?></textarea>
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
	$("#graphictype").chosen({width:"100%"});
	$('.dateControl').datetimepicker({
	    timepicker:false,
	    format:'m-d-Y',
	    scrollMonth : false,
		scrollInput : false,
		onSelectDate:function(ct,$i){
			setDuration();
		}
	})
	$('.datepicker').datetimepicker({
	    timepicker:false,
	    format:'m-d-Y',
	    scrollMonth : false,
		scrollInput : false,
		onSelectDate:function(ct,$i){
			setDuration();
		}
	})
	showTagFields();
	showGraphicFields();
	showLabelFields();
	loadCustomer();
	showHideLabelType();
	$('#isprivatelabel').on('ifChanged', function(event){
		showHideLabelType();
	});
	$(".positive-integer").numeric({ decimalPlaces: 2, negative: false }, function() { alert("Positive integers only"); this.value = ""; this.focus(); });
});
function setDuration(){
	var startDateStr = $("#graphicartiststartdate").val();
	var endDateStr = $("#approxgraphicschinasentdate").val();
	if(startDateStr == "" || endDateStr == ""){
		return;
	}
	var startDate = parseDate(startDateStr);
	var endDate = parseDate(endDateStr);
	if(startDate > endDate){
		alert("Start Date should be less than Appx Completion Date");
		$("#duration").val(0);	
		return false;
	}else{
		var daysDiff = datediff(startDate,endDate);
		$("#duration").val(daysDiff);	
	}
	

	
}
function parseDate(str) {
    var mdy = str.split('-');
    return new Date(mdy[2], mdy[0]-1, mdy[1]);
}

function datediff(first, second) {
    // Take the difference between the dates and divide by milliseconds per day.
    // Round to nearest whole number to deal with DST.
    return Math.round((second-first)/(1000*60*60*24));
}

function showHideLabelType(){
	var flag  = $("#isprivatelabel").is(':checked');	
	if(flag){
		$("#labelTypeDiv").show();
	}else{
		$("#labelTypeDiv").hide();
	}
	showLabelFields();
}
function loadCustomer(){		
    $(".customers").select2({
    	tags: true,
        ajax: {
        url: "Actions/CustomerAction.php?call=searchCustomers",
        dataType: 'json',            
        delay: 250,
        data: function (params) {
          return {
            q: params.term, // search term
            page: params.page
          };
        },
      
        processResults: function (data, page) {
          return data;
        },
        cache: true
      },
      width: '100%',
      minimumInputLength: 1
    }); 
}
function showLabelFields(){
	value = $("#labeltype").val();
	var isPrivate  = $("#isprivatelabel").is(':checked');
	if(value == "custom" && isPrivate){
		$("#labelFields").show();
		$("#labellength").attr("required","required");
		$("#labelwidth").attr("required","required");
		$("#labelheight").attr("required","required");
	}else{
		$("#labelFields").hide();
		$("#labellength").removeAttr("required");
		$("#labelwidth").removeAttr("required");
		$("#labelheight").removeAttr("required");
	}
}

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
	if(value != "a4_label" && value != ""){
		$("#graphicFields").show();
		//$("#graphiclength").attr("required","required");
		//$("#graphicwidth").attr("required","required");
		//$("#graphicheight").attr("required","required");
	}else{
		$("#graphicFields").hide();
		//$("#graphiclength").removeAttr("required");
		//$("#graphicwidth").removeAttr("required");
		//$("#graphicheight").removeAttr("required");
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
	$("#classcode").val(($( "#classcodeseq option:selected" ).text()));
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