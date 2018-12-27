<?php ?>
	<div id="page-wrapper" class="gray-bg">
		<div class="row border-bottom"></div>
        <div class="row">
			<div class="col-lg-12">
	        	<div class="ibox">
					<div class="ibox-title">
						<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
								<a class="navbar-minimalize minimalize-styl-2 btn btn-primary "
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
		                     	<div class="row">
		                     		<div id="showGrid"></div>
		                     	</div>
		                     </div>
	                    </div>	
		            </div>
	            </div>
	        </div>
<script type="text/javascript">
$(document).ready(function(){
	$('.showSelect').on('change', function() {
		loadGridWithUsers(this.value);
	});
	loadGridWithUsers($('.showSelect').val());
});
function loadGridWithUsers(showSeq){
	$.getJSON("Actions/ShowTaskAction.php?call=getAllAssigneesByShow&showSeq="+showSeq,function( users ){
		loadGrid(showSeq,users);
	});
}
function loadGrid(showSeq,users){
	var actions = function (row, columnfield, value, defaulthtml, columnproperties) {
        data = $('#showGrid').jqxGrid('getrowdata', row);
        var html = "<div style='text-align: center; margin-top:1px;font-size:18px'><a target='new' href='documents/"+data["seq"]+"."+data["fileextension"]+"' ><i class='fa fa-eye' title='Edit'></i></a>";
            html += "</div>";     
        return html;
    }

	var statusrenderer = function (row, columnfield, value, defaulthtml, columnproperties) {
        data = $('#showGrid').jqxGrid('getrowdata', row);
        style = "label-warning";
        if(data['status'] == "In Process"){
			style="label-info";
        }else if(data['status'] == "Completed"){
			style="label-primary";
        }else if(data['status'] == "Delay"){
			style="label-danger";
        }
		var html = "<center><div><span class='label "+style+"' style='line-height:24px'>"+data['status']+"</span></div></center>";
        return html;
    }
    
    var columns = [
      { text: 'id', datafield: 'seq' , hidden:true},
      { text: 'File Name', datafield: 'showtaskfiles.title', width:"22%"},
      { text: 'Task', datafield: 'tasks.title', width:"30%"},
      { text: 'Upload By', datafield: 'fullname', width:"19%",filtertype: 'checkedlist',filteritems:users},
      { text: 'Uploaded On', datafield: 'createdon',filtertype: 'date',cellsformat: 'M-d-yyyy',width:"20%"},
      { text: 'Action', datafield: 'action',cellsrenderer:actions,width:'9%',filterable:false}
    ]
   
    var source =
    {
        datatype: "json",
        id: 'id',
        pagesize: 20,
        sortcolumn: 'createdon',
        sortdirection: 'asc',
        datafields: [{ name: 'seq', type: 'integer' },
                     { name: 'fileextension', type: 'string' },  
                    { name: 'showtaskfiles.title', type: 'string' }, 
                    { name: 'tasks.title', type: 'string' },
                    { name: 'fullname', type: 'string' },
                    { name: 'createdon', type: 'date' },
                    { name: 'action', type: 'string' } 
                    ],                          
        url: 'Actions/ShowTaskFileAction.php?call=getTasksFilesByTradeShow&showSeq='+showSeq,
        root: 'Rows',
        cache: false,
        beforeprocessing: function(data)
        {        
            source.totalrecords = data.TotalRows;
        },
        filter: function()
        {
            $("#showGrid").jqxGrid('updatebounddata', 'filter');
        },
        sort: function()
        {
            $("#showGrid").jqxGrid('updatebounddata', 'sort');
        },
        addrow: function (rowid, rowdata, position, commit) {
            commit(true);
        },
        deleterow: function (rowid, commit) {
            commit(true);
        },
        updaterow: function (rowid, newdata, commit) {
            commit(true);
        }
    };
    
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#showGrid").jqxGrid(
    {
    	width: '100%',
		height: '75%',
		source: dataAdapter,
		filterable: true,
		sortable: true,
		showfilterrow: true,
		autoshowfiltericon: true,
		columns: columns,
		pageable: true,
		altrows: true,
		enabletooltips: true,
		columnsresize: true,
		columnsreorder: true,
		showstatusbar: true,
		virtualmode: true,
		rendergridrows: function (toolbar) {
          return dataAdapter.records;     
   		},
        renderstatusbar: function (statusbar) {
            var container = $("<div style='overflow: hidden; position: relative; margin: 5px;height:30px'></div>");
            var reloadButton = $("<div style='float: left; margin-left: 5px;'><i class='fa fa-refresh'></i><span style='margin-left: 4px; position: relative;'>Reload</span></div>");
            container.append(reloadButton);
            statusbar.append(container);
            reloadButton.jqxButton({  width: 70, height: 18 });
             $("#showGrid").bind('rowselect', function (event) {
                 var selectedRowIndex = event.args.rowindex;
                  var pageSize = event.args.owner.rows.records.length - 1;                       
                 if($.isArray(selectedRowIndex)){           
                     if(isSelectAll){
                         isSelectAll = false;    
                     } else{
                         isSelectAll = true;
                     }                                                                     
                     $('#showGrid').jqxGrid('clearselection');
                     if(isSelectAll){
                         for (i = 0; i <= pageSize; i++) {
                             var index = $('#showGrid').jqxGrid('getrowboundindex', i);
                             $('#showGrid').jqxGrid('selectrow', index);
                         }    
                     }
                 }                        
            });
            // reload grid data.
            reloadButton.click(function (event) {
                $("#showGrid").jqxGrid({ source: dataAdapter });
            });
        }
    });

}
<!--

//-->
</script>