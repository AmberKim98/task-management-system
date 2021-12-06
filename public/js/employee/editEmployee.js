$(document).ready(function(e){

    $('#changePasswordForm').hide();
    if(($('#yes-radio').prop("checked")) == true){
        $('#changePasswordForm').show();
    }
    $('input[type="radio"]').click(function(){
        if(($('#yes-radio').prop("checked")) == true){
            $('#changePasswordForm').show();
        }
        if(($('#no-radio').prop("checked")) == true){
            $('#changePasswordForm').hide();
        }
    });
    $('#resetBtn').click(function(event) {
        event.preventDefault();
        $("input[type=text], input[type=email], input[type=file], input[type=tel], input[type=date]").val("");
        $("textarea").val("");
        $("select").val("");
        $("img").removeAttr("src");
        $("#profile").val("");
        $('input[name="pwd_radio"]').prop("checked", false);
    });
    $('#profile').change(function(){
        let reader = new FileReader();
        reader.onload = (e) => { 
          $('#preview_profile_img').attr('src', e.target.result); 
        }
        reader.readAsDataURL(this.files[0]);
    });
});

