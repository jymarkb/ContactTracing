$(document).ready(function(){

    sessionStorage.setItem("timeleft_tracking", 0);

    $('#number').keypress(function (key) {
        testInputNumber(key);
        if(this.value.length==11){
           return false;
        } 
    });
    $('#number').change(function(){
        if($('#number').val() != ''){
            var fValue = $('#number').val().charAt(0);
            var sValue = $('#number').val().charAt(1);
            if( fValue != 0 && sValue != 9){
                $('#number').addClass("is-invalid");
            }else{
                if($('#number').val().length < 11){
                    $('#number').addClass("is-invalid");
                }else{
                    $('#number').removeClass("is-invalid");
                }   
            }
        }

    });

    $('#next-submit').click(function(){
        
        if(checkNumber() == 'true'){
            var formData = new FormData(document.getElementById('id_download'));
            $.ajax({
                type:'POST',
                url: "/common/tk/ajaxCheckNumberTracking",
                data: formData,
                cache:false,
                async:false,
                global:false,
                contentType: false,
                processData: false,
                success: function(data){
                    if(data == 'true'){
                        $('#mobileI').addClass('d-none');
                        window.location.href = "/citizen/tracking/verification";
                    }else{
                        $('#number').addClass("is-invalid");
                        $('#mobileA').addClass('d-none');
                        $('#mobileI').removeClass('d-none');
                    }
                }
           });
        }
    });

});
function checkNumber(){
    if($('number').val() == ''){
        $('#number').addClass("is-invalid");
        return 'false';
    }else{
        var fValue = $('#number').val().charAt(0);
        var sValue = $('#number').val().charAt(1);
        if( fValue != 0 && sValue != 9){
            $('#number').addClass("is-invalid");
            return 'false';
        }else{
            if($('#number').val().length < 11){
                $('#number').addClass("is-invalid");
                return 'false';
            }else{
                $('#number').removeClass("is-invalid");
                return 'true';
            }   
        }
    }
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