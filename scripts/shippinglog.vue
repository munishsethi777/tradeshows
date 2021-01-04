var shippinglogs;
var seq;
$(document).ready(function () {
    var detailsofinternet = Vue.component("detailsofinternet", {
        // props: ["index", "key", "flag", "isdomestic"],
        props: ["index", "flag", "isdomestic"],
        template: `<div class="accordion" v-bind:class="{'invisible_block':isdomestic}">
      <div v-if="this.flag == 'false'" :class="'detailpanel' + index" class="panel panel-mauve">
      <div class="panel-heading" :id="'headingOne' + index" v-if="this.flag == 'false'">
            <h4 class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" :href="'#collapseOne' + index" aria-expanded="false"><span>Main</span></a>
                <a class="pull-right collapsed" data-toggle="collapse" data-parent="#accordion" :href="'#collapseOne' + index" aria-expanded="false">
                    <i class="fa fa-arrow-down" aria-hidden="true"></i>
                </a>
            </h4>
        </div>
        <div :id="'collapseOne' + index" class="" v-bind:class="{'panel-collapse collapse':flag == 'false'}" :aria-labelledby="'headingOne' + index" data-parent="#accordion">
            <div class="panel-body" style="padding:30px">
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Save Batch to Z:\\Cust\\Dot Com Orders :</label>
                    <div class="col-lg-4">
                        <div class="input-group date">
                            <input tabindex="" type="text" value="" name="savebatchto[]" :id="'saveBatchToZDotComOrders' + index" class="form-control currentdatepicker" v-model="saveBatchToZDotComOrders">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Print & Save Pick List from WMS :</label>
                    <div class="col-lg-4">
                        <input type="text" name="printpicklistfromwms[]" class="form-control" :id="'printSavePickListFromWMS' + index" v-model="printSavePickListFromWMS">

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Create Shipments in Lingo :</label>
                    <div class="col-lg-4">
                        <input type="text" value="" name="createshipmentsinlingo[]" :id="'createShipmentsInLingo' + index" class="form-control" v-model="createShipmentsInLingo">
                    </div>
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Open pick ticket Pdf Batch to Verify weights, Ship via & service level against Lingo for parcel creation :</label>
                    <div class="col-lg-4">
                        <input tabindex="" type="text" value="" name="openpickticketpdfbatchtoverifyweights[]" :id="'openPickTicketPdfBatchToVerifyWeights' + index" class="form-control" v-model="openPickTicketPdfBatchToVerifyWeights">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Print labels from Customer portal * must print cover label first* :</label>
                    <div class="col-lg-4">
                        <input tabindex="" type="text" value="" name="printlabelsfromcustomerportal[]" :id="'printLabelsFromCustomerPortal' + index" class="form-control" v-model="printLabelsFromCustomerPortal">
                    </div>
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Print labels from Alpine's UPS or FEDEX station *must print cover label first* :</label>
                    <div class="col-lg-4">
                        <input tabindex="" type="text" value="" name="printlabelsfromalpineups[]" :id="'printLabelsFromAlpineUPS' + index" class="form-control" v-model="printLabelsFromAlpineUPS">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Send ASNs through Lingo or SPS :</label>
                    <div class="col-lg-4">
                        <input tabindex="" type="text" value="" name="sendasnthroughlingo[]" :id="'sendASNThroughLingo' + index" class="form-control" v-model="sendASNThroughLingo">
                    </div>
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Add Tracking in customer portal :</label>
                    <div class="col-lg-4">
                        <input tabindex="" type="text" value="" name="addtrackingincustomerportal[]" :id="'addTrackingInCustomerPortal' + index" class="form-control" v-model="addTrackingInCustomerPortal">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Send invoice through Lingo or SPS :</label>
                    <div class="col-lg-4">
                        <input tabindex="" type="text" value="" name="sendinvoicethroughlingo[]" :id="'sendInvoiceThroughLingo' + index" class="form-control" v-model="sendInvoiceThroughLingo">
                    </div>
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Send invoice on customer portal :</label>
                    <div class="col-lg-4">
                        <input tabindex="" type="text" value="" name="sendinvoiceoncustomerportal[]" :id="'sendInvoiceOnCustomerPortal' + index" class="form-control" v-model="sendInvoiceOnCustomerPortal">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Verify with Lead Batch and labels Printed Name :</label>
                    <div class="col-lg-4">
                        <div class="input-group datetime">
                            <input tabindex="" type="text" value="" name="verifywithleadbatchandlabelsprintedname[]" :id="'verifyWithLeadBatch' + index" class="form-control currentdatetimepicker" v-model="verifyWithLeadBatch">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="panel panel-mauve">
                        <div class="panel-heading">Notes for Logistic in USA office :</div>
                        <div class="panel-body">
                            <textarea name="notesforlogisticinusaoffice[]" :id="'notesForLogisticInUSAOffice' + index" class="form-control" v-model="notesForLogisticInUSAOffice"></textarea>
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
                            <input type="text" value="" name="issuedtoorderleadalma[]" :id="'issuedToOrderLeadAlma' + index" class="form-control currentdatetimepicker" v-model="issuedToOrderLeadAlma">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label bg-formLabelRustic">Order lead issued batch to warehouse :</label>
                    <div class="col-lg-4">
                        <div class="input-group datetime">
                            <input tabindex="" type="text" value="" name="orderleadissuedbatchtowarehouse[]" :id="'orderLeadIssuedBatchToWarehouse' + index" class="form-control currentdatetimepicker" v-model="orderLeadIssuedBatchToWarehouse">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <label class="col-lg-2 col-form-label bg-formLabelRustic">Warehouse lead Confirmed Pick Tickets Revieved :</label>
                    <div class="col-lg-4">
                        <input tabindex="" type="number" value="" name="warehouseleadconfirmedpickticketsreviewed[]" :id="'warehouseLeadConfirmedPickTicketsReviewed' + index" class="form-control" v-model="warehouseLeadConfirmedPickTicketsReviewed">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label bg-formLabelGrey">Invoice Date in OMS :</label>
                    <div class="col-lg-4">
                        <div class="input-group date">
                            <input tabindex="" type="text" value="" name="invoicedateinoms[]" :id="'invoiceDateInOMS' + index" class="form-control currentdatepicker" v-model="invoiceDateInOMS">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <label class="col-lg-2 col-form-label bg-formLabelGrey">Number of invoices generate :</label>
                    <div class="col-lg-4">
                        <input tabindex="" type="number" value="" name="numberofinvoicesgenerated[]" :id="'numberOfInvoicesGenerate' + index" class="form-control" v-model="numberOfInvoicesGenerate">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="panel panel-grey">
                        <div class="panel-heading">Invoiced issues to report to USA office :</div>
                        <div class="panel-body">
                            <textarea name="invoicedissuestoreportusaoffice[]" :id="'invoicedIssuesToReportToUSAOffice' + index" class="form-control" v-model="invoicedIssuesToReportToUSAOffice"></textarea>
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
                            <input tabindex="" type="text" value="" name="omsinvoicedupdatedwithfrieghtcostinsource[]" :id="'omsInvoicedUpdatedWithFrieght' + index" class="form-control currentdatepicker" v-model="omsInvoicedUpdatedWithFrieght">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <label class="col-lg-2 col-form-label bg-formLabelGrey">Create ASN and invoiced in Lingo :</label>
                    <div class="col-lg-4">
                        <div class="input-group date">
                            <input tabindex="" type="text" value="" name="createasnandinvoicedinlingo[]" :id="'createASNInvoicedInLingo' + index" class="form-control currentdatepicker" v-model="createASNInvoicedInLingo">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label bg-formLabelGrey">Date Batch is 100% invoiced (Open Pick Ticket Report has 0 Open P/T's) :</label>
                    <div class="col-lg-4">
                        <div class="input-group date">
                            <input tabindex="" type="text" value="" name="datebatchis100invoiced[]" :id="'dateBatchIsInvoiced'+index" class="form-control currentdatepicker" v-model="dateBatchIsInvoiced">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div v-else :class="'detailpanel' + index" >
        
        <div :id="'collapseOne' + index" :aria-labelledby="'headingOne' + index" data-parent="#accordion">
            <div class="panel-body">
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Save Batch to Z:\\Cust\\Dot Com Orders :</label>
                    <div class="col-lg-4">
                        <div class="input-group date">
                            <input tabindex="" type="text" value="" name="savebatchto[]" :id="'saveBatchToZDotComOrders' + index" class="form-control currentdatepicker" v-model="saveBatchToZDotComOrders">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Print & Save Pick List from WMS :</label>
                    <div class="col-lg-4">
                        <input type="text" name="printpicklistfromwms[]" class="form-control" :id="'printSavePickListFromWMS' + index" v-model="printSavePickListFromWMS">

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Create Shipments in Lingo :</label>
                    <div class="col-lg-4">
                        <input type="text" value="" name="createshipmentsinlingo[]" :id="'createShipmentsInLingo' + index" class="form-control" v-model="createShipmentsInLingo">
                    </div>
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Open pick ticket Pdf Batch to Verify weights, Ship via & service level against Lingo for parcel creation :</label>
                    <div class="col-lg-4">
                        <input tabindex="" type="text" value="" name="openpickticketpdfbatchtoverifyweights[]" :id="'openPickTicketPdfBatchToVerifyWeights' + index" class="form-control" v-model="openPickTicketPdfBatchToVerifyWeights">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Print labels from Customer portal * must print cover label first* :</label>
                    <div class="col-lg-4">
                        <input tabindex="" type="text" value="" name="printlabelsfromcustomerportal[]" :id="'printLabelsFromCustomerPortal' + index" class="form-control" v-model="printLabelsFromCustomerPortal">
                    </div>
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Print labels from Alpine's UPS or FEDEX station *must print cover label first* :</label>
                    <div class="col-lg-4">
                        <input tabindex="" type="text" value="" name="printlabelsfromalpineups[]" :id="'printLabelsFromAlpineUPS' + index" class="form-control" v-model="printLabelsFromAlpineUPS">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Send ASNs through Lingo or SPS :</label>
                    <div class="col-lg-4">
                        <input tabindex="" type="text" value="" name="sendasnthroughlingo[]" :id="'sendASNThroughLingo' + index" class="form-control" v-model="sendASNThroughLingo">
                    </div>
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Add Tracking in customer portal :</label>
                    <div class="col-lg-4">
                        <input tabindex="" type="text" value="" name="addtrackingincustomerportal[]" :id="'addTrackingInCustomerPortal' + index" class="form-control" v-model="addTrackingInCustomerPortal">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Send invoice through Lingo or SPS :</label>
                    <div class="col-lg-4">
                        <input tabindex="" type="text" value="" name="sendinvoicethroughlingo[]" :id="'sendInvoiceThroughLingo' + index" class="form-control" v-model="sendInvoiceThroughLingo">
                    </div>
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Send invoice on customer portal :</label>
                    <div class="col-lg-4">
                        <input tabindex="" type="text" value="" name="sendinvoiceoncustomerportal[]" :id="'sendInvoiceOnCustomerPortal' + index" class="form-control" v-model="sendInvoiceOnCustomerPortal">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label bg-formLabelCyan">Verify with Lead Batch and labels Printed Name :</label>
                    <div class="col-lg-4">
                        <div class="input-group datetime">
                            <input tabindex="" type="text" value="" name="verifywithleadbatchandlabelsprintedname[]" :id="'verifyWithLeadBatch' + index" class="form-control currentdatetimepicker" v-model="verifyWithLeadBatch">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="panel panel-mauve">
                        <div class="panel-heading">Notes for Logistic in USA office :</div>
                        <div class="panel-body">
                            <textarea name="notesforlogisticinusaoffice[]" :id="'notesForLogisticInUSAOffice' + index" class="form-control" v-model="notesForLogisticInUSAOffice"></textarea>
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
                            <input type="text" value="" name="issuedtoorderleadalma[]" :id="'issuedToOrderLeadAlma' + index" class="form-control currentdatetimepicker" v-model="issuedToOrderLeadAlma">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label bg-formLabelRustic">Order lead issued batch to warehouse :</label>
                    <div class="col-lg-4">
                        <div class="input-group datetime">
                            <input tabindex="" type="text" value="" name="orderleadissuedbatchtowarehouse[]" :id="'orderLeadIssuedBatchToWarehouse' + index" class="form-control currentdatetimepicker" v-model="orderLeadIssuedBatchToWarehouse">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <label class="col-lg-2 col-form-label bg-formLabelRustic">Warehouse lead Confirmed Pick Tickets Revieved :</label>
                    <div class="col-lg-4">
                        <input tabindex="" type="number" value="" name="warehouseleadconfirmedpickticketsreviewed[]" :id="'warehouseLeadConfirmedPickTicketsReviewed' + index" class="form-control" v-model="warehouseLeadConfirmedPickTicketsReviewed">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label bg-formLabelGrey">Invoice Date in OMS :</label>
                    <div class="col-lg-4">
                        <div class="input-group date">
                            <input tabindex="" type="text" value="" name="invoicedateinoms[]" :id="'invoiceDateInOMS' + index" class="form-control currentdatepicker" v-model="invoiceDateInOMS">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <label class="col-lg-2 col-form-label bg-formLabelGrey">Number of invoices generate :</label>
                    <div class="col-lg-4">
                        <input tabindex="" type="number" value="" name="numberofinvoicesgenerated[]" :id="'numberOfInvoicesGenerate' + index" class="form-control" v-model="numberOfInvoicesGenerate">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="panel panel-grey">
                        <div class="panel-heading">Invoiced issues to report to USA office :</div>
                        <div class="panel-body">
                            <textarea name="invoicedissuestoreportusaoffice[]" :id="'invoicedIssuesToReportToUSAOffice' + index" class="form-control" v-model="invoicedIssuesToReportToUSAOffice"></textarea>
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
                            <input tabindex="" type="text" value="" name="omsinvoicedupdatedwithfrieghtcostinsource[]" :id="'omsInvoicedUpdatedWithFrieght' + index" class="form-control currentdatepicker" v-model="omsInvoicedUpdatedWithFrieght">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <label class="col-lg-2 col-form-label bg-formLabelGrey">Create ASN and invoiced in Lingo :</label>
                    <div class="col-lg-4">
                        <div class="input-group date">
                            <input tabindex="" type="text" value="" name="createasnandinvoicedinlingo[]" :id="'createASNInvoicedInLingo' + index" class="form-control currentdatepicker" v-model="createASNInvoicedInLingo">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label bg-formLabelGrey">Date Batch is 100% invoiced (Open Pick Ticket Report has 0 Open P/T's) :</label>
                    <div class="col-lg-4">
                        <div class="input-group date">
                            <input tabindex="" type="text" value="" name="datebatchis100invoiced[]" :id="'dateBatchIsInvoiced'+index" class="form-control currentdatepicker" v-model="dateBatchIsInvoiced">
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
            <input tabindex="" type="text" maxLength="250" value="" name="orderno" id="orderNumber" class="form-control" v-model="orderNumber">
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Allocated Full :</label>
        <div class="col-lg-4">
          <div class="i-checks isAllocatedFull">
            <input type="checkbox" name="allocatefull" id="isAllocatedFull" v-model="isAllocatedFull">
          </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Pk No# :</label>
        <div class="col-lg-4">
            <input tabindex="" type="text" maxLength="250" value="" name="pkno" id="pkNumber" class="form-control" v-model="pkNumber">
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Total So Qty :</label>
        <div class="col-lg-4">
            <input tabindex="" type="text" maxLength="250" value="" name="totalsoqty" id="totalSoQty" class="form-control" v-model="totalSoQty">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelMauve">PO # :</label>
        <div class="col-lg-4">
            <input tabindex="" type="text" maxLength="250" value="" name="pono" id="poNumber" class="form-control" v-model="poNumber">
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Total Cases :</label>
        <div class="col-lg-4">
            <input tabindex="" type="text" maxLength="250" value="" name="totalcase" id="totalCases" class="form-control" v-model="totalCases">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Order Ship Date :</label>
        <div class="col-lg-4">
            <div class="input-group date">
                <input tabindex="" type="text" maxLength="250" value="" name="ordershipdate" id="orderShipDate" class="form-control currentdatepicker" v-model="orderShipDate">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Total Actual Open Order</label>
        <div class="col-lg-4">
            <input tabindex="" type="text" maxLength="250" value="" name="totalactualopenorder" id="totalActualOpenOrder" class="form-control" v-model="totalActualOpenOrder">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Order Must Arrive By :</label>
        <div class="col-lg-4">
            <div class="input-group date">
                <input tabindex="" type="text" maxLength="250" value="" name="ordermustarrivebydate" id="orderMustArriveBy" class="form-control currentdatepicker" v-model="orderMustArriveBy">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Total Pick Ticket Amount</label>
        <div class="col-lg-4">
            <input tabindex="" type="text" maxLength="250" name="totalpickticketamount" id="totalpickticketamount" class="form-control" v-model="totalpickticketamount">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Cancel Date:</label>
        <div class="col-lg-4">
            <div class="input-group date">
                <input tabindex="" tabindex="" type="text" maxLength="250" value="" name="canceldate" id="cancelDate" class="form-control currentdatepicker" v-model="cancelDate">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelMauve">Ship Service Level :</label>
        <div class="col-lg-4">
            <select class="form-control" v-model="ship_service_level_chosen" name="shipservicelevel" id="shipServiceLevel">
                <option v-for="option in ship_service_level" :value="option">{{option}}</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-6">
            <div class="panel panel-mauve">
                <div class="panel-heading">CS Notes:</div>
                <div class="panel-body">
                    <textarea name="csnote" id="csNotes" class="form-control" v-model="csNotes"></textarea>
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
                    <textarea id="warehouseNotes" name="warehousenotes" class="form-control" v-model="warehouseNotes"></textarea>
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
            <input type="text" name="logisticname" id="logisticName" class="form-control" v-model="logisticName">
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelBeige">Status of Order :</label>
        <div class="col-lg-4">
            <select name="statusoforder" id="statusOfOrder" class="form-control" v-model="status_of_order_chosen">
                <option v-for="option in status_of_order" :value="option">{{option}}</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelBeige">Pick Up Type :</label>
        <div class="col-lg-4">
            <select name="pickuptype" id="pickUpType" class="form-control" v-model="pick_up_type_chosen">
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
            <input type="text" name="pickupreference" id="pickUpReference" class="form-control" v-model="pickUpReference">
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelBeige">Confirm Pickup Date :</label>
        <div class="col-lg-4">
            <div class="input-group date">
                <input type="text" name="confirmpickupdate" id="confirmPickupDate" class="form-control currentdatepicker" v-model="confirmPickupDate">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelBeige">Confirm Pickup Time :</label>
        <div class="col-lg-4">
            <div class="input-group time">
                <input type="text" name="confirmpickuptime" id="confirmPickupTime" class="form-control currenttimepicker" v-model="confirmPickupTime">
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
            </div>
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelBeige">Number of Pallets :</label>
        <div class="col-lg-4">
            <input type="text" name="numberofpallets" id="numberOfPallets" class="form-control" v-model="numberOfPallets">
        </div>
    </div>
    <div class="form-group row">
        <div class="panel panel-beige">
            <div class="panel-heading">Logistic Team Internal Notes:</div>
            <div class="panel-body">
                <textarea name="logisticteaminternalnotes" id="logisticTeamInternalNotes" class="form-control" v-model="logisticTeamInternalNotes"></textarea>
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
                <input type="text" name="datelogisticalhandedpttoalmadate" id="dateLogisticalHandedPtToAlma" class="form-control currentdatetimepicker" v-model="dateLogisticalHandedPtToAlma">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelBeige">Invoiced</label>
        <div class="col-lg-4">
          <div class="i-checks Invoiced">
            <input type="checkbox" name="invoiced" id="isInvoiced" v-model="isInvoiced">
          </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelRustic">Pick Date :</label>
        <div class="col-lg-4">
            <div class="input-group date">
                <input type="text" id="pickDate" name="pickdate" class="form-control currentdatepicker" v-model="pickDate">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelRustic">Frieght Location in Warehouse</label>
        <div class="col-lg-4">
            <input type="text" name="frieghtlocationinwarehouse" id="frieghtLocationInWarehouse" class="form-control" v-model="frieghtLocationInWarehouse">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label bg-formLabelRustic">Pro #:</label>
        <div class="col-lg-4">
            <input type="text" id="proNumber" name="prono" class="form-control" v-model="proNumber">
        </div>
        <label class="col-lg-2 col-form-label bg-formLabelRustic">Date Frieght Picked up:</label>
        <div class="col-lg-4">
            <div class="input-group date">
                <input type="text" name="datefrieghtpickedup" id="datefrieghtPickedup" class="form-control currentdatepicker" v-model="datefrieghtPickedup">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="panel panel-rustic">
            <div class="panel-heading">Notes to Logistic Team from Warehouse:</div>
            <div class="panel-body">
                <textarea name="notestologisticteamfromwarehouse" id="notesToLogisticTeamFromWarehouse" class="form-control" v-model="notesToLogisticTeamFromWarehouse"></textarea>
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
                totalpickticketamount: "",
                orderMustArriveBy: "",
                cancelDate: "",
                ship_service_level: ["Overnight", "2nd Day", "3rd Day"],
                ship_service_level_chosen: "Overnight",
                status_of_order: ["Order Shipped", "Invoiced", "Stagged", "Routed", "Waiting on Carrier"],
                pick_up_type: ["LTL", "Parcel"],
                pick_up_type_chosen: "LTL",
                status_of_order_chosen: "Order Shipped",
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
            $(".i-checks.isEdi").on("ifChanged", () => {
                var ichecks = $(".i-checks.isEdi").iCheck({
                    checkboxClass: "icheckbox_square-green",
                    radioClass: "iradio_square-green",
                });
                if (ichecks[0].checked) {
                    shippinglogs._data["isEdi"] = true;
                }
                else {
                    shippinglogs._data["isEdi"] = false;
                }
            });
        }
    });
    let shippinglogs = new Vue({
        el: "#createShippingLogForm",
        data: {
            business: ["Domestic", "Internet"],
            seq: 0,
            iseditdone: false,
            business_chosen: "domestic",
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
            orderIssueDate: "",
            customerName: "",
            batchNumber: "",
            enteredBy: "",
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
                var digit = 0;
                let total_amount_of_indexes = shippinglogs.$children.length;
                var total_amount_of_indexes_clone = total_amount_of_indexes;
                var working_with_child_index = 0;
                var id_of_variable_without_index = "";
                if (id_of_variable == "orderShipDate" || id_of_variable == "orderMustArriveBy" || id_of_variable == "cancelDate" || id_of_variable == "confirmPickupDate" || id_of_variable == "confirmPickupTime" || id_of_variable == "numberOfPallets" || id_of_variable == "pickDate" || id_of_variable == "datefrieghtPickedup" || id_of_variable == "dateLogisticalHandedPtToAlma") {
                    shippinglogs.$children[0]._data[id_of_variable] = value_of_variable;
                }
                else if (id_of_variable == "orderShipDate2" || id_of_variable == "allocationTime" || id_of_variable == "orderIssueDate") {
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
            if (!this.iseditdone) {
                this.$forceUpdate();
            }
        },
        updated: function () {
            $(".i-checks").iCheck({
                checkboxClass: "icheckbox_square-green",
                radioClass: "iradio_square-green",
            });
            $(".i-checks.isEdi").on("ifChanged", () => {
                var ichecks = $(".i-checks.isEdi").iCheck({
                    checkboxClass: "icheckbox_square-green",
                    radioClass: "iradio_square-green",
                });
                if (ichecks[0].checked) {
                    shippinglogs._data["isEdi"] = true;
                }
                else {
                    shippinglogs._data["isEdi"] = false;
                }
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
                if (id_of_variable == "orderShipDate" || id_of_variable == "orderMustArriveBy" || id_of_variable == "cancelDate" || id_of_variable == "confirmPickupDate" || id_of_variable == "confirmPickupTime" || id_of_variable == "numberOfPallets" || id_of_variable == "pickDate" || id_of_variable == "datefrieghtPickedup" || id_of_variable == "dateLogisticalHandedPtToAlma") {
                    shippinglogs.$children[0]._data[id_of_variable] = value_of_variable;
                }
                else if (id_of_variable == "orderShipDate2" || id_of_variable == "allocationTime" || id_of_variable == "orderIssueDate") {
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
            if (!this.iseditdone) {
                if (seq != "" && seq != undefined) {
                    $.getJSON("Actions/ShippinglogAction.php?call=getShippinglog&seq=" + seq, (data) => {
                        shippinglogs._data.seq = seq;
                        shippinglogs._data.business_chosen = data.business;
                        shippinglogs._data.orderIssueDate = data.orderissuedate;
                        shippinglogs._data.customerName = data.customername;
                        shippinglogs._data.batchNumber = data.batchno;
                        shippinglogs._data.enteredBy = data.enteredby;
                        if (data.isedi == "0") {
                            shippinglogs._data.isEdi = false;
                        }
                        else {
                            shippinglogs._data.isEdi = true;
                        }
                        if (data.business == "domestic") {
                            shippinglogs.$children[0]._data.orderNumber = data.orderno;
                            if (data.allocatedfull == "1") {
                                shippinglogs.$children[0]._data.isAllocatedFull = true;
                            }
                            else {
                                shippinglogs.$children[0]._data.isAllocatedFull = false;
                            }
                            shippinglogs.$children[0]._data.pkNumber = data.pkno;
                            shippinglogs.$children[0]._data.poNumber = data.pono;
                            shippinglogs.$children[0]._data.proNumber = data.prono;
                            shippinglogs.$children[0]._data.ship_service_level_chosen = data.shipservicelevel;
                            shippinglogs.$children[0]._data.cancelDate = data.canceldate;
                            shippinglogs.$children[0]._data.carrier = data.carrier;
                            shippinglogs.$children[0]._data.confirmPickupDate = data.confirmpickupdate;
                            shippinglogs.$children[0]._data.confirmPickupTime = data.confirmpickuptime;
                            shippinglogs.$children[0]._data.csNotes = data.csnotes;
                            shippinglogs.$children[0]._data.datefrieghtPickedup = data.datefrieghtpickedup;
                            shippinglogs.$children[0]._data.frieghtLocationInWarehouse = data.frieghtlocationinwarehouse;
                            if (data.invoiced == "1") {
                                shippinglogs.$children[0]._data.isInvoiced = true;
                            }
                            else {
                                shippinglogs.$children[0]._data.isInvoiced = false;
                            }
                            shippinglogs.$children[0]._data.logisticName = data.logisticname;
                            shippinglogs.$children[0]._data.logisticTeamInternalNotes = data.logisticteaminternalnotes;
                            shippinglogs.$children[0]._data.notesToLogisticTeamFromWarehouse = data.notesToLogisticTeamFromWarehouse;
                            shippinglogs.$children[0]._data.numberOfPallets = data.numberofpallets;
                            shippinglogs.$children[0]._data.orderMustArriveBy = data.ordermustarrivebydate;
                            shippinglogs.$children[0]._data.orderShipDate = data.ordershipdate;
                            shippinglogs.$children[0]._data.pickDate = data.pickdate;
                            shippinglogs.$children[0]._data.pick_up_type_chosen = data.pickuptype;
                            shippinglogs.$children[0]._data.pickUpReference = data.pickupreference;
                            shippinglogs.$children[0]._data.showdata = true;
                            shippinglogs.$children[0]._data.status_of_order_chosen = data.statusoforder;
                            shippinglogs.$children[0]._data.totalActualOpenOrder = data.totalactualopenorder;
                            shippinglogs.$children[0]._data.totalCases = data.totalcase;
                            shippinglogs.$children[0]._data.totalSoQty = data.totalsoqty;
                            shippinglogs.$children[0]._data.totalpickticketamount = data.totalpickticketamount;
                            shippinglogs.$children[0]._data.warehouseNotes = data.warehousenotes;
                            shippinglogs.$children[0]._data.dateLogisticalHandedPtToAlma = data.datelogisticalhandedpttoalmadate;
                            shippinglogs.$children[0]._data.notesToLogisticTeamFromWarehouse = data.notestologisticteamfromwarehouse;
                        }
                        else {
                            shippinglogs.$children[0]._data.showdata = false;
                            shippinglogs._data.orderShipDate2 = data.ordershipdate;
                            shippinglogs._data.allocationTime = data.allocationtime;
                            shippinglogs._data.whNumber = data.whno;
                            shippinglogs._data.OMSReport = data.totalnumberofpickticketsforbatchfromomsreport;
                            shippinglogs._data.detailedUsers = data.totalnumberofpickticketsforpalletorders;
                            shippinglogs._data.RMAReport = data.totalnumberofpickticketsforrma;
                            shippinglogs.$children[1]._data.addTrackingInCustomerPortal = data.addtrackingincustomerportal;
                            shippinglogs.$children[1]._data.createASNInvoicedInLingo = data.createasnandinvoicedinlingo;
                            shippinglogs.$children[1]._data.createShipmentsInLingo = data.createshipmentsinlingo;
                            shippinglogs.$children[1]._data.dateBatchIsInvoiced = data.datebatchis100invoiced;
                            shippinglogs.$children[1]._data.invoiceDateInOMS = data.invoicedateinoms;
                            shippinglogs.$children[1]._data.invoicedIssuesToReportToUSAOffice = data.invoicedissuestoreporttousaoffice;
                            shippinglogs.$children[1]._data.issuedToOrderLeadAlma = data.issuedtoorderleadalma;
                            shippinglogs.$children[1]._data.notesForLogisticInUSAOffice = data.notesforlogisticinusaoffice;
                            shippinglogs.$children[1]._data.numberOfInvoicesGenerate = data.numberofinvoicesgenerated;
                            shippinglogs.$children[1]._data.omsInvoicedUpdatedWithFrieght = data.omsinvoicedupdatedwithfrieghtcostinsource;
                            shippinglogs.$children[1]._data.openPickTicketPdfBatchToVerifyWeights = data.openpickticketpdfbatchtoverifyweights;
                            shippinglogs.$children[1]._data.orderLeadIssuedBatchToWarehouse = data.orderleadissuedbatchtowarehouse;
                            shippinglogs.$children[1]._data.printLabelsFromAlpineUPS = data.printlabelsfromalpineups;
                            shippinglogs.$children[1]._data.printLabelsFromCustomerPortal = data.printlabelsfromcustomerportal;
                            shippinglogs.$children[1]._data.printSavePickListFromWMS = data.printpicklistfromwms;
                            shippinglogs.$children[1]._data.saveBatchToZDotComOrders = data.savebatchto;
                            shippinglogs.$children[1]._data.sendASNThroughLingo = data.sendasnthroughlingo;
                            shippinglogs.$children[1]._data.sendInvoiceOnCustomerPortal = data.sendinvoiceoncustomerportal;
                            shippinglogs.$children[1]._data.sendInvoiceThroughLingo = data.sendinvoicethroughlingo;
                            shippinglogs.$children[1]._data.verifyWithLeadBatch = data.verifywithleadbatchandlabelsprintedname;
                            shippinglogs.$children[1]._data.warehouseLeadConfirmedPickTicketsReviewed = data.warehouseleadconfirmedpickticketsreviewed;
                        }
                        this.iseditdone = true;
                    });
                }
            }
            if (shippinglogs.$children.length == Number(shippinglogs._data.detailedUsers) + 2) {
                if (Array.isArray(shippinglogs.$children[1]._data.addTrackingInCustomerPortal)) {
                    for (var i = 0; i < Number(shippinglogs._data.detailedUsers); i++) {
                        shippinglogs.$children[i + 2]._data.addTrackingInCustomerPortal = shippinglogs.$children[1]._data.addTrackingInCustomerPortal[i + 1];
                        shippinglogs.$children[i + 2]._data.createASNInvoicedInLingo = shippinglogs.$children[1]._data.createASNInvoicedInLingo[i + 1];
                        shippinglogs.$children[i + 2]._data.createShipmentsInLingo = shippinglogs.$children[1]._data.createShipmentsInLingo[i + 1];
                        shippinglogs.$children[i + 2]._data.dateBatchIsInvoiced = shippinglogs.$children[1]._data.dateBatchIsInvoiced[i + 1];
                        shippinglogs.$children[i + 2]._data.invoiceDateInOMS = shippinglogs.$children[1]._data.invoiceDateInOMS[i + 1];
                        shippinglogs.$children[i + 2]._data.invoicedIssuesToReportToUSAOffice = shippinglogs.$children[1]._data.invoicedIssuesToReportToUSAOffice[i + 1];
                        shippinglogs.$children[i + 2]._data.issuedToOrderLeadAlma = shippinglogs.$children[1]._data.issuedToOrderLeadAlma[i + 1];
                        shippinglogs.$children[i + 2]._data.notesForLogisticInUSAOffice = shippinglogs.$children[1]._data.notesForLogisticInUSAOffice[i + 1];
                        shippinglogs.$children[i + 2]._data.numberOfInvoicesGenerate = shippinglogs.$children[1]._data.numberOfInvoicesGenerate[i + 1];
                        shippinglogs.$children[i + 2]._data.omsInvoicedUpdatedWithFrieght = shippinglogs.$children[1]._data.omsInvoicedUpdatedWithFrieght[i + 1];
                        shippinglogs.$children[i + 2]._data.openPickTicketPdfBatchToVerifyWeights = shippinglogs.$children[1]._data.openPickTicketPdfBatchToVerifyWeights[i + 1];
                        shippinglogs.$children[i + 2]._data.orderLeadIssuedBatchToWarehouse = shippinglogs.$children[1]._data.orderLeadIssuedBatchToWarehouse[i + 1];
                        shippinglogs.$children[i + 2]._data.printLabelsFromAlpineUPS = shippinglogs.$children[1]._data.printLabelsFromAlpineUPS[i + 1];
                        shippinglogs.$children[i + 2]._data.printLabelsFromCustomerPortal = shippinglogs.$children[1]._data.printLabelsFromCustomerPortal[i + 1];
                        shippinglogs.$children[i + 2]._data.printSavePickListFromWMS = shippinglogs.$children[1]._data.printSavePickListFromWMS[i + 1];
                        shippinglogs.$children[i + 2]._data.saveBatchToZDotComOrders = shippinglogs.$children[1]._data.saveBatchToZDotComOrders[i + 1];
                        shippinglogs.$children[i + 2]._data.sendASNThroughLingo = shippinglogs.$children[1]._data.sendASNThroughLingo[i + 1];
                        shippinglogs.$children[i + 2]._data.sendInvoiceOnCustomerPortal = shippinglogs.$children[1]._data.sendInvoiceOnCustomerPortal[i + 1];
                        shippinglogs.$children[i + 2]._data.sendInvoiceThroughLingo = shippinglogs.$children[1]._data.sendInvoiceThroughLingo[i + 1];
                        shippinglogs.$children[i + 2]._data.verifyWithLeadBatch = shippinglogs.$children[1]._data.verifyWithLeadBatch[i + 1];
                        shippinglogs.$children[i + 2]._data.warehouseLeadConfirmedPickTicketsReviewed = shippinglogs.$children[1]._data.warehouseLeadConfirmedPickTicketsReviewed[i + 1];
                    }
                    shippinglogs.$children[1]._data.addTrackingInCustomerPortal = shippinglogs.$children[1]._data.addTrackingInCustomerPortal[0];
                    shippinglogs.$children[1]._data.createASNInvoicedInLingo = shippinglogs.$children[1]._data.createASNInvoicedInLingo[0];
                    shippinglogs.$children[1]._data.createShipmentsInLingo = shippinglogs.$children[1]._data.createShipmentsInLingo[0];
                    shippinglogs.$children[1]._data.dateBatchIsInvoiced = shippinglogs.$children[1]._data.dateBatchIsInvoiced[0];
                    shippinglogs.$children[1]._data.invoiceDateInOMS = shippinglogs.$children[1]._data.invoiceDateInOMS[0];
                    shippinglogs.$children[1]._data.invoicedIssuesToReportToUSAOffice = shippinglogs.$children[1]._data.invoicedIssuesToReportToUSAOffice[0];
                    shippinglogs.$children[1]._data.issuedToOrderLeadAlma = shippinglogs.$children[1]._data.issuedToOrderLeadAlma[0];
                    shippinglogs.$children[1]._data.notesForLogisticInUSAOffice = shippinglogs.$children[1]._data.notesForLogisticInUSAOffice[0];
                    shippinglogs.$children[1]._data.numberOfInvoicesGenerate = shippinglogs.$children[1]._data.numberOfInvoicesGenerate[0];
                    shippinglogs.$children[1]._data.omsInvoicedUpdatedWithFrieght = shippinglogs.$children[1]._data.omsInvoicedUpdatedWithFrieght[0];
                    shippinglogs.$children[1]._data.openPickTicketPdfBatchToVerifyWeights = shippinglogs.$children[1]._data.openPickTicketPdfBatchToVerifyWeights[0];
                    shippinglogs.$children[1]._data.orderLeadIssuedBatchToWarehouse = shippinglogs.$children[1]._data.orderLeadIssuedBatchToWarehouse[0];
                    shippinglogs.$children[1]._data.printLabelsFromAlpineUPS = shippinglogs.$children[1]._data.printLabelsFromAlpineUPS[0];
                    shippinglogs.$children[1]._data.printLabelsFromCustomerPortal = shippinglogs.$children[1]._data.printLabelsFromCustomerPortal[0];
                    shippinglogs.$children[1]._data.printSavePickListFromWMS = shippinglogs.$children[1]._data.printSavePickListFromWMS[0];
                    shippinglogs.$children[1]._data.saveBatchToZDotComOrders = shippinglogs.$children[1]._data.saveBatchToZDotComOrders[0];
                    shippinglogs.$children[1]._data.sendASNThroughLingo = shippinglogs.$children[1]._data.sendASNThroughLingo[0];
                    shippinglogs.$children[1]._data.sendInvoiceOnCustomerPortal = shippinglogs.$children[1]._data.sendInvoiceOnCustomerPortal[0];
                    shippinglogs.$children[1]._data.sendInvoiceThroughLingo = shippinglogs.$children[1]._data.sendInvoiceThroughLingo[0];
                    shippinglogs.$children[1]._data.verifyWithLeadBatch = shippinglogs.$children[1]._data.verifyWithLeadBatch[0];
                    shippinglogs.$children[1]._data.warehouseLeadConfirmedPickTicketsReviewed = shippinglogs.$children[1]._data.warehouseLeadConfirmedPickTicketsReviewed[0];
                }
            }
        },
        methods: {
            business_change: () => {
                if (shippinglogs._data.business_chosen == "domestic") {
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
});
