$(document).ready(function() {
    active();

    //eula start
    $('#nextEula').on('click', function () {
        if(!$('#chkAgree').prop('checked')){
            $('#chkAgree').addClass('is-invalid');
            $('#chkAgree').removeClass('is-valid');
        }else{
            window.location = "/register/form";
        }
    });

    $('#chkAgree').on('change',function() {
        if($('#chkAgree').prop('checked')){
            $('#chkAgree').addClass('is-valid');
            $('#chkAgree').removeClass('is-invalid');
        }
    });
    //eula end

    
})
function active(){
    $(".form-group .form-control").blur(function(){
        if($(this).val()!="" && $(this).val()!=0){
          $(this).siblings("label").addClass("active");
        }else{
           $(this).siblings("label").removeClass("active");
        }
        if($('#suffix').val() == 0){
            $('#suffix').siblings("label").addClass("active");
        }
    });
}