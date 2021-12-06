$(document).ready(function(){
    $('#resetBtn').click(function(event){
        event.preventDefault();
        $("input[type='text'], input[type='date']").val("");
        $("textarea").val("");
    });
});
