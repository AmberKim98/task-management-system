$(document).ready(function(){
    $("#editBtn").removeClass('disabled');

    if($("#position").text() == 'admin')
    {
        if($("#employeeID").val() != $("#userID").val())
        {
           $("#editBtn").addClass('disabled');
        }
    }
});
