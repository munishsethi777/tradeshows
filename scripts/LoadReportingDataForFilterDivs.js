function loadReportingData(dataFor) {
    $.getJSON("Actions/ReportingDataAction.php?call=getReportingData&for=" + dataFor,
        function(response) {
            $.each(response.data, function(key, value) {
                if (key.includes("change_arrow")) {
                    $("#" + key).addClass(value);
                } else if (key.includes("change_color")) {
                    $("#" + key).css("color", value);
                } else if (key.includes("thirty_days")) {//graph case
                    if(value != ""){
                        var graph = new Rickshaw.Graph( {
                            element: document.querySelector("#"+key),
                            height:'50',
                            width:'180',
                            series: [{
                                color: '#1ab394',
                                data: value,
                            }]
                        });
                        var barElement = document.getElementById(key); 
                        var resize = function () {
                            graph.configure({
                                width: barElement.clientWidth, //html is "auto-magically" rendering size
                                height: barElement.clientHeight //leverage this for precise re-size scalling
                            });
                            graph.render();
                        }
                        window.addEventListener('resize', resize);
                        resize();
                    }
                } else {
                    $("#" + key).text(value);
                }
            });
        }
    );
}