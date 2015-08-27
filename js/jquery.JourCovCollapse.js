$(document).ready(function(){
    $("#archiveExpend").click(function(event){
        $("div.none").first().show('fast', function showNext() {
            $(this).next("div.none").show("fast", showNext);
        });
        $("#archiveExpend").hide();
        $("#archiveHide").show();
    });

    $("#archiveHide").click(function(event){
        $("div.none").last().hide('fast', function hideNext() {
            $(this).prev("div.none").hide("fast", hideNext);
        });
        $("#archiveHide").hide();
        $("#archiveExpend").show();
    });
});