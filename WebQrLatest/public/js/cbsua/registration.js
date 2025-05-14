var municipality;var barangay;var zone;
$(document).ready(function(){
    active();
    getMuni();
    getZone();

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
        if($('#month').val() != '0'){
            $('#lblMonth').addClass("active");
        }else{
            $('#lblMonth').removeClass("active");
        }
    });
    $('#day').on('change',function(){
        validDay();
    });
    $('#year').on('change',function(){
        validYear();
    });
    $('#gender').on('change',function(){
        validGender();
        if($('#gender').val() != '0'){
            $('#lblGender').addClass("active");
        }else{
            $('#lblGender').removeClass("active");
        }
    });
    $('#profession').on('change',function(){
        validProf();
    });
    $('#mobile').on('change',function(){
        validMobile();
    });
    $('#photo').on('change',function(){
        validPhoto();
        process();
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

        if($('#municipality').val() != '0'){
            $('#lblMunicipality').addClass("active");
        }else{
            $('#lblMunicipality').removeClass("active");
        } 
    });
    $('#barangay').on('change',function(){
        validBrgy();
        setNewZone(id_zone);
        clrZoneField("main");
        clrBldg("main");

        if(parseInt($('#barangay').val()) > 0){
            $('#lblBrgy').addClass("active");
        }else{
            $('#lblBrgy').removeClass("active");
        }
    });
    $('#zone').on('change', function(){
        validZone();
        clrBldg("main");

        if($('#zone').val() != '0'){
            $('#lblZone').addClass("active");
        }else{
            $('#lblZone').removeClass("active");
        }
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

        if($('#municipality_current').val() != '0'){
            $('#lblMuniCur').addClass('active');
        }else{
            $('#lblMuniCur').removeClass('active');
        }
    });
    $('#barangay_current').on('change',function(){
        validBrgyCur();
        setNewZoneCur(id_zoneCur);
        clrZoneField("curr");
        clrBldg("curr");

        if(parseInt($('#barangay_current option:selected').val()) > 0){
            $('#lblBrgyCur').addClass('active');
        }else{
            $('#lblBrgyCur').removeClass('active');
        }
    });
    $('#zone_current').on('change',function(){
        validZoneCur();
        clrBldg("curr");

        if($('#zone_current').val() != '0'){
            $('#lblZoneCur').addClass('active');
        }else{
            $('#lblZoneCur').removeClass('active');
        }
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

    $('#modalSpinner').on('shown.bs.modal', function() {
        sendRequest();
    });

    $('#submitForm').click(function(){
        if($('#chkCurrent').prop('checked')){
            if(!validFname() | !validMname() | !validLname() | !validMonth() | !validDay() | !validYear() | !validGender() | !validProf() | !validMobile() | !validPhoto() | !validMuni() | !validBrgy() | !validZone() | !validZoneField()){
                $('#requiredAll').removeClass('d-none');
                $('html, body').animate({
                    scrollTop: $("#requiredAll").offset().top - 100
                }, 1000);
            }else{
                $('#requiredAll').addClass('d-none');
                if(!$('#chkTerms').prop('checked')){
                    $('#chkTerms').addClass('is-invalid');
                    $('#termsForm').removeClass('d-none')
                }else{
                    $('#chkTerms').removeClass('is-invalid');
                    $('#termsForm').addClass('d-none')
                    
                    $('#modalSpinner').modal('show');
                }
            }
        }else{
            if(!validFname() | !validMname() | !validLname() | !validMonth() | !validDay() | !validYear() | !validGender() | !validProf() | !validMobile() | !validPhoto() | !validMuni() | !validBrgy() | !validZone() | !validZoneField() | !validMuniCur() | !validBrgyCur() | !validZoneCur() | !validZoneFieldCur()){
                $('#requiredAll').removeClass('d-none');
                $('html, body').animate({
                    scrollTop: $("#requiredAll").offset().top - 100
                }, 1000);
            }else{
                $('#requiredAll').addClass('d-none');
                if(!$('#chkTerms').prop('checked')){
                    $('#chkTerms').addClass('is-invalid');
                    $('#termsForm').removeClass('d-none')
                }else{
                    $('#chkTerms').removeClass('is-invalid');
                    $('#termsForm').addClass('d-none')
    
                    $('#modalSpinner').modal('show');
                }
            }
        }

    });

});

function setNewMunicipality($municipality){
    $('.label-municipality').removeClass('active');
    $municipality.empty();
    $municipality.append('<option selected value="0" hidden disabled></option>');
      
    Object.keys(municipality).forEach(function(key) {
        if(municipality[key].province_id == $('#province').val()){
        $municipality.append('<option  value=' + municipality[key].municipalities_id + '>'+ nameTable(municipality[key].municipalities_name) +'</option>');
        }
    });

    $municipality.removeClass('is-valid is-invalid');

}
function setNewBrgy($barangay){
    $('.label-barangay').removeClass('active');
    $barangay.empty();
    $barangay.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
    $barangay.append('<option id=' + 0 + ' value=' + 0 + ' disabled>Loading please wait..</option>');
    // Object.keys(barangay).forEach(function(key) {
    //    if(barangay[key].municipalities_id == $('#municipality').val()){
    //       $barangay.append('<option  value=' + barangay[key].barangays_id + '>'+ barangay[key].barangays_name +'</option>');
    //    }
    // });

    $_token = $('meta[name="csrf-token"]').attr('content');
    var muni_id = $('#municipality').val();
    $.ajax({
        type:'POST',
        url: "/ajaxBrgy",
        data: {_token: $_token,muni_id:muni_id},
        success: function(data){
            $barangay.empty();
            $barangay.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
            for( var i = 0; i < data.length; i++){
                $barangay.append('<option  value=' + data[i].barangays_id + '>'+ data[i].barangays_name +'</option>');
            }
        }
    });

    $barangay.removeClass('is-valid is-invalid');

}
function setNewZone($zone){
    $('.label-zone').removeClass('active');
    $zone.empty();
    $zone.append('<option selected value="0" hidden disabled></option>');
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
        $curMunicipality.append('<option selected value="0" hidden disabled></option>');

    Object.keys(municipality).forEach(function(key) {
        if(municipality[key].province_id == $('#province_current').val()){
            $curMunicipality.append('<option  value=' + municipality[key].municipalities_id + '>'+ nameTable(municipality[key].municipalities_name) +'</option>');
        }
    });
    $curMunicipality.removeClass('is-valid is-invalid');
}
function setNewBrgyCur($curBarangay){
    $('.label-curBarangay').removeClass('active');
    $curBarangay.empty();
    $curBarangay.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
    $curBarangay.append('<option id=' + 0 + ' value=' + 0 + ' disabled>Loading please wait..</option>');
    // Object.keys(barangay).forEach(function(key) {
    //     if(barangay[key].municipalities_id == $('#municipality_current').val()){
    //         $curBarangay.append('<option  value=' + barangay[key].barangays_id + '>'+ barangay[key].barangays_name +'</option>');
    //     }
    // });

    $_token = $('meta[name="csrf-token"]').attr('content');
    var muni_id = $('#municipality_current').val();
    $.ajax({
        type:'POST',
        url: "/ajaxBrgy",
        data: {_token: $_token,muni_id:muni_id},
        success: function(data){
            $curBarangay.empty();
            $curBarangay.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
            for( var i = 0; i < data.length; i++){
                $curBarangay.append('<option  value=' + data[i].barangays_id + '>'+ data[i].barangays_name +'</option>');
            }
        }
    });


    $curBarangay.removeClass('is-valid is-invalid');
}
function setNewZoneCur($curZone){
    $('.label-curZone').removeClass('active');
        $curZone.empty();
        $curZone.append('<option selected value="0" hidden disabled></option>');
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
    // $barangay.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
    // $barangay.append('<option id=' + 0 + ' value=' + 0 + ' disabled>Please select Municipality first.</option>');

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
        $('.label-bldg').removeClass('active');
        $('#details').val('');
        $('#details').removeClass('is-valid');
    }else{
        $('.label-curDetail').removeClass('active');
        $('#details_current').val('');
        $('#details_current').removeClass('is-valid');
    }
}

function sendRequest(){
    var formData = new FormData(document.getElementById('citizen-new'));

    formData.set('imgProfile', $('#profilePreview').attr('src'));
    formData.delete('photo');
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
        url: "/postCitizen",
        data: formData,
        cache:false,
        async:false,
        global:false,
        contentType: false,
        processData: false,
        success: function(data){
            if(data == "true"){
                document.getElementById('verifybtn').click();
            }else{
                setTimeout(function() { 
                    $('#modalSpinner').modal('hide');
                }, 1500);
            }
        }
   });



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
    // var value = $("#month");

    if($('#month').val() > 0){
        $('#month').addClass("is-valid");
        $('#month').removeClass("is-invalid");
        return true;
    }else{
        $('#month').addClass("is-invalid");
        $('#month').removeClass("is-valid");
        return false;
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
    // var value = $("#gender");
    if($("#gender option:selected").val() != '0'){
        $("#gender").addClass("is-valid");
        $("#gender").removeClass("is-invalid");
        return true;
    }else{
        $("#gender").addClass("is-invalid");
        $("#gender").removeClass("is-valid");
        return false;
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
            case 'jpg': case 'png': case 'jpeg':
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
    // var value = $('#municipality');
    // if(value.val()==0){
    //     value.addClass("is-invalid");
    //     value.removeClass("is-valid");
    //     return false;
    // }else{
    //     value.addClass("is-valid");
    //     value.removeClass("is-invalid");
    //     return true;
    // }

    if($('#municipality option:selected').val() > 0){
        $('#municipality').addClass("is-valid");
        $('#municipality').removeClass("is-invalid");
        return true;
    }else{
        $('#municipality').addClass("is-invalid");
        $('#municipality').removeClass("is-valid");
        return false;
    }

}
function validBrgy(){
    // var value = $('#barangay');
    // if($('#barangay').val() == '0'){
        // $('#barangay').addClass("is-invalid");
        // $('#barangay').removeClass("is-valid");
        // return false;
    // }else{
        // $('#barangay').addClass("is-valid");
        // $('#barangay').removeClass("is-invalid");
        // return true;
    // }

    if(parseInt($('#barangay option:selected').val()) > 0){
        $('#barangay').addClass("is-valid");
        $('#barangay').removeClass("is-invalid");
        return true;
    }else{
        $('#barangay').addClass("is-invalid");
        $('#barangay').removeClass("is-valid");
        return false;
    }
}
function validZone(){
    // var value = $('#zone');
    // if($('#province').val() == 20){
    //     if($('#municipality').val()  == 361){
    //         if(value.val()== 0){
    //             value.addClass("is-invalid");
    //             value.removeClass("is-valid");
    //             return false;
    //         }else{
    //             value.addClass("is-valid");
    //             value.removeClass("is-invalid");
    //             return true;
    //         }
    //     }else{
    //         if($('#municipality').val() == 0){
    //             value.addClass("is-invalid");
    //             value.removeClass("is-valid");
    //             return false;
    //         }else{
    //             return true;
    //         }
    //     }
    // }else{
    //     if($('#municipality').val() == 0){
    //         if($('#zone').val() == 0){
    //             $('#zone').addClass("is-invalid");
    //             $('#zone').removeClass("is-valid");
    //             return false;
    //         }
    //     }else{
    //         return true;
    //     }
    // }

    // var value = $('#zone');
    if($('#province option:selected').val() == 20){
        if($('#municipality option:selected').val()  == 361){
            if($('#zone option:selected').val()== 0){
                $('#zone').addClass("is-invalid");
                $('#zone').removeClass("is-valid");
                return false;
            }else{
                $('#zone').addClass("is-valid");
                $('#zone').removeClass("is-invalid");
                return true;
            }
        }else{
            if($('#municipality option:selected').val() == 0){
                $('#zone').addClass("is-invalid");
                $('#zone').removeClass("is-valid");
                return false;
            }else{
                return true;
            }
        }
    }else{
        if($('#municipality option:selected').val() == 0){
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
    // var value = $('#municipality_current');
    if($('#municipality_current option:selected').val() > 0){
        $('#municipality_current').addClass("is-valid");
        $('#municipality_current').removeClass("is-invalid");
        return true;
    }else{
        $('#municipality_current').addClass("is-invalid");
        $('#municipality_current').removeClass("is-valid");
        return false;
    }
}
function validBrgyCur(){
    // var value = $('#barangay_current');
    if(parseInt($('#barangay_current option:selected').val()) > 0){
        $('#barangay_current').addClass("is-valid");
        $('#barangay_current').removeClass("is-invalid");
        return true;
    }else{
        $('#barangay_current').addClass("is-invalid");
        $('#barangay_current').removeClass("is-valid");
        return false;
    }
}
function validZoneCur(){
    // var value = $('#zone_current');
    // if($('#province_current').val() == 20){
    //     if($('#municipality_current').val() == 361){
    //         if(value.val()== 0){
    //             value.addClass("is-invalid");
    //             value.removeClass("is-valid");
    //             return false;
    //         }else{
    //             value.addClass("is-valid");
    //             value.removeClass("is-invalid");
    //             return true;     
    //         }
    //     }else{
    //         if($('#municipality_current').val() == 0){
    //             value.addClass("is-invalid");
    //             value.removeClass("is-valid");
    //             return false;
    //         }else{
    //             return true;
    //         }
    //     }
    // }else{
    //     if($('#municipality_current').val() == 0){
    //         if(value.val()== 0){
    //             value.addClass("is-invalid");
    //             value.removeClass("is-valid");
    //             return false;
    //         }
    //     }else{
    //         return true;
    //     }
    // }

    if($('#province_current option:selected').val() == 20){
        if($('#municipality_current option:selected').val() == 361){
            if($('#zone_current option:selected').val()== 0){
                $('#zone_current').addClass("is-invalid");
                $('#zone_current').removeClass("is-valid");
                return false;
            }else{
                $('#zone_current').addClass("is-valid");
                $('#zone_current').removeClass("is-invalid");
                return true;     
            }
        }else{
            if($('#municipality_current option:selected').val() == 0){
                $('#zone_current').addClass("is-invalid");
                $('#zone_current').removeClass("is-valid");
                return false;
            }else{
                return true;
            }
        }
    }else{
        if($('#municipality_current option:selected').val() == 0){
            if($('#zone_current').val()== 0){
                $('#zone_current').addClass("is-invalid");
                $('#zone_current').removeClass("is-valid");
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
    $municipality.append('<option selected value="0" hidden disabled></option>');
    Object.keys(municipality).forEach(function(key) {
        if(municipality[key].province_id == $('#province').val()){
        $municipality.append('<option  value=' + municipality[key].municipalities_id + '>'+ nameTable(municipality[key].municipalities_name) +'</option>');
        }
    });

    var $municipalityCur = $('#municipality_current');
    $municipalityCur.empty();
    $municipalityCur.append('<option selected value="0" hidden disabled></option>');
    Object.keys(municipality).forEach(function(key) {
        if(municipality[key].province_id == $('#province_current').val()){
        $municipalityCur.append('<option  value=' + municipality[key].municipalities_id + '>'+ nameTable(municipality[key].municipalities_name) +'</option>');
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
        if($('#suffix').val() == '0'){
            $('#lblSuffix').addClass("active");
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
function getMuni() {
    $_token = $('meta[name="csrf-token"]').attr('content');
    var address = 'true';
    $.ajax({
        type:'POST',
        url: "/ajaxMuni",
        async:true,
        data: {_token: $_token,address:address},
        success: function(data){
            municipality = data.municipality;
            loadMunicipality();
        }
    });
}
function getZone() {
    $_token = $('meta[name="csrf-token"]').attr('content');
    var address = 'true';
    $.ajax({
        type:'POST',
        url: "/ajaxZone",
        async:true,
        data: {_token: $_token,address:address},
        success: function(data){
            zone = data.zone;
        }
    });
}

function process() {
    const file = document.querySelector("#photo").files[0];
  
    if (!file) return;
  
    const reader = new FileReader();
  
    reader.readAsDataURL(file);
  
    reader.onload = function (event) {
      const imgElement = document.createElement("img");
      imgElement.src = event.target.result;
    //   document.querySelector("#profilePreview").src = event.target.result;
  
      imgElement.onload = function (e) {
        const canvas = document.createElement("canvas");
        const MAX_WIDTH = 500;
  
        const scaleSize = MAX_WIDTH / e.target.width;
        canvas.width = MAX_WIDTH;
        canvas.height = e.target.height * scaleSize;
  
        const ctx = canvas.getContext("2d");
  
        ctx.drawImage(e.target, 0, 0, canvas.width, canvas.height);
  
        const srcEncoded = ctx.canvas.toDataURL(e.target, "image/jpeg");
  
        // you can send srcEncoded to the server
        document.querySelector("#profilePreview").src = srcEncoded;
        // $('#profilePreview').removeClass('d-none');
      };
    };
}
function nameTable(data){
    return data.replace(
        /\w\S*/g,
        function(txt) {
          return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
        }
    );
}