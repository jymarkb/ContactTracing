$(document).ready(function(){

    sessionStorage.setItem("timeleft_id", 0);
    
    $('#d_number').keypress(function (key) {
        testInputNumber(key);
        if(this.value.length==11){
           return false;
        } 
    });
    $('#d_number').change(function(){
        if($('#d_number').val() != ''){
            var fValue = $('#d_number').val().charAt(0);
            var sValue = $('#d_number').val().charAt(1);
            if( fValue != 0 && sValue != 9){
                $('#d_number').addClass("is-invalid");
            }else{
                if($('#d_number').val().length < 11){
                    $('#d_number').addClass("is-invalid");
                }else{
                    $('#d_number').removeClass("is-invalid");
                }   
            }
        }

    });
    $('#next-submit').click(function(){
        if(checkNumber() == 'true'){
            var postNumber = postPhoneNumber();
            if(postNumber == 'true'){
                $('#mobileI').addClass('d-none');
                window.location.href = "/citizen/i-card/verification";
            }else{
                $('#d_number').addClass("is-invalid");
                $('#mobileA').addClass('d-none');
                $('#mobileI').removeClass('d-none');
            }
        }
    });

});
function checkNumber(){
    if($('d_number').val() == ''){
        $('#d_number').addClass("is-invalid");
        return 'false';
    }else{
        var fValue = $('#d_number').val().charAt(0);
        var sValue = $('#d_number').val().charAt(1);
        if( fValue != 0 && sValue != 9){
            $('#d_number').addClass("is-invalid");
            return 'false';
        }else{
            if($('#d_number').val().length < 11){
                $('#d_number').addClass("is-invalid");
                return 'false';
            }else{
                $('#d_number').removeClass("is-invalid");
                return 'true';
            }   
        }
    }
}
function postPhoneNumber(){
    var check;
    var formData = new FormData(document.getElementById('id_download'));
    $.ajax({
        type:'POST',
        url: "/common/id/ajaxCheckNumberID",
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
 