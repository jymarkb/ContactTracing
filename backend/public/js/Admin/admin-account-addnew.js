$(document).ready(function(){
    active();
    $('#u_fname').on("change", function(){
        validFname();
    });
    $('#u_mname').on("change", function(){
        validMname();
    });
    $('#u_lname').on("change", function(){
        validLname();
    });
    $('#u_suffix').on("change", function(){
        if($('#u_suffix').val() != "0"){
            $('#u_suffix').addClass('is-valid');
        }else{
            $('#u_suffix').removeClass('is-valid');
        }
    });
    $('#u_gender').on("change", function(){
        validGender();
    });
    $('#u_month').on("change", function(){
        validMonth();
    });
    $('#u_day').on("change", function(){
        validDay();
    });
    $('#u_year').on("change", function(){
        validYear();
    });
    $('#u_number').on("change", function(){
        validMobile();
    });
    $('#u_username').on("change", function(){
        validUsername();
    });
    $('#u_password').on("change", function(){
        validPassword();
    });
    $('#u_passwordCon').on("change", function(){
        validConPassword();
    });
    $('#u_type').on("change", function(){
        validType();
    });
    $('#u_fname').on("keypress", function(e){
        keyString(e);
    });
    $('#u_mname').on("keypress", function(e){
        keyString(e);
    });
    $('#u_lname').on("keypress", function(e){
        keyString(e);
    });
    $('#u_day').on("keypress", function(e){
        if(this.value.length==2){
           return false;
        }
        keyNumber(e);
    });
    $('#u_year').on("keypress", function(e){
        if(this.value.length==4){
           return false;
        } 
        keyNumber(e);
    });
    $('#u_number').on("keypress", function(e){
        if(this.value.length==11){
           return false;
        } 
        keyNumber(e);
    });
    $('#addnew_admin').on("click", function(){
        if(!validFname() | !validMname() | !validLname() | !validGender() | !validMonth() | !validDay() | !validYear() | !validMobile() | !validUsername() | !validPassword() | !validConPassword() | !validType()){
            document.getElementById('scroll-up').click();
            $('#register-toast').toast('show');
        }else{
            addNewAdmin();
        }
    })

});

function addNewAdmin(){
    var formData = new FormData(document.getElementById('admin-add'));
    $.ajax({
        type:'POST',
        url: "/account/add-new",
        data: formData,
        cache:false,
        contentType: false,
        async:true,
        global:false,
        processData: false,
        success: function(data){
            if(data == "exist"){
                document.getElementById('scroll-up').click();
                clearFormAdmin();
                $('#exist-toast').toast('show');
            }else{
                document.getElementById('scroll-up').click();
                clearFormAdmin();
                $('#success-toast').toast('show');
            }
        }
   });
}
function clearFormAdmin(){
    $('#u_fname').removeClass('is-valid is-invalid');
    $('#u_mname').removeClass('is-valid is-invalid');
    $('#u_lname').removeClass('is-valid is-invalid');
    $('#u_suffix').removeClass('is-valid is-invalid');
    $('#u_gender').removeClass('is-valid is-invalid');
    $('#u_month').removeClass('is-valid is-invalid');
    $('#u_day').removeClass('is-valid is-invalid');
    $('#u_year').removeClass('is-valid is-invalid');
    $('#u_number').removeClass('is-valid is-invalid');
    $('#u_username').removeClass('is-valid is-invalid');
    $('#u_password').removeClass('is-valid is-invalid');
    $('#u_passwordCon').removeClass('is-valid is-invalid');
    $('#u_type').removeClass('is-valid is-invalid');

    $('#u_fname').val('')
    $('#u_mname').val('');
    $('#u_lname').val('');
    $('#u_suffix').val(0);
    $('#u_gender').val(0);
    $('#u_month').val(0);
    $('#u_day').val('');
    $('#u_year').val('');
    $('#u_number').val('');
    $('#u_username').val('');
    $('#u_password').val('');
    $('#u_passwordCon').val('');
    $('#u_type').val(0);
    $('.lblForm').removeClass('active');
}
function validFname(){
    if($('#u_fname').val() == ''){
        $('#u_fname').addClass('is-invalid');
        $('#u_fname').removeClass('is-valid');
        return false;
    }else{
        $('#u_fname').addClass('is-valid');
        $('#u_fname').removeClass('is-invalid');
        return true;
    } 
}
function validMname(){
    if($('#u_mname').val() == ''){
        $('#u_mname').addClass('is-invalid');
        $('#u_mname').removeClass('is-valid');
        return false;
    }else{
        $('#u_mname').addClass('is-valid');
        $('#u_mname').removeClass('is-invalid');
        return true;
    } 
}
function validLname(){
    if($('#u_lname').val() == ''){
        $('#u_lname').addClass('is-invalid');
        $('#u_lname').removeClass('is-valid');
        return false;
    }else{
        $('#u_lname').addClass('is-valid');
        $('#u_lname').removeClass('is-invalid');
        return true;
    } 
}
function validGender(){
    if($('#u_gender').val()==0){
        $('#u_gender').addClass("is-invalid");
        $('#u_gender').removeClass("is-valid");
        return false;
    }else{
        $('#u_gender').addClass("is-valid");
        $('#u_gender').removeClass("is-invalid");
        return true;
    }
}
function validMonth(){
    if($('#u_month').val()==0){
        $('#u_month').addClass("is-invalid");
        $('#u_month').removeClass("is-valid");
        return false;
    }else{
        $('#u_month').addClass("is-valid");
        $('#u_month').removeClass("is-invalid");
        return true;
    }
}
function validDay(){
    if($('#u_day').val()==""){
        $('#u_day').addClass("is-invalid");
        $('#u_day').removeClass("is-valid");
        return false;
    }else{
        if($('#u_day').val() > 31 || $('#u_day').val() == 0){
            $('#u_day').addClass("is-invalid");
            $('#u_day').removeClass("is-valid");
            $('#u_day').val('');
            return false;
        }else{
            $('#u_day').addClass("is-valid");
            $('#u_day').removeClass("is-invalid");
            return true;
        }
    }
}
function validYear(){
    var newD = new Date();
    var year = newD.getFullYear();
    if($('#u_year').val()==""){
        $('#u_year').addClass("is-invalid");
        $('#u_year').removeClass("is-valid");
        return false;
    }else{
        if($('#u_year').val() < 1920 || $('#u_year').val() == 0 || $('#u_year').val() >= year){
            $('#u_year').addClass("is-invalid");
            $('#u_year').removeClass("is-valid");
            $('#u_year').val('');
            return false;
        }else{
            $('#u_year').addClass("is-valid");
            $('#u_year').removeClass("is-invalid");
            return true;
        }
    }
}
async function validMobile(){
    if($('#u_number').val() == ''){
        $('#u_number').addClass("is-invalid");
        $('#validMobileA').removeClass('d-none');
        $('#validMobileB').addClass('d-none');
        return false;
    }else{
        if($('#u_number').val().length < 11){
            $('#u_number').addClass("is-invalid");
            $('#validMobileA').removeClass('d-none');
            $('#validMobileB').addClass('d-none');
            return false;
        }else{
        var fValue = $('#u_number').val().charAt(0);
        var sValue = $('#u_number').val().charAt(1);
            if( fValue == 0 && sValue == 9){
                $value = $('#u_number').val();
                $_token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "/account/ajaxCheckMobile",
                    type:"POST",
                    async:true,
                    data:{
                        numberValue:$value,
                        _token: $_token
                    },
                    success:function(data){
                        if(data == 'has'){
                            $('#u_number').addClass("is-invalid");
                            $('#validMobileA').addClass('d-none');
                            $('#validMobileB').removeClass('d-none');
                            return false;
                        }else{
                            $('#u_number').removeClass("is-invalid");
                            $('#u_number').addClass('is-valid');
                            return true;
                        }
                    }
                });
            }else{
                $('#u_number').addClass('is-invalid');
                $('#validMobileA').removeClass('d-none');
                $('#validMobileB').addClass('d-none');
                return false;
            }
        }
    }
}
async function validUsername(){
    if($('#u_username').val() == ''){
        $('#u_username').addClass('is-invalid');
        $('#u_username').removeClass('is-valid');
        $('#userA').removeClass('d-none');
        $('#userB').addClass('d-none');
        return false;
    }else{
        $user = $('#u_username').val();
        $_token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "/account/ajaxCheckAccount",
            type:"POST",
            async:true,
            data:{
                user:$user,
                _token: $_token
            },
            success:function(data){
                if(data == 'has'){
                    $('#u_username').addClass("is-invalid");
                    $('#u_username').removeClass("is-valid");
                    $('#userA').addClass('d-none');
                    $('#userB').removeClass('d-none');
                    return false;
                }else{
                    $('#u_username').removeClass("is-invalid");
                    $('#u_username').addClass('is-valid');
                    return true;
                }
            }
        });
    } 
}
function validPassword(){
    if($('#u_password').val() == ''){
        $('#u_password').addClass('is-invalid');
        $('#u_password').removeClass('is-valid');
        return false;
    }else{
        if($('#u_password').val().length < 8){
            $('#u_password').addClass('is-invalid');
            $('#u_password').removeClass('is-valid');
            return false;
        }else{
            $('#u_password').removeClass('is-invalid');
            $('#u_password').addClass('is-valid');
            return true;
        }
    }
}
function validConPassword(){
    if($('#u_passwordCon').val() == ''){
        $('#u_passwordCon').addClass('is-invalid');
        $('#u_passwordCon').removeClass('is-valid');
        $('#cpassA').removeClass('d-none');
        $('#cpassB').addClass('d-none');
        return false;
    }else{
        if($('#u_password').val() != $('#u_passwordCon').val()){
            $('#u_passwordCon').addClass('is-invalid');
            $('#u_passwordCon').removeClass('is-valid');
            $('#cpassA').addClass('d-none');
            $('#cpassB').removeClass('d-none');
            return false;
        }else{
            $('#u_passwordCon').removeClass('is-invalid');
            $('#u_passwordCon').addClass('is-valid');
            return true;
        }
    }
}
function validType(){
    if($('#u_type').val() > 0){
        $('#u_type').addClass('is-valid');
        $('#u_type').removeClass('is-invalid');
        return true;
    }else{
        $('#u_type').removeClass('is-valid');
        $('#u_type').addClass('is-invalid');
        return false;
    }
}
function keyString(key){
    var regex = new RegExp("^[a-zA-ZÑñ ]*$");
    var str = String.fromCharCode(!key.charCode ? key.which : key.charCode);
    if (regex.test(str)) {
        return true;
    }else{
        key.preventDefault();
        return false;
    }
}
function keyNumber(key){
    var regex = new RegExp("^[0-9]*$");
    var str = String.fromCharCode(!key.charCode ? key.which : key.charCode);
    if (regex.test(str)) {
        return true;
    }else{
        key.preventDefault();
        return false;
    }
}
function active(){
    $(".form-group .form-control").blur(function(){
        if($(this).val()!="" && $(this).val()!=0){
          $(this).siblings("label").addClass("active");
        }else{
           $(this).siblings("label").removeClass("active");
        }
    });
}