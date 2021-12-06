$(document).ready(function() {
    $('#resetBtn').click(function(event) {
         event.preventDefault();
         $("input[type=text], input[type=email], input[type=tel], input[type=file], input[type=date]").val("");
         $("textarea").val("");
         $("select").val("");
     });
});
