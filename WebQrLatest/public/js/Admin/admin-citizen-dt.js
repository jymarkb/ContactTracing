var province;var municipality;var barangay;var zone; 
var oldData; var view_id;
$(document).ready(function(){
    dt();
    getAddress();

    var i_muni = $('#edt_per_municipality');
    var i_brgy = $('#edt_per_barangay');
    var i_zone = $('#edt_per_zone');
    var i_zonef = $('#edt_per_zone_field');
    var i_bldg = $('#edt_per_bldg');

    var i_muniCur = $('#edt_cur_municipality');
    var i_brgyCur = $('#edt_cur_barangay');
    var i_zoneCur = $('#edt_cur_zone');
    var i_zonefCur = $('#edt_cur_zone_field');
    var i_bldgCur = $('#edt_cur_bldg');

    var i_provFilter = $('#per_province');
    var i_muniFilter = $('#per_municipality');
    var i_brgyFilter = $('#per_barangay');
    var i_zoneFilter = $('#per_zone');

    var i_provFilterC = $('#cur_province');
    var i_muniFilterC = $('#cur_municipality');
    var i_brgyFilterC = $('#cur_barangay');
    var i_zoneFilterC = $('#cur_zone');

    $("#citizens_modal").on('shown.bs.modal', function(){
        document.body.style.overflow = "hidden";
    });
    $("#citizens_modal").on('hidden.bs.modal', function(){
        resetField();
        document.body.style.overflow = "scroll";
    });
    $('.cls-update-modal').click(function(){
        $('#modal-citizen').removeClass('hide-modal');
    });
    $('#update_modal').on('hidden.bs.modal', function () {
        $('#modal-citizen').removeClass('hide-modal');
        resetFieldValid();
    });
    $('#update_modal').on('shown.bs.modal', function () {
        $('#modal-citizen').addClass('hide-modal');
    });
    $('#change_modal').on('hidden.bs.modal', function () {
        $('#modal-citizen').removeClass('hide-modal');
    });
    $('#change_modal').on('shown.bs.modal', function () {
        $('#modal-citizen').addClass('hide-modal');
    });

    $('#per_province').change(function(){
        if($('#per_province').val() > 0){
            i_muniFilter.empty();
            i_muniFilter.append('<option value=' + 0 + ' selected hidden>Select Municipality</option>');

            Object.keys(municipality).forEach(function(key) {
                if(municipality[key].province_id == $('#per_province').val()){
                    i_muniFilter.append('<option  value=' + municipality[key].municipalities_id + '> ' + municipality[key].municipalities_name + '</option>');
                }
            });

            i_brgyFilter.empty();
            i_brgyFilter.append('<option value=' + 0 + ' selected hidden>Select Barangay</option>');
            i_brgyFilter.append('<option value=' + 0 + ' disabled>Please select Province first.</option>');
          
            i_zoneFilter.empty();
            i_zoneFilter.append('<option value=' + 0 + ' selected hidden>Select Zone</option>');
            i_zoneFilter.append('<option value=' + 0 + ' disabled>Please select Barangay first.</option>');
            $('#lbl-zone-per').removeClass('d-none');
            $('#per_zone').removeClass('d-none');
        }
    });
    $('#per_municipality').change(function(){
        if($('#per_municipality').val() > 0){
            i_brgyFilter.empty();
            i_brgyFilter.append('<option value=' + 0 + ' selected hidden>Select Barangay</option>');

            Object.keys(barangay).forEach(function(key) {
                if(barangay[key].municipalities_id == $('#per_municipality').val()){
                    i_brgyFilter.append('<option  value=' + barangay[key].barangays_id + '>'+ barangay[key].barangays_name +'</option>');
                }
            });

            i_zoneFilter.empty();
            i_zoneFilter.append('<option value=' + 0 + ' selected hidden>Select Zone</option>');
            i_zoneFilter.append('<option value=' + 0 + ' disabled>Please select Barangay first.</option>');
            $('#lbl-zone-per').removeClass('d-none');
            $('#per_zone').removeClass('d-none');
        }
    });
    $('#per_barangay').change(function(){
        if($('#per_barangay').val() > 0){
            i_zoneFilter.empty();
            i_zoneFilter.append('<option value=' + 0 + ' selected hidden>Select Barangay</option>');

            Object.keys(zone).forEach(function(key) {
                if(zone[key].barangays_id == $('#per_barangay').val()){
                    i_zoneFilter.append('<option  value=' + zone[key].zones_id + '>'+ zone[key].zones_name +'</option>');
                }
            });

            if ($('#per_zone option').length == 1) {
                $('#lbl-zone-per').addClass('d-none');
                $('#per_zone').addClass('d-none');
            }else{
                $('#lbl-zone-per').removeClass('d-none');
                $('#per_zone').removeClass('d-none');
            }
        }
    });
    $('#cur_province').change(function(){
        if($('#cur_province').val() > 0){
            i_muniFilterC.empty();
            i_muniFilterC.append('<option value=' + 0 + ' selected hidden>Select Municipality</option>');

            Object.keys(municipality).forEach(function(key) {
                if(municipality[key].province_id == $('#cur_province').val()){
                    i_muniFilterC.append('<option  value=' + municipality[key].municipalities_id + '>'+ municipality[key].municipalities_name +'</option>');
                }
            });

            i_brgyFilterC.empty();
            i_brgyFilterC.append('<option value=' + 0 + ' selected hidden>Select Barangay</option>');
            i_brgyFilterC.append('<option value=' + 0 + ' disabled>Please select Province first.</option>');

            i_zoneFilterC.empty();
            i_zoneFilterC.append('<option value=' + 0 + ' selected hidden>Select Zone</option>');
            i_zoneFilterC.append('<option value=' + 0 + ' disabled>Please select Barangay first.</option>');
            $('#lbl-zone-cur').removeClass('d-none');
            $('#cur_zone').removeClass('d-none');
        }
    });
    $('#cur_municipality').change(function(){
        if($('#cur_municipality').val() > 0){
            i_brgyFilterC.empty();
            i_brgyFilterC.append('<option value=' + 0 + ' selected hidden>Select Barangay</option>');

            Object.keys(barangay).forEach(function(key) {
                if(barangay[key].municipalities_id == $('#cur_municipality').val()){
                    i_brgyFilterC.append('<option  value=' + barangay[key].barangays_id + '>'+ barangay[key].barangays_name +'</option>');
                }
            });

            i_zoneFilterC.empty();
            i_zoneFilterC.append('<option value=' + 0 + ' selected hidden>Select Zone</option>');
            i_zoneFilterC.append('<option value=' + 0 + ' disabled>Please select Barangay first.</option>');
            $('#lbl-zone-cur').removeClass('d-none');
            $('#cur_zone').removeClass('d-none');
        }
    });
    $('#cur_barangay').change(function(){
        if($('#cur_barangay').val() > 0){
            i_zoneFilterC.empty();
            i_zoneFilterC.append('<option value=' + 0 + ' selected hidden>Select Barangay</option>');

            Object.keys(zone).forEach(function(key) {
                if(zone[key].barangays_id == $('#cur_barangay').val()){
                    i_zoneFilterC.append('<option  value=' + zone[key].zones_id + '>'+ zone[key].zones_name +'</option>');
                }
            });

            if ($('#cur_zone option').length == 1) {
                $('#lbl-zone-cur').addClass('d-none');
                $('#cur_zone').addClass('d-none');
            }else{
                $('#lbl-zone-cur').removeClass('d-none');
                $('#cur_zone').removeClass('d-none');
            }
        }
    });

    $('#edt_ct_fname').on('keypress',function(e) {
        keyString(e);
    });
    $('#edt_ct_mname').on('keypress',function(e) {
        keyString(e);
    });
    $('#edt_ct_lname').on('keypress',function(e) {
        keyString(e);
    });
    $('#edt_ct_day').on('keypress',function(e) {
        keyNumber(e);
        if(this.value.length==2){
           return false;
        }
    });
    $('#edt_ct_year').on('keypress',function(e) {
        keyNumber(e);
        if(this.value.length==4){
           return false;
        } 
    });
    $('#edt_ct_mobile').on('keypress',function(e) {
        keyNumber(e);
        if(this.value.length==11){
           return false;
        } 
    });
    $('#edt_ct_profession').on('keypress',function(e) {
        keyString(e);
    });

    $('#filterMale').click(function(){
        $('#filterFemale').prop('checked',false);
    });
    $('#filterFemale').click(function(){
        $('#filterMale').prop('checked',false);
    });
    $('#filterVerified').click(function(){
        $('#filterNotVerified').prop('checked',false);
        $('#filterBlock').prop('checked',false);
    });
    $('#filterNotVerified').click(function(){
        $('#filterVerified').prop('checked',false);
        $('#filterBlock').prop('checked',false);
    });
    $('#filterBlock').click(function(){
        $('#filterVerified').prop('checked',false);
        $('#filterNotVerified').prop('checked',false);
    });

    $('#edt_ct_fname').on('change',function() {
        validFname();
    });
    $('#edt_ct_mname').on('change',function() {
        validMname();
    });
    $('#edt_ct_lname').on('change',function() {
        validLname();
    });
    $('#edt_ct_suffix').on('change',function() {
        if($('#edt_ct_suffix').val() == "0"){
            if(oldData.citizens_suffix == null)
                $('#edt_ct_suffix').removeClass('is-valid');
            else
                $('#edt_ct_suffix').addClass('is-valid');
        }else{
            if(oldData.citizens_suffix != $('#edt_ct_suffix').val())
                $('#edt_ct_suffix').addClass('is-valid');
            else
                $('#edt_ct_suffix').removeClass('is-valid');
        }
    });
    $('#edt_ct_month').on('change',function() {
        if($('#edt_ct_month').val() != oldData.citizens_bday.substr(5,2))
            $('#edt_ct_month').addClass('is-valid');
        else
            $('#edt_ct_month').removeClass('is-valid');
    });
    $('#edt_ct_day').on('change',function () {
        validDay();
    });
    $('#edt_ct_year').on('change',function() {
        validYear();
    });
    $('#edt_ct_gender').on('change',function() {
        if($('#edt_ct_gender').val() != oldData.citizens_gender){
            $('#edt_ct_gender').addClass('is-valid');
        }else{
            $('#edt_ct_gender').removeClass('is-valid');
        }
    });
    $('#edt_ct_profession').on('change', function() {
        validProfession();
    });
    $('#edt_ct_mobile').on('change', function() {
        validMobile();
    });
    $('#edt_ct_photo').on('change', function() {
        validPhoto();
    });

    $('#edt_per_province').on('change', function() {
        validProv();
        var id = $('#edt_per_province');
        checkZone(id.val(),"province");
        setNewMunicipality(i_muni,"perm");
        clrBrgy(i_brgy);
        clrZone(i_zone);
        clrField(i_zonef);
        clrField(i_bldg);
    });
    $('#edt_per_municipality').on('change',function() {
        validMuni();
        checkZone(i_muni.val(),"muni");
        setNewBrgy(i_brgy,"perm");
        clrZone(i_zone);
        clrField(i_zonef);
        clrField(i_bldg);
    });
    $('#edt_per_barangay').on('change',function() {
        validBrgy();
        setNewZone(i_zone,"perm");
        clrField(i_zonef);
        clrField(i_bldg);
    });
    $('#edt_per_zone').on('change',function() {
        validZone();
        clrField(i_bldg);
    });
    $('#edt_per_zone_field').on('change',function() {
        validZoneField();
        clrField(i_bldg);
    })
    $('#edt_per_bldg').on('change',function() {
        if($('#edt_per_bldg').val() == ""){
            $('#edt_per_bldg').removeClass('is-valid');
        }else{
            $('#edt_per_bldg').addClass('is-valid');
        }
    });

    $('#edt_cur_province').on('change',function() {
        validProvCur();
        var id = $('#edt_cur_province');
        checkZoneCur(id.val(),"province");
        setNewMunicipality(i_muniCur,"curr");
        clrBrgy(i_brgyCur);
        clrZone(i_zoneCur);
        clrField(i_zonefCur);
        clrField(i_bldgCur);
    });
    $('#edt_cur_municipality').on('change',function() {
        validMuniCur();
        checkZoneCur(i_muniCur.val(),"muni");
        setNewBrgy(i_brgyCur,"curr");
        clrZone(i_zoneCur);
        clrField(i_zonefCur);
        clrField(i_bldgCur);
    });
    $('#edt_cur_barangay').on('change',function() {
        validBrgyCur();
        setNewZone(i_zoneCur,"curr");
        clrField(i_zonefCur);
        clrField(i_bldgCur);
    });
    $('#edt_cur_zone').on('change',function() {
        validZoneCur();
        clrField(i_bldgCur);
    });
    $('#edt_cur_zone_field').on('change',function () {
        validZoneFieldCur();
        clrField(i_bldgCur);
    });
    $('#edt_cur_bldg').on('change',function() {
        if($('#edt_cur_bldg').val() == ""){
            $('#edt_cur_bldg').removeClass('is-valid');
        }else{
            $('#edt_cur_bldg').addClass('is-valid');
        }
    });
    $('#edt_ct_update-btn').on('click', function() {
        if(!validFname() | !validMname() | !validLname() | !validDay() | !validYear() | !validProfession() | !validMobile() | !validPhoto() | !validMuni() | !validBrgy() | !validZone() | !validMuniCur() | !validBrgyCur() | !validZoneCur()){
            $('#edt_ct_month').addClass('is-valid');
            $('#edt_ct_gender').addClass('is-valid');
            $('#edt_ct_photo').addClass('is-valid');
            $('#edt_per_province').addClass('is-valid');
            $('#edt_cur_province').addClass('is-valid');

            document.getElementById('scroll-up').click();
            $('#citizens_modal').animate({ scrollTop: 0 }, 'slow');
            $('#field-toast').toast('show');
        }else{
            $('#edt_ct_month').addClass('is-valid');
            $('#edt_ct_gender').addClass('is-valid');
            $('#edt_ct_mobile').addClass('is-valid');
            $('#edt_ct_photo').addClass('is-valid');
            $('#edt_per_province').addClass('is-valid');
            $('#edt_cur_province').addClass('is-valid');

            if(changeFname() | changeMname() |  changeLname() | changeSuffix() | changeMonth() | changeDay() | changeYear() | changeGender() | changeProfession() | changeMobile() | changePhoto() | changeProvince() | changeMuni() | changeBrgy() | changeZone() | changeProvinceCur() | changeMuniCur() | changeBrgyCur() | changeZoneCur() | changeBldg() | changeBldgCur()){
                setChangePerson();
                $('#update_modal').modal('show');
            }else{
                resetFieldValid();
                document.getElementById('scroll-up').click();
                $('#citizens_modal').animate({ scrollTop: 0 }, 'slow');
                $('#change-toast').toast('show');
            }
        }
    });
    $('#edt_ct_cancel-btn').on('click',function() {
        if(changeFname() | changeMname() |  changeLname() | changeSuffix() | changeMonth() | changeDay() | changeYear() | changeGender() | changeProfession() | changeMobile() | changePhoto() | changeProvince() | changeMuni() | changeBrgy() | changeZone() | changeProvinceCur() | changeMuniCur() | changeBrgyCur() | changeZoneCur() | changeBldg() | changeBldgCur()){
            $('#change_modal').modal('show');
        }else{
            $('#citizens_modal').modal('toggle');
        }
    });
    $('#change_no').on('click', function() {
        $('#change_modal').modal('toggle');
        $('#citizens_modal').modal('toggle');
    });
    $('#change_cls').on('click', function() {
        $('#change_modal').modal('toggle');
        $('#citizens_modal').modal('toggle');
    });
    $('#change_yes').on('click',function() {
        if(!validFname() | !validMname() | !validLname() | !validDay() | !validYear() | !validProfession() | !validMobile() | !validPhoto() | !validMuni() | !validBrgy() | !validZone() | !validMuniCur() | !validBrgyCur() | !validZoneCur()){
            $('#edt_ct_month').addClass('is-valid');
            $('#edt_ct_gender').addClass('is-valid');
            $('#edt_ct_photo').addClass('is-valid');
            $('#edt_per_province').addClass('is-valid');
            $('#edt_cur_province').addClass('is-valid');

            document.getElementById('scroll-up').click();
            $('#citizens_modal').animate({ scrollTop: 0 }, 'slow');
            $('#field-toast').toast('show');
        }else{
            $('#change_modal').modal('toggle');
            setChangePerson();
            $('#update_modal').modal('show');
        }
    });
    $('#update_data').on('click',function() {
        var formData = new FormData(document.getElementById('citizenUpdate'));
        formData.append('edt_ct_id', oldData.citizens_id);
        if($('#edt_ct_perZone1').hasClass('d-none') ){
            formData.append('edt_ct_perZone1', null);
        }
        if($('#edt_ct_curZone1').hasClass('d-none')){
            formData.append('edt_ct_curZone1', null);
        }
        if($('#edt_ct_perZone2').hasClass('d-none') ){
            formData.append('edt_ct_perZone2', null);
        }
        if($('#edt_ct_curZone2').hasClass('d-none')){
            formData.append('edt_ct_curZone2', null);
        }
        $.ajax({
            type:'POST',
            url: "/citizens-update",
            data: formData,
            cache:false,
            async:false,
            contentType: false,
            processData: false,
            success: function(data){
                if(data == 'true'){
                    $('#update_modal').modal('toggle');
                    $('#citizens_modal').modal('toggle');
                    document.getElementById('scroll-up').click();
                    $('#update-toast').toast('show');
                    dt();
                }else{
                    $('#updateError-toast').toast('show');
                }
            }
       });
    });
    $('#view_edit').on('click',function() {
        $('#view_modal').modal('toggle');
        editPerson(view_id);
    });

    $('#filter-set-btn').click(function(){
        var gender; var verification; var p_province =''; var p_municipality=''; var p_barangay=''; var p_zone=''; var c_province=''; var c_municipality=''; var c_barangay=''; var c_zone='';
        if($('#filterMale').prop('checked') == true){
            gender = 'Male';
        }
        if($('#filterFemale').prop('checked') == true){
            gender = 'Female';
        }
        if($('#filterVerified').prop('checked') == true){
            verification = '1';
        }
        if($('#filterNotVerified').prop('checked') == true){
            verification = '2';
        }
        if($('#per_province').val() > 0){
            p_province = $('#per_province').val();
        }
        if($('#per_municipality').val() > 0){
            p_municipality = $('#per_municipality').val();
        }
        if($('#per_barangay').val() > 0){
            p_barangay = $('#per_barangay').val();
        }
        if($('#per_zone').val() > 0){
            p_zone = $('#per_zone').val();
        }
        if($('#cur_province').val() > 0){
            c_province = $('#cur_province').val();
        }
        if($('#cur_municipality').val() > 0){
            c_municipality = $('#cur_municipality').val();
        }
        if($('#cur_barangay').val() > 0){
            c_barangay = $('#cur_barangay').val();
        }
        if($('#cur_zone').val() > 0){
            c_zone = $('#cur_zone').val();
        }
        dt(gender, verification, p_province, p_municipality, p_barangay, p_zone, c_province, c_municipality, c_barangay, c_zone);
    });
    $('#filter-reset-btn').click(function(){
        $('#filterMale').prop('checked',false);
        $('#filterFemale').prop('checked',false);
        $('#filterVerified').prop('checked',false);
        $('#filterNotVerified').prop('checked',false);

        i_provFilter.val("0");
        i_muniFilter.empty();
        i_muniFilter.append('<option value=' + 0 + ' selected hidden>Select Municipality</option>');
        i_muniFilter.val("0");
        i_brgyFilter.empty();
        i_brgyFilter.append('<option value=' + 0 + ' selected hidden>Select Municipality</option>');
        i_brgyFilter.val("0");
        i_zoneFilter.empty();
        i_zoneFilter.append('<option value=' + 0 + ' selected hidden>Select Municipality</option>');
        i_zoneFilter.val("0");
        $('#lbl-zone-per').removeClass('d-none');
        $('#per_zone').removeClass('d-none');

        i_provFilterC.val("0");
        i_muniFilterC.empty();
        i_muniFilterC.append('<option value=' + 0 + ' selected hidden>Select Municipality</option>');
        i_muniFilterC.val("0");
        i_brgyFilterC.empty();
        i_brgyFilterC.append('<option value=' + 0 + ' selected hidden>Select Municipality</option>');
        i_brgyFilterC.val("0");
        i_zoneFilterC.empty();
        i_zoneFilterC.append('<option value=' + 0 + ' selected hidden>Select Municipality</option>');
        i_zoneFilterC.val("0");
        $('#lbl-zone-cur').removeClass('d-none');
        $('#cur_zone').removeClass('d-none');
        document.getElementById('filter-btn').click();
        dt();
    });

    $('#generateInfo').click(function(){
        var checkFilter = checkFilterGenerate('false');
        if(checkFilter == 'true'){
            $('#filter_modal').modal('show');
        }else{
            document.getElementById('downloadNoFilter').click();
            document.getElementById('scroll-up').click();
            $('#generate-toast').toast('show');
        }
    });
    $('#fltr_Yes').click(function(){
        var gender='';var verification=''; 
        var p_province =''; var p_municipality=''; var p_barangay=''; var p_zone=''; 
        var c_province=''; var c_municipality=''; var c_barangay=''; var c_zone=''; 
        if($('#filterMale').prop('checked') == true){
            gender = 'Male';
        }
        if($('#filterFemale').prop('checked') == true){
            gender = 'Female';
        }
        if($('#filterVerified').prop('checked') == true){
            verification = '1';
        }
        if($('#filterNotVerified').prop('checked') == true){
            verification = '2';
        }
        if($('#per_province').val() > 0){
            p_province = $('#per_province').val();
        }
        if($('#per_municipality').val() > 0){
            p_municipality = $('#per_municipality').val();
        }
        if($('#per_barangay').val() > 0){
            p_barangay = $('#per_barangay').val();
        }
        if($('#per_zone').val() > 0){
            p_zone = $('#per_zone').val();
        }
        if($('#cur_province').val() > 0){
            c_province = $('#cur_province').val();
        }
        if($('#cur_municipality').val() > 0){
            c_municipality = $('#cur_municipality').val();
        }
        if($('#cur_barangay').val() > 0){
            c_barangay = $('#cur_barangay').val();
        }
        if($('#cur_zone').val() > 0){
            c_zone = $('#cur_zone').val();
        }
        $.ajax({
            type:'POST',
            url: "/citizen/generateInfo",
            data: {
                _token: $_token,
                gender:gender,
                verification,verification,
                p_province:p_province,
                p_municipality:p_municipality,
                p_barangay:p_barangay,
                p_zone:p_zone,
                c_province:c_province,
                c_municipality:c_municipality,
                c_barangay:c_barangay,
                c_zone:c_zone
            },
            success: function(data){
                if(data == 'true'){
                    $('#filter_modal').modal('toggle');
                    document.getElementById('downloadFilter').click();
                    document.getElementById('scroll-up').click();
                    $('#generate-toast').toast('show');
                }else{
                    document.getElementById('scroll-up').click();
                    $('#generateError-toast').toast('show');
                }
            }
       });
    });
    $('#fltr_No').click(function(){
        document.getElementById('downloadNoFilter').click();
        document.getElementById('scroll-up').click();
        $('#generate-toast').toast('show');
    });
});

function editPerson(id){
    $selected_id = id;
    $_token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "/admin-citizen-select",
        type:"POST",
        data:{
                select_id:$selected_id,
                _token: $_token
        },
        success:function(data){
            setPersonData(data);
            $("#citizens_modal").modal('show');
        }
    });
}
function setPersonData(data) {
    oldData = [];
    oldData = data;

    $('#edt_ct_fname').val(data.citizens_fname);
    $('#edt_ct_mname').val(data.citizens_mname);
    $('#edt_ct_lname').val(data.citizens_lname);
    if(data.citizens_suffix != null){
        $('#edt_ct_suffix').val(data.citizens_suffix);
    }
    $("#edt_ct_month").val(data.citizens_bday.substr(5,2));
    $('#edt_ct_day').val(parseInt(data.citizens_bday.substr(8,2)));
    $("#edt_ct_year").val(data.citizens_bday.substr(0,4));
    $("#edt_ct_gender").val(data.citizens_gender);
    $('#edt_ct_profession').val(data.citizens_profession);
    $('#edt_ct_mobile').val(data.citizens_mobile);
    $('#photo-label').text('Profile Photo : ' + data.citizens_img_src);
    document.getElementById("edt_ct_profile").src = "/images/profileid/" + data.citizens_img_src;

    $('#edt_per_province').val(data.province_id);
    Object.keys(municipality).forEach(function(key) {
        if(municipality[key].province_id == $('#edt_per_province').val()){
            $('#edt_per_municipality').append('<option  value=' + municipality[key].municipalities_id + '>'+ municipality[key].municipalities_name +'</option>');
        }
    });
    $('#edt_per_municipality').val(data.municipalities_id);
    Object.keys(barangay).forEach(function(key) {
        if(barangay[key].municipalities_id == $('#edt_per_municipality').val()){
            $('#edt_per_barangay').append('<option  value=' + barangay[key].barangays_id + '>'+ barangay[key].barangays_name +'</option>');
        }
    });
    $('#edt_per_barangay').val(data.barangays_id);
    if($('#edt_per_province').val() == 20 && $('#edt_per_municipality').val() == 361){
        $('#zone-select-edt-lbl').removeClass('d-none');
        $('#zone-select-edt').removeClass('d-none');
        $('#zone-field-edt-lbl').addClass('d-none');
        $('#zone-field-edt').addClass('d-none');

        Object.keys(zone).forEach(function(key) {
            if(zone[key].barangays_id == $('#edt_per_barangay').val()){
                $('#edt_per_zone').append('<option  value=' + zone[key].zones_id + '>'+ zone[key].zones_name +'</option>');
            }
        });

        if(data.zones_id != null){
            $('#edt_per_zone').val(data.zones_id);

        }

    }else{
        $('#zone-select-edt-lbl').addClass('d-none');
        $('#zone-select-edt').addClass('d-none');
        $('#zone-field-edt-lbl').removeClass('d-none');
        $('#zone-field-edt').removeClass('d-none');

        if(data.zones_id != null){
            Object.keys(zone).forEach(function(key) {
                if(zone[key].zones_id == data.zones_id){
                    $('#edt_per_zone_field').val(zone[key].zones_name);
                }
            });
        }
    }
    if(data.citizen_add_address != null){
        $('#edt_per_bldg').val(data.citizen_add_address);
    }
    $('#edt_cur_province').val(data.province_id_current);
    Object.keys(municipality).forEach(function(key) {
        if(municipality[key].province_id == $('#edt_cur_province').val()){
            $('#edt_cur_municipality').append('<option  value=' + municipality[key].municipalities_id + '>'+ (municipality[key].municipalities_name.toLowerCase()).charAt(0).toUpperCase() + (municipality[key].municipalities_name.toLowerCase()).slice(1) +'</option>');
        }
    });
    $('#edt_cur_municipality').val(data.municipalities_id_current);
    Object.keys(barangay).forEach(function(key) {
        if(barangay[key].municipalities_id == $('#edt_cur_municipality').val()){
            $('#edt_cur_barangay').append('<option  value=' + barangay[key].barangays_id + '>'+ barangay[key].barangays_name +'</option>');
        }
    });
    $('#edt_cur_barangay').val(data.barangays_id_current);
    if($('#edt_cur_province').val() == 20 && $('#edt_cur_municipality').val() == 361){
        $('#zone-select-edt-lbl-cur').removeClass('d-none');
        $('#zone-select-edt-cur').removeClass('d-none');
        $('#zone-field-edt-lbl-cur').addClass('d-none');
        $('#zone-field-edt-cur').addClass('d-none');
        Object.keys(zone).forEach(function(key) {
            if(zone[key].barangays_id == $('#edt_cur_barangay').val()){
                $('#edt_cur_zone').append('<option  value=' + zone[key].zones_id + '>'+ zone[key].zones_name +'</option>');
            }
        });
        if(data.zones_id_current != null){
            $('#edt_cur_zone').val(data.zones_id_current);
        }
    }else{
        $('#zone-select-edt-lbl-cur').addClass('d-none');
        $('#zone-select-edt-cur').addClass('d-none');
        $('#zone-field-edt-lbl-cur').removeClass('d-none');
        $('#zone-field-edt-cur').removeClass('d-none');
        if(data.zones_id_current != null){
            Object.keys(zone).forEach(function(key) {
                if(zone[key].zones_id == data.zones_id_current){
                    $('#edt_cur_zone_field').val(zone[key].zones_name);
                }
            });
        }
    }
    if(data.citizen_add_address_current != null){
        $('#edt_cur_bldg').val(data.citizen_add_address_current);
    }
}
function setChangePerson() {
    if(changeFname() | changeMname() | changeLname() | changeSuffix()){
        var sfOld=''; var sfNew='';
        if(oldData.citizens_suffix != null){
            sfOld = oldData.citizens_suffix;
        }
        if($('#edt_ct_suffix').val() != 0){
            sfNew = $('#edt_ct_suffix').val();
        }
        $('#row-name').removeClass('d-none');
        $('#nameOld').text(oldData.citizens_fname + ' ' + oldData.citizens_mname + ' ' + oldData.citizens_lname + ' ' + sfOld);
        $('#nameNew').text($('#edt_ct_fname').val() + ' ' + $('#edt_ct_mname').val() + ' ' + $('#edt_ct_lname').val() + ' ' + sfNew);
    }else{
        $('#row-name').addClass('d-none');
    }
    if(changeMonth() | changeDay() | changeYear() ){
        $('#row-bday').removeClass('d-none');
        var m = Array('January', 'February','March', 'April', 'May', 'June', 'July', 'August', ' September', 'October', 'November', 'December');
        var oldM; var oldD; var oldY;

        if(oldData.citizens_bday.charAt(5) != 0){
            oldM = oldData.citizens_bday.substr(5,2);
        }else{
            oldM = oldData.citizens_bday.substr(6,1);
        }

        if(oldData.citizens_bday.substr(8,1) != 0){
            oldD = oldData.citizens_bday.substr(8,2);
        }else{
            oldD = oldData.citizens_bday.substr(9,1);
        }

        oldY = oldData.citizens_bday.substr(0,4);
        $('#bdayOld').text(m[oldM-1] + ' ' + oldD + ',' + oldY);
        $('#bdayNew').text(m[$('#edt_ct_month').val() -1] + ' ' + $('#edt_ct_day').val() + ', ' + $('#edt_ct_year').val());
    }else{
        $('#row-bday').addClass('d-none');
    }
    if(changeGender()){
        $('#row-gender').removeClass('d-none');
        $('#genderOld').text(oldData.citizens_gender);
        $('#genderNew').text($('#edt_ct_gender').val());
    }else{
        $('#row-gender').addClass('d-none');
    }
    if(changeProfession()){
        $('#row-profession').removeClass('d-none');
        $('#professionOld').text(oldData.citizens_proffesion);
        $('#professionNew').text($('#edt_ct_profession').val());
    }else{
        $('#row-profession').addClass('d-none');
    }
    if(changeMobile()){
        $('#row-mobile').removeClass('d-none');
        $('#mobileOld').text(oldData.citizens_mobile);
        $('#mobileNew').text($('#edt_ct_mobile').val());
    }else{
        $('#row-mobile').addClass('d-none');
    }
    if(changePhoto()){
        $('#row-photo').removeClass('d-none');
        document.getElementById("photoOld").src = "/storage/images/" + oldData.citizens_img_src ;
        var file = $("#edt_ct_photo").get(0).files[0];
        var reader = new FileReader();
        reader.onload = function(){
            $("#photoNew").attr("src", reader.result);
        }
        reader.readAsDataURL(file);
    }else{
        $('#row-photo').addClass('d-none');
    }
    if(changeProvince() | changeMuni() | changeBrgy() | changeZone() | changeBldg()){
        $('#row-permanent').removeClass('d-none');
        var oldP =''; var newP='';
        if(oldData.citizen_add_address != null){
            oldP += oldData.citizen_add_address + ', ';
        }
        if(oldData.zones_id != null){
            oldP += oldData.get_main_zone.zones_name + ', ';
        }
        oldP += oldData.get_main_barangay.barangays_name + ', ';
        oldP += oldData.get_main_municipality.municipalities_name + ', ';
        oldP += oldData.get_main_province.province_name;

        if($('#edt_per_bldg').val() != ''){
            newP += $('#edt_per_bldg').val() +', ';
        }
        if($('#edt_per_province').val() == 20 && $('#edt_per_municipality').val() == 361){
            Object.keys(zone).forEach(function(key) {
                if(zone[key].zones_id == $('#edt_per_zone').val()){
                    newP += zone[key].zones_name + ', ';
                }
            });
        }else{
            if($('#edt_per_zone_field').val() != ''){
                newP += $('#edt_per_zone_field').val() +', ';
            }
        }
        Object.keys(barangay).forEach(function(key) {
            if(barangay[key].barangays_id  == $('#edt_per_barangay').val()){
                newP += barangay[key].barangays_name + ', ';
            }
        });
        Object.keys(municipality).forEach(function(key) {
            if(municipality[key].municipalities_id  == $('#edt_per_municipality').val()){
                newP += municipality[key].municipalities_name + ', ';
            }
        });
        Object.keys(province).forEach(function(key) {
            if(province[key].province_id == $('#edt_per_province').val()){
                newP += province[key].province_name;
            }
        });
        $('#permanentOld').text(oldP);
        $('#permanentNew').text(newP);
    }else{
        $('#row-permanent').addClass('d-none');
    }
    if(changeProvinceCur() | changeMuniCur() | changeBrgyCur() | changeZoneCur() | changeBldgCur()){
        $('#row-current').removeClass('d-none');
        var oldC =''; var newC='';
        if(oldData.citizen_add_address_current != null){
            oldC += oldData.citizen_add_address_current + ', ';
        }
        if(oldData.zones_id_current != null){
            oldC += oldData.citizen_to_zone.zones_name + ', ';
        }
        oldC += oldData.citizen_to_barangay.barangays_name + ', ';
        oldC += oldData.citizen_to_municipality.municipalities_name + ', ';
        oldC += oldData.citizen_to_province.province_name;
       
        if($('#edt_cur_bldg').val() != ''){
            newC += $('#edt_cur_bldg').val() +', ';
        }
        if($('#edt_cur_province').val() == 20 && $('#edt_cur_municipality').val() == 361){
            Object.keys(zone).forEach(function(key) {
                if(zone[key].zones_id == $('#edt_cur_zone').val()){
                    newC += zone[key].zones_name + ', ';
                }
            });
        }else{
            if($('#edt_cur_zone_field').val() != ''){
                newC += $('#edt_cur_zone_field').val() +', ';
            }
        }
        Object.keys(barangay).forEach(function(key) {
            if(barangay[key].barangays_id == $('#edt_cur_barangay').val()){
                newC += barangay[key].barangays_name + ', ';
            }
        });
        Object.keys(municipality).forEach(function(key) {
            if(municipality[key].municipalities_id == $('#edt_cur_municipality').val()){
                newC += municipality[key].municipalities_name + ', ';
            }
        });
        Object.keys(province).forEach(function(key) {
            if(province[key].province_id == $('#edt_cur_province').val()){
                newC += province[key].province_name;
            }
        });
        $('#currentOld').text(oldC);
        $('#currentNew').text(newC);
    }else{
        $('#row-current').addClass('d-none');
    }
}

function view(id){
    view_id = id;
    $selected_id = id;
    $_token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: "/admin-citizen-select",
        type:"POST",
        data:{
                select_id:$selected_id,
                _token: $_token
        },
        success:function(data){
            setBlkPersonData(data);
            $('#view_modal').modal('show');
        }
    });
}

function setBlkPersonData(data){

    var listMonth = {"01":"January","02":"February","03":"March", "04":"April", "05":"May", "06":"June", "07":"July", "08":"August", "09":"September", "10":"October", "11":"November","12":"December"};
    var listVerify = {"1":"Verified", "2":"Not Verified", "3":"Blocked"};
    var month; var day;var permanent= ''; var current=''; var verify;

    Object.keys(listMonth).forEach(function(key) {
        if(key == data.citizens_bday.substr(5,2)){
            month = listMonth[key];
        }
    });
    day = parseInt(data.citizens_bday.substr(8,2));

    Object.keys(listVerify).forEach(function(key) {
        if(key == data.verifications_id){
            verify = listVerify[key];
        }
    });

    if(data.citizen_add_address != null){
        permanent += data.citizen_add_address + ', ';
    }
    if(data.zones_id != null){
        permanent += data.get_main_zone.zones_name+ ', ';
    }
    permanent += data.get_main_barangay.barangays_name + ', ';
    permanent += data.get_main_municipality.municipalities_name + ', ';
    permanent += data.get_main_province.province_name;

    if(data.citizen_add_address_current != null){
        current += data.citizen_add_address_current + ', ';
    }
    if(data.zones_id_current != null){
        current += data.citizen_to_zone.zones_name +", ";
    }
    current += data.citizen_to_barangay.barangays_name + ', ';
    current += data.citizen_to_municipality.municipalities_name + ', ';
    current += data.citizen_to_province.province_name;

    $('#blk_name').text(data.citizens_fname + ' ' + data.citizens_mname + ' ' + data.citizens_lname);
    $('#blk_bday').text(month + ' ' + day + ', ' + data.citizens_bday.substr(0,4));
    $('#blk_age').text((new Date()).getFullYear() - data.citizens_bday.substr(0,4));
    $('#blk_mobile').text(data.citizens_mobile);
    $('#blk_gender').text(data.citizens_gender);
    $('#blk_occupation').text(data.citizens_profession);
    $('#blk_permanent').text(permanent);
    $('#blk_current').text(current);

    document.getElementById("blk_profile").src = "/images/profileid/" + data.citizens_img_src ;

    if(data.verifications_id == 1){
        $('#blk_verify').addClass('text-success');
        $('#blk_verify').removeClass('text-danger');
        $('#blk_verify').removeClass('text-warning');
        $('#blk_verify').text('VERIFIED');
    }else if(data.verifications_id == 2){
        $('#blk_verify').addClass('text-warning');
        $('#blk_verify').removeClass('text-danger');
        $('#blk_verify').removeClass('text-success');
        $('#blk_verify').text('NOT VERIFIED');
    }else{
        $('#blk_verify').addClass('text-danger');
        $('#blk_verify').removeClass('text-success');
        $('#blk_verify').removeClass('text-warning');
        $('#blk_verify').text('BLOCKED');
    }
}
function checkFilterGenerate(f){
    if($('#filterMale').prop('checked') == true || $('#filterFemale').prop('checked') == true){
        $('#fltr_l_Gender').removeClass('d-none');
        $('#fltr_gender').removeClass('d-none');
        if($('#filterMale').prop('checked') == true){
            f = 'true';
            $('#fltr_gender').text('Male');
        }
        if($('#filterFemale').prop('checked') == true){
            f = 'true';
            $('#fltr_gender').text('Female');
        }
    }else{
        $('#fltr_l_Gender').addClass('d-none');
        $('#fltr_gender').addClass('d-none');
    }
    if($('#filterVerified').prop('checked') == true || $('#filterNotVerified').prop('checked') == true){
        $('#fltr_verify').removeClass('d-none');
        $('#fltr_l_Verify').removeClass('d-none');
        if($('#filterVerified').prop('checked') == true){
            f = 'true';
            $('#fltr_verify').text('Verified');
        }
        if($('#filterNotVerified').prop('checked') == true){
            f = 'true';
            $('#fltr_verify').text('Not Verified');
        }
        if($('#filterBlock').prop('checked') == true){
            f = 'true';
            $('#fltr_verify').text('Block');
        }

    }else{
        $('#fltr_verify').addClass('d-none');
        $('#fltr_l_Verify').addClass('d-none');
    }
    if($('#per_province').val() > 0 || $('#per_municipality').val() > 0 || $('#per_barangay').val() > 0 || $('#per_zone').val() > 0){
        $('#fltr_t_per').removeClass('d-none');
        if($('#per_province').val() > 0){
            f = 'true';
            $('#fltr_pProv').text($('#per_province').find(":selected").text());
            $('#fltr_pProv').removeClass('d-none');
            $('#fltr_l_pProve').removeClass('d-none');
        }else{
            $('#fltr_pProv').addClass('d-none');
            $('#fltr_l_pProve').addClass('d-none');
        }
        if($('#per_municipality').val() > 0){
            f = 'true';
            $('#fltr_pMuni').text($('#per_municipality').find(":selected").text());
            $('#fltr_pMuni').removeClass('d-none');
            $('#fltr_l_pMuni').removeClass('d-none');
        }else{
            $('#fltr_pMuni').addClass('d-none');
            $('#fltr_l_pMuni').addClass('d-none');
        }
        if($('#per_barangay').val() > 0){
            f = 'true';
            $('#fltr_pBrgy').text($('#per_barangay').find(":selected").text());
            $('#fltr_pBrgy').removeClass('d-none');
            $('#fltr_l_pBrgy').removeClass('d-none');
        }else{
            $('#fltr_pBrgy').addClass('d-none');
            $('#fltr_l_pBrgy').addClass('d-none');
        }
        if($('#per_zone').val() > 0){
            f = 'true';
            $('#fltr_pZone').text($('#per_zone').find(":selected").text());
            $('#fltr_pZone').removeClass('d-none');
            $('#fltr_l_pZone').removeClass('d-none');
        }else{
            $('#fltr_pZone').addClass('d-none');
            $('#fltr_l_pZone').addClass('d-none');
        }

    }else{
        $('#fltr_t_per').addClass('d-none');
        $('#fltr_pProv').addClass('d-none');
        $('#fltr_l_pProve').addClass('d-none');
        $('#fltr_pMuni').addClass('d-none');
        $('#fltr_l_pMuni').addClass('d-none');
        $('#fltr_pBrgy').addClass('d-none');
        $('#fltr_l_pBrgy').addClass('d-none');
        $('#fltr_pZone').addClass('d-none');
        $('#fltr_l_pZone').addClass('d-none');
    }
    if($('#cur_province').val() > 0 || $('#cur_municipality').val() > 0 || $('#cur_barangay').val() > 0 || $('#cur_zone').val() > 0){
        $('#fltr_t_cur').removeClass('d-none');

        if($('#cur_province').val() > 0){
            f = 'true';
            $('#fltr_cProv').text($('#cur_province').find(":selected").text());
            $('#fltr_cProv').removeClass('d-none');
            $('#fltr_l_cProv').removeClass('d-none');
        }else{
            $('#fltr_cProv').addClass('d-none');
            $('#fltr_l_cProv').addClass('d-none');
        }
        if($('#cur_municipality').val() > 0){
            f = 'true';
            $('#fltr_cMuni').text($('#cur_municipality').find(":selected").text());
            $('#fltr_cMuni').removeClass('d-none');
            $('#fltr_l_cMuni').removeClass('d-none');
        }else{
            $('#fltr_cMuni').addClass('d-none');
            $('#fltr_l_cMuni').addClass('d-none');
        }
        if($('#cur_barangay').val() > 0){
            f = 'true';
            $('#fltr_cBrgy').text($('#cur_barangay').find(":selected").text());
            $('#fltr_cBrgy').removeClass('d-none');
            $('#fltr_l_cBrgy').removeClass('d-none');
        }else{
            $('#fltr_cBrgy').addClass('d-none');
            $('#fltr_l_cBrgy').addClass('d-none');
        }
        if($('#cur_zone').val() > 0){
            f = 'true';
            $('#fltr_cZone').text($('#cur_zone').find(":selected").text());
            $('#fltr_cZone').removeClass('d-none');
            $('#fltr_l_cZone').removeClass('d-none');
        }else{
            $('#fltr_cZone').addClass('d-none');
            $('#fltr_l_cZone').addClass('d-none');
        }

    }else{
        $('#fltr_t_cur').addClass('d-none');
        $('#fltr_cProv').addClass('d-none');
        $('#fltr_l_cProv').addClass('d-none');
        $('#fltr_cMuni').addClass('d-none');
        $('#fltr_l_cMuni').addClass('d-none');
        $('#fltr_cBrgy').addClass('d-none');
        $('#fltr_l_cBrgy').addClass('d-none');
        $('#fltr_cZone').addClass('d-none');
        $('#fltr_l_cZone').addClass('d-none');
    }
    return f;
}
function resetField() {
    $('#edt_ct_fname').val('');
    $('#edt_ct_mname').val('');
    $('#edt_ct_lname').val('');
    $('#edt_ct_suffix').val('0');
    $('#edt_ct_month').val('1');
    $('#edt_ct_day').val('');
    $('#edt_ct_year').val('');
    $('#edt_ct_gender').val('Male');
    $('#edt_ct_profession').val('');
    $('#edt_ct_mobile').val('');
    $('#photo-label').text('Profile Photo (Choose file)');
    $('#edt_ct_photo').val('');

    $('#edt_per_municipality').empty();
    $('#edt_per_barangay').empty();
    $('#edt_per_zone').empty();
    $('#edt_per_zone_field').val('');
    $('#edt_per_bldg').val('');

    $('#edt_cur_municipality').empty();
    $('#edt_cur_barangay').empty();
    $('#edt_cur_zone').empty();
    $('#edt_cur_zone_field').val('');
    $('#edt_cur_bldg').val('');
    resetFieldValid();
}
function resetFieldValid() {
    $('#edt_ct_fname').removeClass('is-invalid is-valid');
    $('#edt_ct_mname').removeClass('is-invalid is-valid');
    $('#edt_ct_lname').removeClass('is-invalid is-valid');
    $('#edt_ct_month').removeClass('is-invalid is-valid');
    $('#edt_ct_day').removeClass('is-invalid is-valid');
    $('#edt_ct_year').removeClass('is-invalid is-valid');
    $('#edt_ct_gender').removeClass('is-invalid is-valid');
    $('#edt_ct_profession').removeClass('is-invalid is-valid');
    $('#edt_ct_mobile').removeClass('is-invalid is-valid');
    $('#photo-label').removeClass('is-invalid is-valid');
    $('#edt_per_municipality').removeClass('is-invalid is-valid');
    $('#edt_per_barangay').removeClass('is-invalid is-valid');
    $('#edt_per_zone').removeClass('is-invalid is-valid');
    $('#edt_cur_municipality').removeClass('is-invalid is-valid');
    $('#edt_cur_barangay').removeClass('is-invalid is-valid');
    $('#edt_cur_zone').removeClass('is-invalid is-valid');

    $('#edt_ct_photo').removeClass('is-valid');
    $('#edt_per_province').removeClass('is-valid');
    $('#edt_cur_province').removeClass('is-valid');
}

function setNewMunicipality(id,section) {
    id.empty();
    id.append('<option value=' + 0 + ' selected hidden>Select Municipality</option>');

    Object.keys(municipality).forEach(function(key) {
        if(section == "perm"){
            if(municipality[key].province_id == $('#edt_per_province').val()){
                id.append('<option  value=' + municipality[key].municipalities_id + '>'+ municipality[key].municipalities_name +'</option>');
            }
        }else{
            if(municipality[key].province_id == $('#edt_cur_province').val()){
                id.append('<option  value=' + municipality[key].municipalities_id + '>'+ municipality[key].municipalities_name +'</option>');
            }
        }
        
    });
    id.removeClass('is-valid is-invalid');
}
function setNewBrgy(id, section) {
    id.empty();
    id.append('<option value=' + 0 + ' selected hidden>Select Barangay</option>');
    Object.keys(barangay).forEach(function(key) {
        if(section == "perm"){
            if(barangay[key].municipalities_id == $('#edt_per_municipality').val()){
                id.append('<option  value=' + barangay[key].barangays_id + '>'+ barangay[key].barangays_name +'</option>');
            }
        }else{
            if(barangay[key].municipalities_id == $('#edt_cur_municipality').val()){
                id.append('<option  value=' + barangay[key].barangays_id + '>'+ barangay[key].barangays_name +'</option>');
            }
        }
    });
    id.removeClass('is-valid is-invalid');
}
function setNewZone(id,section) {
    id.empty();
    id.append('<option value=' + 0 + ' selected hidden>Select Barangay</option>');
    Object.keys(zone).forEach(function(key) {
       if(section == "perm"){
            if(zone[key].barangays_id == $('#edt_per_barangay').val()){
                id.append('<option  value=' + zone[key].zones_id + '>'+ zone[key].zones_name +'</option>');
            }
       }else{
            if(zone[key].barangays_id == $('#edt_cur_barangay').val()){
                id.append('<option  value=' + zone[key].zones_id + '>'+ zone[key].zones_name +'</option>');
            }
       }
    });
    id.removeClass('is-valid is-invalid')
}
function checkZone(value,select){
    if(select == "muni"){
        if(value == 361){
            $('#zone-select-edt-lbl').removeClass('d-none');
            $('#zone-select-edt').removeClass('d-none');

            $('#zone-field-edt-lbl').addClass('d-none');
            $('#zone-field-edt').addClass('d-none');

        }else{
            $('#zone-select-edt-lbl').addClass('d-none');
            $('#zone-select-edt').addClass('d-none');

            $('#zone-field-edt-lbl').removeClass('d-none');
            $('#zone-field-edt').removeClass('d-none');
        }
    }else{
        if(value == 20){
            $('#zone-select-edt-lbl').removeClass('d-none');
            $('#zone-select-edt').removeClass('d-none');

            $('#zone-field-edt-lbl').addClass('d-none');
            $('#zone-field-edt').addClass('d-none');

        }else{
            $('#zone-select-edt-lbl').addClass('d-none');
            $('#zone-select-edt').addClass('d-none');

            $('#zone-field-edt-lbl').removeClass('d-none');
            $('#zone-field-edt').removeClass('d-none');
        }
    }
}
function checkZoneCur(value,select) {
    if(select == "muni"){
        if(value == 361){
            $('#zone-select-edt-lbl-cur').removeClass('d-none');
            $('#zone-select-edt-cur').removeClass('d-none');

            $('#zone-field-edt-lbl-cur').addClass('d-none');
            $('#zone-field-edt-cur').addClass('d-none');
        }else{
            $('#zone-select-edt-lbl-cur').addClass('d-none');
            $('#zone-select-edt-cur').addClass('d-none');

            $('#zone-field-edt-lbl-cur').removeClass('d-none');
            $('#zone-field-edt-cur').removeClass('d-none');
        }
    }else{
        if(value == 20){
            $('#zone-select-edt-lbl-cur').removeClass('d-none');
            $('#zone-select-edt-cur').removeClass('d-none');

            $('#zone-field-edt-lbl-cur').addClass('d-none');
            $('#zone-field-edt-cur').addClass('d-none');

        }else{
            $('#zone-select-edt-lbl-cur').addClass('d-none');
            $('#zone-select-edt-cur').addClass('d-none');

            $('#zone-field-edt-lbl-cur').removeClass('d-none');
            $('#zone-field-edt-cur').removeClass('d-none');
        }
    }
}
function clrBrgy(id) {
    id.empty();
    id.append('<option id="' + 0 + '" value="' + 0 + '" selected disabled>Please select Municipality first.</option>');
    id.removeClass('is-valid is-invalid');
}
function clrZone(id) {
    id.empty();
    id.append('<option value=' + 0 + ' selected disabled>Please select Barangay first.</option>');
    id.removeClass('is-valid is-invalid');
}
function clrField(id) {
    id.val('');
    id.removeClass('is-valid');
}
function validFname() {
    if($('#edt_ct_fname').val() == ''){
        $('#edt_ct_fname').addClass('is-invalid');
        $('#edt_ct_fname').removeClass('is-valid');
        return false;
    }else{
        $('#edt_ct_fname').removeClass('is-invalid');
        $('#edt_ct_fname').addClass('is-valid');
        return true;
    }
}
function validMname() {
    if($('#edt_ct_mname').val() == ''){
        $('#edt_ct_mname').addClass('is-invalid');
        $('#edt_ct_mname').removeClass('is-valid');
        return false;
    }else{
        $('#edt_ct_mname').removeClass('is-invalid');
        $('#edt_ct_mname').addClass('is-valid');
        return true;
    }
}
function validLname() {
    if($('#edt_ct_lname').val() == ''){
        $('#edt_ct_lname').addClass('is-invalid');
        $('#edt_ct_lname').removeClass('is-valid');
        return false;
    }else{
        $('#edt_ct_lname').removeClass('is-invalid');
        $('#edt_ct_lname').addClass('is-valid');
        return true;
    }
}
function validDay() {
    if($('#edt_ct_day').val()==""){
        $('#edt_ct_day').addClass("is-invalid");
        $('#edt_ct_day').removeClass("is-valid");
        return false;
    }else{
        if($('#edt_ct_day').val() > 31 || $('#edt_ct_day').val() == 0){
           $('#edt_ct_day').addClass("is-invalid");
           $('#edt_ct_day').removeClass("is-valid");
           $('#edt_ct_day').val('');
           return false;
        }else{
           $('#edt_ct_day').removeClass("is-invalid");
           $('#edt_ct_day').addClass("is-valid");
           return true;
        }
    }
}
function validYear() {
    var newD = new Date();
    var year = newD.getFullYear();
    if($('#edt_ct_year').val() == ""){
        $('#edt_ct_year').addClass("is-invalid");
        $('#edt_ct_year').removeClass("is-valid");
        return false;
    }else{
        if($('#edt_ct_year').val() < 1950 || $('#edt_ct_year').val() == 0 || $('#edt_ct_year').val() >= year){
           $('#edt_ct_year').addClass("is-invalid");
           $('#edt_ct_year').removeClass("is-valid");
           $('#edt_ct_year').val('');
           return false;
        }else{
           $('#edt_ct_year').removeClass("is-invalid");
           $('#edt_ct_year').addClass("is-valid");
           return true;
        }
    }
}
function validProfession() {
    if($('#edt_ct_profession').val() == ''){
        $('#edt_ct_profession').addClass('is-invalid');
        $('#edt_ct_profession').removeClass('is-valid');
        return false;
    }else{
        $('#edt_ct_profession').removeClass('is-invalid');
        $('#edt_ct_profession').addClass('is-valid');
        return true;
    } 
}
function validMobile(){
    if($('#edt_ct_mobile').val() == ''){
        $('#edt_ct_mobile').addClass("is-invalid");
        $('#validMobileA').removeClass('d-none');
        $('#validMobileB').addClass('d-none');
        return false;
    }else{
        if($('#edt_ct_mobile').val().length < 11){
            $('#edt_ct_mobile').addClass("is-invalid");
            $('#validMobileA').removeClass('d-none');
            $('#validMobileB').addClass('d-none');
            return false;
        }else{
            var fValue = $('#edt_ct_mobile').val().charAt(0);
            var sValue = $('#edt_ct_mobile').val().charAt(1);
            if( fValue == 0 && sValue == 9){
                $value = $('#edt_ct_mobile').val();
                $_token = $('meta[name="csrf-token"]').attr('content');
                var newData;

                $.ajax({
                    url: "/ajaxCheckMobile",
                    type:"POST",
                    async:false,
                    global:false,
                    data:{
                        numberValue:$value,
                        _token: $_token
                    },
                    success:function(data){
                        newData = data;
                    }
                });

                if(newData == 'has'){
                    if($('#edt_ct_mobile').val() != oldData.citizens_mobile){
                        $('#edt_ct_mobile').addClass("is-invalid");
                        $('#validMobileA').addClass('d-none');
                        $('#validMobileB').removeClass('d-none');
                        return false;
                    }else{
                        $('#edt_ct_mobile').removeClass("is-invalid");
                        return true;
                    }
                }else{
                    $('#edt_ct_mobile').removeClass("is-invalid");
                    return true;
                }

            }else{
                $('#edt_ct_mobile').addClass('is-invalid');
                $('#validMobileA').removeClass('d-none');
                $('#validMobileB').addClass('d-none');
                return false;
            }
        }
    }
}
function validPhoto() {
    if($.trim($('#edt_ct_photo').val())==""){
        $('#photo-label').text('Profile Photo : ' + oldData.citizens_img_src);
        document.getElementById("edt_ct_profile").src = "/images/profileid/" + oldData.citizens_img_src;
        $('#edt_ct_photo').removeClass('is-valid');
        return true;
    }else{
        var val = $('#edt_ct_photo').val();
        switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
            case 'gif': case 'jpg': case 'png': case 'jpeg':
               var fullPath = document.getElementById('edt_ct_photo').value;
               var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
               var filename = fullPath.substring(startIndex);
               if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                  filename = filename.substring(1);
               }
               $('#photo-label').text('Profile Photo : ' + filename);

                var file = $("#edt_ct_photo").get(0).files[0];
                var reader = new FileReader();
                    reader.onload = function(){
                        $("#edt_ct_profile").attr("src", reader.result);
                    }
                    reader.readAsDataURL(file);
                $('#edt_ct_photo').addClass('is-valid');
               return true;

            default:
               $('#photo-label').text('Profile Photo : ' +  oldData.citizens_img_src);
               document.getElementById("edt_ct_profile").src = "/images/profileid/" + oldData.citizens_img_src;
               $('#edt_ct_photo').removeClass('is-valid');
               $('#edt_ct_photo').val(''); 
               return true;
        }
    }
}
function validProv() {
    if($('#edt_per_province').val() == oldData.province_id)
        $('#edt_per_province').removeClass('is-valid');
    else
        $('#edt_per_province').addClass('is-valid');
}
function validMuni() {
    if($('#edt_per_municipality').val() == 0){
        $('#edt_per_municipality').addClass('is-invalid');
        $('#edt_per_municipality').removeClass('is-valid');
        return false;
    }else{
        $('#edt_per_municipality').removeClass('is-invalid');
        $('#edt_per_municipality').addClass('is-valid');
        return true;
    }
}
function validBrgy() {
    $('#edt_per_barangay').removeClass('is-valid is-invalid');
    if($('#edt_per_barangay').find(":selected").val() == "0"){
        $('#edt_per_barangay').addClass('is-invalid');
        return false;
    }else{
        $('#edt_per_barangay').addClass('is-valid');
        return true;
    }
}
function validZone() {
    $('#edt_per_zone').removeClass('is-valid is-invalid');
    if($('#edt_per_province').find(":selected").val() == 20){
        if($('#edt_per_municipality').find(":selected").val() == 361){
            if($('#edt_per_zone').find(":selected").val() == 0){
                $('#edt_per_zone').addClass('is-invalid');
                return false;
            }else{
                $('#edt_per_zone').addClass('is-valid');
                return true;
            }
        }else{
            if($('#edt_per_municipality').find(":selected").val() == 0){
                $('#edt_per_zone').addClass("is-invalid");
                return false;
            }else{
                return true;
            }
        }
    }else{
        if($('#edt_per_municipality').find(":selected").val() == 0){
            if($('#edt_per_zone').find(":selected").val() == 0){
                $('#edt_per_zone').addClass("is-invalid");
                return false;
            }
        }else{
            $('#edt_per_zone').addClass('is-valid');
            return true;
        }
    }
}
function validZoneField() {
    if($('#edt_per_province').val() != 20){
        if($('#edt_per_municipality') != 361){
            if($('#edt_per_zone_field').val()==""){
                $('#edt_per_zone_field').removeClass("is-valid");
                return true;
            }else{
                $('#edt_per_zone_field').addClass("is-valid");
                return true;
            }
        }
    }else{
        if($('#edt_per_municipality') != 0){
            if($('#edt_per_zone_field').val()==""){
                $('#edt_per_zone_field').removeClass("is-valid");
                return true;
            }else{
                $('#edt_per_zone_field').addClass("is-valid");
                return true;
            }
        }
    }
}
function validProvCur() {
    if($('#edt_cur_province').val() == oldData.province_id_current)
        $('#edt_cur_province').removeClass('is-valid');
    else
        $('#edt_cur_province').addClass('is-valid');
}
function validMuniCur() {
    if($('#edt_cur_municipality').val() == 0){
        $('#edt_cur_municipality').addClass('is-invalid');
        $('#edt_cur_municipality').removeClass('is-valid');
        return false;
    }else{
        $('#edt_cur_municipality').removeClass('is-invalid');
        $('#edt_cur_municipality').addClass('is-valid');
        return true;
    }
}
function validBrgyCur() {
    $('#edt_cur_barangay').removeClass('is-valid is-invalid');
    if($('#edt_cur_barangay').find(":selected").val() == 0){
        $('#edt_cur_barangay').addClass('is-invalid');
        return false;
    }else{
        $('#edt_cur_barangay').addClass('is-valid');
        return true;
    }
}
function validZoneCur() {
    $('#edt_cur_zone').removeClass('is-valid is-invalid');
    if($('#edt_cur_province').find(":selected").val() == 20){
        if($('#edt_cur_municipality').find(":selected").val() == 361){
            if($('#edt_cur_zone').find(":selected").val() == 0){
                $('#edt_cur_zone').addClass('is-invalid');
                return false;
            }else{
                $('#edt_cur_zone').addClass('is-valid');
                return true;
            }
        }else{
            if($('#edt_cur_municipality').find(":selected").val() == 0){
                $('#edt_cur_zone').addClass("is-invalid");
                return false;
            }else{
                return true;
            }
        }
    }else{
        if($('#edt_cur_municipality').find(":selected").val() == 0){
            if($('#edt_cur_zone').find(":selected").val() == 0){
                $('#edt_cur_zone').addClass("is-invalid");
                return false;
            }
        }else{
            $('#edt_cur_zone').addClass('is-valid');
            return true;
        }
    }
}
function validZoneFieldCur() {
    if($('#edt_cur_province').val() != 20){
        if($('#edt_cur_municipality') != 361){
            if($('#edt_cur_zone_field').val()==""){
                $('#edt_cur_zone_field').removeClass("is-valid");
                return true;
            }else{
                $('#edt_cur_zone_field').addClass("is-valid");
                return true;
            }
        }
    }else{
        if($('#edt_cur_municipality') != 0){
            if($('#edt_cur_zone_field').val()==""){
                $('#edt_cur_zone_field').removeClass("is-valid");
                return true;
            }else{
                $('#edt_cur_zone_field').addClass("is-valid");
                return true;
            }
        }
    }
}

function changeFname() {
    if(oldData.citizens_fname != $('#edt_ct_fname').val())
        return true;
    else
        return false;
}
function changeMname() {
    if(oldData.citizens_mname != $('#edt_ct_mname').val())
        return true;
    else
        return false;
}
function changeLname() {
    if(oldData.citizens_lname != $('#edt_ct_lname').val())
        return true;
    else
        return false;
}
function changeSuffix() {
    if($('#edt_ct_suffix').val() == 0){
        if(oldData.citizens_suffix != null)
            return true;
        else
            return false;
    }else{
        if(oldData.citizens_suffix != $('#edt_ct_suffix').val())
            return true;
        else
            return false; 
    }
}
function changeMonth() {
    if(oldData.citizens_bday.substr(5,2) != $('#edt_ct_month').val())
        return true;
    else
        return false;
}
function changeDay() {
    if($('#edt_ct_day').val() != parseInt(oldData.citizens_bday.substr(8,2)))
        return true;
    else
        return false;
}
function changeYear() {
    if(oldData.citizens_bday.substr(0,4) != $('#edt_ct_year').val())
        return true;
    else   
        return false;
}
function changeGender() {
    if(oldData.citizens_gender != $('#edt_ct_gender').val())
        return true;
    else
        return false;
}
function changeProfession() {
    if(oldData.citizens_profession != $('#edt_ct_profession').val())
        return true;
    else
        return false;
}
function changeMobile() {
    if(oldData.citizens_mobile != $('#edt_ct_mobile').val())
        return true;
    else   
        return false;
}
function changePhoto() {
    if($.trim($('#edt_ct_photo').val())!="")
        return true;
    else
        return false;
}
function changeProvince() {
    if(oldData.province_id != $('#edt_per_province').val())   
        return true;
    else
        return false;
}
function changeMuni() {
    if(oldData.municipalities_id != $('#edt_per_municipality').val())
        return true;
    else
        return false;
}
function changeBrgy() {
    if(oldData.barangays_id != $('#edt_per_barangay').val())
        return true;
    else
        return false;
}
function changeZone() {
    if($('#edt_per_province').val() == 20){
        if($('#edt_per_municipality').val() == 361){
            if(oldData.zones_id != null){
                if($('#edt_per_zone').val()  == oldData.zones_id){
                    return false;
                }else{
                    return true;
                }
            }else{
                if($('#edt_per_zone').val() != 0){
                    return true
                }else{
                    return false;
                }
            }
        }else{
            if(oldData.zones_id != null){
                if(oldData.citizen_to_zone.zones_name != $('#edt_per_zone_field').val()){
                    return true;
                }else{
                    return false;
                }
            }else{
                if($('#edt_per_zone_field').val() != ""){
                    return true;
                }else{
                    return false;
                }
            }
        }
    }else{
        if($('#edt_per_municipality').val() != 361){
            if(oldData.zones_id != null){
                if(oldData.citizen_to_zone.zones_name != $('#edt_per_zone_field').val()){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
    }
}
function changeBldg() {
    if($('#edt_per_bldg').val() != ""){
        if(oldData.citizen_add_address != $('#edt_per_bldg').val())
            return true;
        else
            return false;
    }else{
        if(oldData.citizen_add_address != null)
            return true;
        else
            return false;
    }
}
function changeProvinceCur() {
    if(oldData.province_id_current != $('#edt_cur_province').val())   
        return true;
    else
        return false;
}
function changeMuniCur() {
    if(oldData.municipalities_id_current != $('#edt_cur_municipality').val())
        return true;
    else
        return false;
}
function changeBrgyCur() {
    if(oldData.barangays_id_current != $('#edt_cur_barangay').val())
        return true;
    else
        return false;
}
function changeZoneCur() {
    if($('#edt_cur_province').val() == 20){
        if($('#edt_cur_municipality').val() == 361){
            if(oldData.zones_id_current != null){
                if($('#edt_cur_zone').val()  == oldData.zones_id_current){
                    return false;
                }else{
                    return true;
                }
            }else{
                if($('#edt_cur_zone').val() != 0){
                    return true
                }else{
                    return false;
                }
            }
        }else{
            if(oldData.zones_id_current != null){
                if(oldData.citizen_to_zone.zones_name != $('#edt_cur_zone_field').val()){
                    return true;
                }else{
                    return false;
                }
            }else{
                if($('#edt_cur_zone_field').val() != ""){
                    return true;
                }else{
                    return false;
                }
            }
        }
    }else{
        if($('#edt_cur_municipality').val() != 361){
            if(oldData.zones_id != null){
                if(oldData.citizen_to_zone.zones_name != $('#edt_cur_zone_field').val()){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
    }
}
function changeBldgCur() {
    if($('#edt_cur_bldg').val() != ""){
        if(oldData.citizen_add_address_current != $('#edt_cur_bldg').val())
            return true;
        else
            return false;
    }else{
        if(oldData.citizen_add_address_current != null)
            return true;
        else
            return false;
    }
}

function dt(gender, verification, p_province, p_municipality, p_barangay, p_zone, c_province, c_municipality, c_barangay, c_zone){
    $("#citizen_info").DataTable({
        responsive:true,
        "language": {
            "search": "Search here : ",
            searchPlaceholder:  "Search for... (e.g Juan)",
            "processing": "Please wait processing ..."
        },
        pagingType: "simple",
        fnDrawCallback: function() {
            if($('#citizen_info').DataTable().page.info().recordsTotal > 10){
                $('.dataTables_paginate').show();
            }else{
                if($('#citizen_info').DataTable().page.info().end > 10){
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
            url:"/citizen/getCitizenInfo",
            data:   {
               "gender":gender,
                "verification":verification,
                "p_province":p_province,
                "p_municipality":p_municipality,
                "p_barangay":p_barangay,
                "p_zone":p_zone,
                "c_province":c_province,
                "c_municipality":c_municipality,
                "c_barangay":c_barangay,
                "c_zone":c_zone
            }
        },
        columns:[
            {data: "id",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data:"citizens_fname"},
            {data:"citizens_mname"},
            {data:"citizens_lname"},
            {data:"citizens_suffix"},
            {data:"citizens_gender"},
            {data:"citizens_bday"},
            {data:"citizens_mobile"},
            {data:"citizens_profession"},
            {data:"citizen_add_address"},
            {data:"get_main_zone",
                render: function(data, type, row) {
                    if(data == null){
                        return '';
                    }else{
                        return data.zones_name;
                    }
                }
            },
            {data:"get_main_barangay.barangays_name"},
            {data:"get_main_municipality.municipalities_name"},
            {data:"get_main_province.province_name"},
            {data:"citizen_add_address_current"},
            {data:"citizen_to_zone",
                render: function(data, type, row) {
                    if(data == null){
                        return '';
                    }else{
                        return data.zones_name;
                    }
                }
            },
            {data:"citizen_to_barangay.barangays_name"},
            {data:"citizen_to_municipality.municipalities_name"},
            {data:"citizen_to_province.province_name"},
            {data:"citizen_to_verify.verifications_name"},
            {data:"citizens_id"},
            
        ],
        columnDefs:[
            { className: "dt-center all", searchable:false, "targets": [ 0 ] },
            {
                targets: [1],
                "orderable": true, className: "dt-nowrap all",
                render: function(data, type, row ){
                    if(row.citizens_suffix != null){
                        return nameTable(data + ' ' +row.citizens_mname + ' ' + row.citizens_lname )+ ' ' + row.citizens_suffix ;
                    }else{
                        return nameTable(data + ' ' +row.citizens_mname + ' ' + row.citizens_lname );
                    }
                   
                }
            },
            {
                targets: [2,3,4,10,11,12,13,15,16,17,18],"orderable": false, "visible": false, "searchable": false
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
                targets:[8], width:"12%"
            },
            {
                targets:[9],
                render:function (data, type, row) {
                    if(data != null){
                        if(row.get_main_zone != null){
                            return data + ', ' + row.get_main_zone.zones_name + ', ' + row.get_main_barangay.barangays_name + ', ' + row.get_main_municipality.municipalities_name + ', ' + row.get_main_province.province_name;  
                        }else{
                            return data + ', ' + row.get_main_barangay.barangays_name + ', ' + row.get_main_municipality.municipalities_name + ', ' + row.get_main_province.province_name;
                        }
                    }else{
                        if(row.get_main_zone != null){
                            return row.get_main_zone.zones_name + ', ' + row.get_main_barangay.barangays_name + ', ' + row.get_main_municipality.municipalities_name + ', ' + row.get_main_province.province_name;  
                        }else{
                            return row.get_main_barangay.barangays_name + ', ' + row.get_main_municipality.municipalities_name + ', ' + row.get_main_province.province_name;  
                        }
                    }
                }
            },

            {
                targets:[14],
                render:function(data, type, row) {
                    if(data != null){
                        if(row.citizen_to_zone != null){
                            return data + ', ' + row.citizen_to_zone.zones_name + ', ' + row.citizen_to_barangay.barangays_name + ', ' + row.citizen_to_municipality.municipalities_name + ', ' + row.get_main_province.province_name;  
                        }else{
                            return data + ', ' + row.citizen_to_barangay.barangays_name + ', ' + row.citizen_to_municipality.municipalities_name + ', ' + row.get_main_province.province_name;  
                        }
                    }else{
                        if(row.citizen_to_zone != null){
                            return row.citizen_to_zone.zones_name + ', ' + row.citizen_to_barangay.barangays_name + ', ' + row.citizen_to_municipality.municipalities_name + ', ' + row.get_main_province.province_name;  
                        }else{
                            return row.citizen_to_barangay.barangays_name + ', ' + row.citizen_to_municipality.municipalities_name + ', ' + row.get_main_province.province_name;  
                        }
                    }
                }
            },
            {
                targets:[20], className:"dt-center", orderable:false,
                render:function(data, type, row) {
                    return '<div class="dropdown"><button class="btn  btn-sm btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-tools"></i></button><div class="dropdown-menu tableActionMenu" aria-labelledby="dropdownMenuButton"><a class="dropdown-item" onClick="editPerson(this.id);" id="' + data+ '" ><i class="fa fa-edit"></i> Edit</a><a class="dropdown-item" id="' + data+ '"  onClick="view(this.id);" ><i class="fa fa-eye"></i> View</a></div>';
                }
            }
        ]
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
$(window).resize(function() {
    $('#citizen_info').DataTable().columns.adjust().draw();
});
function nameTable(data){
    return data.replace(
        /\w\S*/g,
        function(txt) {
          return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
        }
    );
}
function getAddress(){
    $_token = $('meta[name="csrf-token"]').attr('content');
    var address = 'true';
    $.ajax({
        type:'POST',
        url: "/ajaxGetAddress",
        data: {_token: $_token,address:address},
        success: function(data){
            province = data.province;
            municipality = data.municipality;
            barangay = data.barangay;
            zone = data.zone;
        }
   });
}