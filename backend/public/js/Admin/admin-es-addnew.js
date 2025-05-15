var zone;
$(document).ready(function(){
    active();
    getAddress();
    loadZone();

    $('#es_fname').on("change", function(){
        validFname();
    });
    $('#es_mname').on("change", function(){
        validMname();
    });
    $('#es_lname').on("change", function(){
        validLname();
    });
    $('#es_suffix').on("change", function(){
        if($('#es_suffix').val() != "0"){
            $('#es_suffix').addClass('is-valid');
        }else{
            $('#es_suffix').removeClass('is-valid');
        }
    });
    $('#es_gender').on("change", function(){
        validGender();
    });
    $('#es_month').on("change", function(){
        validMonth();
    });
    $('#es_day').on("change", function(){
        validDay();
    });
    $('#es_year').on("change", function(){
        validYear();
    });
    $('#es_number').on("change", function(){
        validMobile();
    });
    $('#es_company').on("change", function(){
        validCompany();
    });
    $('#es_permit').on("change", function(){
        validPermit();
    });
    $('#es_brgy').on("change", function(){
        validBrgy();
        setNewZone();
    });
    $('#es_zone').on("change", function(){
        validZone();
    });
    $('#es_details').on("change", function(){
        if($('#es_details').val() != ""){
            $('#es_details').addClass('is-valid');
        }else{
            $('#es_details').removeClass('is-valid');
        }
    });

    $('#es_fname').keypress(function (e) {
        keyString(e);
     });
    $('#es_mname').keypress(function (e) {
        keyString(e);
     });
    $('#es_lname').keypress(function (e) {
        keyString(e);
     });
    $('#es_day').keypress(function (e) {
        if(this.value.length==2){
            return false;
         }
        keyNumber(e);
        
    });
    $('#es_year').keypress(function (e) {
        if(this.value.length==4){
            return false;
        } 
        keyNumber(e);
        
    });
    $('#es_number').keypress(function (e) {
        if(this.value.length==11){
            return false;
        } 
        keyNumber(e);
        
    });
    $('#addnew_establishment').on('click', function(){
        if(!validFname() | !validMname() | !validLname() | !validGender() | !validMonth() | !validDay() | !validYear() | !validMobile() | !validCompany() | !validPermit() | !validBrgy() | !validZone()){
            document.getElementById('scroll-up').click();
            $('#register-toast').toast('show');
        }else{
            addNewES();
        }
    });
});
async function addNewES(){
    var formData = new FormData(document.getElementById('establishment-add'));
    $.ajax({
        type:'POST',
        url: "/establishment/add",
        data: formData,
        cache:false,
        contentType: false,
        async:true,
        global:false,
        processData: false,
        success: function(data){
            if(data == "exist"){
                document.getElementById('scroll-up').click();
                clearFormES();
                $('#exist-toast').toast('show');
            }else{
                document.getElementById('scroll-up').click();
                clearFormES();
                $('#success-toast').toast('show');
            }
        }
   });
}
function clearFormES(){
    $('#es_fname').removeClass('is-valid is-invalid');
    $('#es_mname').removeClass('is-valid is-invalid');
    $('#es_lname').removeClass('is-valid is-invalid');
    $('#es_suffix').removeClass('is-valid is-invalid');
    $('#es_gender').removeClass('is-valid is-invalid');
    $('#es_month').removeClass('is-valid is-invalid');
    $('#es_day').removeClass('is-valid is-invalid');
    $('#es_year').removeClass('is-valid is-invalid');
    $('#es_number').removeClass('is-valid is-invalid');
    $('#es_company').removeClass('is-valid is-invalid');
    $('#es_permit').removeClass('is-valid is-invalid');
    $('#es_brgy').removeClass('is-valid is-invalid');
    $('#es_zone').removeClass('is-valid is-invalid');
    $('#es_details').removeClass('is-valid is-invalid');
    $('#es_fname').val('')
    $('#es_mname').val('');
    $('#es_lname').val('');
    $('#es_suffix').val(0);
    $('#es_gender').val(0);
    $('#es_month').val(0);
    $('#es_day').val('');
    $('#es_year').val('');
    $('#es_number').val('');
    $('#es_company').val('');
    $('#es_permit').val('');
    $('#es_brgy').val(0);
    $('#es_zone').empty();
    $('#es_zone').append('<option value=' + 0 + ' selected hidden></option>');
    $('#es_zone').val(0);
    $('#es_details').val('');
    $('.lblForm').removeClass('active');
}
function setNewZone(){
    $('#es_zone').empty();
    $('#es_zone').append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
    Object.keys(zone).forEach(function(key) {
        if(zone[key].barangays_id == $('#es_brgy').val()){
            $('#es_zone').append('<option  value=' + zone[key].zones_id + '>'+ zone[key].zones_name +'</option>');
        }
    });
    $('#es_lblzone').removeClass('active');
    $('#es_zone').removeClass('is-valid is-invalid');
}
function loadZone(){
    $('#es_zone').empty();
    $('#es_zone').append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
    $('#es_zone').append('<option id=' + 0 + ' value=' + 0 + ' disabled>Please select Barangay first.</option>');
}
function validFname(){
    if($('#es_fname').val() == ''){
        $('#es_fname').addClass('is-invalid');
        $('#es_fname').removeClass('is-valid');
        return false;
    }else{
        $('#es_fname').addClass('is-valid');
        $('#es_fname').removeClass('is-invalid');
        return true;
    } 
}
function validMname(){
    if($('#es_mname').val() == ''){
        $('#es_mname').addClass('is-invalid');
        $('#es_mname').removeClass('is-valid');
        return false;
    }else{
        $('#es_mname').addClass('is-valid');
        $('#es_mname').removeClass('is-invalid');
        return true;
    } 
}
function validLname(){
    if($('#es_lname').val() == ''){
        $('#es_lname').addClass('is-invalid');
        $('#es_lname').removeClass('is-valid');
        return false;
    }else{
        $('#es_lname').addClass('is-valid');
        $('#es_lname').removeClass('is-invalid');
        return true;
    } 
}
function validGender(){
    if($('#es_gender').val()==0){
        $('#es_gender').addClass("is-invalid");
        $('#es_gender').removeClass("is-valid");
        return false;
    }else{
        $('#es_gender').addClass("is-valid");
        $('#es_gender').removeClass("is-invalid");
        return true;
    }
}
function validMonth(){
    if($('#es_month').val()==0){
        $('#es_month').addClass("is-invalid");
        $('#es_month').removeClass("is-valid");
        return false;
    }else{
        $('#es_month').addClass("is-valid");
        $('#es_month').removeClass("is-invalid");
        return true;
    }
}
function validDay(){
    if($('#es_day').val()==""){
        $('#es_day').addClass("is-invalid");
        $('#es_day').removeClass("is-valid");
        return false;
    }else{
        if($('#es_day').val() > 31 || $('#es_day').val() == 0){
            $('#es_day').addClass("is-invalid");
            $('#es_day').removeClass("is-valid");
            $('#es_day').val('');
            return false;
        }else{
            $('#es_day').addClass("is-valid");
            $('#es_day').removeClass("is-invalid");
            return true;
        }
    }
}
function validYear(){
    var newD = new Date();
    var year = newD.getFullYear();
    if($('#es_year').val()==""){
        $('#es_year').addClass("is-invalid");
        $('#es_year').removeClass("is-valid");
        return false;
    }else{
        if($('#es_year').val() < 1920 || $('#es_year').val() == 0 || $('#es_year').val() >= year){
            $('#es_year').addClass("is-invalid");
            $('#es_year').removeClass("is-valid");
            $('#es_year').val('');
            return false;
        }else{
            $('#es_year').addClass("is-valid");
            $('#es_year').removeClass("is-invalid");
            return true;
        }
    }
}
async function validMobile(){
    if($('#es_number').val() == ''){
        $('#es_number').addClass("is-invalid");
        $('#validMobileA').removeClass('d-none');
        $('#validMobileB').addClass('d-none');
        return false;
    }else{
        if($('#es_number').val().length < 11){
            $('#es_number').addClass("is-invalid");
            $('#validMobileA').removeClass('d-none');
            $('#validMobileB').addClass('d-none');
            return false;
        }else{
        var fValue = $('#es_number').val().charAt(0);
        var sValue = $('#es_number').val().charAt(1);
            if( fValue == 0 && sValue == 9){
                $value = $('#es_number').val();
                $_token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "/establishment/ajaxCheckMobile",
                    type:"POST",
                    async:true,
                    data:{
                        numberValue:$value,
                        _token: $_token
                    },
                    success:function(data){
                        if(data == 'has'){
                            $('#es_number').addClass("is-invalid");
                            $('#validMobileA').addClass('d-none');
                            $('#validMobileB').removeClass('d-none');
                            return false;
                        }else{
                            $('#es_number').removeClass("is-invalid");
                            $('#es_number').addClass('is-valid');
                            
                            return true;
                        }
                    }
                });
            }else{
                $('#es_number').addClass('is-invalid');
                $('#validMobileA').removeClass('d-none');
                $('#validMobileB').addClass('d-none');
                return false;
            }
        }
    }
}
function validCompany(){
    if($('#es_company').val() == ''){
        $('#es_company').addClass('is-invalid');
        $('#es_company').removeClass('is-valid');
        return false;
    }else{
        $('#es_company').addClass('is-valid');
        $('#es_company').removeClass('is-invalid');
        return true;
    }
}
function validPermit(){
    if($('#es_permit').val() == ''){
        $('#es_permit').addClass('is-invalid');
        $('#es_permit').removeClass('is-valid');
        return false;
    }else{
        $('#es_permit').addClass('is-valid');
        $('#es_permit').removeClass('is-invalid');
        return true;
    } 
}
function validBrgy(){
    if($('#es_brgy').val() == 0){
        $('#es_brgy').addClass('is-invalid');
        $('#es_brgy').removeClass('is-valid');
        return false;
    }else{
        $('#es_brgy').removeClass('is-invalid');
        $('#es_brgy').addClass('is-valid');
        return true;
    }
}
function validZone(){
    if($('#es_zone').val() == 0){
        $('#es_zone').addClass('is-invalid');
        $('#es_zone').removeClass('is-valid');
        return false;
    }else{
        $('#es_zone').removeClass('is-invalid');
        $('#es_zone').addClass('is-valid');
        return true;
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
function getAddress(){
    $_token = $('meta[name="csrf-token"]').attr('content');
    var address = 'true';
    $.ajax({
        type:'POST',
        url: "/ajaxGetAddress",
        async:true,
        data: {_token: $_token,address:address},
        success: function(data){
            zone = data.zone;
        }
   });
}