$(document).ready(function(){
    $("#resetBtn").click(function(event){
        event.preventDefault();
        $("input[type=text], input[type=datetime-local]").val("");
        $("select").val("");
        $("textarea").val("");
    });
});
