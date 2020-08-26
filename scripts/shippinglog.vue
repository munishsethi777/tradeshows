var shippinglogs = this;
$(document).ready(function () {
    var detailsofinternet = Vue.component("detailsofinternet", {
        props: ["index", "key", "flag"],
        template: `<div class="accordion">
    <div :class="'detailpanel' + index" :class="{'panel panel-mauve':flag == 'false'}">
        <div class="panel-heading" :id="'headingOne' + index" v-if="this.flag == 'false'">
            <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" :href="'#collapseOne' + index" aria-expanded="false"><span>Main</span></a>
                <a class="pull-right collapsed" data-toggle="collapse" data-parent="#accordion" :href="'#collapseOne' + index" aria-expanded="false">
                    <i class="fa fa-arrow-down" aria-hidden="true"></i>
                </a>
            </h4>
        </div>
        <div :id="'collapseOne' + index" class="" v-bind:class="{'panel-collapse collapse':flag == 'false'}" :aria-labelledby="'headingOne' + index" data-parent="#accordion">
            <div :class="{'panel-body':flag=='false'}" :style="{'padding:30px':flag=='false'}">
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Save Batch to Z:\\Cust\\Dot Com Orders :</label>
                    <div class="col-lg-4">
                        <div class="input-group date">
                            <input tabindex="" type="text" value="" name="saveBatchToZDotComOrders[]" :id="'saveBatchToZDotComOrders' + index" class="form-control currentdatepicker" v-model="saveBatchToZDotComOrders">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Print & Save Pick List from WMS :</label>
                    <div class="col-lg-4">
                        <input type="text" name="printSavePickListFromWMS[]" class="form-control" :id="'printSavePickListFromWMS' + index" v-model="printSavePickListFromWMS">

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Create Shipments in Lingo :</label>
                    <div class="col-lg-4">
                        <input type="text" value="" name="createShipmentsInLingo[]" :id="'createShipmentsInLingo' + index" class="form-control" v-model="createShipmentsInLingo">
                    </div>
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Open pick ticket Pdf Batch to Verify weights, Ship via & service level against Lingo for parcel creation :</label>
                    <div class="col-lg-4">
                        <input tabindex="" type="text" value="" name="openPickTicketPdfBatchToVerifyWeights[]" :id="'openPickTicketPdfBatchToVerifyWeights' + index" class="form-control" v-model="openPickTicketPdfBatchToVerifyWeights">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Print labels from Customer portal * must print cover label first* :</label>
                    <div class="col-lg-4">
                        <input tabindex="" type="text" value="" name="printLabelsFromCustomerPortal[]" :id="'printLabelsFromCustomerPortal' + index" class="form-control" v-model="printLabelsFromCustomerPortal">
                    </div>
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Print labels from Alpine's UPS or FEDEX station *must print cover label first* :</label>
                    <div class="col-lg-4">
                        <input tabindex="" type="text" value="" name="printLabelsFromAlpineUPS[]" :id="'printLabelsFromAlpineUPS' + index" class="form-control" v-model="printLabelsFromAlpineUPS">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Send ASNs through Lingo or SPS :</label>
                    <div class="col-lg-4">
                        <input tabindex="" type="text" value="" name="sendASNThroughLingo[]" :id="'sendASNThroughLingo' + index" class="form-control" v-model="sendASNThroughLingo">
                    </div>
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Add Tracking in customer portal :</label>
                    <div class="col-lg-4">
                        <input tabindex="" type="text" value="" name="addTrackingInCustomerPortal[]" :id="'addTrackingInCustomerPortal' + index" class="form-control" v-model="addTrackingInCustomerPortal">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Send invoice through Lingo or SPS :</label>
                    <div class="col-lg-4">
                        <input tabindex="" type="text" value="" name="sendInvoiceThroughLingo[]" :id="'sendInvoiceThroughLingo' + index" class="form-control" v-model="sendInvoiceThroughLingo">
                    </div>
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Send invoice on customer portal :</label>
                    <div class="col-lg-4">
                        <input tabindex="" type="text" value="" name="sendInvoiceOnCustomerPortal[]" :id="'sendInvoiceOnCustomerPortal' + index" class="form-control" v-model="sendInvoiceOnCustomerPortal">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Verify with Lead Batch and labels Printed Name :</label>
                    <div class="col-lg-4">
                        <div class="input-group datetime">
                            <input tabindex="" type="text" value="" name="verifyWithLeadBatch[]" :id="'verifyWithLeadBatch' + index" class="form-control currentdatetimepicker" v-model="verifyWithLeadBatch">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="panel panel-mauve">
                        <div class="panel-heading">Notes for Logistic in USA office :</div>
                        <div class="panel-body">
                            <textarea name="notesForLogisticInUSAOffice[]" :id="'notesForLogisticInUSAOffice' + index" class="form-control" v-model="notesForLogisticInUSAOffice"></textarea>
                            <div class="row">
                                <ul class="list-group"></ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label bg-formLabelBeige">Issued to Order Lead Alma :</label>
                    <div class="col-lg-4">
                        <div class="input-group datetime">
                            <input type="text" value="" name="issuedToOrderLeadAlma[]" :id="'issuedToOrderLeadAlma' + index" class="form-control currentdatetimepicker" v-model="issuedToOrderLeadAlma">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label bg-formLabelRustic">Order lead issued batch to warehouse :</label>
                    <div class="col-lg-4">
                        <div class="input-group datetime">
                            <input tabindex="" type="text" value="" name="orderLeadIssuedBatchToWarehouse[]" :id="'orderLeadIssuedBatchToWarehouse' + index" class="form-control currentdatetimepicker" v-model="orderLeadIssuedBatchToWarehouse">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <label class="col-lg-2 col-form-label bg-formLabelRustic">Warehouse lead Confirmed Pick Tickets Revieved :</label>
                    <div class="col-lg-4">
                        <input tabindex="" type="text" value="" name="warehouseLeadConfirmedPickTicketsReviewed[]" :id="'warehouseLeadConfirmedPickTicketsReviewed' + index" class="form-control" v-model="warehouseLeadConfirmedPickTicketsReviewed">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label bg-formLabelGrey">Invoice Date in OMS :</label>
                    <div class="col-lg-4">
                        <div class="input-group date">
                            <input tabindex="" type="text" value="" name="invoiceDateInOMS[]" :id="'invoiceDateInOMS' + index" class="form-control currentdatepicker" v-model="invoiceDateInOMS">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <label class="col-lg-2 col-form-label bg-formLabelGrey">Number of invoices generate :</label>
                    <div class="col-lg-4">
                        <input tabindex="" type="text" value="" name="numberOfInvoicesGenerate[]" :id="'numberOfInvoicesGenerate' + index" class="form-control" v-model="numberOfInvoicesGenerate">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="panel panel-grey">
                        <div class="panel-heading">Invoiced issues to report to USA office :</div>
                        <div class="panel-body">
                            <textarea name="invoicedIssuesToReportToUSAOffice[]" :id="'invoicedIssuesToReportToUSAOffice' + index" class="form-control" v-model="invoicedIssuesToReportToUSAOffice"></textarea>
                            <div class="row">
                                <ul class="list-group"></ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-2 col-form-label bg-formLabelGrey">OMS invoiced updated with Frieght Cost in source :</label>
                    <div class="col-lg-4">
                        <div class="input-group date">
                            <input tabindex="" type="text" value="" name="omsInvoicedUpdatedWithFrieght[]" :id="'omsInvoicedUpdatedWithFrieght' + index" class="form-control currentdatepicker" v-model="omsInvoicedUpdatedWithFrieght">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <label class="col-lg-2 col-form-label bg-formLabelGrey">Create ASN and invoiced in Lingo :</label>
                    <div class="col-lg-4">
                        <div class="input-group date">
                            <input tabindex="" type="text" value="" name="createASNInvoicedInLingo[]" :id="'createASNInvoicedInLingo' + index" class="form-control currentdatepicker" v-model="createASNInvoicedInLingo">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label bg-formLabelGrey">Date Batch is 100% invoiced (Open Pick Ticket Report has 0 Open P/T's) :</label>
                    <div class="col-lg-4">
                        <div class="input-group date">
                            <input tabindex="" type="text" value="" name="dateBatchIsInvoiced[]" :id="'dateBatchIsInvoiced'+index" class="form-control currentdatepicker" v-model="dateBatchIsInvoiced">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>`,
        data: function () {
            return {
                index: this.index,
                saveBatchToZDotComOrders: "",
                printSavePickListFromWMS: "",
                createShipmentsInLingo: "",
                openPickTicketPdfBatchToVerifyWeights: "",
                printLabelsFromCustomerPortal: "",
                printLabelsFromAlpineUPS: "",
                sendASNThroughLingo: "",
                addTrackingInCustomerPortal: "",
                sendInvoiceThroughLingo: "",
                sendInvoiceOnCustomerPortal: "",
                verifyWithLeadBatch: "",
                notesForLogisticInUSAOffice: "",
                issuedToOrderLeadAlma: "",
                orderLeadIssuedBatchToWarehouse: "",
                warehouseLeadConfirmedPickTicketsReviewed: "",
                invoiceDateInOMS: "",
                numberOfInvoicesGenerate: "",
                invoicedIssuesToReportToUSAOffice: "",
                omsInvoicedUpdatedWithFrieght: "",
                createASNInvoicedInLingo: "",
                dateBatchIsInvoiced: "",
            };
        }
    });
    var domesticlogcomponent = Vue.component("domesticlogcomponent", {
        props: ["index"],
        template: `<div><div v-if="showdata">
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Order No/ Pick Ticket :</label>
        <div class="col-lg-4">
            <input tabindex="" type="text" maxLength="250" value="" name="orderNumber" id="orderNumber" class="form-control" v-model="orderNumber">
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Allocated Full :</label>
        <div class="col-lg-4">
          <div class="i-checks isAllocatedFull">
            <input type="checkbox" name="isAllocatedFull" id="isAllocatedFull" v-model="isAllocatedFull">
          </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Pk No# :</label>
        <div class="col-lg-4">
            <input tabindex="" type="text" maxLength="250" value="" name="pkNumber" id="pkNumber" class="form-control" v-model="pkNumber">
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Total So Qty :</label>
        <div class="col-lg-4">
            <input tabindex="" type="text" maxLength="250" value="" name="totalSoQty" id="totalSoQty" class="form-control" v-model="totalSoQty">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelMauve">PO # :</label>
        <div class="col-lg-4">
            <input tabindex="" type="text" maxLength="250" value="" name="poNumber" id="poNumber" class="form-control" v-model="poNumber">
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Total Cases :</label>
        <div class="col-lg-4">
            <input tabindex="" type="text" maxLength="250" value="" name="totalCases" id="totalCases" class="form-control" v-model="totalCases">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Order Ship Date :</label>
        <div class="col-lg-4">
            <div class="input-group date">
                <input tabindex="" type="text" maxLength="250" value="" name="orderShipDate" id="orderShipDate" class="form-control currentdatepicker" v-model="orderShipDate">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Total Actual Open Order :</label>
        <div class="col-lg-4">
            <input tabindex="" type="text" maxLength="250" value="" name="totalActualOpenOrder" id="totalActualOpenOrder" class="form-control" v-model="totalActualOpenOrder">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Order Must Arrive By :</label>
        <div class="col-lg-4">
            <div class="input-group date">
                <input tabindex="" type="text" maxLength="250" value="" name="orderMustArriveBy" id="orderMustArriveBy" class="form-control currentdatepicker" v-model="orderMustArriveBy">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Total Actual Open Order :</label>
        <div class="col-lg-4">
            <input tabindex="" type="text" maxLength="250" value="" name="totalActualOpenOrder" id="totalActualOpenOrder" class="form-control" v-model="totalActualOpenOrder">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Cancel Date:</label>
        <div class="col-lg-4">
            <div class="input-group date">
                <input tabindex="" tabindex="" type="text" maxLength="250" value="" name="cancelDate" id="cancelDate" class="form-control currentdatepicker" v-model="cancelDate">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Ship Service Level :</label>
        <div class="col-lg-4">
            <select class="form-control" v-model="ship_service_level_chosen" name="shipServiceLevel" id="shipServiceLevel">
                <option v-for="option in ship_service_level" :value="option">{{option}}</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-6">
            <div class="panel panel-mauve">
                <div class="panel-heading">CS Notes:</div>
                <div class="panel-body">
                    <textarea name="csNotes" id="csNotes" class="form-control" v-model="csNotes"></textarea>
                    <div class="row">
                        <ul class="list-group"></ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-beige">
                <div class="panel-heading">Warehouse Notes:</div>
                <div class="panel-body">
                    <textarea name="warehouseNotes" id="warehouseNotes" class="form-control" v-model="warehouseNotes"></textarea>
                    <div class="row">
                        <ul class="list-group"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelBeige">Logistic Name :</label>
        <div class="col-lg-4">
            <input type="text" name="logisticName" id="logisticName" class="form-control" v-model="logisticName">
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelBeige">Status of Order :</label>
        <div class="col-lg-4">
            <select name="statusOfOrder" id="statusOfOrder" class="form-control" v-model="status_of_order_chosen">
                <option v-for="option in status_of_order" :value="option">{{option}}</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelBeige">Pick Up Type :</label>
        <div class="col-lg-4">
            <select name="pickUpType" id="pickUpType" class="form-control" v-model="pick_up_type_chosen">
                <option v-for="option in pick_up_type" :value="option">{{option}}</option>
            </select>
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelBeige">Carrier :</label>
        <div class="col-lg-4">
            <input type="text" name="carrier" id="carrier" class="form-control" v-model="carrier">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelBeige">Pick Up Reference :</label>
        <div class="col-lg-4">
            <input type="text" name="pickUpReference" id="pickUpReference" class="form-control" v-model="pickUpReference">
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelBeige">Confirm Pickup Date :</label>
        <div class="col-lg-4">
            <div class="input-group date">
                <input type="text" name="confirmPickupDate" id="confirmPickupDate" class="form-control currentdatepicker" v-model="confirmPickupDate">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelBeige">Confirm Pickup Time :</label>
        <div class="col-lg-4">
            <div class="input-group time">
                <input type="text" name="confirmPickupTime" id="confirmPickupTime" class="form-control currenttimepicker" v-model="confirmPickupTime">
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
            </div>
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelBeige">Number of Pallets :</label>
        <div class="col-lg-4">
            <input type="text" name="numberOfPallets" id="numberOfPallets" class="form-control" v-model="numberOfPallets">
        </div>
    </div>
    <div class="form-group row">
        <div class="panel panel-beige">
            <div class="panel-heading">Logistic Team Internal Notes:</div>
            <div class="panel-body">
                <textarea name="logisticTeamInternalNotes" id="logisticTeamInternalNotes" class="form-control" v-model="logisticTeamInternalNotes"></textarea>
                <div class="row">
                    <ul class="list-group" style="padding: 10px 10px 0px 10px"></ul>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelBeige">Date Logistical Handed PT to ALma :</label>
        <div class="col-lg-4">
            <div class="input-group date">
                <input type="text" name="dateLogisticalHandedPtToAlma" id="dateLogisticalHandedPtToAlma" class="form-control currentdatetimepicker" v-model="dateLogisticalHandedPtToAlma">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelBeige">Invoiced</label>
        <div class="col-lg-4">
          <div class="i-checks Invoiced">
            <input type="checkbox" name="isInvoiced" id="isInvoiced" v-model="isInvoiced">
          </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelRustic">Pick Date :</label>
        <div class="col-lg-4">
            <div class="input-group date">
                <input type="text" id="pickDate" name="pickDate" class="form-control currentdatepicker" v-model="pickDate">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelRustic">Frieght Location in Warehouse</label>
        <div class="col-lg-4">
            <input type="text" name="frieghtLocationInWarehouse" id="frieghtLocationInWarehouse" class="form-control" v-model="frieghtLocationInWarehouse">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelRustic">Pro #:</label>
        <div class="col-lg-4">
            <input type="text" id="proNumber" name="proNumber" class="form-control" v-model="proNumber">
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelRustic">Date Frieght Picked up:</label>
        <div class="col-lg-4">
            <div class="input-group date">
                <input type="text" name="dateFrieghtPickedup" id="datefrieghtPickedup" class="form-control currentdatepicker" v-model="datefrieghtPickedup">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="panel panel-rustic">
            <div class="panel-heading">Notes to Logistic Team from Warehouse:</div>
            <div class="panel-body">
                <textarea name="notesToLogisticTeamFromWarehouse" id="notesToLogisticTeamFromWarehouse" class="form-control" v-model="notesToLogisticTeamFromWarehouse"></textarea>
                <div class="row">
                    <ul class="list-group" style="padding: 10px 10px 0px 10px"></ul>
                </div>
            </div>
        </div>
    </div>
    </div></div>`,
        data: function () {
            return {
                showdata: true,
                orderNumber: "",
                isAllocatedFull: false,
                pkNumber: "",
                totalSoQty: "",
                poNumber: "",
                totalCases: "",
                orderShipDate: "",
                totalActualOpenOrder: "",
                orderMustArriveBy: "",
                cancelDate: "",
                ship_service_level: ["Overnight", "2nd Day", "3rd Day"],
                ship_service_level_chosen: "",
                status_of_order: ["Order Shipped", "Invoiced", "Stagged", "Routed", "Waiting on Carrier"],
                pick_up_type: ["LTL", "Parcel"],
                pick_up_type_chosen: "",
                status_of_order_chosen: "",
                csNotes: "",
                warehouseNotes: "",
                logisticName: "",
                carrier: "",
                pickUpReference: "",
                confirmPickupDate: "",
                confirmPickupTime: "",
                numberOfPallets: "",
                logisticTeamInternalNotes: "",
                dateLogisticalHandedPtToAlma: "",
                datefrieghtPickedup: "",
                isInvoiced: false,
                pickDate: "",
                frieghtLocationInWarehouse: "",
                proNumber: "",
                dateFrieghtPickedup: "",
                notesToLogisticTeamFromWarehouse: "",
            };
        },
        mounted: () => {
            $(".i-checks.isAllocatedFull").on("ifChanged", () => {
                var ichecks = $(".i-checks.isAllocatedFull").iCheck({
                    checkboxClass: "icheckbox_square-green",
                    radioClass: "iradio_square-green",
                });
                if (ichecks[0].checked) {
                    shippinglogs.$children[0]._data["isAllocatedFull"] = true;
                }
                else {
                    shippinglogs.$children[0]._data["isAllocatedFull"] = false;
                }
            });
            $(".i-checks.Invoiced").on("ifChanged", () => {
                var ichecks = $(".i-checks.Invoiced").iCheck({
                    checkboxClass: "icheckbox_square-green",
                    radioClass: "iradio_square-green",
                });
                if (ichecks[0].checked) {
                    shippinglogs.$children[0]._data["isInvoiced"] = true;
                }
                else {
                    shippinglogs.$children[0]._data["isInvoiced"] = false;
                }
            });
        }
    });
    let shippinglogs = new Vue({
        el: "#createShippingLogForm",
        data: {
            business: ["Domestic", "Internet"],
            business_chosen: "Domestic",
            isEdi: false,
            ship_service_level: ["Overnight", "2nd Day", "3rd Day"],
            ship_service_level_chosen: "Overnight",
            status_of_order: [
                "Order Shipped",
                "Invoiced",
                "Stagged",
                "Routed",
                "Waiting on Carrier",
            ],
            status_of_order_chosen: "Order Shipped",
            pick_up_type: ["LTL", "Parcel"],
            pick_up_type_chosen: "LTL",
            PalletReport: 0,
            RMAReport: 0,
            OMSReport: 0,
            detailedUsers: 0,
            orderShipDate2: "",
            allocationTime: "",
            whNumber: "",
        },
        components: {
            detailsofinternet: detailsofinternet,
            domesticlogcomponent: domesticlogcomponent,
        },
        mounted: function () {
            $(".datepicker").attr("autocomplete", "off");
            $(".currentdatepicker").attr("autocomplete", "off");
            $(".currentdatetimepicker").attr("autocomplete", "off");
            $(".currenttimepicker").attr("autocomplete", "off");
            $(".dateControl").datetimepicker({
                timepicker: false,
                format: "m-d-Y",
                scrollMonth: false,
                scrollInput: false,
                onSelectDate: function (ct, $i) {
                    ondateTimeChange($i[0].id, $i[0].value);
                },
            });
            $(".datepicker").datetimepicker({
                timepicker: false,
                format: "m-d-Y",
                scrollMonth: false,
                scrollInput: false,
                onSelectDate: function (ct, $i) {
                    ondateTimeChange($i[0].id, $i[0].value);
                },
            });
            $(".currentdatepicker").datetimepicker({
                timepicker: false,
                format: "m-d-Y",
                scrollMonth: false,
                scrollInput: false,
                minDate: 0,
                onSelectDate: function (ct, $i) {
                    ondateTimeChange($i[0].id, $i[0].value);
                },
            });
            $(".currentdatetimepicker").datetimepicker({
                timepicker: true,
                format: "m-d-Y H:i:s",
                scrollMonth: false,
                scrollInput: false,
                minDate: 0,
                onSelectDate: function (ct, $i) { },
                onClose: function (ct, $i) {
                    ondateTimeChange($i[0].id, $i[0].value);
                },
            });
            $(".currenttimepicker").datetimepicker({
                datepicker: false,
                timepicker: true,
                format: "H:i:s",
                scrollMonth: false,
                scrollInput: false,
                minDate: 0,
                onSelectTime: function (ct, $i) { },
                onSelectDate: function (ct, $i) { },
                onClose: function (ct, $i) {
                    ondateTimeChange($i[0].id, $i[0].value);
                },
            });
            function ondateTimeChange(id_of_variable, value_of_variable) {
                //   var digit: number = 0;
                //   let total_amount_of_indexes: number = Number(
                //     this.$vm.$parent._data.detailedUsers
                //   );
                //   var total_amount_of_indexes_clone: number = total_amount_of_indexes;
                //   var id_of_variable_without_index: string = "";
                //   while (total_amount_of_indexes_clone > 0) {
                //     digit += 1;
                //     total_amount_of_indexes_clone /= 10;
                //   }
                //   for (var i: number = digit; i > 0; i--) {
                //     if (isNaN(id_of_variable.substring(id_of_variable.length - i))) {
                //       id_of_variable_without_index = id_of_variable.substring(
                //         0,
                //         id_of_variable.length - i
                //       );
                //       break;
                //     }
                //   }
                //   this.$vm0[digit]._data.id_of_variable_without_index = value_of_variable;
                var digit = 0;
                let total_amount_of_indexes = shippinglogs.$children.length;
                var total_amount_of_indexes_clone = total_amount_of_indexes;
                var working_with_child_index = 0;
                var id_of_variable_without_index = "";
                if (id_of_variable == "orderShipDate" || id_of_variable == "orderIssueDate" || id_of_variable == "orderMustArriveBy" || id_of_variable == "cancelDate" || id_of_variable == "confirmPickupDate" || id_of_variable == "confirmPickupTime" || id_of_variable == "numberOfPallets" || id_of_variable == "pickDate" || id_of_variable == "datefrieghtPickedup" || id_of_variable == "dateLogisticalHandedPtToAlma") {
                    shippinglogs.$children[0]._data[id_of_variable] = value_of_variable;
                }
                else if (id_of_variable == "orderShipDate2" || id_of_variable == "allocationTime") {
                    shippinglogs._data[id_of_variable] = value_of_variable;
                }
                else if (shippinglogs.$children.length != 0) {
                    while (total_amount_of_indexes_clone >= 1) {
                        digit += 1;
                        total_amount_of_indexes_clone /= 10;
                    }
                    for (var i = digit; i > 0; i--) {
                        if (!isNaN(id_of_variable.substring(id_of_variable.length - i))) {
                            id_of_variable_without_index = id_of_variable.substring(0, id_of_variable.length - i);
                            working_with_child_index = parseInt(id_of_variable.substring(id_of_variable.length - i));
                            break;
                        }
                    }
                    if (id_of_variable_without_index == "saveBatchToZDotComOrders" ||
                        id_of_variable_without_index == "printSavePickListFromWMS" ||
                        id_of_variable_without_index == "createShipmentsInLingo" ||
                        id_of_variable_without_index ==
                            "openPickTicketPdfBatchToVerifyWeights" ||
                        id_of_variable_without_index == "printLabelsFromCustomerPortal" ||
                        id_of_variable_without_index == "printLabelsFromAlpineUPS" ||
                        id_of_variable_without_index == "sendASNThroughLingo" ||
                        id_of_variable_without_index == "addTrackingInCustomerPortal" ||
                        id_of_variable_without_index == "sendInvoiceThroughLingo" ||
                        id_of_variable_without_index == "sendInvoiceOnCustomerPortal" ||
                        id_of_variable_without_index == "verifyWithLeadBatch" ||
                        id_of_variable_without_index == "notesForLogisticInUSAOffice" ||
                        id_of_variable_without_index == "issuedToOrderLeadAlma" ||
                        id_of_variable_without_index == "orderLeadIssuedBatchToWarehouse" ||
                        id_of_variable_without_index ==
                            "warehouseLeadConfirmedPickTicketsReviewed" ||
                        id_of_variable_without_index == "invoiceDateInOMS" ||
                        id_of_variable_without_index == "numberOfInvoicesGenerate" ||
                        id_of_variable_without_index ==
                            "invoicedIssuesToReportToUSAOffice" ||
                        id_of_variable_without_index == "omsInvoicedUpdatedWithFrieght" ||
                        id_of_variable_without_index == "createASNInvoicedInLingo" ||
                        id_of_variable_without_index == "dateBatchIsInvoiced") {
                        shippinglogs.$children[working_with_child_index]._data[id_of_variable_without_index] = value_of_variable;
                    }
                }
            }
        },
        updated: function () {
            $(".i-checks").iCheck({
                checkboxClass: "icheckbox_square-green",
                radioClass: "iradio_square-green",
            });
            $(".datepicker").attr("autocomplete", "off");
            $(".currentdatepicker").attr("autocomplete", "off");
            $(".currentdatetimepicker").attr("autocomplete", "off");
            $(".currenttimepicker").attr("autocomplete", "off");
            $(".dateControl").datetimepicker({
                timepicker: false,
                format: "m-d-Y",
                scrollMonth: false,
                scrollInput: false,
                onSelectDate: function (ct, $i) {
                    ondateTimeChange($i[0].id, $i[0].value);
                },
            });
            $(".datepicker").datetimepicker({
                timepicker: false,
                format: "m-d-Y",
                scrollMonth: false,
                scrollInput: false,
                onSelectDate: function (ct, $i) {
                    ondateTimeChange($i[0].id, $i[0].value);
                },
            });
            $(".currentdatepicker").datetimepicker({
                timepicker: false,
                format: "m-d-Y",
                scrollMonth: false,
                scrollInput: false,
                minDate: 0,
                onSelectDate: function (ct, $i) {
                    ondateTimeChange($i[0].id, $i[0].value);
                },
            });
            $(".currentdatetimepicker").datetimepicker({
                timepicker: true,
                format: "m-d-Y H:i:s",
                scrollMonth: false,
                scrollInput: false,
                minDate: 0,
                onSelectDate: function (ct, $i) { },
                onClose: function (ct, $i) {
                    ondateTimeChange($i[0].id, $i[0].value);
                },
            });
            $(".currenttimepicker").datetimepicker({
                datepicker: false,
                timepicker: true,
                format: "H:i:s",
                scrollMonth: false,
                scrollInput: false,
                minDate: 0,
                onSelectTime: function (ct, $i) { },
                onSelectDate: function (ct, $i) { },
                onClose: function (ct, $i) {
                    ondateTimeChange($i[0].id, $i[0].value);
                },
            });
            function ondateTimeChange(id_of_variable, value_of_variable) {
                var digit = 0;
                let total_amount_of_indexes = shippinglogs.$children.length;
                var total_amount_of_indexes_clone = total_amount_of_indexes;
                var working_with_child_index = 0;
                var id_of_variable_without_index = "";
                if (id_of_variable == "orderShipDate" || id_of_variable == "orderIssueDate" || id_of_variable == "orderMustArriveBy" || id_of_variable == "cancelDate" || id_of_variable == "confirmPickupDate" || id_of_variable == "confirmPickupTime" || id_of_variable == "numberOfPallets" || id_of_variable == "pickDate" || id_of_variable == "datefrieghtPickedup" || id_of_variable == "dateLogisticalHandedPtToAlma") {
                    shippinglogs.$children[0]._data[id_of_variable] = value_of_variable;
                }
                else if (id_of_variable == "orderShipDate2" || id_of_variable == "allocationTime") {
                    shippinglogs._data[id_of_variable] = value_of_variable;
                }
                else if (shippinglogs.$children.length != 0) {
                    while (total_amount_of_indexes_clone >= 1) {
                        digit += 1;
                        total_amount_of_indexes_clone /= 10;
                    }
                    for (var i = digit; i > 0; i--) {
                        if (!isNaN(id_of_variable.substring(id_of_variable.length - i))) {
                            id_of_variable_without_index = id_of_variable.substring(0, id_of_variable.length - i);
                            working_with_child_index = parseInt(id_of_variable.substring(id_of_variable.length - i));
                            break;
                        }
                    }
                    if (id_of_variable_without_index == "saveBatchToZDotComOrders" ||
                        id_of_variable_without_index == "printSavePickListFromWMS" ||
                        id_of_variable_without_index == "createShipmentsInLingo" ||
                        id_of_variable_without_index ==
                            "openPickTicketPdfBatchToVerifyWeights" ||
                        id_of_variable_without_index == "printLabelsFromCustomerPortal" ||
                        id_of_variable_without_index == "printLabelsFromAlpineUPS" ||
                        id_of_variable_without_index == "sendASNThroughLingo" ||
                        id_of_variable_without_index == "addTrackingInCustomerPortal" ||
                        id_of_variable_without_index == "sendInvoiceThroughLingo" ||
                        id_of_variable_without_index == "sendInvoiceOnCustomerPortal" ||
                        id_of_variable_without_index == "verifyWithLeadBatch" ||
                        id_of_variable_without_index == "notesForLogisticInUSAOffice" ||
                        id_of_variable_without_index == "issuedToOrderLeadAlma" ||
                        id_of_variable_without_index == "orderLeadIssuedBatchToWarehouse" ||
                        id_of_variable_without_index ==
                            "warehouseLeadConfirmedPickTicketsReviewed" ||
                        id_of_variable_without_index == "invoiceDateInOMS" ||
                        id_of_variable_without_index == "numberOfInvoicesGenerate" ||
                        id_of_variable_without_index ==
                            "invoicedIssuesToReportToUSAOffice" ||
                        id_of_variable_without_index == "omsInvoicedUpdatedWithFrieght" ||
                        id_of_variable_without_index == "createASNInvoicedInLingo" ||
                        id_of_variable_without_index == "dateBatchIsInvoiced") {
                        shippinglogs.$children[working_with_child_index]._data[id_of_variable_without_index] = value_of_variable;
                    }
                }
            }
        },
        methods: {
            business_change: () => {
                if (shippinglogs._data.business_chosen == "Domestic") {
                    shippinglogs.$children[0]._data.showdata = true;
                }
                else {
                    shippinglogs.$children[0]._data.showdata = false;
                }
            }
        }
    });
    $(".i-checks").iCheck({
        checkboxClass: "icheckbox_square-green",
        radioClass: "iradio_square-green",
    });
    function business_change() {
        if (shippinglogs._data.business_chosen == "Domestic") {
            shippinglogs.$children[0]._data.showdata = true;
        }
        else {
            shippinglogs.$children[0]._data.showdata = false;
        }
    }
});
