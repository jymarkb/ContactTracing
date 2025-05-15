$(document).ready(function(){

    var dt = new Date();
    var st = new Date(2020,9,1);

    $('#datepicker').datepicker({
        format:'mm/dd/yyyy',
        autoclose:true,
        endDate: "today",
        startDate: '9-1-2020'

    }).datepicker("setDate", new Date()).on('changeDate', function (ev) {
         $(this).datepicker('hide');
    });


    $('#callendarIcon').on('click',function(){
        $('#datepicker').datepicker('show');
    });


});