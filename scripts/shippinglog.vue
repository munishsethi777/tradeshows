var shippinglogs = this;
$(document).ready(function () {
    var detailsofinternet = Vue.component("detailsofinternet", {
        props: ["index", "key"],
        template: "<div class=\"accordion\">\n    <div :class=\"'detailpanel' + index\" class=\"panel panel-mauve\">\n        <div class=\"panel-heading\" :id=\"'headingOne' + index\">\n            <h4 class=\"panel-title\">\n                <a class=\"collapsed\" data-toggle=\"collapse\" data-parent=\"#accordion\" :href=\"'#collapseOne' + index\" aria-expanded=\"false\"><span>Main</span></a>\n                <a class=\"pull-right collapsed\" data-toggle=\"collapse\" data-parent=\"#accordion\" :href=\"'#collapseOne' + index\" aria-expanded=\"false\">\n                    <i class=\"fa fa-arrow-down\" aria-hidden=\"true\"></i>\n                </a>\n            </h4>\n        </div>\n        <div :id=\"'collapseOne' + index\" class=\"panel-collapse collapse\" :aria-labelledby=\"'headingOne' + index\" data-parent=\"#accordion\">\n            <div class=\"panel-body\" style=\"padding:30px\">\n                <div class=\"form-group row\">\n                    <label class=\"col-lg-2 col-form-label bg-formLabelCyan\">Save Batch to Z:\\Cust\\Dot Com Orders :</label>\n                    <div class=\"col-lg-4\">\n                        <div class=\"input-group date\">\n                            <input tabindex=\"\" type=\"text\" value=\"\" name=\"saveBatchToZDotComOrders[]\" :id=\"'saveBatchToZDotComOrders' + index\" class=\"form-control currentdatepicker\" v-model=\"saveBatchToZDotComOrders\">\n                            <span class=\"input-group-addon\"><i class=\"fa fa-calendar\"></i></span>\n                        </div>\n                    </div>\n                    <label class=\"col-lg-2 col-form-label bg-formLabelCyan\">Print & Save Pick List from WMS :</label>\n                    <div class=\"col-lg-4\">\n                        <input type=\"text\" name=\"printSavePickListFromWMS[]\" class=\"form-control\" :id=\"'printSavePickListFromWMS' + index\" v-model=\"printSavePickListFromWMS\">\n\n                    </div>\n                </div>\n                <div class=\"form-group row\">\n                    <label class=\"col-lg-2 col-form-label bg-formLabelCyan\">Create Shipments in Lingo :</label>\n                    <div class=\"col-lg-4\">\n                        <input type=\"text\" value=\"\" name=\"createShipmentsInLingo[]\" :id=\"'createShipmentsInLingo' + index\" class=\"form-control\" v-model=\"createShipmentsInLingo\">\n                    </div>\n                    <label class=\"col-lg-2 col-form-label bg-formLabelCyan\">Open pick ticket Pdf Batch to Verify weights, Ship via & service level against Lingo for parcel creation :</label>\n                    <div class=\"col-lg-4\">\n                        <input tabindex=\"\" type=\"text\" value=\"\" name=\"openPickTicketPdfBatchToVerifyWeights[]\" :id=\"'openPickTicketPdfBatchToVerifyWeights' + index\" class=\"form-control\" v-model=\"openPickTicketPdfBatchToVerifyWeights\">\n                    </div>\n                </div>\n                <div class=\"form-group row\">\n                    <label class=\"col-lg-2 col-form-label bg-formLabelCyan\">Print labels from Customer portal * must print cover label first* :</label>\n                    <div class=\"col-lg-4\">\n                        <input tabindex=\"\" type=\"text\" value=\"\" name=\"printLabelsFromCustomerPortal[]\" :id=\"'printLabelsFromCustomerPortal' + index\" class=\"form-control\" v-model=\"printLabelsFromCustomerPortal\">\n                    </div>\n                    <label class=\"col-lg-2 col-form-label bg-formLabelCyan\">Print labels from Alpine's UPS or FEDEX station *must print cover label first* :</label>\n                    <div class=\"col-lg-4\">\n                        <input tabindex=\"\" type=\"text\" value=\"\" name=\"printLabelsFromAlpineUPS[]\" :id=\"'printLabelsFromAlpineUPS' + index\" class=\"form-control\" v-model=\"printLabelsFromAlpineUPS\">\n                    </div>\n                </div>\n                <div class=\"form-group row\">\n                    <label class=\"col-lg-2 col-form-label bg-formLabelCyan\">Send ASNs through Lingo or SPS :</label>\n                    <div class=\"col-lg-4\">\n                        <input tabindex=\"\" type=\"text\" value=\"\" name=\"sendASNThroughLingo[]\" :id=\"'sendASNThroughLingo' + index\" class=\"form-control\" v-model=\"sendASNThroughLingo\">\n                    </div>\n                    <label class=\"col-lg-2 col-form-label bg-formLabelCyan\">Add Tracking in customer portal :</label>\n                    <div class=\"col-lg-4\">\n                        <input tabindex=\"\" type=\"text\" value=\"\" name=\"addTrackingInCustomerPortal[]\" :id=\"'addTrackingInCustomerPortal' + index\" class=\"form-control\" v-model=\"addTrackingInCustomerPortal\">\n                    </div>\n                </div>\n                <div class=\"form-group row\">\n                    <label class=\"col-lg-2 col-form-label bg-formLabelCyan\">Send invoice through Lingo or SPS :</label>\n                    <div class=\"col-lg-4\">\n                        <input tabindex=\"\" type=\"text\" value=\"\" name=\"sendInvoiceThroughLingo[]\" :id=\"'sendInvoiceThroughLingo' + index\" class=\"form-control\" v-model=\"sendInvoiceThroughLingo\">\n                    </div>\n                    <label class=\"col-lg-2 col-form-label bg-formLabelCyan\">Send invoice on customer portal :</label>\n                    <div class=\"col-lg-4\">\n                        <input tabindex=\"\" type=\"text\" value=\"\" name=\"sendInvoiceOnCustomerPortal[]\" :id=\"'sendInvoiceOnCustomerPortal' + index\" class=\"form-control\" v-model=\"sendInvoiceOnCustomerPortal\">\n                    </div>\n                </div>\n                <div class=\"form-group row\">\n                    <label class=\"col-lg-2 col-form-label bg-formLabelCyan\">Verify with Lead Batch and labels Printed Name :</label>\n                    <div class=\"col-lg-4\">\n                        <div class=\"input-group datetime\">\n                            <input tabindex=\"\" type=\"text\" value=\"\" name=\"verifyWithLeadBatch[]\" :id=\"'verifyWithLeadBatch' + index\" class=\"form-control currentdatetimepicker\" v-model=\"verifyWithLeadBatch\">\n                            <span class=\"input-group-addon\"><i class=\"fa fa-calendar\"></i></span>\n                        </div>\n                    </div>\n                </div>\n                <div class=\"form-group row\">\n                    <div class=\"panel panel-mauve\">\n                        <div class=\"panel-heading\">Notes for Logistic in USA office :</div>\n                        <div class=\"panel-body\">\n                            <textarea name=\"notesForLogisticInUSAOffice[]\" :id=\"'notesForLogisticInUSAOffice' + index\" class=\"form-control\" v-model=\"notesForLogisticInUSAOffice\"></textarea>\n                            <div class=\"row\">\n                                <ul class=\"list-group\"></ul>\n                            </div>\n                        </div>\n                    </div>\n                </div>\n                <div class=\"form-group row\">\n                    <label class=\"col-lg-2 col-form-label bg-formLabelBeige\">Issued to Order Lead Alma :</label>\n                    <div class=\"col-lg-4\">\n                        <div class=\"input-group datetime\">\n                            <input type=\"text\" value=\"\" name=\"issuedToOrderLeadAlma[]\" :id=\"'issuedToOrderLeadAlma' + index\" class=\"form-control currentdatetimepicker\" v-model=\"issuedToOrderLeadAlma\">\n                            <span class=\"input-group-addon\"><i class=\"fa fa-calendar\"></i></span>\n                        </div>\n                    </div>\n                </div>\n                <div class=\"form-group row\">\n                    <label class=\"col-lg-2 col-form-label bg-formLabelRustic\">Order lead issued batch to warehouse :</label>\n                    <div class=\"col-lg-4\">\n                        <div class=\"input-group datetime\">\n                            <input tabindex=\"\" type=\"text\" value=\"\" name=\"orderLeadIssuedBatchToWarehouse[]\" :id=\"'orderLeadIssuedBatchToWarehouse' + index\" class=\"form-control currentdatetimepicker\" v-model=\"orderLeadIssuedBatchToWarehouse\">\n                            <span class=\"input-group-addon\"><i class=\"fa fa-calendar\"></i></span>\n                        </div>\n                    </div>\n                    <label class=\"col-lg-2 col-form-label bg-formLabelRustic\">Warehouse lead Confirmed Pick Tickets Revieved :</label>\n                    <div class=\"col-lg-4\">\n                        <input tabindex=\"\" type=\"text\" value=\"\" name=\"warehouseLeadConfirmedPickTicketsReviewed[]\" :id=\"'warehouseLeadConfirmedPickTicketsReviewed' + index\" class=\"form-control\" v-model=\"warehouseLeadConfirmedPickTicketsReviewed\">\n                    </div>\n                </div>\n                <div class=\"form-group row\">\n                    <label class=\"col-lg-2 col-form-label bg-formLabelGrey\">Invoice Date in OMS :</label>\n                    <div class=\"col-lg-4\">\n                        <div class=\"input-group date\">\n                            <input tabindex=\"\" type=\"text\" value=\"\" name=\"invoiceDateInOMS[]\" :id=\"'invoiceDateInOMS' + index\" class=\"form-control currentdatepicker\" v-model=\"invoiceDateInOMS\">\n                            <span class=\"input-group-addon\"><i class=\"fa fa-calendar\"></i></span>\n                        </div>\n                    </div>\n                    <label class=\"col-lg-2 col-form-label bg-formLabelGrey\">Number of invoices generate :</label>\n                    <div class=\"col-lg-4\">\n                        <input tabindex=\"\" type=\"text\" value=\"\" name=\"numberOfInvoicesGenerate[]\" :id=\"'numberOfInvoicesGenerate' + index\" class=\"form-control\" v-model=\"numberOfInvoicesGenerate\">\n                    </div>\n                </div>\n\n                <div class=\"form-group row\">\n                    <div class=\"panel panel-grey\">\n                        <div class=\"panel-heading\">Invoiced issues to report to USA office :</div>\n                        <div class=\"panel-body\">\n                            <textarea name=\"invoicedIssuesToReportToUSAOffice[]\" :id=\"'invoicedIssuesToReportToUSAOffice' + index\" class=\"form-control\" v-model=\"invoicedIssuesToReportToUSAOffice\"></textarea>\n                            <div class=\"row\">\n                                <ul class=\"list-group\"></ul>\n                            </div>\n                        </div>\n                    </div>\n                </div>\n\n                <div class=\"form-group row\">\n                    <label class=\"col-lg-2 col-form-label bg-formLabelGrey\">OMS invoiced updated with Frieght Cost in source :</label>\n                    <div class=\"col-lg-4\">\n                        <div class=\"input-group date\">\n                            <input tabindex=\"\" type=\"text\" value=\"\" name=\"omsInvoicedUpdatedWithFrieght[]\" :id=\"'omsInvoicedUpdatedWithFrieght' + index\" class=\"form-control currentdatepicker\" v-model=\"omsInvoicedUpdatedWithFrieght\">\n                            <span class=\"input-group-addon\"><i class=\"fa fa-calendar\"></i></span>\n                        </div>\n                    </div>\n                    <label class=\"col-lg-2 col-form-label bg-formLabelGrey\">Create ASN and invoiced in Lingo :</label>\n                    <div class=\"col-lg-4\">\n                        <div class=\"input-group date\">\n                            <input tabindex=\"\" type=\"text\" value=\"\" name=\"createASNInvoicedInLingo[]\" :id=\"'createASNInvoicedInLingo' + index\" class=\"form-control currentdatepicker\" v-model=\"createASNInvoicedInLingo\">\n                            <span class=\"input-group-addon\"><i class=\"fa fa-calendar\"></i></span>\n                        </div>\n                    </div>\n                </div>\n                <div class=\"form-group row\">\n                    <label class=\"col-lg-2 col-form-label bg-formLabelGrey\">Date Batch is 100% invoiced (Open Pick Ticket Report has 0 Open P/T's) :</label>\n                    <div class=\"col-lg-4\">\n                        <div class=\"input-group date\">\n                            <input tabindex=\"\" type=\"text\" value=\"\" name=\"dateBatchIsInvoiced[]\" :id=\"'dateBatchIsInvoiced'+index\" class=\"form-control currentdatepicker\" v-model=\"dateBatchIsInvoiced\">\n                            <span class=\"input-group-addon\"><i class=\"fa fa-calendar\"></i></span>\n                        </div>\n                    </div>\n                </div>\n            </div>\n        </div>\n    </div>\n</div>",
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
                dateBatchIsInvoiced: ""
            };
        },
        methods: {}
    });
    var shippinglogs = new Vue({
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
            detailedUsers: 0
        },
        components: {
            detailsofinternet: detailsofinternet
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
                }
            });
            $(".datepicker").datetimepicker({
                timepicker: false,
                format: "m-d-Y",
                scrollMonth: false,
                scrollInput: false,
                onSelectDate: function (ct, $i) {
                    ondateTimeChange($i[0].id, $i[0].value);
                }
            });
            $(".currentdatepicker").datetimepicker({
                timepicker: false,
                format: "m-d-Y",
                scrollMonth: false,
                scrollInput: false,
                minDate: 0,
                onSelectDate: function (ct, $i) {
                    ondateTimeChange($i[0].id, $i[0].value);
                }
            });
            $(".currentdatetimepicker").datetimepicker({
                timepicker: true,
                format: "m-d-Y H:i:s",
                scrollMonth: false,
                scrollInput: false,
                minDate: 0,
                onSelectDate: function (ct, $i) {
                    ondateTimeChange($i[0].id, $i[0].value);
                }
            });
            $(".currenttimepicker").datetimepicker({
                timepicker: true,
                format: "H:i:s",
                scrollMonth: false,
                scrollInput: false,
                minDate: 0,
                onSelectDate: function (ct, $i) {
                    ondateTimeChange($i[0].id, $i[0].value);
                }
            });
            function ondateTimeChange(id_of_variable, value_of_variable) {
                var digit = 0;
                var total_amount_of_indexes = Number(this.$vm.$parent._data.detailedUsers);
                var total_amount_of_indexes_clone = total_amount_of_indexes;
                var id_of_variable_without_index = "";
                while (total_amount_of_indexes_clone > 0) {
                    digit += 1;
                    total_amount_of_indexes_clone /= 10;
                }
                for (var i = digit; i > 0; i--) {
                    if (isNaN(id_of_variable.substring(id_of_variable.length - i))) {
                        id_of_variable_without_index = id_of_variable.substring(0, id_of_variable.length - i);
                        break;
                    }
                }
                this.$vm0[digit]._data.id_of_variable_without_index = value_of_variable;
            }
        },
        updated: function () {
            $(".i-checks").iCheck({
                checkboxClass: "icheckbox_square-green",
                radioClass: "iradio_square-green"
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
                }
            });
            $(".datepicker").datetimepicker({
                timepicker: false,
                format: "m-d-Y",
                scrollMonth: false,
                scrollInput: false,
                onSelectDate: function (ct, $i) {
                    ondateTimeChange($i[0].id, $i[0].value);
                }
            });
            $(".currentdatepicker").datetimepicker({
                timepicker: false,
                format: "m-d-Y",
                scrollMonth: false,
                scrollInput: false,
                minDate: 0,
                onSelectDate: function (ct, $i) {
                    ondateTimeChange($i[0].id, $i[0].value);
                }
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
                }
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
                }
            });
            function ondateTimeChange(id_of_variable, value_of_variable) {
                var digit = 0;
                var total_amount_of_indexes = shippinglogs.$children.length;
                var total_amount_of_indexes_clone = total_amount_of_indexes;
                var working_with_child_index = 0;
                var id_of_variable_without_index = "";
                if (shippinglogs.$children.length != 0) {
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
                        shippinglogs.$children[working_with_child_index - 1]._data[id_of_variable_without_index] = value_of_variable;
                    }
                }
            }
        }
    });
    $(".i-checks").iCheck({
        checkboxClass: "icheckbox_square-green",
        radioClass: "iradio_square-green"
    });
});
