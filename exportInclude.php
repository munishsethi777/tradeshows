<?php
  
?>
    <div id="exportModalForm" class="modal fade" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Export</h4>
                </div>
                <div class="modal-body exportMainDiv">
                    <div class="row" >
                        <div class="col-sm-12">
                            <form role="form" method="GET" action="Actions/QCScheduleAction.php" id="exportForm" class="form-horizontal">
                                <input type="hidden" value="export" name="call">
                                <input type="hidden" name="qcscheduleseq" id="qcscheduleseq">
                                <input type="hidden" id="queryString" name="queryString"/>
                                <h4 class="modal-title">Select a option for export :- </h4><br/>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <input type="radio" value="selectedRows" checked="checked" name="exportOption" id="selected"> Selected Rows
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="radio" value="allRows" name="exportOption" id="all"> All Rows
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="radio" value="template" name="exportOption" id="all"> Empty Template
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary ladda-button" data-style="expand-right" id="exportBtn" type="button">
                                        <span class="ladda-label">Export</span>
                                    </button>        
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="exportModalFormForGraphicsLogs" class="modal fade" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Export</h4>
                </div>
                <div class="modal-body exportMainDiv">
                    <div class="row" >
                        <div class="col-sm-12">
                            <form role="form" method="GET" action="Actions/GraphicLogAction.php" id="exportFormForGraphicsLog" class="form-horizontal">
                                <input type="hidden" value="export" name="call">
                                <input type="hidden" name="graphiclogseq" id="graphiclogseq">
                                <input type="hidden" id="queryStringForGraphicLog" name="queryString"/>
                                <h4 class="modal-title">Select a option for export :- </h4><br/>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <input type="radio" value="selectedRows" checked="checked" name="exportOptionForGraphicsLogs" id="selected"> Selected Rows
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="radio" value="allRows" name="exportOptionForGraphicsLogs" id="all"> All Rows
                                            </div>
                                            <!-- <div class="col-sm-4">
                                                <input type="radio" value="template" name="exportOptionForGraphicsLogs" id="all"> Empty Template
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary ladda-button" data-style="expand-right" id="exportBtnForGraphicsLog" type="button">
                                        <span class="ladda-label">Export</span>
                                    </button>        
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="exportModalFormForInstructionManualLogs" class="modal fade" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Export</h4>
                </div>
                <div class="modal-body exportMainDiv">
                    <div class="row" >
                        <div class="col-sm-12">
                            <form role="form" method="GET" action="Actions/InstructionManualLogsAction.php" id="exportFormForInstructionManualLog" class="form-horizontal">
                                <input type="hidden" value="export" name="call">
                                <input type="hidden" name="filterId"/>
                                <input type="hidden" name="instructionmanuallogseq" id="instructionmanuallogseq">
                                <input type="hidden" id="queryStringForInstructionManualLog" name="queryStringForInstructionManualLog"/>
                                <h4 class="modal-title">Select a option for export :- </h4><br/>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <input type="radio" value="selectedRows" checked="checked" name="exportOptionForInstructionManualLogs" id="selected"> Selected Rows
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="radio" value="allRows" name="exportOptionForInstructionManualLogs" id="all" checked> All Rows
                                            </div>
                                            <!-- <div class="col-sm-4">
                                                <input type="radio" value="template" name="exportOptionForInstructionManualLogs" id="all"> Empty Template
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary ladda-button" data-style="expand-right" id="exportBtnForInstructionManualLog" type="button">
                                        <span class="ladda-label">Export</span>
                                    </button>        
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="exportModalFormForRequests" class="modal fade" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Export</h4>
                </div>
                <div class="modal-body exportMainDiv">
                    <div class="row" >
                        <div class="col-sm-12">
                        <form role="form" method="GET" action="Actions/RequestAction.php" id="exportFormForRequests" class="form-horizontal">
                                <input type="hidden" value="export" name="call">
                                <input type="hidden" name="filterId"/>
                                <input type="hidden" name="requestSeqs" id="requestSeqs">
                                <input type="hidden" id="queryStringForRequests" name="queryStringForRequests"/>
                                <h4 class="modal-title">Select a option for export :- </h4><br/>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <input type="radio" value="selectedRows" checked="checked" name="exportOptionForRequests" id="selected"> Selected Rows
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="radio" value="allRows" name="exportOptionForRequests" id="all" checked> All Rows
                                            </div>
                                            <!-- <div class="col-sm-4">
                                                <input type="radio" value="template" name="exportOptionForInstructionManualLogs" id="all"> Empty Template
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary ladda-button" data-style="expand-right" id="exportBtnForRequests" type="button">
                                        <span class="ladda-label">Export</span>
                                    </button>        
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="deleteAttachmentModal" class="modal fade" aria-hidden="true" style='z-index:2051 !important'>
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title">Do you want delete this attachment</h3>
                </div>
                <div class="modal-body exportMainDiv">
                    <div class="row" >
                        <div class="col-sm-12">
                            <form role="form" method="GET" action="Actions/RequestAction.php" id="deleteAttachmentModalForm" class="form-horizontal" style='text-align:end'>
                                <input type="hidden" value="deleteAttachment" name="call">
                                <input type="hidden" id='attachmentseq' name="attachmentseq"/>
                                <input type="hidden" id='attachmentname' name="attachmentname"/>
                                <input type="hidden" id='requestseq' name="requestseq"/>
                                <input type="hidden" id='attachmenttitle' name="attachmenttitle"/>
                                
                                    <button class="btn btn-primary ladda-button" data-style="expand-right" id="deleteRequestAttachmentBtn" type="button">
                                        <span class="ladda-label">Yes</span>
                                    </button>        
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>