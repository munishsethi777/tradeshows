 
	<div id="page-wrapper" class="gray-bg">
		<div class="row border-bottom"></div>
        <div class="row">
			<div class="col-lg-12">
	        	<div class="ibox">
	        	
	        	 	<div class="ibox-title">
						<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
								<a class="navbar-minimalize minimalize-styl-2 btn btn-info"
									href="#"><i class="fa fa-bars"></i> </a>
									<h4 class="p-h-sm font-normal"> Public Documents Repository</h4>
						</nav>
						</div>
					        <div class="ibox-content">
					         	<div class="row">
		                     		<div class="form-group">
	                       				<label class="col-lg-2 col-form-label">Select Tradeshow</label>
	                                    <div class="col-lg-4">
	                                    	<select name="showSeq" id="showSeq" class="showSelect form-control">
	                                    	<?php 
	                                    		foreach($shows as $show){
	                                    			$html = "<option value='". $show->getSeq()  ."'>".$show->getTitle()."</option>";
	                                    			echo($html);
	                                    		}
	                                    	?>
	                                    	</select>
	                                    </div>
	                               </div>
		                     	</div>
		                     	<div class="row m-xs">
		                     		<div class="table-responsive m-t-lg">
			                     		<table class="table table-striped repositoryTable">
			                     			
			                     		</table>
		                     		</div>
		                     	</div>
		                     </div>
	                    </div>	
		            </div>
	            </div>
	        </div>
	     </div>

<script type="text/javascript">
$(document).ready(function(){
	$('.showSelect').on('change', function() {
		loadGridWithStatusMenu(this.value);
	});
	loadGridWithStatusMenu($('.showSelect').val());
    $('.saveTaskDetails').on('click', function() {
        showHideProgress();
        $('#updateShowTaskDetailsForm').ajaxSubmit(function( data ){
        	showHideProgress();
            showResponseToastr(data,null,"updateShowTaskDetailsForm","mainDiv");
            $("#showGrid").jqxGrid("updatebounddata");
            $('#taskDetailsModal').modal('hide');
        })
  	});
});
function loadGridWithStatusMenu(showSeq){
	$(".repositoryTable").html("");
	$.getJSON("Actions/ShowTaskFileAction.php?call=getTasksFilesByTradeShow&showSeq="+showSeq,function( data ){
		if(data.taskFiles.length == 0){
			str = "<h5 class='text-danger'>No Files uploaded for the selected tradeshow</h5>";
		}else{	
			str = "<thead><tr><th width='5%'>Sr.</th><th width='5%'>Type</th><th width='20%'>File Name</th><th width='30%'>Task</th><th width='10%'>Uploaded By</th><th width='15%'>Uploaded On</th><th style='text-align:center' width='5%'>Action</th></tr></thead>";
			i = 1;
			str += "<tbody>";
		  	$.each(data.taskFiles,function(key,file){
				str += "<tr>";
				str += "<td>"+ i++ +"</td>"
				str += "<td>"+ file.fileextension.toUpperCase() +"</td>"
				str += "<td>"+ file.ftitle +"</td>"
				str += "<td>"+ file.ttitle +"</td>"
				str += "<td>"+ file.fullname +"</td>"
				str += "<td>"+ file.createdon +"</td>"
				str += "<td align='center'><a target='new' href='documents/"+file.seq+"."+file.fileextension+"'><i class='fa fa-eye' title='View File'></i></a></td>"
				str += "</tr>";
		  	});
		  	str += "</tbody>";
		}
	  	$(".repositoryTable").html(str);
	});
	
}
</script>
