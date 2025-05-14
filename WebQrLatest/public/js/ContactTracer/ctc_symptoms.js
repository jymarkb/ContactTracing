$(document).ready(function() {
    dt();

    $('#add_modal').on('hidden.bs.modal',function() {
        $('#sname').val('');
        $('#sname').removeClass('is-invalid is-valid');
    });
    $('#sname').on('keypress',function(e) {
        keyString(e);
    })

    $('#sname').on('change',function() {
        validSname();
    });

    $('#add-new').on('click',function() {
        if(!validSname()){
            $('#field-toast').toast('show');
        }else{
            var formData = new FormData(document.getElementById('symptom-new'));
            $.ajax({
                type:'POST',
                url: "/postSymptom",
                data: formData,
                cache:false,
                async:false,
                contentType: false,
                processData: false,
                success: function(data){
                    if(data){
                        $('#add_modal').modal('toggle');
                        dt();
                    }
                }
           });
        }
    });

});

function validSname() {
    $('#sname').removeClass('is-invalid is-valid');
    if($('#sname').val() == ""){
        $('#sname').addClass('is-invalid');
        return false;
    }else{
        $('#sname').addClass('is-valid');
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

function  dt(){
    $("#symptoms_info").DataTable({
        responsive:true,
        "language": {
            "search": "Search here : ",
            searchPlaceholder:  "Search for... (e.g Juan)",
            "processing": "Please wait processing ..."
        },
        pagingType: "simple",
        fnDrawCallback: function(oSettings) {
            if($('#symptoms_info').DataTable().page.info().recordsTotal > 10){
                $('.dataTables_paginate').show();
            }else{
                if($('#symptoms_info').DataTable().page.info().end > 10){
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
            url:"/ctc/symptoms-table",
        },
        columns:[
            {data: "id",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data:"symptoms_description", name:"symptoms_description"},
        ],
        columnDefs:[
            { className: "dt-center" , "width": "4%", searchable:false, "targets": [ 0 ] },
        ]
    });
}       