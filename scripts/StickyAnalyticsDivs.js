$(document).ready(function(){
});
function setUserConfigForStickyAnalyticsDiv(userConfigKey){
    var userConfigValue = $("#is"+userConfigKey).val();
    $.getJSON("Actions/UserConfigurationAction.php?call=setConfiguration&userConfigKey="+userConfigKey+"&userConfigValue="+userConfigValue,
        function (response){
            // console.log(response.data['configvalue']);
            $("#is"+userConfigKey).val(response.data['configvalue']);
        }
    );
}