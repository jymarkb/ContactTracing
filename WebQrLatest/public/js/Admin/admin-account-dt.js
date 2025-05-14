var oldData;
$(document).ready(function(){
    dt();

    $("#ac_modal").on('shown.bs.modal', function(){
        document.body.style.overflow = "hidden";
    });
    $("#ac_modal").on('hidden.bs.modal', function(){
        document.body.style.overflow = "scroll";
        resetField();
    });
    $('#update_modal').on('hidden.bs.modal', function () {
        $('#ac_modal').removeClass('hide-modal');
        resetFieldValid();
    });
    $('#update_modal').on('shown.bs.modal', function () {
        $('#ac_modal').addClass('hide-modal');
    });
    $('#change_modal').on('hidden.bs.modal', function () {
        $('#ac_modal').removeClass('hide-modal');
    });

    $('#u_fname').keypress(function (e) {
        keyString(e);
     });
    $('#u_mname').keypress(function (e) {
        keyString(e);
     });
    $('#u_lname').keypress(function (e) {
        keyString(e);
     });
    $('#u_day').keypress(function (e) {
        keyNumber(e);
        if(this.value.length==2){
           return false;
        }
    });
    $('#u_year').keypress(function (e) {
        keyNumber(e);
        if(this.value.length==4){
           return false;
        } 
    });
    $('#u_number').keypress(function (e) {
        keyNumber(e);
        if(this.value.length==11){
           return false;
        } 
    });

    $('#u_fname').on('change',function(){
        validFname();
    });
    $('#u_mname').on('change',function(){
        validMname();
    });
    $('#u_lname').on('change',function(){
        validLname();
    });
    $('#u_suffix').on('change',function(){
        if($('#u_suffix').val() != "0"){
            if(oldData.users_suffix == null){
                $('#u_suffix').addClass('is-valid');
            }else{
                if($('#u_suffix').val() != oldData.users_suffix ){
                    $('#u_suffix').addClass('is-valid');
                }else{
                    $('#u_suffix').removeClass('is-valid');
                }
            }
        }else{
            if(oldData.users_suffix == null){
                $('#u_suffix').removeClass('is-valid');
            }else{
                $('#u_suffix').addClass('is-valid');
            }
        }
    });
    $('#u_gender').on('change', function(){
        validGender();
    });
    $('#u_month').on('change', function(){
        validMonth();
    });
    $('#u_day').on('change', function(){
        validDay();
    });
    $('#u_year').on('change', function(){
        validYear();
    });
    $('#u_number').on('change', function(){
        validMobile();
    });
    $('#u_username').on('change', function(){
        validUsername();
    });
    $('#u_type').on('change', function(){
        if($('#u_type').val() != oldData.types_id){
            $('#u_type').addClass('is-valid');
        }else{
            $('#u_type').removeClass('is-valid');
        }
    });
    $('#ac_update_save').on('click', function(){
        if(!validFname() | !validMname() | !validLname() | !validGender() | !validMonth() | !validDay() | !validYear() | !validMobile() | !validUsername()){
            document.getElementById('scroll-up').click();
            $('#field-toast').toast('show');
        }else{
            $('#u_number').addClass('is-valid');
            $('#u_username').addClass('is-valid');
            $('#u_type').addClass('is-valid');

            if(oldData.types_id != 4){
                if(changeFname() | changeMname() | changeLname() | changeSuffix() | changeGender() | changeMonth() | changeDay() | changeYear() | changeMobile() | changeUsername() | changeType()){
                    setUpdate();
                    $('#update_modal').modal('show');
                }else{
                    document.getElementById('scroll-up').click();
                    $('#change-toast').toast('show');
                    resetFieldValid();
                }
            }else{
                if(changeFname() | changeMname() | changeLname() | changeSuffix() | changeGender() | changeMonth() | changeDay() | changeYear() | changeMobile() | changeType()){
                    setUpdate();
                    $('#update_modal').modal('show');
                }else{
                    document.getElementById('scroll-up').click();
                    $('#change-toast').toast('show');
                    resetFieldValid();
                }
            }
        }
    });
    $('#ac_update_cancel').on('click',function(){
        if(oldData.types_id != 4){
            if(changeFname() | changeMname() | changeLname() | changeSuffix() | changeGender() | changeMonth() | changeDay() | changeYear() | changeMobile() | changeUsername() | changeType()){
                $("#ac_modal").addClass('hide-modal');
                $('#change_modal').modal('show');
            }else{
                resetField();
                $('#ac_modal').modal('toggle');
            }
        }else{
            if(changeFname() | changeMname() | changeLname() | changeSuffix() | changeGender() | changeMonth() | changeDay() | changeYear() | changeMobile() | changeType()){
                $("#ac_modal").addClass('hide-modal');
                $('#change_modal').modal('show');
            }else{
                resetField();
                $('#ac_modal').modal('toggle');
            }
        }
    });
    $('#change_no').on('click',function(){
        $('#change_modal').modal('toggle');
        $('#ac_modal').modal('toggle');
    });
    $('#change_close').on('click',function(){
        $('#change_modal').modal('toggle');
        $('#ac_modal').modal('toggle'); 
    });
    $('#change_yes').on('click', function(){
        if(!validFname() | !validMname() | !validLname() | !validGender() | !validMonth() | !validDay() | !validYear() | !validMobile() | !validUsername()){
            $('#change_modal').modal('toggle');
            document.getElementById('scroll-up').click();
            $('#field-toast').toast('show');
        }else{
            $('#change_modal').modal('toggle');

            $('#u_number').addClass('is-valid');
            $('#u_username').addClass('is-valid');
            $('#u_type').addClass('is-valid');

            if(oldData.types_id != 4){
                if(changeFname() | changeMname() | changeLname() | changeSuffix() | changeGender() | changeMonth() | changeDay() | changeYear() | changeMobile() | changeUsername() | changeType()){
                    setUpdate();
                    $('#update_modal').modal('show');
                }else{
                    setUpdate();
                    $('#update_modal').modal('show');
                }
            }else{
                if(changeFname() | changeMname() | changeLname() | changeSuffix() | changeGender() | changeMonth() | changeDay() | changeYear() | changeMobile() | changeType()){
                    setUpdate();
                    $('#update_modal').modal('show');
                }else{
                    setUpdate();
                    $('#update_modal').modal('show');
                }
            }
        }
    });
    $('#update_data').on('click',function(){
        var formData = new FormData(document.getElementById('acUpdate'));
        formData.append('users_id', oldData.users_id);
        $.ajax({
            type:'POST',
            url: "/admin/account/update",
            data: formData,
            cache:false,
            async:true,
            contentType: false,
            processData: false,
            success: function(data){
                if(data == "exist"){
                    $('#update_modal').modal('toggle');
                    $('#ac_modal').modal('toggle');
                    document.getElementById('scroll-up').click();
                    $('#updateError-toast').toast('show');
                }else{
                    $('#update_modal').modal('toggle');
                    $('#ac_modal').modal('toggle');
                    document.getElementById('scroll-up').click();
                    $('#update-toast').toast('show');
                    dt();
                }
            }
        });
    });
});

function editAccount(id){
    $selected_id = id;
    $_token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "/admin/account/select",
        type:"POST",
        async:true,
        data:{
            select_id:$selected_id,
            _token: $_token
        },
        success:function(data){
            setAccountData(data);
            $('#ac_modal').modal('show');
        }
    });  
}
async function setAccountData(data){
    oldData = data;
    $('#u_fname').val(data.users_fname);
    $('#u_mname').val(data.users_mname);
    $('#u_lname').val(data.users_lname);

    if(data.users_suffix != null){
        $('#u_suffix').val(data.users_suffix);
    }
    $('#u_gender').val(data.users_gender);
    $('#u_month').val(data.users_bday.substr(5,2));
    if(data.users_bday.substr(8,1) != 0){
        $('#u_day').val(data.users_bday.substr(8,2));
    }else{
        $('#u_day').val(data.users_bday.substr(9,1));
    }
    $('#u_year').val(data.users_bday.substr(0,4));
    $('#u_number').val(data.users_mobile);
    $('#u_username').val(data.users_username);
    $('#u_type').val(data.types_id);
    if(data.types_id == 4){
        $('.user-row').addClass('d-none');
        $('#u_type').children('option[value="1"]').css('display','none');
        $('#u_type').children('option[value="2"]').css('display','none');
        $('#u_type').children('option[value="3"]').css('display','none');
        $('#u_type').children('option[value="4"]').css('display','block');
    }else{
        $('.user-row').removeClass('d-none');
        $('#u_type').children('option[value="1"]').css('display','block');
        $('#u_type').children('option[value="2"]').css('display','block');
        $('#u_type').children('option[value="3"]').css('display','block');
        $('#u_type').children('option[value="4"]').css('display','none');
    }
}
function resetField(){
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
    $('#u_type').val(0);
    resetFieldValid();
}
function resetFieldValid(){
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
    $('#u_type').removeClass('is-valid is-invalid');
}
function setUpdate(){
    if(changeFname() || changeMname() || changeLname() || changeSuffix()){
        $('#row-name').removeClass('d-none');
        var sfOld=''; var sfNew='';
        if(oldData.users_suffix != null){
            sfOld = oldData.users_suffix;
        }
        if($('#u_suffix').val() != 0){
            sfNew = $('#u_suffix').val();
        }
        $('#nameOld').text(oldData.users_fname + ' ' + oldData.users_mname + ' ' + oldData.users_lname + ' ' + sfOld);
        $('#nameNew').text($('#u_fname').val() + ' ' + $('#u_mname').val() + ' ' + $('#u_lname').val() + ' ' + sfNew);
    }else{
        $('#row-name').addClass('d-none');
    }
    if(changeMonth() || changeDay() || changeYear()){
        $('#row-bday').removeClass('d-none');
        var m = Array('January', 'February','March', 'April', 'May', 'June', 'July', 'August', ' September', 'October', 'November', 'December');
        var oldM; var oldD; var oldY;

        if(oldData.users_bday.charAt(5) != 0){
            oldM = oldData.users_bday.substr(5,2);
        }else{
            oldM = oldData.users_bday.substr(6,1);
        }
        if(oldData.users_bday.substr(8,1) != 0){
            oldD = oldData.users_bday.substr(8,2);
        }else{
            oldD = oldData.users_bday.substr(9,1);
        }
        oldY = oldData.users_bday.substr(0,4);
        $('#bdayOld').text(m[oldM-1] + ' ' + oldD + ',' + oldY);
        $('#bdayNew').text(m[$('#u_month').val() -1] + ' ' + $('#u_day').val() + ', ' + $('#u_year').val());
    }else{
        $('#row-bday').addClass('d-none');
    }
    if(changeGender()){
        $('#row-gender').removeClass('d-none');
        $('#genderOld').text(oldData.users_gender);
        $('#genderNew').text($('#u_gender').val());
    }else{
        $('#row-gender').addClass('d-none');
    }
    if(changeMobile()){
        $('#row-mobile').removeClass('d-none');
        $('#mobileOld').text(oldData.users_mobile);
        $('#mobileNew').text($('#u_number').val());

    }else{
        $('#row-mobile').addClass('d-none');
    }
    if(changeUsername()){
        $('#row-username').removeClass('d-none');
        $('#usernameOld').text(oldData.users_username);
        $('#usernameNew').text($('#u_username').val());
    }else{
        $('#row-username').addClass('d-none');
    }
    if(changeType()){
        var t = Array('Admin', 'Misu','Contact Tracer');
        $('#row-type').removeClass('d-none');
        $('#typeOld').text(t[oldData.types_id - 1]);
        $('#typeNew').text(t[$('#u_type').val() - 1]);
    }else{
        $('#row-type').addClass('d-none');
    }
}

function viewAccount(id){
    $selected_id = id;
    $_token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "/admin/account/select",
        type:"POST",
        async:true,
        data:{
            select_id:$selected_id,
            _token: $_token
        },
        success:function(data){
            setViewAccount(data);
            $('#view_modal').modal('show');
        }
    });  
}
function setViewAccount(data){
    if(data.users_profile != null){
        document.getElementById("v_profile").src = "/storage/profiles/"+data.users_profile;
    }else{
        document.getElementById("v_profile").src = "/storage/profiles/noprofile.png";
    }
    
    if(data.users_username != null){
        $('#v_username').text(data.users_username);
    }else{
        $('#v_username').text("n/a");
    }
    if(data.types_id == 4){
        $('#v_lblCompany').removeClass('d-none');
        $('#v_company').removeClass('d-none');
        $('#v_type').text("Establishment");
        $('#v_company').text(data.get_company.establishments_name);
    }else{
        $('#v_lblCompany').addClass('d-none');
        $('#v_company').addClass('d-none');
        switch(data.types_id){
            case 1:
                $('#v_type').text("Admin");
            break;
            case 2:
                $('#v_type').text("Misu");
            break;
            case 3:
                $('#v_type').text("Contact Tracer");
            break;
        }
    }
    if(data.users_suffix != null){
        $('#v_name').text(nameTable(data.users_fname + ' ' + data.users_mname + ' ' + data.users_lname) + ' ' + data.users_suffix);  
    }else{
        $('#v_name').text(nameTable(data.users_fname + ' ' + data.users_mname + ' ' + data.users_lname));
    }
    $('#v_gender').text(data.users_gender);

    var newD = new Date();
    var year = newD.getFullYear();
    $('#v_age').text(year - data.users_bday.substr(0,4));

    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    $('#v_bday').text(months[parseInt(data.users_bday.substr(5,2))-1] + ' '+ parseInt(data.users_bday.substr(8,2)) +', ' + data.users_bday.substr(0,4));

    $('#v_number').text("+63"+data.users_mobile.substr(1,10));
}

function validFname(){
    if($('#u_fname').val() == ''){
        $('#u_fname').addClass('is-invalid');
        $('#u_fname').removeClass('is-valid');
        return false;
    }else{
        $('#u_fname').removeClass('is-invalid');
        $('#u_fname').addClass('is-valid');
        return true;
    }
}
function validMname(){
    if($('#u_mname').val() == ''){
        $('#u_mname').addClass('is-invalid');
        $('#u_mname').removeClass('is-valid');
        return false;
    }else{
        $('#u_mname').removeClass('is-invalid');
        $('#u_mname').addClass('is-valid'); 
        return true;
    }
}
function validLname(){
    if($('#u_lname').val() == ''){
        $('#u_lname').addClass('is-invalid');
        $('#u_lname').removeClass('is-valid');
        return false;
    }else{
        $('#u_lname').removeClass('is-invalid');
        $('#u_lname').addClass('is-valid');
        return true;
    }
}
function validGender(){
    if($('#u_gender').val()==0){
        $('#u_gender').addClass("is-invalid");
        $('#u_gender').removeClass("is-valid");
        return false;
    }else{
        $('#u_gender').removeClass("is-invalid");
        $('#u_gender').addClass("is-valid");
        return true;
    }
}
function validMonth(){
    if($('#u_month').val()==0){
        $('#u_month').addClass("is-invalid");
        $('#u_month').removeClass("is-valid");
        return false;
    }else{
        $('#u_month').removeClass("is-invalid");
        $('#u_month').addClass("is-valid");
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
            $('#u_day').removeClass("is-invalid");
            $('#u_day').addClass("is-valid");
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
            $('#u_year').removeClass("is-invalid");
            $('#u_year').addClass("is-valid");
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
                            if($('#u_number').val() != oldData.users_mobile){
                                $('#u_number').addClass("is-invalid");
                                $('#u_number').removeClass("is-valid");
                                $('#validMobileA').addClass('d-none');
                                $('#validMobileB').removeClass('d-none');
                                return false;
                            }else{
                                $('#u_number').removeClass("is-invalid");
                                return true;
                            }
                        }else{
                            if($('#u_number').val() != oldData.users_mobile){
                                $('#u_number').removeClass("is-invalid");
                                $('#u_number').addClass('is-valid');
                            }else{
                                $('#u_number').removeClass("is-invalid");
                            }
                            return true
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
                    if($('#u_username').val() != oldData.users_username){
                        $('#u_username').addClass("is-invalid");
                        $('#u_username').removeClass("is-valid");
                        $('#userA').addClass('d-none');
                        $('#userB').removeClass('d-none');
                        return false;
                    }else{
                        $('#u_username').removeClass("is-invalid");
                        return true;
                    }
                }else{
                    $('#u_username').removeClass("is-invalid");
                    $('#u_username').addClass("is-valid");
                    return true;
                }
            }
        });
    }
}
function changeFname(){
    if(oldData.users_fname != $('#u_fname').val())
        return true;
    else   
        return false;
}
function changeMname(){
    if(oldData.users_mname != $('#u_mname').val())
        return true;
    else
        return false;
}
function changeLname(){
    if(oldData.users_lname != $('#u_lname').val())
        return true;
    else
        return false;
}
function changeSuffix(){
    if($('#u_suffix').val() == 0){
        if(oldData.users_suffix != null)
            return true;
        else
            return false;
    }else{
        if(oldData.users_suffix != $('#u_suffix').val())
            return true;
        else
            return false;
    }
}
function changeGender(){
    if(oldData.users_gender != $('#u_gender').val())
        return true;
    else
        return false;  
}
function changeMonth(){
    if(oldData.users_bday.substr(5,2) != $('#u_month').val())
        return true;
    else
        return false;
}
function changeDay(){
    if($('#u_day').val() > 0){
        if($('#u_day').val() <10){
            if(oldData.users_bday.substr(8,1) == 0){
                if(oldData.users_bday.substr(9,1) != $('#u_day').val())
                    return true;
                else
                    return false;
            }else{
                if(oldData.users_bday.substr(8,2) != $('#u_day').val())
                    return true;
                else
                    return false;
            }
        }else{
            if(oldData.users_bday.substr(8,1) == 0){
                return true;
            }else{
                if(oldData.users_bday.substr(8,2) != $('#u_day').val())
                    return true;
                else
                    return false;
            }
        }
    }
}
function changeYear(){
    if(oldData.users_bday.substr(0,4) != $('#u_year').val())
        return true;
    else
        return false;
}
function changeMobile(){
    if(oldData.users_mobile != $('#u_number').val())
        return true;
    else
        return false;
}
function changeUsername(){
    if(oldData.users_username != $('#u_username').val())
        return true;
    else
        return false
}
function changeType(){
    if(oldData.types_id != $('#u_type').val())
        return true;
    else
        return false;
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
    $("#user_info").DataTable({
        responsive:true,
        "language": {
            "search": "Search here : ",
            searchPlaceholder:  "Search for... (e.g Juan)",
            "processing": "Please wait processing ..."
        },
        pagingType: "simple",
        fnDrawCallback: function(oSettings) {
            if($('#user_info').DataTable().page.info().recordsTotal > 10){
                $('.dataTables_paginate').show();
            }else{
                if($('#user_info').DataTable().page.info().end > 10){
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
            url:"/account/admin-table",
        },
        columns:[
            {data: "id",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data:"users_fname", name:"users_fname"},
            {data:"users_mname", name:"users_mname"},
            {data:"users_lname", name:"users_lname"},
            {data:"users_suffix", name:"users_suffix"},
            {data:"users_gender", name:"users_gender"},
            {data:"users_bday", name:"user_bday"},
            {data:"users_mobile", name:"users_mobile"},
            {data:"users_username", name:"users_username"},
            {data:"type.types_id", name:"type.types_id"},
            {data:"users_id", name:"action"},
        ],
        columnDefs:[
            { className: "dt-center" , "width": "3%", searchable:false, "targets": [ 0 ] },
            {
                targets: [1],
                "orderable": true, className: "dt-nowrap",
                render: function(data, type, row ){
                    if(row.users_suffix != null){
                        return nameTable(data + ' ' +row.users_mname + ' ' + row.users_lname )+ ' ' + row.users_suffix ;
                    }else{
                        return nameTable(data + ' ' +row.users_mname + ' ' + row.users_lname );
                    }
                   
                }
            },
            {
                targets: [2,3,4],"orderable": false, "visible": false, "searchable": false
            },
            {
                targets:[6],
                render:function(data, type, row){
                    var newD = new Date();
                    var year = newD.getFullYear();
                    return (year - (data.substr(0,4)));
                }
            },
            {
                targets:[7],
                render:function(data, type, row){
                    return "+63"+ data.substr(1,10);
                }
            },
            {
                targets:[8],
                render:function(data, type, row){
                    if(data == null){
                        return "N/A";
                    }else{
                        return data;
                    }
                }
            },
            {
                targets:[9],
                render:function(data, type, row){
                    switch(data){
                        case 1:
                            return "Admin";
                        case 2:
                            return "Misu";
                        case 3:
                            return "Contact Tracer";
                        case 4:
                            return "Establishment";
                    }
                }
            },
            {
                targets:[10],className: "dt-center", orderable:false, "width": "5%",
                render:function(data, type, row){
                    return '<div class="dropdown"> <button class="btn  btn-sm btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-tools"></i> </button> <div class="dropdown-menu tableActionMenu" aria-labelledby="dropdownMenuButton"><a class="dropdown-item edit-btn" id="'+ data + '" onClick="editAccount(this.id);"><i class="fa fa-edit"></i> Edit</a><a class="dropdown-item view-btn" id="'+ data + '" onClick="viewAccount(this.id);"><i class="fa fa-eye"></i> View</a></div></div>'
                }
            },


        ]

    });
}
$(window).resize(function() {
    $('#user_info').DataTable().columns.adjust().draw();
});
function nameTable(data){
    return data.replace(
        /\w\S*/g,
        function(txt) {
          return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
        }
    );
}