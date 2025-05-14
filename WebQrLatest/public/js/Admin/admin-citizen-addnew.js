var municipality;var barangay;var zone;

$(document).ready(function(){
    active();
    getAddress();

    var id_muni = $('#municipality');
    var id_brgy = $('#barangay');
    var id_zone = $('#zone');
    var id_muniCur = $('#municipality_current');
    var id_brgyCur = $('#barangay_current');
    var id_zoneCur = $('#zone_current');

    clrBrgy(id_brgy,"main");
    clrBrgy(id_brgyCur,"main");
    clrZone(id_zone,"main");
    clrZone(id_zoneCur,"curr");

    $('#firstName').on('change',function(){
        validFname();
    });
    $('#middleName').on('change',function(){
        validMname();
    });
    $('#lastName').on('change',function(){
        validLname();
    });
    $('#lastName').on('change',function(){
        validLname();
    });
    $('#suffix').on('change',function(){
        validSuffix();
    });
    $('#month').on('change',function(){
        validMonth();
    });
    $('#day').on('change',function(){
        validDay();
    });
    $('#year').on('change',function(){
        validYear();
    });
    $('#gender').on('change',function(){
        validGender();
    });
    $('#profession').on('change',function(){
        validProf();
    });
    $('#mobile').on('change',function(){
        validMobile();
    });
    $('#photo').on('change',function(){
        validPhoto();
    });
    $('#province').on('change',function(){
        var value = $('#province').val();
        checkZone(value,"province");
        setNewMunicipality(id_muni);
        clrBrgy(id_brgy,"main");
        clrZone(id_zone,"main");
        clrZoneField("main");
        clrBldg("main");  
    });
    $('#municipality').on('change',function(){
        validMuni();
        var value = $('#municipality').val();
        checkZone(value,"municipality");
        setNewBrgy(id_brgy);
        clrZone(id_zone,"main");
        clrZoneField("main");
        clrBldg("main");
    });
    $('#barangay').on('change',function(){
        validBrgy();
        setNewZone(id_zone);
        clrZoneField("main");
        clrBldg("main");
    });
    $('#zone').on('change', function(){
        validZone();
        clrBldg("main");
    });
    $('#zone_field').on('change', function(){
        validZoneField();
        clrBldg("main");
    });
    $('#details').on('change',function(){
        if($('#details').val() == ""){
            $('#details').removeClass('is-valid');
        }else{
            $('#details').addClass('is-valid');
        }
    });
    $('#province_current').on('change',function(){
        var value = $('#province_current').val();
        checkZoneCur(value,"province");
        setNewMunicipalityCur(id_muniCur);
        clrBrgy(id_brgyCur,"curr");
        clrZone(id_zoneCur,"curr");
        clrZoneField("curr");
        clrBldg("curr");  
    });
    $('#municipality_current').on('change',function(){
        validMuniCur();
        var value = $('#municipality_current').val();
        checkZoneCur(value,"municipality");
        setNewBrgyCur(id_brgyCur);
        clrZone(id_zoneCur,"curr");
        clrZoneField("curr");
        clrBldg("curr");
    });
    $('#barangay_current').on('change',function(){
        validBrgyCur();
        setNewZoneCur(id_zoneCur);
        clrZoneField("curr");
        clrBldg("curr");
    });
    $('#zone_current').on('change',function(){
        validZoneCur();
        clrBldg("curr");
    });
    $('#zone_field_current').on('change',function(){
        validZoneFieldCur();
        clrBldg("curr");
    });
    $('#details_current').on('change',function(){
        if($('#details_current').val() == ""){
            $('#details_current').removeClass('is-valid');
        }else{
            $('#details_current').addClass('is-valid');
        }
    });
    $('#chkCurrent').on('change',function(){
        if($(this).prop('checked')) {
            $('#currentAddress').addClass('d-none');
        } else {
            $('#currentAddress').removeClass('d-none');
        }
    }); 

    $('#firstName').keypress(function (e) {
        keyString(e);
    });
    $('#middleName').keypress(function (e) {
        keyString(e);
    });
    $('#lastName').keypress(function (e) {
        keyString(e);
    });
    $('#day').keypress(function (e) {
        if(this.value.length==2){
            return false;
        }
        keyNumber(e);
    });
    $('#year').keypress(function (e) {
    keyNumber(e);
        if(this.value.length==4){
            return false;
        } 
    });
    $('#profession').keypress(function (e) {
        keyString(e);
    });
    $('#mobile').keypress(function (e) {
        if(this.value.length==11){
            return false;
        } 
        keyNumber(e);
    });
    $('#adminCitizenAdd').on("click",function(){
        if($('#chkCurrent').prop('checked')){
            if(!validFname() | !validMname() | !validLname() | !validMonth() | !validDay() | !validYear() | !validGender() | !validProf() | !validMobile() | !validPhoto() | !validMuni() | !validBrgy() | !validZone() | !validZoneField()){
                document.getElementById('scroll-up').click();
                $('#register-toast').toast('show');
            }else{
                sendRequest();
            }
        }else{
            if(!validFname() | !validMname() | !validLname() | !validMonth() | !validDay() | !validYear() | !validGender() | !validProf() | !validMobile() | !validPhoto() | !validMuni() | !validBrgy() | !validZone() | !validZoneField() | !validMuniCur() | !validBrgyCur() | !validZoneCur() | !validZoneFieldCur()){
                document.getElementById('scroll-up').click();
                $('#register-toast').toast('show');
            }else{
                sendRequest();
            }
        }
    });
});

function setNewMunicipality($municipality){
    $('.label-municipality').removeClass('active');
    $municipality.empty();
    $municipality.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
      
    Object.keys(municipality).forEach(function(key) {
        if(municipality[key].province_id == $('#province').val()){
        $municipality.append('<option  value=' + municipality[key].municipalities_id + '>'+ (municipality[key].municipalities_name.toLowerCase()).charAt(0).toUpperCase() + (municipality[key].municipalities_name.toLowerCase()).slice(1) +'</option>');
        }
    });

    $municipality.removeClass('is-valid is-invalid');

}
function setNewBrgy($barangay){
    $('.label-barangay').removeClass('active');
    $barangay.empty();
    $barangay.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
    Object.keys(barangay).forEach(function(key) {
       if(barangay[key].municipalities_id == $('#municipality').val()){
          $barangay.append('<option  value=' + barangay[key].barangays_id + '>'+ barangay[key].barangays_name +'</option>');
       }
    });

    $barangay.removeClass('is-valid is-invalid');

}
function setNewZone($zone){
    $('.label-zone').removeClass('active');
    $zone.empty();
    $zone.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
    Object.keys(zone).forEach(function(key) {
        if(zone[key].barangays_id == $('#barangay').val()){
        $zone.append('<option  value=' + zone[key].zones_id + '>'+ zone[key].zones_name +'</option>');
        }
    });
    $zone.removeClass('is-valid is-invalid');
}
function setNewMunicipalityCur($curMunicipality){
    $('.label-curMunicipality').removeClass('active');
        $curMunicipality.empty();
        $curMunicipality.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');

    Object.keys(municipality).forEach(function(key) {
        if(municipality[key].province_id == $('#province_current').val()){
            $curMunicipality.append('<option  value=' + municipality[key].municipalities_id + '>'+ (municipality[key].municipalities_name.toLowerCase()).charAt(0).toUpperCase() + (municipality[key].municipalities_name.toLowerCase()).slice(1) +'</option>');
        }
    });
    $curMunicipality.removeClass('is-valid is-invalid');
}

function setNewBrgyCur($curBarangay){
    $('.label-curBarangay').removeClass('active');
        $curBarangay.empty();
        $curBarangay.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
        Object.keys(barangay).forEach(function(key) {
            if(barangay[key].municipalities_id == $('#municipality_current').val()){
                $curBarangay.append('<option  value=' + barangay[key].barangays_id + '>'+ barangay[key].barangays_name +'</option>');
            }
    });
    $curBarangay.removeClass('is-valid is-invalid');
}
function setNewZoneCur($curZone){
    $('.label-curZone').removeClass('active');
        $curZone.empty();
        $curZone.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
        Object.keys(zone).forEach(function(key) {
            if(zone[key].barangays_id == $('#barangay_current').val()){
                $curZone.append('<option  value=' + zone[key].zones_id + '>'+ zone[key].zones_name +'</option>');
            }
    });
    $curZone.removeClass('is-valid is-invalid');
}

function checkZone($selected_id,select){
    if(select == "municipality"){
        if($selected_id != 361){
            $('#zone_div_select').addClass('hidden');
            $('#zone_div_select').removeClass('show');
    
            $('#zone_div_field').addClass('show');
            $('#zone_div_field').removeClass('hidden');
        }else{
            $('#zone_div_select').removeClass('hidden');
            $('#zone_div_select').addClass('show');
    
            $('#zone_div_field').addClass('hidden');
            $('#zone_div_field').removeClass('show');
        }
    }else{
        if($selected_id != 20){
            $('#zone_div_select').addClass('hidden');
            $('#zone_div_select').removeClass('show');
   
            $('#zone_div_field').addClass('show');
            $('#zone_div_field').removeClass('hidden');
   
        }else{
            $('#zone_div_select').removeClass('hidden');
            $('#zone_div_select').addClass('show');
   
            $('#zone_div_field').addClass('hidden');
            $('#zone_div_field').removeClass('show');
        }
    }
}
function checkZoneCur($selected_id,select){
    if(select == "municipality"){
        if($selected_id != 361){
            $('#zone_div_select_current').addClass('hidden');
            $('#zone_div_select_current').removeClass('show');
   
            $('#zone_div_field_current').addClass('show');
            $('#zone_div_field_current').removeClass('hidden');
        }else{
            $('#zone_div_select_current').removeClass('hidden');
            $('#zone_div_select_current').addClass('show');
   
            $('#zone_div_field_current').addClass('hidden');
            $('#zone_div_field_current').removeClass('show');
        }
    }else{
        if($selected_id != 20){
            $('#zone_div_select_current').addClass('hidden');
            $('#zone_div_select_current').removeClass('show');
   
            $('#zone_div_field_current').addClass('show');
            $('#zone_div_field_current').removeClass('hidden');
        }else{
            $('#zone_div_select_current').removeClass('hidden');
            $('#zone_div_select_current').addClass('show');
   
            $('#zone_div_field_current').addClass('hidden');
            $('#zone_div_field_current').removeClass('show');
        }
    }
}

function clrBrgy($barangay,select){
    if(select == "main"){
        $('.label-barangay').removeClass('active');
    }else{
        $('.label-curBarangay').removeClass('active');
    }
    
    $barangay.empty();
    $barangay.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
    $barangay.append('<option id=' + 0 + ' value=' + 0 + ' disabled>Please select Municipality first.</option>');

    $barangay.removeClass('is-valid is-invalid');
}
function clrZone($zone,select){
    if(select == "main"){
        $('.label-zone').removeClass('active');
        $('#zone_field').val('');
        $('.label-zone-field').removeClass('active');
    }else{
        $('.label-curZone').removeClass('active');
        $('#zone_field_current').val('');
        $('.label-curZone-field').removeClass('active');
    }
    
    $zone.empty();
    $zone.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
    $zone.append('<option id=' + 0 + ' value=' + 0 + ' disabled>Please select Barangay first.</option>');
    
    $zone.removeClass('is-valid is-invalid');
}
function clrZoneField(select){
    if(select == "main"){
        $('.label-zone-field').removeClass('active');
        $('#zone_field').val('');
        validZoneField();
    }else{
        $('.label-curZone-field').removeClass('active');
        $('#zone_field_current').val('');
        validZoneFieldCur();
    }
    
}
function clrBldg(select){
    if(select == "main"){
        $('.label-detail').removeClass('active');
        $('#details').val('');
        $('#details').removeClass('is-valid');
    }else{
        $('.label-curDetail').removeClass('active');
        $('#details_current').val('');
        $('#details_current').removeClass('is-valid');
    }
}


async function sendRequest(){
    var formData = new FormData(document.getElementById('citizen-add'));
    if($('#chkCurrent').prop('checked')){
        formData.set('curProvince', $('#province').val());
        formData.set('curMunicipality', $('#municipality').val());
        formData.set('curBarangay', $('#barangay').val());
        formData.set('curZone1', $('#zone').val());
        formData.set('curZone2', $('#zone_field').val());
        formData.set('curBldg', $('#details').val());
    }
    $.ajax({
        type:'POST',
        url: "/admin-citizen-add",
        data: formData,
        cache:false,
        async:true,
        global:false,
        contentType: false,
        processData: false,
        success: function(data){
            clr();
            if(data == "true"){
                document.getElementById('scroll-up').click();
                $('#success-toast').toast('show');
            }else{
                document.getElementById('scroll-up').click();
                $('#exist-toast').toast('show');
            }
        }
   });
}

function clr(){
    var id_muni = $('#municipality');
    var id_brgy = $('#barangay');
    var id_zone = $('#zone');
    var id_muniCur = $('#municipality_current');
    var id_brgyCur = $('#barangay_current');
    var id_zoneCur = $('#zone_current');

    $('#firstName').val('');
    $('#middleName').val('');
    $('#lastName').val('');
    $('#suffix').val('0');
    $("#month").val("0").change();
    $('#day').val('');
    $('#year').val('');
    $("#gender").val("0").change();
    $('#profession').val('');
    $('#mobile').val('');

    $("#province").val("20").change();

    id_muni.empty();
    id_muni.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
    id_muni.append('<option id=' + 0 + ' value=' + 0 + ' disabled>Please select Province first.</option>');

    id_brgy.empty();
    id_brgy.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
    id_brgy.append('<option id=' + 0 + ' value=' + 0 + ' disabled>Please select Municipality first.</option>');

    id_zone.empty();
    id_zone.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
    id_zone.append('<option id=' + 0 + ' value=' + 0 + ' disabled>Please select Barangay first.</option>');

    $('#zone_field').val('');
    $('#details').val('');

    $('#currentAddress').removeClass('d-none');
    $("#chkCurrent").prop("checked", false);
    $("#province_current").val("20").change();
    id_muniCur.empty();
    id_muniCur.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
    id_muniCur.append('<option id=' + 0 + ' value=' + 0 + ' disabled>Please select Province first.</option>');

    id_brgyCur.empty();
    id_brgyCur.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
    id_brgyCur.append('<option id=' + 0 + ' value=' + 0 + ' disabled>Please select Municipality first.</option>');
    
    id_zoneCur.empty();
    id_zoneCur.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
    id_zoneCur.append('<option id=' + 0 + ' value=' + 0 + ' disabled>Please select Barangay first.</option>');

    $('#zone_field_current').val('');
    $('#details_current').val('');

    $('#firstName').removeClass('is-valid is-invalid');
    $('#middleName').removeClass('is-valid is-invalid');
    $('#lastName').removeClass('is-valid is-invalid');
    $('#suffix').removeClass('is-valid is-invalid');
    $('#month').removeClass('is-valid is-invalid');
    $('#day').removeClass('is-valid is-invalid');
    $('#year').removeClass('is-valid is-invalid');;
    $('#gender').removeClass('is-valid is-invalid');
    $('#profession').removeClass('is-valid is-invalid');
    $('#mobile').removeClass('is-valid is-invalid');
    $('#photo').removeClass('is-valid is-invalid');
    $('#photo-label').text('Profile Photo (Choose file)');
    $('#photoHelp').removeClass('d-none');
    $('#province').removeClass('is-valid is-invalid');
    $('#municipality').removeClass('is-valid is-invalid');
    $('#barangay').removeClass('is-valid is-invalid');
    $('#zone').removeClass('is-valid is-invalid');
    $('#zone_field').removeClass('is-valid is-invalid');
    $('#details').removeClass('is-valid is-invalid');
    $('#province_current').removeClass('is-valid is-invalid');
    $('#municipality_current').removeClass('is-valid is-invalid');
    $('#barangay_current').removeClass('is-valid is-invalid');
    $('#zone_current').removeClass('is-valid is-invalid');
    $('#zone_field_current').removeClass('is-valid is-invalid');
    $('#details_current').removeClass('is-valid is-invalid');

    $('.lblForm').removeClass('active');
   loadMunicipality();
}

function validFname(){
    var value = $("#firstName");
    if(value.val() == ""){
        value.addClass("is-invalid");
        value.removeClass("is-valid");
        return false;
    }else{
        value.addClass("is-valid");
        value.removeClass("is-invalid");
        return true;
    }
}
function validMname(){
    var value = $("#middleName");
    if(value.val() == ""){
        value.addClass("is-invalid");
        value.removeClass("is-valid");
        return false;
    }else{
        value.addClass("is-valid");
        value.removeClass("is-invalid");
        return true;
    }
}
function validLname(){
    var value = $("#lastName");
    if(value.val() == ""){
        value.addClass("is-invalid");
        value.removeClass("is-valid");
        return false;
    }else{
        value.addClass("is-valid");
        value.removeClass("is-invalid");
        return true;
    }
}
function validSuffix(){
    var value = $('#suffix');
    if(value.val() != '0'){
        value.addClass("is-valid");
    }else{
        value.removeClass("is-valid");
    }
}
function validMonth(){
    var value = $("#month");
    if(value.val()==0){
        value.addClass("is-invalid");
        value.removeClass("is-valid");
        return false;
    }else{
        value.addClass("is-valid");
        value.removeClass("is-invalid");
        return true;
    }
}
function validDay(){
    var value = $("#day");
    if(value.val()==""){
        value.addClass("is-invalid");
        value.removeClass("is-valid");
        return false;
    }else{
        if(value.val() > 31 || value.val() == 0){
            value.addClass("is-invalid");
            value.removeClass("is-valid");
            value.val('');
            return false;
        }else{
            value.addClass("is-valid");
            value.removeClass("is-invalid");
            return true;
        }
    }
}
function validYear(){
    var newD = new Date();
    var year = newD.getFullYear();
    var value = $("#year");
    if(value.val()==""){
        value.addClass("is-invalid");
        value.removeClass("is-valid");
        return false;
    }else{
        if(value.val() < 1920 || value.val() == 0 || value.val() >= year){
            value.addClass("is-invalid");
            value.removeClass("is-valid");
            value.val('');
            return false;
        }else{
            value.addClass("is-valid");
            value.removeClass("is-invalid");
            return true;
        }
    }
}
function validGender(){
    var value = $("#gender");
    if(value.val() == 0){
        value.addClass("is-invalid");
        value.removeClass("is-valid");
        return false;
    }else{
        value.addClass("is-valid");
        value.removeClass("is-invalid");
        return true;
    }
}
function validProf(){
    var value = $("#profession");
    if(value.val()==""){
        value.addClass("is-invalid");
        value.removeClass("is-valid");
        return false;
    }else{
        value.addClass("is-valid");
        value.removeClass("is-invalid");
        return true;
    }
}
async function validMobile(){
    var value = $("#mobile");
    if(value.val()==""){
        value.addClass("is-invalid");
        value.removeClass("is-valid");
        $('#validMobileA').removeClass('d-none');
        $('#validMobileB').addClass('d-none');
        return false;
     }else{
        if(value.val().length < 11){
            value.addClass("is-invalid");
            value.removeClass("is-valid");
            $('#validMobileA').removeClass('d-none');
            $('#validMobileB').addClass('d-none');
            return false;
        }else{
           var fValue = value.val().charAt(0);
           var sValue = value.val().charAt(1);
           if( fValue == 0 && sValue == 9){
  
              $getValue = value.val();
              $_token = $('meta[name="csrf-token"]').attr('content');
  
            await $.ajax({
                url: "/ajaxCheckMobile",
                async:true,
                global:false,
                type:"POST",
                data:{
                    numberValue:$getValue,
                    _token: $_token
                },
                success:function(success){
                    if(success == 'has'){
                        value.addClass("is-invalid");
                        value.removeClass("is-valid");
                        $('#validMobileA').addClass('d-none');
                        $('#validMobileB').removeClass('d-none');
                        return false;
                    }else{
                        value.addClass("is-valid");
                        value.removeClass("is-invalid");
                        return true;
                    }
                }
              });
           }else{
                value.addClass("is-invalid");
                value.removeClass("is-valid");
                $('#validMobileA').removeClass('d-none');
                $('#validMobileB').addClass('d-none');
                return false;
           }
        }
     }
}
function validPhoto(){
    var value = $("#photo");
    if($.trim(value.val())==""){
        value.addClass("is-invalid");
        value.removeClass("is-valid");
        $('#photo-label').text('Profile Photo (Choose file)');
        $('#photoHelp').addClass('d-none');
        return false;
    }else{
       switch(value.val().substring(value.val().lastIndexOf('.') + 1).toLowerCase()){
            case 'jpg': case 'png': case'jpeg' :
                var fullPath = document.getElementById('photo').value;
                var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
                var filename = fullPath.substring(startIndex);
                if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                    filename = filename.substring(1);
                }
                $('#photo-label').text('Profile Photo : ' + filename);
                value.addClass("is-valid");
                value.removeClass("is-invalid");
                $('#photoHelp').removeClass('d-none');
                return true;

            default:
                $('#photo').addClass("is-invalid");
                $('#photo').removeClass("is-valid");
                $('#photo-label').text('Profile Photo (Choose file)');
                $('#photoHelp').addClass('d-none');
                return false;
        }
    }
}
function validMuni(){
    var value = $('#municipality');
    if(value.val()==0){
        value.addClass("is-invalid");
        value.removeClass("is-valid");
        return false;
    }else{
        value.addClass("is-valid");
        value.removeClass("is-invalid");
        return true;
    }
}
function validBrgy(){
    var value = $('#barangay');
    if(value.val()==0){
        value.addClass("is-invalid");
        value.removeClass("is-valid");
        return false;
    }else{
        value.addClass("is-valid");
        value.removeClass("is-invalid");

        return true;
    }
}
function validZone(){
    var value = $('#zone');
    if($('#province').val() == 20){
        if($('#municipality').val()  == 361){
            if(value.val()== 0){
                value.addClass("is-invalid");
                value.removeClass("is-valid");
                return false;
            }else{
                value.addClass("is-valid");
                value.removeClass("is-invalid");
                return true;
            }
        }else{
            if($('#municipality').val() == 0){
                value.addClass("is-invalid");
                value.removeClass("is-valid");
                return false;
            }else{
                return true;
            }
        }
    }else{
        if($('#municipality').val() == 0){
            if($('#zone').val() == 0){
                $('#zone').addClass("is-invalid");
                $('#zone').removeClass("is-valid");
                return false;
            }
        }else{
            return true;
        }
    }
}
function validZoneField(){
    var value = $('#zone_field');
    if($('#province').val() != 20){
        if($('#municipality') != 361){
            if($('#zone_field').val()==""){
                $('#zone_field').removeClass("is-valid");
                return true;
            }else{
                $('#zone_field').addClass("is-valid");
                return true;
            }
        }
    }else{
        if($('#municipality') != 0){
            if($('#zone_field').val()==""){
                $('#zone_field').removeClass("is-valid");
                return true;
            }else{
                $('#zone_field').addClass("is-valid");
                return true;
            }
        }
    }
}
function validMuniCur(){
    var value = $('#municipality_current');
    if(value.val()==0){
        value.addClass("is-invalid");
        value.removeClass("is-valid");
        return false;
    }else{
        value.addClass("is-valid");
        value.removeClass("is-invalid");

        return true;
    }
}
function validBrgyCur(){
    var value = $('#barangay_current');
    if(value.val()==0){
        value.addClass("is-invalid");
        value.removeClass("is-valid");
        return false;
    }else{
        value.addClass("is-valid");
        value.removeClass("is-invalid");
        return true;
    }
}
function validZoneCur(){
    var value = $('#zone_current');
    if($('#province_current').val() == 20){
        if($('#municipality_current').val() == 361){
            if(value.val()== 0){
                value.addClass("is-invalid");
                value.removeClass("is-valid");
                return false;
            }else{
                value.addClass("is-valid");
                value.removeClass("is-invalid");
                return true;     
            }
        }else{
            if($('#municipality_current').val() == 0){
                value.addClass("is-invalid");
                value.removeClass("is-valid");
                return false;
            }else{
                return true;
            }
        }
    }else{
        if($('#municipality_current').val() == 0){
            if(value.val()== 0){
                value.addClass("is-invalid");
                value.removeClass("is-valid");
                return false;
            }
        }else{
            return true;
        }
    }
}
function validZoneFieldCur(){
    var value = $('#zone_field_current');
    if($('#province_current').val() != 20){
        if($('#municipality_current') != 361){
            if(value.val()==""){
                value.removeClass("is-valid");
                return true;
            }else{
                value.addClass("is-valid");
                return true;
            }
        }
    }else{
        if($('#municipality_current') != 0){
            if(value.val()==""){
                value.removeClass("is-valid");
                return true;
            }else{
                value.addClass("is-valid");
                return true;
            }
        }
    }
}
 
function loadMunicipality(){
    var $municipality = $('#municipality');
    $municipality.empty();
    $municipality.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
    Object.keys(municipality).forEach(function(key) {
        if(municipality[key].province_id == $('#province').val()){
        $municipality.append('<option  value=' + municipality[key].municipalities_id + '>'+ (municipality[key].municipalities_name.toLowerCase()).charAt(0).toUpperCase() + (municipality[key].municipalities_name.toLowerCase()).slice(1) +'</option>');
        }
    });

    var $municipalityCur = $('#municipality_current');
    $municipalityCur.empty();
    $municipalityCur.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
    Object.keys(municipality).forEach(function(key) {
        if(municipality[key].province_id == $('#province_current').val()){
        $municipalityCur.append('<option  value=' + municipality[key].municipalities_id + '>'+ (municipality[key].municipalities_name.toLowerCase()).charAt(0).toUpperCase() + (municipality[key].municipalities_name.toLowerCase()).slice(1) +'</option>');
        }
    });
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
function getAddress(){
    $_token = $('meta[name="csrf-token"]').attr('content');
    var address = 'true';
    $.ajax({
        type:'POST',
        url: "/ajaxGetAddress",
        async:true,
        data: {_token: $_token,address:address},
        success: function(data){
            municipality = data.municipality;
            barangay = data.barangay;
            zone = data.zone;
            loadMunicipality();
        }
    });
}