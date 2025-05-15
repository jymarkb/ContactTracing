$(document).ready(function() {
    dt();
    selectName();

    $('#filterMale').click(function(){
        $('#filterFemale').prop('checked',false);
        filters();
    });
    $('#filterFemale').click(function(){
        $('#filterMale').prop('checked',false);
        filters();
    });
    $('#filter_description').on('change',function() {
        filters();
    })

    $('#add_modal').on('hidden.bs.modal',function() {
        resetValid();
    });

    $('#citizens_name').on('change',function() {
        $('#citizens_name').removeClass('is-valid is-invalid');
        validName();
    });
    $('#description').on('change',function() {
        $('#description').removeClass('is-valid is-invalid');
        validDesc();
    });

    $('#modalSpinner').on('shown.bs.modal', function (e) {
        newtag();
      })

    $('#add-new').on('click',function() {
        // $('#modalSpinner').modal('show');
        if(!validName() | !validDesc()){
            document.getElementById('scroll-up').click();
            $('#new-toast').toast('show');
        }else{
            $('#modalSpinner').modal('show');
        }
    });

    $('#filter-reset-btn').on('click', function() {
        $('#filterFemale').prop('checked',false);
        $('#filterMale').prop('checked',false);
        $('#filter_description').val('0');
        dt();
        document.getElementById('filter-btn').click();
    })

    $('.generateInfo').on('click',function() {
        if($('#tag_info').DataTable().data().any()){
            if(filter_gender() | filter_description()){
                $('#filter_modal').modal('show');
            }else{
                document.getElementById('downloadNoFilter').click();
                $('#generate-toast').toast('show');
            }
        }else{
            $('#generateError-toast').toast('show');
        }
    });

    $('#fltr_No').on('click', function() {
        document.getElementById('downloadNoFilter').click();
        $('#filter_modal').modal('toggle');
        $('#generate-toast').toast('show');
    });

    $('#fltr_Yes').on('click',function() {
        document.getElementById('downloadFilter').click();
        $('#filter_modal').modal('toggle');
        $('#generate-toast').toast('show');
        
    });

});

function newtag() {
    var formData = new FormData(document.getElementById('tag-new'));
    $.ajax({
        type:'POST',
        url: "/tag/add-new",
        data: formData,
        cache:false,
        async:false,
        contentType: false,
        processData: false,
        success: function(data){
            console.log(data);
            if(data == "exist"){
                resetValidation();
                document.getElementById('scroll-up').click();
                $('#exist-toast').toast('show');
                $('#modalSpinner').modal('hide');
            }else{
                $('#add_modal').modal('hide');
                document.getElementById('scroll-up').click();
                $('#success-toast').toast('show');
                $('#modalSpinner').modal('hide');
                dt();
            }
        }
    });
}

function validName() {
    if($('#citizens_name').find(":selected").val() == null){
        $('#citizens_name').addClass('is-invalid')
        return false;
    }
    else{
        $('#citizens_name').addClass('is-valid');
        return true;
    }     
}
function validDesc() {
    if($('#description').find(":selected").val() == '0'){
        $('#description').addClass('is-invalid');
        return false;  
    }
    else{
        $('#description').addClass('is-valid');
        return true;
    }     
}
function resetValid() {
    $("#citizens_name").select2("val", "");
    $("#citizens_name").val('').trigger('change')
    $('#description').val(0);
    resetValidation();
}
function resetValidation() {
    $('#citizens_name').removeClass('is-valid is-invalid');
    $('#description').removeClass('is-valid is-invalid');
}

function filter_gender() {
    if($('#filterMale').prop('checked')){
        $('#fltr_gender').text('Male');
        $('#row-gender').removeClass('d-none');
        return true;
    }else if($('#filterFemale').prop('checked')){
        $('#fltr_gender').text('Female');
        $('#row-gender').removeClass('d-none');
        return true;
    }else{
        $('#row-gender').addClass('d-none');
        return false;
    }
}
function filter_description() {
    if($('#filter_description').val() != "0"){
        $('#row-description').removeClass('d-none');
        $('#fltr_desc').text($('#filter_description option:selected').text());
        return true;
    }else{
        $('#row-description').addClass('d-none');
        return false;
    }
}

function filters() {
    var gender = ""; var description = "";

    if($('#filterMale').prop('checked')){
        gender = "Male";
    }
    if($('#filterFemale').prop('checked')){
        gender = "Female";
    }

    if($('#filter_description').val() != "0"){
        description = $('#filter_description').val();
    }
    dt(gender,description);
}

function dt(gender,description) {
    $("#tag_info").DataTable({
        responsive:true,
        "language": {
            "search": "Search here : ",
            searchPlaceholder:  "Search for... (e.g Juan)",
            "processing": "Please wait processing ..."
        },
        pagingType: "simple",
        fnDrawCallback: function(oSettings) {
            if($('#tag_info').DataTable().page.info().recordsTotal > 10){
                $('.dataTables_paginate').show();
            }else{
                if($('#tag_info').DataTable().page.info().end > 10){
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
            url:"/ctc/tagging-table",
            data:{
                gender:gender,
                description:description
            }
        },
        columns:[
            {data: "id",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data:"citizens_fname", name:"citizens_fname"},
            {data:"citizens_mname", name:"citizens_mname"},
            {data:"citizens_lname", name:"citizens_lname"},
            {data:"citizens_suffix", name:"citizens_suffix"},
            {data:"citizens_gender", name:"citizens_gender"},
            {data:"citizens_bday", name:"citizens_bday"},
            {data:"tag_desc_name", name:"tag_desc_name"},
            {data:"tags_date_time", name:"tags_date_time"},
            {data:"users_fname", name:"users_fname"},
            {data:"users_lname", name:"users_lname"},
            {data:"tags_id", name:"tags_id"},
            
        ],
        columnDefs:[
            { className: "dt-center all" , "width": "4%", searchable:false, "targets": [ 0 ] },
            {
                targets: [1], "orderable": true, className: "dt-nowrap all",
                render: function(data, type, row ){
                    if(row.citizens_suffix != null){
                        return nameTable(data + ' ' +row.citizens_mname + ' ' + row.citizens_lname )+ ' ' + row.citizens_suffix ;
                    }else{
                        return nameTable(data + ' ' +row.citizens_mname + ' ' + row.citizens_lname );
                    }
                }
            },
            {
                targets: [2,3,4,10],"orderable": false, "visible": false, "searchable": false
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
                targets:[7],className:"dt-nowrap",
            },
            {
                targets: [8],className:"dt-nowrap",
                render:function(data, type, row) {
                    var date = data.substr(0,10).replace(/(\d{4})\-(\d{2})\-(\d{2}).*/, '$2-$3-$1');
                    var time =  new Date(data).toLocaleTimeString().replace(/([\d+:[\d]{2})(:[\d]{2})(.*)/, "$1$3");
                    return date + ' ' + time;
                }
            },
            {
                targets: [9], className:"dt-nowrap",
                render:function(data, type, row) {
                    return nameTable(data) + ' ' + row.users_lname;
                }
            },
            {
                targets:[11],className: "dt-center", orderable:false, "width": "5%",
                render:function(data, type, row){
                    return '<div class="dropdown"> <button class="btn  btn-sm btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-tools"></i> </button> <div class="dropdown-menu tableActionMenu" aria-labelledby="dropdownMenuButton"><a class="dropdown-item edit-btn" id="'+ data + '" onClick="editAccount(this.id);"><i class="fa fa-edit"></i> Edit</a><a class="dropdown-item view-btn" id="'+ data + '" onClick="viewAccount(this.id);"><i class="fa fa-eye"></i> View</a></div></div>'
                }
            },
          
        ]

    });
}
function selectName() {
    var $token = $('meta[name="csrf-token"]').attr('content');
    $( "#citizens_name" ).select2({
        placeholder: "Select a citizen",
        width: '100%',
        ajax: { 
            url: "/ctc/get-citizen",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                _token: $token,
                search: params.term 
                };
            },
            processResults: function (response) {
                return {
                results: response
                };
            },
            cache: true
        }
    });
}

$(window).resize(function() {
    $('#tag_info').DataTable().columns.adjust().draw();
});
function nameTable(data){
    return data.replace(
        /\w\S*/g,
        function(txt) {
          return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
        }
    );
}