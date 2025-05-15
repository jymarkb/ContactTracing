var downloadTimer;
var valueTimeLeft = sessionStorage.getItem("timeleft_id");
$(document).ready(function(){

    timerResend();
    $('#id_code').keypress(function (key) {
        testInputNumber(key);
        if(this.value.length==6){
           return false;
        } 
    });
    $('#next-submit-v').click(function(){
        if($('#id_code').val() == ''){
            $('#id_code').addClass('is-invalid');
        }else{
            if(postCode() == 'true'){
                $('#id_code').removeClass('is-invalid');
                $('#codeI').addClass('d-none');
                window.location.href = "/citizen/i-card/download";

            }else{
                $('#codeI').removeClass('d-none');
            }
        }
    });
    
    $('#resend-v').click(function(){
        $_token = $('meta[name="csrf-token"]').attr('content');
        $sendData = 1;

        $.ajax({
            url: "/common/id/ajaxResendCodeID",
            type:"POST",
            async:false,
            data:{
                resend:$sendData,
                _token: $_token
            },
            success:function(data){
                if(data == "true"){
                    sessionStorage.setItem("timeleft_id", 60);
                    downloadTimer = setInterval(timerResend, 1000);
                }
            }
        });
    });

    function timerResend(){
        valueTimeLeft = sessionStorage.getItem("timeleft_id");
        if(valueTimeLeft <= 0){
            clearInterval(downloadTimer);
            document.getElementById("resend-v").innerHTML = "Resend Code";
            document.getElementById("resend-v").disabled = false;
        } else {
            document.getElementById("resend-v").innerHTML = valueTimeLeft + "(s) remaining to re-send code";
            document.getElementById("resend-v").disabled = true;
        }
        valueTimeLeft -= 1;
        sessionStorage.setItem("timeleft_id", valueTimeLeft);
    };
    if(valueTimeLeft != null){
        downloadTimer = setInterval(timerResend, 1000);
    }else{
        valueTimeLeft != null
        document.getElementById("resend-v").innerHTML = "Resend Code";
        document.getElementById("resend-v").disabled = false; 
    }
   
});

function postCode(){
    var check;
    var formData = new FormData(document.getElementById('id_verify'));
    $.ajax({
        type:'POST',
        url: "/common/id/ajaxCheckCodeID",
        data: formData,
        cache:false,
        async:false,
        global:false,
        contentType: false,
        processData: false,
        success: function(data){
            check = data;
        }
   });
    return check;
}
function testInputNumber(key){
    var regex = new RegExp("^[0-9]*$");
    var str = String.fromCharCode(!key.charCode ? key.which : key.charCode);
    if (regex.test(str)) {
        return true;
    }else{
        key.preventDefault();
        return false;
    }
}
 