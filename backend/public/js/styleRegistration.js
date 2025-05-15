var checkField;var province;var municipality;var barangay;var zone;

function validateFirst(){
   if($('#firstName').val()==""){
      $('#firstName').addClass("is-invalid");
      $('#firstName').removeClass("is-valid");
      checkField.fname = "false";
   }else{
      $('#firstName').addClass("is-valid");
      $('#firstName').removeClass("is-invalid");
      checkField.fname = "true";
   }
}
function validateMiddle(){
   if($('#middleName').val()==""){
      $('#middleName').addClass("is-invalid");
      $('#middleName').removeClass("is-valid");
      checkField.mname = "false";
   }else{
      $('#middleName').addClass("is-valid");
      $('#middleName').removeClass("is-invalid");
      checkField.mname = "true";
   }
}
function validateLast(){
   if($('#lastName').val()==""){
      $('#lastName').addClass("is-invalid");
      $('#lastName').removeClass("is-valid");
      checkField.lname = "false";
   }else{
      $('#lastName').addClass("is-valid");
      $('#lastName').removeClass("is-invalid");
      checkField.lname = "true";
   }
}
function validateMonth(){
   if($('#month').val()==0){
      $('#month').addClass("is-invalid");
      $('#month').removeClass("is-valid");
      checkField.month = "false";
   }else{
      $('#month').addClass("is-valid");
      $('#month').removeClass("is-invalid");
      checkField.month = "true";
   }
}
function validateDay(){
   if($('#day').val()==""){
      $('#day').addClass("is-invalid");
      $('#day').removeClass("is-valid");
      checkField.day = "false";
   }else{
      if($('#day').val() > 31 || $('#day').val() == 0){
         $('#day').addClass("is-invalid");
         $('#day').removeClass("is-valid");
         $('#day').val('');
         checkField.day = "false";
      }else{
         $('#day').addClass("is-valid");
         $('#day').removeClass("is-invalid");
         checkField.day = "true";
      }
   }
}
function validateYear(){
   if($('#year').val()==""){
      $('#year').addClass("is-invalid");
      $('#year').removeClass("is-valid");
      checkField.year = "false";
   }else{
      if($('#year').val() < 1920 || $('#year').val() == 0 || $('#year').val() > 2010){
         $('#year').addClass("is-invalid");
         $('#year').removeClass("is-valid");
         $('#year').val('');
         checkField.year = "false";
      }else{
         $('#year').addClass("is-valid");
         $('#year').removeClass("is-invalid");
         checkField.year = "true";
      }
   }
}
function validateGender(){
   if($('#gender').val()==0){
      $('#gender').addClass("is-invalid");
      $('#gender').removeClass("is-valid");
      checkField.gender = "false";
   }else{
      $('#gender').addClass("is-valid");
      $('#gender').removeClass("is-invalid");
      checkField.gender = "true";
   }
}
function validateProfession(){
   if($('#profession').val()==""){
      $('#profession').addClass("is-invalid");
      $('#profession').removeClass("is-valid");
      checkField.profession = "false";
   }else{
      $('#profession').addClass("is-valid");
      $('#profession').removeClass("is-invalid");
      checkField.profession = "true";
   }
}
function validateMobile(){
   if($('#mobile').val()==""){
      $('#mobile').addClass("is-invalid");
      $('#mobile').removeClass("is-valid");
      checkField.mobile = "false";
   }else{
      if($('#mobile').val().length < 11){
         $('#mobile').addClass("is-invalid");
         $('#mobile').removeClass("is-valid");
         checkField.mobile = "false";
      }else{
         var fValue = $('#mobile').val().charAt(0);
         var sValue = $('#mobile').val().charAt(1);
         if( fValue == 0 && sValue == 9){


            $value = $('#mobile').val();
            $_token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
               url: "/ajaxCheckMobile",
               type:"POST",
               data:{
                  numberValue:$value,
                  _token: $_token
               },
               success:function(success){
                  if(success == 'has'){
                     $('#mobile').addClass("is-invalid");
                     $('#mobile').removeClass("is-valid");
                     checkField.mobile = "false";
                  }else{
                     $('#mobile').addClass("is-valid");
                     $('#mobile').removeClass("is-invalid");
                     checkField.mobile = "true";
                  }
               }
            });

            
            
         }else{
            $('#mobile').addClass("is-invalid");
            $('#mobile').removeClass("is-valid");
            checkField.mobile = "false";
         }
      }
   }
}
function validatePhoto(){
   if($.trim($('#photo').val())==""){
      $('#photo').addClass("is-invalid");
      $('#photo').removeClass("is-valid");
      $('#photo-label').text('Profile Photo (Choose file)');
      checkField.photo = "false";
      $('#photoHelp').addClass('d-none');
   }else{
      var val = $('#photo').val();
      switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
         case 'gif': case 'jpg': case 'png':
            var fullPath = document.getElementById('photo').value;
            var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
            var filename = fullPath.substring(startIndex);
            if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
               filename = filename.substring(1);
            }
            $('#photo-label').text('Profile Photo : ' + filename);
            $('#photo').addClass("is-valid");
            $('#photo').removeClass("is-invalid");
            $('#photoHelp').removeClass('d-none');
            checkField.photo = "true";
            break;
         default:
            $('#photo').addClass("is-invalid");
            $('#photo').removeClass("is-valid");
            $('#photo-label').text('Profile Photo (Choose file)');
            checkField.photo = "false";
            $('#photoHelp').addClass('d-none');
            break;
     }
   }
}
function validateProvince(){
   if($('#province').val()==0){
      $('#province').addClass("is-invalid");
      $('#province').removeClass("is-valid");
   }else{
      $('#province').addClass("is-valid");
      $('#province').removeClass("is-invalid");

      $('#municipality').removeClass("is-valid");
      $('#barangay').removeClass("is-valid");
      $('#zone').removeClass("is-valid");
      $('#zone_field').removeClass("is-valid");
      $('#zone').removeClass("is-invalid");
   }
}
function validateMunicipality(){
   if($('#municipality').val()==0){
      $('#municipality').addClass("is-invalid");
      $('#municipality').removeClass("is-valid");
      checkField.muni = "false";
   }else{
      $('#municipality').addClass("is-valid");
      $('#municipality').removeClass("is-invalid");

      $('#barangay').removeClass("is-valid");
      $('#zone').removeClass("is-valid");
      $('#zone_field').removeClass("is-valid");

      checkField.muni = "true";
      checkField.brgy = "false";
      checkField.zone = "false";
   }
}
function validateBrgy(){
   if($('#barangay').val()==0){
      $('#barangay').addClass("is-invalid");
      $('#barangay').removeClass("is-valid");
      checkField.brgy = "false";
   }else{
      $('#barangay').addClass("is-valid");
      $('#barangay').removeClass("is-invalid");

      $('#zone').removeClass("is-valid");
      $('#zone_field').removeClass("is-valid");

      checkField.brgy = "true";
      checkField.zone = "false";
   }
}
function validateZoneSelect(){
   if($('#province').val() == 20){
      if($('#municipality').val() == 361){
         if($('#zone').val()== 0){
            $('#zone').addClass("is-invalid");
            $('#zone').removeClass("is-valid");
            checkField.zone = "false";
         }else{
            $('#zone').addClass("is-valid");
            $('#zone').removeClass("is-invalid");
            checkField.zone = "true";
         }
      }else{
         if($('#municipality').val() == 0){
            $('#zone').addClass("is-invalid");
            $('#zone').removeClass("is-valid");
            checkField.zone = "false";
         }else{
            checkField.zone = "true";
         }
      }
   }else{
      if($('#municipality').val() == 0){
         if($('#zone').val()== 0){
            $('#zone').addClass("is-invalid");
            $('#zone').removeClass("is-valid");
            checkField.zone = "false";
         }
      }
   }
}
function validateZoneField(){
   if($('#province').val() != 20){
      if($('#municipality') != 361){
         if($('#zone_field').val()==""){
            $('#zone_field').removeClass("is-valid");
            checkField.zone = "true";
         }else{
            $('#zone_field').addClass("is-valid");
            checkField.zone = "true";
         }
      }
   }
}
function validateProvinceCur(){
   if($('#province_current').val()==0){
      $('#province_current').addClass("is-invalid");
      $('#province_current').removeClass("is-valid");
      checkField.provC = "false";
   }else{
      $('#province_current').addClass("is-valid");
      $('#province_current').removeClass("is-invalid");

      $('#municipality_current').removeClass("is-valid");
      $('#barangay_current').removeClass("is-valid");
      $('#zone_current').removeClass("is-valid");
      $('#zone_field_current').removeClass("is-valid");
      $('#zone_current').removeClass("is-invalid");

      checkField.provC = "true";
      checkField.muniC = "false";
      checkField.brgyC = "false";
      checkField.zoneC = "false";
   }
}
function validateMunicipalityCur(){
   if($('#municipality_current').val()==0){
      $('#municipality_current').addClass("is-invalid");
      $('#municipality_current').removeClass("is-valid");
      checkField.muniC = "false";
   }else{
      $('#municipality_current').addClass("is-valid");
      $('#municipality_current').removeClass("is-invalid");

      $('#barangay_current').removeClass("is-valid");
      $('#zone_current').removeClass("is-valid");
      $('#zone_field_current').removeClass("is-valid");
      checkField.muniC = "true";
      checkField.brgyC = "false";
      checkField.zoneC = "false";
   }
}
function validateBrgyCur(){
   if($('#barangay_current').val()==0){
      $('#barangay_current').addClass("is-invalid");
      $('#barangay_current').removeClass("is-valid");
      checkField.brgyC = "false";
   }else{
      $('#barangay_current').addClass("is-valid");
      $('#barangay_current').removeClass("is-invalid");
      checkField.brgyC = "true";
      $('#zone_current').removeClass("is-valid");
      $('#zone_field_current').removeClass("is-valid");
      checkField.zoneC = "false";
   }
}
function validateZoneSelectCur(){
   if($('#province_current').val() == 20){
      if($('#municipality_current').val() == 361){
         if($('#zone_current').val()== 0){
            $('#zone_current').addClass("is-invalid");
            $('#zone_current').removeClass("is-valid");
            checkField.zoneC = "false";
         }else{
            $('#zone_current').addClass("is-valid");
            $('#zone_current').removeClass("is-invalid");
            checkField.zoneC = "true";        
         }
      }else{
         if($('#municipality_current').val() == 0){
            $('#zone_current').addClass("is-invalid");
            $('#zone_current').removeClass("is-valid");
            checkField.zoneC = "false";
         }else{
            checkField.zoneC = "true";
         }
      }
   }else{
      if($('#municipality_current').val() == 0){
         if($('#zone_current').val()== 0){
            $('#zone_current').addClass("is-invalid");
            $('#zone_current').removeClass("is-valid");
            checkField.zoneC = "false";
         }
      }
   }
}
function validateZoneFieldCur(){
   if($('#province_current').val() != 20){
      if($('#municipality_current') != 361){
         if($('#zone_field_current').val()==""){
            $('#zone_field_current').removeClass("is-valid");
            checkField.zoneC = "true";
         }else{
            $('#zone_field_current').addClass("is-valid");
            checkField.zoneC = "true";
         }
      }
   }
}

function chkCurrentTrue(){
   var $municipality = $('#municipality');
   var $barangay = $('#barangay');
   var $zone = $('#zone');
   var $curMunicipality = $('#municipality_current');
   var $curBarangay = $('#barangay_current');
   var $curZone = $('#zone_current');

   $('#currentAddress').addClass('hidden');
      $('#currentAddress').removeClass('show');

      var selectedProvince = $('#province').val();
      var selectedMunicipality = $('#municipality').val();
      var selectedBarangay = $('#barangay').val();
      var selectedBldg = $('#details').val();
      if (selectedMunicipality == 361){
         var selectedZone = $('#zone').val();
      }else{
         var fieldZone = $('#zone_field').val();
      }

      $('#province_current').val(selectedProvince);
      $curMunicipality.append('<option id=' + selectedMunicipality + ' value=' + selectedMunicipality + ' selected hidden></option>');
      $curBarangay.append('<option id=' + selectedBarangay + ' value=' + selectedBarangay + ' selected hidden></option>');

      if (selectedMunicipality == 361){
         $curZone.append('<option id=' + selectedZone + ' value=' + selectedZone + ' selected hidden></option>');
      }else{
         $('#zone_field_current').val(fieldZone);
      }

      $('#details_current').val(selectedBldg);


      checkField.provC = "true";
      checkField.muniC = "true";
      checkField.brgyC = "true";
      checkField.zoneC = "true";
}
function chkCurrentFalse(){
   var $municipality = $('#municipality');
   var $barangay = $('#barangay');
   var $zone = $('#zone');
   var $curMunicipality = $('#municipality_current');
   var $curBarangay = $('#barangay_current');
   var $curZone = $('#zone_current');

   $('#currentAddress').removeClass('hidden');
      $('#currentAddress').addClass('show');

      falseField();

      $('#province_current').val(0);
      $curMunicipality.empty();
      $curMunicipality.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
      $curMunicipality.append('<option id=' + 0 + ' value=' + 0 + ' disabled>Please select Province first.</option>');

      $curBarangay.empty();
      $curBarangay.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
      $curBarangay.append('<option id=' + 0 + ' value=' + 0 + ' disabled>Please select Municipality first.</option>');

      $curZone.empty();
      $curZone.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
      $curZone.append('<option id=' + 0 + ' value=' + 0 + ' disabled>Please select Barangay first.</option>');

      $('#province_current').removeClass('is-valid');
      $('#province_current').removeClass('is-invalid');
      $('.label-curProvince').removeClass('active');

      $('#municipality_current').removeClass('is-valid');
      $('#municipality_current').removeClass('is-invalid');
      $('.label-curMunicipality').removeClass('active');

      $('#barangay_current').removeClass('is-valid');
      $('#barangay_current').removeClass('is-invalid');
      $('.label-curBarangay').removeClass('active');

      $('#zone_current').removeClass('is-valid');
      $('#zone_current').removeClass('is-invalid');
      $('.label-curZone').removeClass('active');

      $('#zone_field_current').val('');
      $('#zone_field_current').removeClass('is-valid');
      $('#zone_field_current').removeClass('is-invalid');
      $('.label-curZone-field').removeClass('active');


      $('#details_current').val('');
      $('.label-curDetail').removeClass('active');

      checkField.provC = "false";
      checkField.muniC = "false";
      checkField.brgyC = "false";
      checkField.zoneC = "false";
}

function falseField(){
   document.getElementById('submitForm').disabled = true;
   document.getElementById("chkTerms").checked = false;
}


$(document).ready(function(){
   getAddress();
   checkField = {"fname":"false", "mname":"false", "lname":"false", "month":"false", "day":"false", "year":"false", "gender":"false", "profession":"false", "mobile":"false", "photo":"false", "prov":"false", "muni":"false", "brgy":"false", "zone":"false", "provC":"false", "muniC":"false", "brgyC":"false", "zoneC":"false"};
   
   $(".form-group .form-control").blur(function(){
      if($(this).val()!="" && $(this).val()!=0){
        $(this).siblings("label").addClass("active");
      }else{
         $(this).siblings("label").removeClass("active");
      }
   });

   var $municipality = $('#municipality');
   var $barangay = $('#barangay');
   var $zone = $('#zone');
   var $curMunicipality = $('#municipality_current');
   var $curBarangay = $('#barangay_current');
   var $curZone = $('#zone_current');

   $municipality.empty();
   $municipality.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
   $municipality.append('<option id=' + 0 + ' value=' + 0 + ' disabled>Please select Province first.</option>');
   $barangay.empty();
   $barangay.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
   $barangay.append('<option id=' + 0 + ' value=' + 0 + ' disabled>Please select Municipality first.</option>');
   $zone.empty();
   $zone.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
   $zone.append('<option id=' + 0 + ' value=' + 0 + ' disabled>Please select Barangay first.</option>');
   $curMunicipality.empty();
   $curMunicipality.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
   $curMunicipality.append('<option id=' + 0 + ' value=' + 0 + ' disabled>Please select Province first.</option>');
   $curBarangay.empty();
   $curBarangay.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
   $curBarangay.append('<option id=' + 0 + ' value=' + 0 + ' disabled>Please select Municipality first.</option>');
   $curZone.empty();
   $curZone.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
   $curZone.append('<option id=' + 0 + ' value=' + 0 + ' disabled>Please select Barangay first.</option>');
         
   $('#province').change(function(){
      $selected_id = $("#province").val();
      $_token = $('meta[name="csrf-token"]').attr('content');

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

      $('.label-municipality').removeClass('active');
      $municipality.empty();
      $municipality.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
      
      Object.keys(municipality).forEach(function(key) {
         if(municipality[key].province_id == $('#province').val()){
            $municipality.append('<option  value=' + municipality[key].municipalities_id + '>'+ (municipality[key].municipalities_name.toLowerCase()).charAt(0).toUpperCase() + (municipality[key].municipalities_name.toLowerCase()).slice(1) +'</option>');
         }
     });

      $('.label-barangay').removeClass('active');
      $barangay.empty();
      $barangay.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
      $barangay.append('<option id=' + 0 + ' value=' + 0 + ' disabled>Please select Municipality first.</option>');

      $('.label-zone').removeClass('active');
      $zone.empty();
      $zone.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
      $zone.append('<option id=' + 0 + ' value=' + 0 + ' disabled>Please select Barangay first.</option>');

      $('.label-zone-field').removeClass('active');
      $('#zone_field').val('');

      $('.label-bldg').removeClass('active');
      $('#details').val('');

   });

   $('#municipality').change(function(){
      $selected_id = $("#municipality").val();
      $_token = $('meta[name="csrf-token"]').attr('content');
      $selected_prov = $("#province").val();

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

      $('.label-barangay').removeClass('active');
      $barangay.empty();
      $barangay.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
      Object.keys(barangay).forEach(function(key) {
         if(barangay[key].municipalities_id == $('#municipality').val()){
            $barangay.append('<option  value=' + barangay[key].barangays_id + '>'+ barangay[key].barangays_name +'</option>');
         }
      });

      $('.label-zone').removeClass('active');
      $zone.empty();
      $zone.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
      $zone.append('<option id=' + 0 + ' value=' + 0 + ' disabled>Please select Barangay first.</option>');

      $('.label-zone-field').removeClass('active');
      $('#zone_field').val('');

      $('.label-bldg').removeClass('active');
      $('#details').val('');

   });

   $('#barangay').change(function(){
      $selected_id = $("#barangay").val();
      $_token = $('meta[name="csrf-token"]').attr('content');

      $('.label-zone').removeClass('active');
      $zone.empty();
      $zone.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
      Object.keys(zone).forEach(function(key) {
         if(zone[key].barangays_id == $('#barangay').val()){
            $zone.append('<option  value=' + zone[key].zones_id + '>'+ zone[key].zones_name +'</option>');
         }
     });

      $('.label-zone-field').removeClass('active');
      $('#zone_field').val('');

      $('.label-bldg').removeClass('active');
      $('#details').val('');
   });

   $('#province_current').change(function(){
      $selected_id = $("#province_current").val()
      $_token = $('meta[name="csrf-token"]').attr('content');

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

      $('.label-curMunicipality').removeClass('active');
      $curMunicipality.empty();
      $curMunicipality.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');

      Object.keys(municipality).forEach(function(key) {
         if(municipality[key].province_id == $('#province_current').val()){
             $curMunicipality.append('<option  value=' + municipality[key].municipalities_id + '>'+ (municipality[key].municipalities_name.toLowerCase()).charAt(0).toUpperCase() + (municipality[key].municipalities_name.toLowerCase()).slice(1) +'</option>');
         }
     });

      $('.label-curBarangay').removeClass('active');
      $curBarangay.empty();
      $curBarangay.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
      $curBarangay.append('<option id=' + 0 + ' value=' + 0 + ' disabled>Please select Municipality first.</option>');

      $('.label-curZone').removeClass('active');
      $curZone.empty();
      $curZone.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
      $curZone.append('<option id=' + 0 + ' value=' + 0 + ' disabled>Please select Barangay first.</option>');

      $('.label-curZone-field').removeClass('active');
      $('#zone_field_current').val('');

      $('#details_current').val('');
      $('.label-curDetail').removeClass('active');
      

   });

   $('#municipality_current').change(function(){
      $selected_id = $("#municipality_current").val();
      $_token = $('meta[name="csrf-token"]').attr('content');
      $selected_prov = $("#province_current").val();

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

      $('.label-curBarangay').removeClass('active');
      $curBarangay.empty();
      $curBarangay.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
      Object.keys(barangay).forEach(function(key) {
         if(barangay[key].municipalities_id == $('#municipality_current').val()){
             $curBarangay.append('<option  value=' + barangay[key].barangays_id + '>'+ barangay[key].barangays_name +'</option>');
         }
     });

      $('.label-curZone').removeClass('active');
      $curZone.empty();
      $curZone.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
      $curZone.append('<option id=' + 0 + ' value=' + 0 + ' disabled>Please select Barangay first.</option>');

      $('.label-curZone-field').removeClass('active');
      $('#zone_field_current').val('');

      $('#details_current').val('');
      $('.label-curDetail').removeClass('active');

   });

   $('#barangay_current').change(function(){
      $selected_id = $("#barangay_current").val();
      $_token = $('meta[name="csrf-token"]').attr('content');

      $('.label-curZone').removeClass('active');
      $curZone.empty();
      $curZone.append('<option id=' + 0 + ' value=' + 0 + ' selected hidden></option>');
      Object.keys(zone).forEach(function(key) {
         if(zone[key].barangays_id == $('#barangay_current').val()){
            $curZone.append('<option  value=' + zone[key].zones_id + '>'+ zone[key].zones_name +'</option>');
         }
     });

      $('.label-curZone-field').removeClass('active');
      $('#zone_field_current').val('');

      $('#details_current').val('');
      $('.label-curDetail').removeClass('active');
   });
  
   $("#chkCurrent").change(function() {
      if($(this).prop('checked')) {
         chkCurrentTrue();
      } else {
         chkCurrentFalse();
      }
   });



   $("#chkAgree").change(function() {
      if($(this).prop('checked')) {
         $('.next-eula-a').addClass('show');
         $('.next-eula-a').removeClass('hidden');

         $('.next-eula-btn').addClass('hidden');
         $('.next-eula-btn').removeClass('show');

      } else {
         $('.next-eula-a').addClass('hidden');
         $('.next-eula-a').removeClass('show');

         $('.next-eula-btn').addClass('show');
         $('.next-eula-btn').removeClass('hidden');
      }
   });

   function emptyBldg(){
      $('#details').val('');
      $('#details').removeClass("is-valid");
      $('.label-bldg').removeClass('active');
   }
   function emptyBldgCurrent(){
      $('#details_current').val('');
      $('#details_current').removeClass("is-valid");
      $('.label-curDetail').removeClass('active');
   }

   $('#firstName').change(function(){
      validateFirst();
      falseField();
   });
   
   $('#middleName').change(function(){
      validateMiddle();
      falseField();
   });
   
   $('#lastName').change(function(){
      validateLast();
      falseField();
   });

   $('#suffix').change(function(){
      if($(this).val() != '0'){
         $(this).addClass("is-valid");
      }else{
         $(this).removeClass("is-valid");
      }
      falseField();
   });
   
   $('#month').change(function(){
      validateMonth();
      falseField();
   });

   $('#day').change(function(){
      validateDay();
      falseField();
   });
   
   $('#year').change(function(){
      validateYear();
      falseField();
   });

   $('#gender').change(function(){
      validateGender();
      falseField();
   });

   $('#profession').change(function(){
      validateProfession();
      falseField();
   });

   $('#mobile').change(function(){
      validateMobile();
      falseField();
   });

   $('#photo').change(function(){
      validatePhoto();
      falseField();
   });

   $('#province').change(function(){
      validateProvince();
      falseField();
      emptyBldg();
   });

   $('#municipality').change(function(){
      validateMunicipality();
      falseField();
      emptyBldg();
   });

   $('#barangay').change(function(){
      validateBrgy();
      falseField();
      emptyBldg();
   });
   
   $('#zone').change(function(){
      validateZoneSelect();
      falseField();
      emptyBldg();
   });

   $('#zone_field').change(function(){
      validateZoneField();
      falseField();
      emptyBldg();
   });

   $('#details').change(function(){
      if($(this).val()==""){
         $('#details').removeClass("is-valid");
      }else{
         $('#details').addClass("is-valid");
      }
      falseField();
   });

   $('#province_current').change(function(){
      validateProvinceCur();
      falseField();
      emptyBldgCurrent();
   });

   $('#municipality_current').change(function(){
      validateMunicipalityCur();
      falseField();
      emptyBldgCurrent();
   });

   $('#barangay_current').change(function(){
      validateBrgyCur();
      falseField();
      emptyBldgCurrent();
   });

   $('#zone_current').change(function(){
      validateZoneSelectCur();
      falseField();
      emptyBldgCurrent();
   });

   $('#zone_field_current').change(function(){
      validateZoneFieldCur();
      falseField();
      emptyBldgCurrent();
      
   });

   $('#details_current').change(function(){
      if($(this).val()==""){
         $('#details_current').removeClass("is-valid");
      }else{
         $('#details_current').addClass("is-valid");
      }
   });
   
   // $('#chkTerms').change(function(){
   
   //    if($('#chkTerms').prop('checked')) {


   //    }
   // });

   $('#submitForm').click(function(){

      if($('#chkCurrent').prop('checked')) {
         chkCurrentTrue();
      } else {
         if(checkField['provC'] == 'false' &&  checkField['muniC'] =='false' && checkField['brgyC'] == 'false'){
            chkCurrentFalse();
         }
      }

      validateFirst();
      validateMiddle();
      validateLast();
      validateMonth();
      validateDay();
      validateYear();
      validateGender();
      validateProfession();
      validateMobile();
      validatePhoto();
      validateProvince();
      validateMunicipality();
      validateBrgy();
      validateZoneSelect();
      validateZoneField();
      validateProvinceCur();
      validateMunicipalityCur();
      validateBrgyCur();
      validateZoneSelectCur();
      validateZoneFieldCur();  

      var checkFalseField = 0;
      Object.keys(checkField).forEach(function(key) {
         if(checkField[key] == 'false'){
            checkFalseField++;
         }
       });

      if(checkFalseField > 0){
         $('#required').addClass('show');
         $('#required').removeClass('hidden');
         $('html, body').animate({
            scrollTop: $("#formTitle").offset().top
         }, 1500);

         falseField();
      }else{
         $('#required').addClass('hidden');
         $('#required').removeClass('show');
      }

   });


   $('#firstName').keypress(function (e) {
      testInputString(e);
   });
   $('#middleName').keypress(function (e) {
      testInputString(e);
   });
   $('#lastName').keypress(function (e) {
      testInputString(e);
   });
   $('#day').keypress(function (e) {
      testInputNumber(e);
      if(this.value.length==2){
         return false;
      }
   });
   $('#year').keypress(function (e) {
      testInputNumber(e);
      if(this.value.length==4){
         return false;
      } 
   });
   $('#profession').keypress(function (e) {
      testInputString(e);
   });
   $('#mobile').keypress(function (e) {
      testInputNumber(e);
      if(this.value.length==11){
         return false;
      } 
   });
});

function testInputString(key){
   var regex = new RegExp("^[a-zA-ZÑñ ]*$");
   var str = String.fromCharCode(!key.charCode ? key.which : key.charCode);
   if (regex.test(str)) {
       return true;
   }else{
       key.preventDefault();
       return false;
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
function getAddress(){
   $_token = $('meta[name="csrf-token"]').attr('content');
   var address = 'true';
   $.ajax({
       type:'POST',
       url: "/ajaxGetAddress",
       async:true,
       data: {_token: $_token,address:address},
       success: function(data){
           province = data.province;
           municipality = data.municipality;
           barangay = data.barangay;
           zone = data.zone;
       }
  });
}
