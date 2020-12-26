$(document).ready(function(){
    $("#analyticsDivExpandedIcon").click(function(){
        // hidden property created on grid page
        var isAnalyticsDivExpandedUserConfigValue = $("#isAnalyticsDivExpandedUserConfigValue").val() == "1" ? "0" : "1";
        // hidden property created on grid page
        var analyticsDivExpandedUserConfigKey = $("#analyticsDivExpandedUserConfigKey").val();
        setUserConfigForStickyAnalyticsDiv(analyticsDivExpandedUserConfigKey,isAnalyticsDivExpandedUserConfigValue);
        $("#isAnalyticsDivExpandedUserConfigValue").val(isAnalyticsDivExpandedUserConfigValue);
    });
});
function setUserConfigForStickyAnalyticsDiv(userConfigKey,userConfigValue){
    $.getJSON("Actions/UserConfigurationAction.php?call=setConfiguration&userConfigKey="+userConfigKey+"&userConfigValue="+userConfigValue,
        function (response){
        }
    );
}