$(document).ready(function() {

    dt();
    selects();

    $('#filterMale').click(function(){
        $('#filterFemale').prop('checked',false);
        filters();
    });
    $('#filterFemale').click(function(){
        $('#filterMale').prop('checked',false);
        filters();
    });
    $('#filterDescription').on('change', function() {
        filters();
    });
    $('#filterStatus').on('change', function() {
        filters();
    })
    $('#filterFacility').on('change', function() {
        filters();
    })

    $('#tag_id').on('change',function() {
        validName();
    });
    $('#types_id').on('change',function() {
        validStatus();

        if($('#types_id').find(":selected").val() == "2"){
            $('.sym-row').removeClass('d-none');
        }else{
            $('.sym-row').addClass('d-none');
        }
    });

    $('#add_modal').on('hidden.bs.modal',function() {
        resetValid();
    });

    $('#add-new').on('click',function() {
        if(!validName() | !validStatus() | !validSymptoms() | !validFacility()){
            document.getElementById('scroll-up').click();
            $('#error-toast').toast('show');
        }else{
            var formData = new FormData(document.getElementById('monitor-new'));

            if($('#types_id').find(":selected").val()== "2"){
                formData.append('symptoms', $("#symptoms").select2("val"));
            }else{
                formData.append('symptoms', "0");
            }

            $.ajax({
                type:'POST',
                url: "/monitor/add-new",
                data: formData,
                cache:false,
                async:false,
                contentType: false,
                processData: false,
                success: function(data){
                    if(data == "exist"){
                        document.getElementById('scroll-up').click();
                        $('#exist-toast').toast('show');
                    }else{
                        resetValid();
                        $('#add_modal').modal('toggle');
                        document.getElementById('scroll-up').click();
                        $('#success-toast').toast('show');
                        dt();
                    }
                }
            });
        }
    });

    $('#filter-set-btn').on('click', function() {
        var gender = ''; var description = ''; var status = ''; var facility = '';

        if($('#filterMale').prop('checked')){
            gender = "Male";
        }
        if($('#filterFemale').prop('checked')){
            gender = "Female";
        }

        if($('#filterDescription option:selected').val() != '0'){
            description = $('#filterDescription option:selected').val()
        }

        if($('#filterStatus option:selected').val() != '0'){
            status = $('#filterStatus option:selected').val();
        }

        if($('#filterFacility option:selected').val() != '0'){
            facility = $('#filterFacility option:selected').val();
        }

        dt(gender,description,status,facility);
    });

    $('#filter-reset-btn').on('click', function() {
        var gender = ''; var description = ''; var status = ''; var facility = '';
        $('#filterFemale').prop('checked',false);
        $('#filterMale').prop('checked',false);
        $('#filterDescription').val('0');
        $('#filterStatus').val('0');
        $('#filterFacility').val('0');
        dt(gender,description,status,facility);
    });

    $('.generateInfo').on('click', function() {
        if($('#monitor_info').DataTable().data().any()){
            if(filterGender() | filterDescription() | filterStatus() | filterFacility()){
                $('#filter_modal').modal('show');
            }else{
                document.getElementById('downloadNoFilter').click();                
            }
            $('#generate-toast').toast('show');
        }else{
            $('#generateError-toast').toast('show');
        }
    });

    $('#fltr_No').on('click',function() {
        document.getElementById('downloadNoFilter').click();   
    });
    $('#fltr_Yes').on('click', function() {
        document.getElementById('downloadFilter').click();   
    });

});


function viewMonitor(id) {
    $_token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type:'POST',
        url: "/monitor/view",
        data: {
            monitor_id:id,
            _token: $_token
        },
        success: function(data){
            setMonitor(data);
            // console.log(data);
            $('#view_modal').modal('show');
        }
    });
}
function setMonitor(data) {
    // $('#mv-profile')
    document.getElementById("mv-profile").src = "/images/profileid/" + data.data[0].citizens_img_src ;

    if(data.data[0].citizens_suffix != null){
        $('#mv-name').text(nameTable(data.data[0].citizens_fname) + " " + nameTable(data.data[0].citizens_mname) + " " + nameTable(data.data[0].citizens_lname) + " " + data.data[0].citizens_suffix);
    }else{
        $('#mv-name').text(nameTable(data.data[0].citizens_fname) + " " + nameTable(data.data[0].citizens_mname) + " " + nameTable(data.data[0].citizens_lname));
    }
    $('#mv-gender').text(data.data[0].citizens_gender);
    $('#mv-age').text((new Date()).getFullYear() - data.data[0].citizens_bday.substr(0,4));
    
    
    
    
    day = parseInt(data.data[0].citizens_bday.substr(8,2));
    $('#mv-bday').text(getMonth(data.data[0].citizens_bday.substr(5,2)) + ' ' + day + ', ' + data.data[0].citizens_bday.substr(0,4));
    $('#mv-mobile').text(data.data[0].citizens_mobile);

    if(data.data[0].citizen_add_address_current != null){

    }else{
        $('#mv-address').text(data.data[0].zones_name + ", " + data.data[0].barangays_name + ", " + data.data[0].municipalities_name + ", " + data.data[0].province_name);
    }

    $('#mv-description').text(data.data[0].tag_desc_name);
    $('#mv-status').text(data.data[0].monitor_types_name);



    // $('#mv-start').text();
    $('#mv-start').text(getMonth(data.data[0].monitors_created.substr(5,2)) + " " + parseInt(data.data[0].monitors_created.substr(8,2)) + ", " + data.data[0].monitors_created.substr(0,4))

    var start = new Date(data.data[0].monitors_created);
    start.setDate(start.getDate() + 14);

    const monthNames = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
    ];

    $('#mv-end').text(monthNames[start.getMonth()] + " " + start.getDate() + ", " + start.getFullYear());

    $('#mv-symptoms').empty();
    if(data.record.length > 0){
        for(var i = 0; i < data.record.length ; i++){
            $("#mv-symptoms").append('<li class="list-group-item border-0 p-0"><i class="text-danger fas fa-circle"></i> ' + data.record[i].symptoms_description + '</li>');
        }
    }else{
        $("#mv-symptoms").append('<li class="list-group-item border-0 p-0"><i class="text-danger fas fa-circle"></i> None </li>');
    }

    $('#mv-facility').text(data.data[0].facilities_desc);


    if(data.data[0].monitors_updated != null){
        $('#mv-last').text(getMonth(data.data[0].monitors_updated.substr(5,2)) + " " + parseInt(data.data[0].monitors_updated.substr(8,2)) + ", " + data.data[0].monitors_updated.substr(0,4));
    }else{
        $('#mv-last').text(getMonth(data.data[0].monitors_created.substr(5,2)) + " " + parseInt(data.data[0].monitors_created.substr(8,2)) + ", " + data.data[0].monitors_created.substr(0,4));
    }

}


function validName() {
    if($('#tag_id').find(":selected").val() == null){
        return false;
    }
    else{
        return true;
    } 
}
function validStatus() {
    if($('#types_id').find(":selected").val() == "0"){
        return false;
    }else{
        return true;
    }
}
function validSymptoms() {
    if($('#types_id').find(":selected").val()== "2"){
        if($('#symptoms').find(":selected").val() == null){
            return false;
        }else{
            return true;
        }
    }else{
        return true;
    }
}
function validFacility() {
    if($('#facility_id').find(":selected").val()== '0'){
        return false;
    }else{
        return true;
    }
}
function resetValid() {
    $("#tag_id").select2("val", "");
    $("#tag_id").val('').trigger('change');
    $('#types_id').val(0);
    $('#facility_id').val(0);
    $('.sym-row').addClass('d-none');
    $("#symptoms").select2("val", "");
    $("#symptoms").val('').trigger('change');
}

function filterGender(){
    if($('#filterMale').prop('checked')){
        $('#fltr_gender').text('Male');
        $('#row-gender').removeClass('d-none');
        return true;
    }
    if($('#filterFemale').prop('checked')){
        $('#fltr_gender').text('Female');
        $('#row-gender').removeClass('d-none');
        return true;
    }
    $('#row-gender').addClass('d-none');
    return false;
}
function filterDescription() {
    if($('#filterDescription option:selected').val() != '0'){
        $('#fltr_desc').text($('#filterDescription option:selected').text());
        $('#row-description').removeClass('d-none');
        return true;
    }
    $('#row-description').addClass('d-none');
    return false;
}
function filterStatus() {
    if($('#filterStatus option:selected').val() != '0'){
        $('#fltr_status').text($('#filterStatus option:selected').text());
        $('#row-status').removeClass('d-none');
        return true;
    }
    $('#row-status').addClass('d-none');
    return false;
}
function filterFacility() {
    if($('#filterFacility option:selected').val() != '0'){
        $('#fltr_facility').text($('#filterFacility option:selected').text());
        $('#row-facility').removeClass('d-none');
        return true;
    }
    $('#row-facility').addClass('d-none');
    return false;
}

function filters() {
    var gender = ''; var description = ''; var status = ''; var facility = '';

    if($('#filterMale').prop('checked')){
        gender = "Male";
    }
    if($('#filterFemale').prop('checked')){
        gender = "Female";
    }

    if($('#filterDescription option:selected').val() != '0'){
        description = $('#filterDescription option:selected').val()
    }

    if($('#filterStatus option:selected').val() != '0'){
        status = $('#filterStatus option:selected').val();
    }

    if($('#filterFacility option:selected').val() != '0'){
        facility = $('#filterFacility option:selected').val();
    }

    dt(gender,description,status,facility);
}
function dt(gender,description, status, facility) {
    $("#monitor_info").DataTable({
        responsive:true,
        "language": {
            "search": "Search here : ",
            searchPlaceholder:  "Search for... (e.g Juan)",
            "processing": "Please wait processing ..."
        },
        pagingType: "simple",
        fnDrawCallback: function(oSettings) {
            if($('#monitor_info').DataTable().page.info().recordsTotal > 10){
                $('.dataTables_paginate').show();
            }else{
                if($('#monitor_info').DataTable().page.info().end > 10){
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
            url:"/ctc/monitor-table",
            data:{
                gender:gender,
                description:description,
                status:status,
                facility:facility,
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
            {data:"tag_desc_name"},
            {data:"monitor_types_name"},
            {data:"facilities_desc"},
            {data:"monitors_id"},
            
        ],
        columnDefs:[
            { className: "dt-center all" , "width": "4%", searchable:false, "targets": [ 0 ] },
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
                targets:[7],className:"dt-nowrap",
            },
            {
                targets:[10],className: "dt-center", orderable:false, "width": "5%",
                render:function(data, type, row){
                    return '<div class="dropdown"> <button class="btn  btn-sm btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-tools"></i> </button> <div class="dropdown-menu tableActionMenu" aria-labelledby="dropdownMenuButton"><a class="dropdown-item edit-btn" id="'+ data + '" onClick="editMonitor(this.id);"><i class="fa fa-edit"></i> Update</a><a class="dropdown-item view-btn" id="'+ data + '" onClick="viewMonitor(this.id);"><i class="fa fa-eye"></i> View</a></div></div>'
                }
            },

        ]

    });
}
function selects() {
    var $token = $('meta[name="csrf-token"]').attr('content');
    $('#tag_id').select2({
        placeholder: "Select a citizen",
        width:"100%",
        ajax: { 
            url: "/ctc/get-citizen/hastag",
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

    $('#symptoms').select2({
        placeholder: "Select symptoms",
        width:"100%",
        tags:true,
        tokenSeparators:['/']
    });
}
$(window).resize(function() {
    $('#monitor_info').DataTable().columns.adjust().draw();
});

function getMonth(month) {
    var listMonth = {"01":"January","02":"February","03":"March", "04":"April", "05":"May", "06":"June", "07":"July", "08":"August", "09":"September", "10":"October", "11":"November","12":"December"};
    var month;
    Object.keys(listMonth).forEach(function(key) {
        if(key == month){
            month = listMonth[key];
        }
    });
    return month;
}
function nameTable(data){
    return data.replace(
        /\w\S*/g,
        function(txt) {
          return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
        }
    );
}