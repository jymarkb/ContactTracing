var barangay; var zone; var oldData; var viewID;
$(document).ready(function(){
    
    dt();
    getAddress();

    $("#es_modal").on('shown.bs.modal', function(){
        document.body.style.overflow = "hidden";
    });
    $("#es_modal").on('hidden.bs.modal', function(){
        document.body.style.overflow = "scroll";
    });
    $('.cls-update-modal').click(function(){
        $('#modal-citizen').removeClass('hide-modal');
        resetFieldValid();
    });
    $('#update_modal').on('hidden.bs.modal', function () {
        $('#modal-es').removeClass('hide-modal');
        resetFieldValid();
    });
    $('#update_modal').on('shown.bs.modal', function () {
        $('#modal-es').addClass('hide-modal');
    });
    $('#change_modal').on('hidden.bs.modal', function () {
        $('#modal-es').removeClass('hide-modal');
    });
    $('#change_modal').on('shown.bs.modal', function () {
        $('#modal-es').addClass('hide-modal');
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
        keyNumber(e);
        if(this.value.length==2){
           return false;
        }
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

    $('#es_fname').change(function(){
        validFname();
    });
    $('#es_mname').change(function(){
        validMname();
    });
    $('#es_lname').change(function(){
        validLname(); 
    });
    $('#es_gender').change(function(){
        if($('#es_gender').val()==0){
            $('#es_gender').addClass("is-invalid");
            $('#es_gender').removeClass("is-valid");
        }else{
            $('#es_gender').addClass("is-valid");
            $('#es_gender').removeClass("is-invalid");
        }
    });
    $('#es_month').change(function(){
        if($('#es_month').val()==0){
            $('#es_month').addClass("is-invalid");
            $('#es_month').removeClass("is-valid");
        }else{
            $('#es_month').addClass("is-valid");
            $('#es_month').removeClass("is-invalid");
        }
    });
    $('#es_day').change(function(){
        validDay();
    });
    $('#es_year').change(function(){
        validYear();
    });
    $('#es_number').change(function(){
        validMobile();
    });
    $('#es_company').change(function(){
        validCompany();
    });
    $('#es_permit').change(function(){
        validPermit();
    });
    $('#es_brgy').change(function(){
        if($('#es_brgy').val() > 0){
            $('#es_brgy').removeClass('is-invalid');
            $('#es_brgy').addClass('is-valid');
            $('#es_zone').empty();
            $('#es_zone').append('<option value=' + 0 + ' selected hidden>Please Select Zone</option>');
            Object.keys(zone).forEach(function(key) {
                if(zone[key].barangays_id == $('#es_brgy').val()){
                    $('#es_zone').append('<option  value=' + zone[key].zones_id + '>'+ zone[key].zones_name +'</option>');
                }
            });
            $('#es_zone').removeClass('is-invalid');
            $('#es_zone').removeClass('is-valid');
            $('#es_details').val('');
        }   
    });
    $('#es_zone').change(function(){
        validZone();
    })
    $('#es_update_save').on('click', function(){
        if(!validFname() | !validMname() | !validLname() | !validDay() | !validYear() | !validMobile() | !validCompany() | !validPermit() | !validZone()){
            document.getElementById('scroll-up').click();
            $('#field-toast').toast('show');
        }else{
            $('#es_month').addClass('is-valid');
            $('#es_gender').addClass('is-valid');
            $('#es_brgy').addClass('is-valid');
            
            if(changeFname()| changeMname() | changeLname() | changeSuffix() | changeMonth() | changeDay() | changeYear() | changeGender() | changeMobile() | changeCompany() | changePermit() | changeBrgy() | changeZone() | changeDetails()){
                setUpdateData();
                $('#update_modal').modal('show');
            }else{
                document.getElementById('scroll-up').click();
                $('#change-toast').toast('show');
                resetFieldValid();
            }
            
        }
    });
    $('#es_update_cancel').on('click', function(){
        if(changeFname()| changeMname() | changeLname() | changeSuffix() | changeMonth() | changeDay() | changeYear() | changeGender() | changeMobile() | changeCompany() | changePermit() | changeBrgy() | changeZone() | changeDetails()){
            $('#change_modal').modal('show');
        }else{
            resetField();
            resetFieldValid();
            $('#es_modal').modal('toggle');
        }
    });
    $('#change_close').on('click',function(){
        resetField();
        resetFieldValid();
        $('#es_modal').modal('toggle');
        $('#change_modal').modal('toggle');
    });
    $('#change_no').on('click',function(){
        resetField();
        resetFieldValid();
        $('#es_modal').modal('toggle');
        $('#change_modal').modal('toggle');
    });
    $('#change_yes').on('click', function(){
        if(!validFname() | !validMname() | !validLname() | !validDay() | !validYear() | !validMobile() | !validCompany() | !validPermit() | !validZone()){
            $('#change_modal').modal('toggle');
            document.getElementById('scroll-up').click();
            $('#field-toast').toast('show');
        }else{
            $('#es_month').addClass('is-valid');
            $('#es_gender').addClass('is-valid');
            $('#es_brgy').addClass('is-valid');
            if(changeFname()| changeMname() | changeLname() | changeSuffix() | changeMonth() | changeDay() | changeYear() | changeGender() | changeMobile() | changeCompany() | changePermit() | changeBrgy() | changeZone() | changeDetails()){
                $('#change_modal').modal('toggle');
                setUpdateData();
                $('#update_modal').modal('show');
            }else{
                resetField();
                resetFieldValid();
                $('#es_modal').modal('toggle');
            }
            
        }
    });
    $('#update_data').on('click', function(){
        var formData = new FormData(document.getElementById('esUpdate'));
        formData.append('es_id', oldData.establishments_id);
        formData.append('esUser_id', oldData.establishment_to_user.users_id);
        $.ajax({
            type:'POST',
            url: "/admin/es/update",
            data: formData,
            cache:false,
            async:true,
            contentType: false,
            processData: false,
            success: function(data){
                if(data == "exist"){
                    $('#update_modal').modal('toggle');
                    document.getElementById('scroll-up').click();
                    $('#updateError-toast').toast('show');
                }else{
                    $('#update_modal').modal('toggle');
                    $('#es_modal').modal('toggle');
                    document.getElementById('scroll-up').click();
                    $('#update-toast').toast('show');
                    dt();
                }
            }
        });
    });

    $('#ves_edit').on('click', function() {
        $('#view_modal').modal('toggle');
        editES(viewID);
    });
});

function editES(id){
    $selected_id = id;
    $_token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "/admin/es/select",
        type:"POST",
        async:true,
        data:{
            select_id:$selected_id,
            _token: $_token
        },
        success:function(data){
            setESdata(data);
            $('#es_modal').modal('show');
        }
    });   
}
async function setESdata(data){
    oldData = data;
    $('#es_fname').val(data.establishment_to_user.users_fname);
    $('#es_mname').val(data.establishment_to_user.users_mname);
    $('#es_lname').val(data.establishment_to_user.users_lname);
    if(data.establishment_to_user.users_suffix != null){
        $('#es_suffix').val(data.establishment_to_user.users_suffix);
    }else{
        $('#es_suffix').val(0);
    }
    $('#es_month').val(data.establishment_to_user.users_bday.substr(5,2));
    if(data.establishment_to_user.users_bday.substr(8,1) != 0){
        $('#es_day').val(data.establishment_to_user.users_bday.substr(8,2));
    }else{
        $('#es_day').val(data.establishment_to_user.users_bday.substr(9,1));
    }
    $('#es_year').val(data.establishment_to_user.users_bday.substr(0,4));
    $('#es_gender').val(data.establishment_to_user.users_gender);
    $('#es_number').val(data.establishment_to_user.users_mobile);

    $('#es_company').val(data.establishments_name);
    $('#es_permit').val(data.establishments_permit);
    $('#es_brgy').val(data.get_brgy.barangays_id);

    $('#es_zone').empty();
    Object.keys(zone).forEach(function(key) {
        if(zone[key].barangays_id == $('#es_brgy').val()){
            $('#es_zone').append('<option  value=' + zone[key].zones_id + '>'+ zone[key].zones_name +'</option>');
        }
    });
    $('#es_zone').val(data.get_zone.zones_id);
    if(data.establishments_add_address != null){
        $('#es_bldg').val(data.establishments_add_address);
    } 
}
function resetField(){
    $('#es_fname').val('');
    $('#es_mname').val('');
    $('#es_lname').val('');
    $('#es_suffix').val('0');
    $('#es_day').val('');
    $('#es_year').val('');
    $('#es_number').val('');

    $('#es_company').val('');
    $('#es_permit').val('');
    $('#es_zone').empty();
    $('#es_bldg').val('');
}
function resetFieldValid(){
    $('#es_fname').removeClass('is-invalid is-valid');
    $('#es_mname').removeClass('is-invalid is-valid');
    $('#es_lname').removeClass('is-invalid is-valid');
    $('#es_month').removeClass('is-invalid is-valid');
    $('#es_day').removeClass('is-invalid is-valid');
    $('#es_year').removeClass('is-invalid is-valid');
    $('#es_gender').removeClass('is-invalid is-valid');
    $('#es_number').removeClass('is-invalid is-valid');
    $('#es_company').removeClass('is-invalid is-valid');
    $('#es_permit').removeClass('is-invalid is-valid');
    $('#es_brgy').removeClass('is-invalid is-valid');
    $('#es_zone').removeClass('is-invalid is-valid');
}
function setUpdateData(){
    if(changeFname() || changeMname() || changeLname() || changeSuffix()){
        $('#row-name').removeClass('d-none');
        var sfOld=''; var sfNew='';
        if(oldData.establishment_to_user.users_suffix != null){
            sfOld = oldData.establishment_to_user.users_suffix;
        }
        if($('#es_suffix').val() != 0){
            sfNew = $('#es_suffix').val();
        }
        $('#nameOld').text(oldData.establishment_to_user.users_fname + ' ' + oldData.establishment_to_user.users_mname + ' ' + oldData.establishment_to_user.users_lname + ' ' + sfOld);
        $('#nameNew').text($('#es_fname').val() + ' ' + $('#es_mname').val() + ' ' + $('#es_lname').val() + ' ' + sfNew);
    }else{
        $('#row-name').addClass('d-none');
    }
    if(changeMonth() || changeDay() || changeYear()){
        $('#row-bday').removeClass('d-none');
        var m = Array('January', 'February','March', 'April', 'May', 'June', 'July', 'August', ' September', 'October', 'November', 'December');
        var oldM; var oldD; var oldY;

        if(oldData.establishment_to_user.users_bday.charAt(5) != 0){
            oldM = oldData.establishment_to_user.users_bday.substr(5,2);
        }else{
            oldM = oldData.establishment_to_user.users_bday.substr(6,1);
        }

        if(oldData.establishment_to_user.users_bday.substr(8,1) != 0){
            oldD = oldData.establishment_to_user.users_bday.substr(8,2);
        }else{
            oldD = oldData.establishment_to_user.users_bday.substr(9,1);
        }

        oldY = oldData.establishment_to_user.users_bday.substr(0,4);

        $('#bdayOld').text(m[oldM-1] + ' ' + oldD + ',' + oldY);
        $('#bdayNew').text(m[$('#es_month').val() -1] + ' ' + $('#es_day').val() + ', ' + $('#es_year').val());
    }else{
        $('#row-bday').addClass('d-none');
    }
    if(changeGender()){
        $('#row-gender').removeClass('d-none');
        $('#genderOld').text(oldData.establishment_to_user.users_gender);
        $('#genderNew').text($('#es_gender').val());
    }else{
        $('#row-gender').addClass('d-none');
    }
    if(changeMobile()){
        $('#row-mobile').removeClass('d-none');
        $('#mobileOld').text(oldData.establishment_to_user.users_mobile);
        $('#mobileNew').text($('#es_number').val());

    }else{
        $('#row-mobile').addClass('d-none');
    }
    if(changeCompany()){
        $('#row-company').removeClass('d-none');
        $('#companyOld').text(oldData.establishments_name);
        $('#companyNew').text($('#es_company').val());
    }else{
        $('#row-company').addClass('d-none');
    }
    if(changePermit()){
        $('#row-permit').removeClass('d-none');
        $('#permitOld').text(oldData.establishments_permit);
        $('#permitNew').text($('#es_permit').val());
    }else{
        $('#row-permit').addClass('d-none');
    }
    if(changeBrgy() || changeZone() || changeDetails()){
        $('#row-address').removeClass('d-none');
        var aOld=''; var aNew='';

        if(oldData.establishments_add_address != null){
            aOld = aOld + ', ';
        }
        if($('#es_bldg').val() != ''){
            aNew = $('#es_bldg').val() + ', ';
        }
        aOld += oldData.get_zone.zones_name + ', ';
        aOld += oldData.get_brgy.barangays_name + ', Libmanan, Camaries Sur';
        Object.keys(zone).forEach(function(key) {
            if(zone[key].zones_id == $('#es_zone').val()){
                aNew += zone[key].zones_name + ', ';
            }
        });
        Object.keys(barangay).forEach(function(key) {
            if(barangay[key].barangays_id  == $('#es_brgy').val()){
                aNew += barangay[key].barangays_name + ', Libmanan, Camaries Sur';
            }
        });
        $('#addressOld').text(aOld);
        $('#addressNew').text(aNew)
    }else{
        $('#row-address').addClass('d-none');
    }
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
function validDay(){
    if($('#es_day').val()==""){
        $('#es_day').addClass("is-invalid");
        $('#es_day').removeClass("is-valid");
        return false;
    }else{
        if($('#es_day').val() > 31 || $('#es_day').val() == 0){
            $('#es_day').addClass("is-invalid");
            $('#es_day').removeClass("is-valid");
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
                            if($('#es_number').val() != oldData.establishment_to_user.users_mobile){
                                $('#es_number').addClass("is-invalid");
                                $('#es_number').removeClass("is-valid");
                                $('#validMobileA').addClass('d-none');
                                $('#validMobileB').removeClass('d-none');
                                return false;
                            }else{
                                $('#es_number').removeClass("is-invalid");
                                return true;
                            }
                        }else{
                            $('#es_number').removeClass("is-invalid");
                            $('#es_number').addClass('is-valid');
                            return true
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

function viewES(id) {
    viewID = id;
    $selected_id = id;
    $_token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "/admin/es/view",
        type:"POST",
        async:false,
        data:{
            select_id:$selected_id,
            _token: $_token
        },
        success:function(data){
            setViewData(data);
            $('#view_modal').modal('show');
        }
    }); 
}
function setViewData(data) {
    $('#ves_esname').text(nameTable(data.establishments_name));
    $('#ves_permit').text(data.establishments_name);
    var address;
    if(data.establishments_add_address != null){
        address = nameTable(data.establishments_add_address);
    }
    address += data.get_zone.zones_name + ", " + data.get_brgy.barangays_name + ", Libmanan, Camarines Sur";
    $('#ves_address').text(address);
    
    var name;
    if(data.establishment_to_user.users_suffix != null){
        name = nameTable(data.establishment_to_user.users_fname) + " " + nameTable(data.establishment_to_user.users_mname) + " " + nameTable(data.establishment_to_user.users_lname) + " " + data.establishment_to_user.users_suffix;
    }else{
        name = nameTable(data.establishment_to_user.users_fname) + " " + nameTable(data.establishment_to_user.users_mname) + " " + nameTable(data.establishment_to_user.users_lname);
    }
    $('#ves_owname').text(name);
    $('#ves_gender').text(data.establishment_to_user.users_gender);

    var newD = new Date();
    var year = newD.getFullYear();
    var age = (year - (data.establishment_to_user.users_bday.substr(0,4)));
    $('#ves_age').text(age);

    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    $('#ves_bday').text(months[parseInt(data.establishment_to_user.users_bday.substr(5,2))-1] + ' '+ parseInt(data.establishment_to_user.users_bday.substr(8,2)) +', ' + data.establishment_to_user.users_bday.substr(0,4));

    $('#ves_mobile').text("+63"+data.establishment_to_user.users_mobile.substr(1,10));

    if(data.establishment_to_user.users_username != null){
        $('#ves_username').text(data.establishment_to_user.users_username);
    }else{
        $('#ves_username').text('N/A');
    }

    if(data.establishments_pin != null){
        $('#ves_pin').text(data.establishments_pin);
    }else{
        $('#ves_pin').text('N/A');
    }
    $('#ves_type').text(data.establishment_to_user.type.types_description);
}

function changeFname(){
    if(oldData.establishment_to_user.users_fname != $('#es_fname').val())
        return true;
    else
        return false;
}
function changeMname(){
    if(oldData.establishment_to_user.users_mname != $('#es_mname').val())
        return true;
    else
        return false;
}
function changeLname(){
    if(oldData.establishment_to_user.users_lname != $('#es_lname').val())
        return true;
    else
        return false;
}
function changeSuffix(){
    if($('#es_suffix').val() == 0){
        if(oldData.establishment_to_user.users_suffix != null)
            return true;
        else
            return false;
    }else{
        if(oldData.establishment_to_user.users_suffix != $('#es_suffix').val())
            return true;
        else
            return false;
    }
}
function changeMonth(){
    if(oldData.establishment_to_user.users_bday.substr(5,2) != $('#es_month').val()){
        return true;
    }
    return false;
}
function changeDay(){
    if($('#es_day').val() > 0){
        if($('#es_day').val() <10){
            if(oldData.establishment_to_user.users_bday.substr(8,1) == 0){
                if(oldData.establishment_to_user.users_bday.substr(9,1) != $('#es_day').val())
                    return true;
                else
                    return false
            }else{
                if(oldData.establishment_to_user.users_bday.substr(8,2) != $('#es_day').val())
                    return true;
                else
                    return false;
            }
        }else{
            if(oldData.establishment_to_user.users_bday.substr(8,1) == 0){
                return true;
            }else{
                if(oldData.establishment_to_user.users_bday.substr(8,2) != $('#es_day').val())
                    return true
                else
                    return false;
            }
        }
    }
    return false;
}
function changeYear(){
    if(oldData.establishment_to_user.users_bday.substr(0,4) != $('#es_year').val())
        return true;
    else
        return false;
}
function changeGender(){
    if(oldData.establishment_to_user.users_gender != $('#es_gender').val())
        return true;
    else
        return false;
}
function changeMobile(){
    if(oldData.establishment_to_user.users_mobile != $('#es_number').val())
        return true;
    else
        return false;
}
function changeCompany(){
    if(oldData.establishments_name != $('#es_company').val())
        return true;
    else
        return false;
}
function changePermit(){
    if(oldData.establishments_permit != $('#es_permit').val())
        return true;
    else
        return false;
}
function changeBrgy(){
    if(oldData.get_brgy.barangays_id != $('#es_brgy').val())
        return true;
    else
        return false;
}
function changeZone(){
    if(oldData.get_zone.zones_id != $('#es_zone').val())
        return true;
    else
        return false;
}
function changeDetails(){
    if(oldData.establishments_add_address != null){
        if(oldData.establishments_add_address != $('#es_bldg').val())
            return true;
        else
            return false;
    }
    return false;
}
$(window).resize(function() {
    $('#establishment_info').DataTable().columns.adjust().draw();
});
function getAddress(){
    $_token = $('meta[name="csrf-token"]').attr('content');
    var address = 'true';
    $.ajax({
        type:'POST',
        url: "/ajaxGetAddress",
        data: {_token: $_token,address:address},
        success: function(data){
            barangay = data.barangay;
            zone = data.zone;
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
function dt(){
    $("#establishment_info").DataTable({
        responsive:true,
        "language": {
            "search": "Search here : ",
            searchPlaceholder:  "Search for... (e.g Juan)",
            "processing": "Please wait processing ..."
        },
        pagingType: "simple",
        fnDrawCallback: function(oSettings) {
            if($('#establishment_info').DataTable().page.info().recordsTotal > 10){
                $('.dataTables_paginate').show();
            }else{
                if($('#establishment_info').DataTable().page.info().end > 10){
                    $('.dataTables_paginate').show();
                }else{
                    $('.dataTables_paginate').hide();
                }
            }
        },
        destroy: true,
        stateSave: false,
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
        ajax:{
            url:"/admin/es/getESinfo",
        },
        columns:[
            {data: "id",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data:"establishments_name", name:"establishment_to_user.users_fname"},
            {data:"establishment_to_user.users_fname", name:"establishment_to_user.users_fname"},
            {data:"establishment_to_user.users_mname", name:"establishment_to_user.users_mname"},
            {data:"establishment_to_user.users_lname", name:"establishment_to_user.users_lname"},
            {data:"establishment_to_user.users_suffix", name:"establishment_to_user.users_suffix"},
            {data:"establishments_permit", name:"establishments_permit"},
            {data:"get_brgy.barangays_name", name:"establishments_name1"},
            {data:"get_zone.zones_name", name:"establishments_name2"},
            {data:"establishments_pin", name:"establishments_pin"},
            {data:"establishments_id",
                render: function(data, row, type){
                    return "<div class='dropdown mt-1 mt-xl-0'><button class='btn  btn-sm btn-outline-dark dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fa fa-tools'></i></button><div class='dropdown-menu tableActionMenu' aria-labelledby='dropdownMenuButton'><a class='dropdown-item edit-btn' id='" + data + "' onClick='editES(this.id);'><i class='fa fa-edit'></i> Edit</a><a class='dropdown-item view-btn' id='" + data + "' onClick='viewES(this.id);'><i class='fa fa-eye'></i> View</a></div></div>";
                }
            }
        ],
        columnDefs:[
            { className: "dt-center" , "width": "3%", searchable:false, "targets": [ 0 ] },
            { className: "text-capitalize dt-nowrap", "width": "15%", "targets": [ 1 ] },
            {
                targets: [2],
                "orderable": true, className: "dt-nowrap", "width": "18%",
                render: function(data, type, row ){
                    if(row.establishment_to_user.users_suffix != null){
                        return nameTable(data + ' ' +row.establishment_to_user.users_mname + ' ' + row.establishment_to_user.users_lname )+ ' ' + row.establishment_to_user.users_suffix ;
                    }else{
                        return nameTable(data + ' ' +row.establishment_to_user.users_mname + ' ' + row.establishment_to_user.users_lname );
                    }
                   
                }
            },
            {
                targets: [3,4,5,8],"orderable": false, "visible": false, "searchable": false
            },
            {
                targets: [6], className: "dt-nowrap", "width": "10%",
            },
            {
                targets: [7], className: "text-capitalize dt-nowrap",
                render: function(data, type, row ){
                    if(row.establishments_add_address != null){
                        return row.establishments_add_address +', ' + data +', ' + row.get_zone.zones_name + ' Libmanan, Camarines Sur';
                    }else{
                        return data +', ' + row.get_zone.zones_name + ' Libmanan, Camarines Sur';
                    }
                }
            },
            {
                targets: [9], className: "dt-nowrap", "width": "10%","orderable": false,"searchable": false,
                render: function(data, type, row ){
                    if(data == null){
                        return 'not set';
                    }else{
                        return data;
                    }
                }
            },
            {
                targets: [10],"searchable": false, className: "dt-center", "width": "5%", orderable:false
            },
        ]

    });
}
function nameTable(data){
    return data.replace(
        /\w\S*/g,
        function(txt) {
          return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
        }
    );
}