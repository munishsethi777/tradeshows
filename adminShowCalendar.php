<?php
include("SessionCheck.php");
require_once('IConstants.inc');
require_once($ConstantsArray['dbServerUrl'] ."Utils/SessionUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Utils/DateUtil.php");
require_once($ConstantsArray['dbServerUrl'] ."Managers/ShowMgr.php");

$showSeq = $_POST["showSeq"];
$showMgr = ShowMgr::getInstance();
$show = $showMgr->findBySeq($showSeq);
$startDate = new DateTime($show->getStartDate());
$endDate = new DateTime($show->getEndDate());

$showHeading = $show->getTitle() . " : " . $startDate->format("d, M Y") ." to ". $endDate->format("d, M Y");
?>
<html>
<head>
<title>Tradeshow Calendar</title>
	<?include "ScriptsInclude.php"?>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="gray-bg">

<div class="wrapper wrapper-content">
    <div class="row animated fadeInDown">
        <div class="col-sm-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Company Employees</h5>
                    
                </div>
                <div class="ibox-content">
                    <div id='external-events'>
                        <p>Drag an employee and drop into callendar.</p>
                        <div class='external-event navy-bg'>James Smith</div>
                        <div class='external-event navy-bg'>Michael Smith</div>
                        <div class='external-event navy-bg'>Maria Garcia</div>
                        <div class='external-event navy-bg'>Maria Rodriguez</div>
                        <div class='external-event navy-bg'>Jennifer</div>
                        <div class='external-event navy-bg'>Elizabeth Taylor</div>
                        <div class='external-event navy-bg'>Geoff Carrol</div>
                       	<div class='external-event navy-bg'>Jignesh Vyas</div>
                       	<div class='external-event navy-bg'>Matthew</div>
                       	<div class='external-event navy-bg'>Michael Jackson</div>
                       	<div class='external-event navy-bg'>Ricky Martin</div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col-sm-9">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                	<div class="pull-left">
                		<h5><?php echo $showHeading?></h5>
                	</div>
                	<div class="pull-right" style="margin-top:-7px">
	                    <button class="btn btn-sm btn-primary pull-right">Save Calendar</button>
	                    <a class="btn btn-sm btn-default m-r-sm pull-right" href="adminShowList.php">Back to Shows</a>
	                </div>
                </div>
                <div class="ibox-content">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function() {

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });

        /* initialize the external events
         -----------------------------------------------------------------*/


        $('#external-events div.external-event').each(function() {

            // store data so the calendar knows to render an event upon drop
            $(this).data('event', {
                title: $.trim($(this).text()), // use the element's text as the event title
                stick: true // maintain when user navigates (see docs on the renderEvent method)
            });

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 1111999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });

        });


        /* initialize the calendar
         -----------------------------------------------------------------*/
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
		var startDate = new Date("<?php echo $startDate->format("Y-m-d")?>");
		var endDate = new Date("<?php echo $endDate->format("Y-m-d")?>");
		
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar
            drop: function() {
                // is the "remove after drop" checkbox checked?
                //if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                //}
            },
			defaultDate : "<?php echo $startDate->format("Y-m-d")?>",//"2014-02-01",
			dayRender: function(date, cell) {
                var today = $.fullCalendar.moment();
                var end = $.fullCalendar.moment().add(7, 'days');
                if (date >= startDate && date <= endDate) {
                    cell.css("background", "#e6ffe6");
     			}
     			
                //if (date.get('date') >= today.get('date') && date.get('date') <= end.get('date')) {
                  //  cell.css("background", "yellow");
     			//}
			}
//             events: [
//                 {
//                     title: 'All Day Event',
//                     start: new Date(y, m, 1)
//                 },
//                 {
//                     title: 'Long Event',
//                     start: new Date(y, m, d-5),
//                     end: new Date(y, m, d-2)
//                 },
//                 {
//                     id: 999,
//                     title: 'Repeating Event',
//                     start: new Date(y, m, d-3, 16, 0),
//                     allDay: false
//                 },
//                 {
//                     id: 999,
//                     title: 'Repeating Event',
//                     start: new Date(y, m, d+4, 16, 0),
//                     allDay: false
//                 },
//                 {
//                     title: 'Meeting',
//                     start: new Date(y, m, d, 10, 30),
//                     allDay: false
//                 },
//                 {
//                     title: 'Lunch',
//                     start: new Date(y, m, d, 12, 0),
//                     end: new Date(y, m, d, 14, 0),
//                     allDay: false
//                 },
//                 {
//                     title: 'Birthday Party',
//                     start: new Date(y, m, d+1, 19, 0),
//                     end: new Date(y, m, d+1, 22, 30),
//                     allDay: false
//                 },
//                 {
//                     title: 'Click for Google',
//                     start: new Date(y, m, 28),
//                     end: new Date(y, m, 29),
//                     url: 'http://google.com/'
//                 }
//             ]
        });


    });

</script>