var minDT; var maxDT; var minServer; var maxServer;
$(document).ready(function() {
    dt();
    getDefault();
    datepicker();

    $('#filterMale').click(function(){
        $('#filterFemale').prop('checked',false);
        filters();
    });
    $('#filterFemale').click(function(){
        $('#filterMale').prop('checked',false);
        filters();
    });
    $('#es_name').on('change', function() {
        filters();
    })
    $('#scan_date').on('change',function() {
        filters();
    });
    $('#time_in').on('change',function() {
        filters();
    });
    $('#time_out').on('change',function() {
        filters();
    });
    $('#server_datemin').on('change',function() {
        filters();
    });
    $('#server_datemax').on('change',function() {
        filters();
    })

    
    $('#filter-set-btn').on('click', function() {
        var gender=''; var scan_date =''; var time_in =''; var time_out=''; var es=''; var server_min =''; var server_max ='';

        if($('#filterMale').prop('checked') == true){
            gender = 'Male';
        }
        if($('#filterFemale').prop('checked') == true){
            gender = 'Female';
        }

        var tempMonth = (minDT.getUTCMonth()+1);
        if(parseInt(tempMonth) < 10){
            tempMonth = "0"+tempMonth;
        }
        var tempScanDT = tempMonth +'-0' + (minDT.getUTCDate()) + '-' + minDT.getFullYear();
        var scanDTval = $('#scan_date').val();
        if(scanDTval == tempScanDT){
            if(($('#time_in').val() != "12:00 AM") || ($('#time_out').val() != "11:59 PM")){
                scan_date = $('#scan_date').val();
            }
        }else{
            scan_date = $('#scan_date').val();
        }
        
        if($('#time_in').val() != "12:00 AM"){
            time_in = $('#time_in').val();
            time_in = time_in.split(":")[0];
            if(parseInt(time_in) < 10){
                time_in = "0"+time_in+":"+$('#time_in').val().split(":")[1].substr(0,2)+":00";
            }else{
                time_in = time_in+":"+$('#time_in').val().split(":")[1].substr(0,2)+":00";
            }

            time_out = $('#time_out').val();
            var checkHour = time_out.split(" ")[1];
            if(checkHour == "PM"){
                time_out = time_out.split(":")[0];
                if(parseInt(time_out) < 10){
                    time_out = "0"+time_out+":"+$('#time_out').val().split(":")[1].substr(0,2)+":00";
                }else{
                    time_out  = parseInt(time_out)+12;
                    time_out = time_out+":"+$('#time_out').val().split(":")[1].substr(0,2)+":00";
                }
            }else{
                time_out = time_out.split(":")[0];
                if(parseInt(time_out) < 10){
                    time_out = "0"+time_out+":"+$('#time_out').val().split(":")[1].substr(0,2)+":00";
                }else{
                    time_out = time_out+":"+$('#time_out').val().split(":")[1].substr(0,2)+":00";
                }
            }
        }
        if($('#time_out').val() != "11:59 PM"){
            time_out = $('#time_out').val();
            var checkHour = time_out.split(" ")[1];

            if(checkHour == "PM"){
                time_out = time_out.split(":")[0];
                if(parseInt(time_out) < 10){
                    time_out  = parseInt(time_out)+12;
                    time_out = time_out + ":"+$('#time_out').val().split(":")[1].substr(0,2)+":00";
                }else{
                    time_out  = parseInt(time_out)+12;
                    time_out = time_out+":"+$('#time_out').val().split(":")[1].substr(0,2)+":00";
                }
            }else{
                time_out = time_out.split(":")[0];
                if(parseInt(time_out) < 10){
                    time_out = "0"+time_out+":"+$('#time_out').val().split(":")[1].substr(0,2)+":00";
                }else{
                    time_out = time_out+":"+$('#time_out').val().split(":")[1].substr(0,2)+":00";
                }
            }
        }
        if($('#es_name').val() != "0"){
            es = $('#es_name').val();
        }

        var tempMonthServerMin = (minServer.getUTCMonth()+1);
        if(parseInt(tempMonthServerMin) < 10){
            tempMonthServerMin = "0"+tempMonthServerMin;
        }
        if($("#server_datemin").val() !=  tempMonthServerMin +'-' + minServer.getUTCDate() + '-' + minServer.getFullYear() + ' 12:00 AM'){
            server_min = $("#server_datemin").val();
            server_max = $('#server_datemax').val();
            
            var splitMin1 = server_min.split(" ")[0];
            var splitMin2 = server_min.split(" ")[1];

            var splitMax1 = server_max.split(" ")[0];
            var splitMax2 = server_max.split(" ")[1];

            server_min = splitMin1 + " " + splitMin2 + ":00";
            server_max = splitMax1 + " " + splitMax2 + ":00";
        }

        var tempMonthServerMax = (maxServer.getUTCMonth()+1);
        if(parseInt(tempMonthServerMax) < 10){
            tempMonthServerMax = "0"+tempMonthServerMax;
        }
        if($('#server_datemax').val() != tempMonthServerMax +'-' + maxServer.getUTCDate() + '-' + maxServer.getFullYear() + ' 11:59 PM'){
            server_max = $('#server_datemax').val();
            var splitMax1 = server_max.split(" ")[0];
            var splitMax2 = server_max.split(" ")[1];
            server_max = splitMax1 + " " + splitMax2 + ":00";
        }
        
        dt(gender,scan_date,time_in,time_out,es,server_min,server_max);
        // console.log(gender + ' ' + scan_date + ' ' + time_in + ' ' + time_out + ' ' + es + ' ' + server_min + ' ' + server_max);
    });
    $('#filter-reset-btn').on('click',function() {
        $('#filterFemale').prop('checked',false);
        $('#filterMale').prop('checked',false);
        $('#es_name').val(0);
        $('#time_in').datetimepicker({
            value:'00:00 A',
        });
        $('#time_out').datetimepicker({
            value:'23:59',
        });
        getDefault();
        dt();
        document.getElementById('filter-btn').click();
    })
    $('#generateInfo').on('click',function() {
        if($("#establishment_info").DataTable().data().any()){
            if(filter_male() | filter_es() | filter_scandate()){
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
    })
    $('#fltr_Yes').on('click', function() {
        document.getElementById('downloadFilter').click();
        $('#filter_modal').modal('toggle');
        $('#generate-toast').toast('show');
    })

});

function filter_male() {
    if($('#filterMale').prop('checked')){
        $('#fltr_gender').text("Male");
        $('#row-gender').removeClass('d-none');
        return true;
    }else if($('#filterFemale').prop('checked')){
        $('#fltr_gender').text("Female");
        $('#row-gender').removeClass('d-none');
        return true;
    }else{
        $('#row-gender').addClass('d-none');
        return false
    }
}
function filter_es() {
    if($('#es_name').val() != '0'){
        $('#fltr_ES').text($('#es_name option:selected').text());
        $('#row-es').removeClass('d-none');
        return true;
    }else{
        $('#row-es').addClass('d-none');
        return false;
    }
}
function filter_scandate() {
    var tempMonth = (minDT.getUTCMonth()+1);
    if(parseInt(tempMonth) < 10){
        tempMonth = "0"+tempMonth;
    }
    var tempScanDT = tempMonth +'-0' + (minDT.getUTCDate()) + '-' + minDT.getFullYear();
    var scanDTval = $('#scan_date').val();
    if(scanDTval == tempScanDT){
        if(($('#time_in').val() != "12:00 AM") || ($('#time_out').val() != "11:59 PM")){
            $('#fltr_ScanDate').text(scanDTval);
            $('#fltr_in').text($('#time_in').val());
            $('#fltr_out').text($('#time_out').val());
            $('#row-scandt').removeClass('d-none');
            return true;
        }else{
            $('#row-scandt').addClass('d-none');
            return false;
        }
    }else{
        $('#fltr_ScanDate').text(scanDTval);
        $('#fltr_in').text($('#time_in').val());
        $('#fltr_out').text($('#time_out').val());
        $('#row-scandt').removeClass('d-none');
        return true;
    }
}
function filter_serverMin() {
    var tempMonthServerMin = (minServer.getUTCMonth()+1);
    if(parseInt(tempMonthServerMin) < 10){
        tempMonthServerMin = "0"+tempMonthServerMin;
    }

    if($("#server_datemin").val() !=  tempMonthServerMin +'-0' + minServer.getUTCDate() + '-' + minServer.getFullYear() +' 00:00 AM'){
        server_min = $("#server_datemin").val();
        server_max = $('#server_datemax').val();
        
        var splitMin1 = server_min.split(" ")[0];
        var splitMin2 = server_min.split(" ")[1];
        var parseHour = parseInt(splitMin2.split(":")[0]);
        var parseTime ='';
        if(parseHour < 12){
            if(parseHour == 0){
                parseTime = "12:"+ splitMin2.split(":")[1] + " AM";
            }else{
                parseTime = parseHour + ":"+ splitMin2.split(":")[1] + " AM";
            }
        }
        else{
            if(parseHour == 12){
                parseTime = "12:"+ splitMin2.split(":")[1] + " PM";
            }else{
                parseTime = (parseHour-12) + ":"+ splitMin2.split(":")[1] + " PM";
            }
        }
        $('#fltr_start').text(splitMin1 + " " +parseTime);

        var splitMax1 = server_max.split(" ")[0];
        var splitMax2 = server_max.split(" ")[1];
        var parseHourE = parseInt(splitMax2.split(":")[0]);
        var parseTimeE ='';
        if(parseHourE < 12){
            if(parseHourE == 0){
                parseTimeE = "12:"+ splitMax2.split(":")[1] + " AM";
            }else{
                parseTimeE = parseHourE + ":"+ splitMax2.split(":")[1] + " AM";
            }
        }
        else{
            if(parseHourE == 12){
                parseTimeE = "12:"+ splitMax2.split(":")[1] + " PM";
            }else{
                parseTimeE = (parseHourE-12) + ":"+ splitMax2.split(":")[1] + " PM";
            }
        }
        $('#fltr_end').text(splitMax1 + " " +parseTimeE);

        $('#row-serverup').removeClass('d-none');
        return true;
    }else {
        var tempMonthServerMax = (maxServer.getUTCMonth()+1);
        if(parseInt(tempMonthServerMax) < 10){
            tempMonthServerMax = "0"+tempMonthServerMax;
        }
        if($('#server_datemax').val() != tempMonthServerMax +'-' + maxServer.getUTCDate() + '-' + maxServer.getFullYear() + ' 23:59 PM'){
            server_min = $("#server_datemin").val();
            server_max = $('#server_datemax').val();
            
            var splitMin1 = server_min.split(" ")[0];
            var splitMin2 = server_min.split(" ")[1];
            var parseHour = parseInt(splitMin2.split(":")[0]);
            var parseTime ='';
            if(parseHour < 12){
                if(parseHour == 0){
                    parseTime = "12:"+ splitMin2.split(":")[1] + " AM";
                }else{
                    parseTime = parseHour + ":"+ splitMin2.split(":")[1] + " AM";
                }
            }
            else{
                if(parseHour == 12){
                    parseTime = "12:"+ splitMin2.split(":")[1] + " PM";
                }else{
                    parseTime = (parseHour-12) + ":"+ splitMin2.split(":")[1] + " PM";
                }
            }
            $('#fltr_start').text(splitMin1 + " " +parseTime);
    
            var splitMax1 = server_max.split(" ")[0];
            var splitMax2 = server_max.split(" ")[1];
            var parseHourE = parseInt(splitMax2.split(":")[0]);
            var parseTimeE ='';
            if(parseHourE < 12){
                if(parseHourE == 0){
                    parseTimeE = "12:"+ splitMax2.split(":")[1] + " AM";
                }else{
                    parseTimeE = parseHourE + ":"+ splitMax2.split(":")[1] + " AM";
                }
            }
            else{
                if(parseHourE == 12){
                    parseTimeE = "12:"+ splitMax2.split(":")[1] + " PM";
                }else{
                    parseTimeE = (parseHourE-12) + ":"+ splitMax2.split(":")[1] + " PM";
                }
            }
            $('#fltr_end').text(splitMax1 + " " +parseTimeE);
    
            $('#row-serverup').removeClass('d-none');
            return true; 
        }
        else{
            $('#row-serverup').addClass('d-none');
            return false;
        }
    }
    
    
    
}
function filter_serverMax() {
    var tempMonthServerMax = (maxServer.getUTCMonth()+1);
    if(parseInt(tempMonthServerMax) < 10){
        tempMonthServerMax = "0"+tempMonthServerMax;
    }
    if($('#server_datemax').val() != tempMonthServerMax +'-' + maxServer.getUTCDate() + '-' + maxServer.getFullYear() + ' 23:59 PM'){
        server_min = $("#server_datemin").val();
        server_max = $('#server_datemax').val();
        
        var splitMin1 = server_min.split(" ")[0];
        var splitMin2 = server_min.split(" ")[1];
        var parseHour = parseInt(splitMin2.split(":")[0]);
        var parseTime ='';
        if(parseHour < 12){
            if(parseHour == 0){
                parseTime = "12:"+ splitMin2.split(":")[1] + " AM";
            }else{
                parseTime = parseHour + ":"+ splitMin2.split(":")[1] + " AM";
            }
        }
        else{
            if(parseHour == 12){
                parseTime = "12:"+ splitMin2.split(":")[1] + " PM";
            }else{
                parseTime = (parseHour-12) + ":"+ splitMin2.split(":")[1] + " PM";
            }
        }
        $('#fltr_start').text(splitMin1 + " " +parseTime);

        var splitMax1 = server_max.split(" ")[0];
        var splitMax2 = server_max.split(" ")[1];
        var parseHourE = parseInt(splitMax2.split(":")[0]);
        var parseTimeE ='';
        if(parseHourE < 12){
            if(parseHourE == 0){
                parseTimeE = "12:"+ splitMax2.split(":")[1] + " AM";
            }else{
                parseTimeE = parseHourE + ":"+ splitMax2.split(":")[1] + " AM";
            }
        }
        else{
            if(parseHourE == 12){
                parseTimeE = "12:"+ splitMax2.split(":")[1] + " PM";
            }else{
                parseTimeE = (parseHourE-12) + ":"+ splitMax2.split(":")[1] + " PM";
            }
        }
        $('#fltr_end').text(splitMax1 + " " +parseTimeE);

        $('#row-serverup').addClass('d-none');
        return true; 
    }else{
        $('#row-serverup').addClass('d-none');
        return false;
    }
}

function filters() {
    var gender=''; var scan_date =''; var time_in =''; var time_out=''; var es=''; var server_min =''; var server_max ='';

    if($('#filterMale').prop('checked') == true){
        gender = 'Male';
    }
    if($('#filterFemale').prop('checked') == true){
        gender = 'Female';
    }

    var tempMonth = (minDT.getUTCMonth()+1);
    if(parseInt(tempMonth) < 10){
        tempMonth = "0"+tempMonth;
    }
    var tempScanDT = tempMonth +'-0' + (minDT.getUTCDate()) + '-' + minDT.getFullYear();
    var scanDTval = $('#scan_date').val();
    if(scanDTval == tempScanDT){
        if(($('#time_in').val() != "12:00 AM") || ($('#time_out').val() != "11:59 PM")){
            scan_date = $('#scan_date').val();
        }
    }else{
        scan_date = $('#scan_date').val();
    }
    
    if($('#time_in').val() != "12:00 AM"){
        time_in = $('#time_in').val();
        time_in = time_in.split(":")[0];
        if(parseInt(time_in) < 10){
            time_in = "0"+time_in+":"+$('#time_in').val().split(":")[1].substr(0,2)+":00";
        }else{
            time_in = time_in+":"+$('#time_in').val().split(":")[1].substr(0,2)+":00";
        }

        time_out = $('#time_out').val();
        var checkHour = time_out.split(" ")[1];
        if(checkHour == "PM"){
            time_out = time_out.split(":")[0];
            if(parseInt(time_out) < 10){
                time_out = "0"+time_out+":"+$('#time_out').val().split(":")[1].substr(0,2)+":00";
            }else{
                time_out  = parseInt(time_out)+12;
                time_out = time_out+":"+$('#time_out').val().split(":")[1].substr(0,2)+":00";
            }
        }else{
            time_out = time_out.split(":")[0];
            if(parseInt(time_out) < 10){
                time_out = "0"+time_out+":"+$('#time_out').val().split(":")[1].substr(0,2)+":00";
            }else{
                time_out = time_out+":"+$('#time_out').val().split(":")[1].substr(0,2)+":00";
            }
        }
    }
    if($('#time_out').val() != "11:59 PM"){
        time_out = $('#time_out').val();
        var checkHour = time_out.split(" ")[1];

        if(checkHour == "PM"){
            time_out = time_out.split(":")[0];
            if(parseInt(time_out) < 10){
                time_out  = parseInt(time_out)+12;
                time_out = time_out + ":"+$('#time_out').val().split(":")[1].substr(0,2)+":59";
            }else{
                time_out  = parseInt(time_out)+12;
                time_out = time_out+":"+$('#time_out').val().split(":")[1].substr(0,2)+":59";
            }
        }else{
            time_out = time_out.split(":")[0];
            if(parseInt(time_out) < 10){
                time_out = "0"+time_out+":"+$('#time_out').val().split(":")[1].substr(0,2)+":59";
            }else{
                time_out = time_out+":"+$('#time_out').val().split(":")[1].substr(0,2)+":59";
            }
        }
    }
    if($('#es_name').val() != "0"){
        es = $('#es_name').val();
    }

    var tempMonthServerMin = (minServer.getUTCMonth()+1);
    if(parseInt(tempMonthServerMin) < 10){
        tempMonthServerMin = "0"+tempMonthServerMin;
    }
    if($("#server_datemin").val() !=  tempMonthServerMin +'-' + minServer.getUTCDate() + '-' + minServer.getFullYear() + ' 12:00 AM'){
        server_min = $("#server_datemin").val();
        server_max = $('#server_datemax').val();
        
        var splitMin1 = server_min.split(" ")[0];
        var splitMin2 = server_min.split(" ")[1];

        var splitMax1 = server_max.split(" ")[0];
        var splitMax2 = server_max.split(" ")[1];

        server_min = splitMin1 + " " + splitMin2 + ":00";
        server_max = splitMax1 + " " + splitMax2 + ":00";
    }

    var tempMonthServerMax = (maxServer.getUTCMonth()+1);
    if(parseInt(tempMonthServerMax) < 10){
        tempMonthServerMax = "0"+tempMonthServerMax;
    }
    if($('#server_datemax').val() != tempMonthServerMax +'-' + maxServer.getUTCDate() + '-' + maxServer.getFullYear() + ' 11:59 PM'){
        server_max = $('#server_datemax').val();
        var splitMax1 = server_max.split(" ")[0];
        var splitMax2 = server_max.split(" ")[1];
        server_max = splitMax1 + " " + splitMax2 + ":00";
    }
    
    dt(gender,scan_date,time_in,time_out,es,server_min,server_max);
    // console.log(gender + ' ' + scan_date + ' ' + time_in + ' ' + time_out + ' ' + es + ' ' + server_min + ' ' + server_max);
}

$(window).resize(function() {
    $('#scanner_info').DataTable().columns.adjust().draw();
});
function getDefault() {
    $_token = $('meta[name="csrf-token"]').attr('content');
    var get = true;
    $.ajax({
        type:'POST',
        url: "/ajax-default-scanner",
        data: {_token: $_token,get:get},
        success: function (data) {
            setDefault(data);
        }
    });
}
function setDefault(data) {
    for(i = 0; i < data.length ; i++){
        if(i == 0){
            minDT = new Date(data[i].scans_timein);
            maxDT = new Date(data[i].scans_timeout);
            minServer = new Date(data[i].scans_timeupdate);
            maxServer = new Date(data[i].scans_timeupdate);
        }else{
            if(minDT > new Date(data[i].scans_timein)){
                minDT = new Date(data[i].scans_timein);
            }
            if(new Date(data[i].scans_timeout) > maxDT){
                maxDT = new Date(data[i].scans_timeout);
            }
            if(minServer > new Date(data[i].scans_timeupdate)){
                minServer = new Date(data[i].scans_timeupdate);
            }
            if(new Date(data[i].scans_timeupdate) > maxServer){
                maxServer = new Date(data[i].scans_timeupdate);
            }
        } 
    }

    if(data.length > 0){
        $("#scan_date").datetimepicker({
            minDate:new Date( minDT.getFullYear() + "/" + (minDT.getUTCMonth()+1) + "/" + (minDT.getUTCDate())),
            value:new Date( minDT.getFullYear() + "/" + (minDT.getUTCMonth()+1) + "/" + (minDT.getUTCDate()))
        });
    
        $('#server_datemin').datetimepicker({
            value: (minServer.getUTCMonth()+1) +'-' + minServer.getUTCDate() + '-' + minServer.getFullYear() + ' 00:00',
            minDate:new Date( minServer.getFullYear() + "/" + (minServer.getUTCMonth()+1) + "/" + (minServer.getUTCDate()) + ' 00:00'),
            onShow:function(ct) {
                this.setOptions({
                    maxDate:new Date( maxServer.getFullYear() + "/" + (maxServer.getUTCMonth()+1) + "/" + (maxServer.getUTCDate()) + ' 23:59')
                });
            }
        });

        var serverMindt = $("#server_datemin").val();

        $('#server_datemax').datetimepicker({
            value: (maxServer.getUTCMonth()+1) +'-' + maxServer.getUTCDate() + '-' + maxServer.getFullYear() + ' 23:59',
            onShow:function(ct) {
                this.setOptions({
                    minDate:new Date( serverMindt.substr(6,4) + "/" + serverMindt.substr(0,2) + "/" + serverMindt.substr(4,2) + ' 23:59'),
                    maxDate:new Date( maxServer.getFullYear() + "/" + (maxServer.getUTCMonth()+1) + "/" + (maxServer.getUTCDate()) + ' 23:59'),
                })
            }
        });
    }
}
function dt(gender,scan_date,time_in,time_out,establishment,update_start,update_end) {
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
            url:"/admin/es/getScanInfo",
            data:{
                gender:gender,
                scan_date:scan_date,
                time_in:time_in,
                time_out:time_out,
                establishment:establishment,
                update_start:update_start,
                update_end:update_end
            }
        },
        columns:[
            {data: "id",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data:"scan_to_citizen.citizens_fname"},
            {data:"scan_to_citizen.citizens_mname"},
            {data:"scan_to_citizen.citizens_lname"},
            {data:"scan_to_citizen.citizens_suffix"},
            {data:"scan_to_citizen.citizens_gender"},
            {data:"scan_to_citizen.citizens_bday"},
            {data:"scan_to_establishment.establishments_name"},
            {data:"scans_timein"},
            {data:"scans_timein"},
            {data:"scans_timeout"},
            {data:"scans_temperature"},
            {data:"scans_timeupdate"},
        ],
        columnDefs:[
            { className: "dt-center all" , "width": "3%", searchable:false, "targets": [ 0 ] },
            { targets: [ 1 ],"orderable": true, className: "dt-nowrap all", "width": "18%",
                render: function(data, type, row ){
                    if(row.scan_to_citizen.citizens_suffix != null){
                        return nameTable(data + ' ' +row.scan_to_citizen.citizens_mname + ' ' + row.scan_to_citizen.citizens_lname )+ ' ' + row.scan_to_citizen.citizens_suffix ;
                    }else{
                        return nameTable(data + ' ' +row.scan_to_citizen.citizens_mname + ' ' + row.scan_to_citizen.citizens_lname );
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
                targets: [ 7 ],
                render: function(data, type, row) {
                    return nameTable(data);
                }
            },
            {
                targets:[8],className:"dt-nowrap",
                render:function(data, type, row) {
                    return  data.substr(0,10).replace(/(\d{4})\-(\d{2})\-(\d{2}).*/, '$2-$3-$1');
                }
            },
            {
                targets: [9], className:"dt-nowrap",
                render:function(data, type, row) {
                    var time =  new Date(data).toLocaleTimeString().replace(/([\d+:[\d]{2})(:[\d]{2})(.*)/, "$1$3");
                    return time;
                }
            },{
                targets: [10],className:"dt-nowrap",
                render:function(data, type, row) {
                    var time =  new Date(data).toLocaleTimeString().replace(/([\d+:[\d]{2})(:[\d]{2})(.*)/, "$1$3");
                    return time;
                }
            },{
                targets:[11],
                render:function(data, type, row) {
                    return data + "&#8451";
                }
            },{
                targets:[12],className:"dt-nowrap",
                render:function(data, type, row) {
                    var date = data.substr(0,10).replace(/(\d{4})\-(\d{2})\-(\d{2}).*/, '$2-$3-$1');
                    var time =  new Date(data).toLocaleTimeString().replace(/([\d+:[\d]{2})(:[\d]{2})(.*)/, "$1$3");
                    return date + ' ' + time;
                }
            }

        ]
    });
}
function datepicker() {
    $('#scan_date').datetimepicker({
        timepicker:false,
        datepicker:true,
        format:'m-d-Y',
        validateOnBlur: false,
    });

    $('#time_in').datetimepicker({
        timepicker:true,
        datepicker:false,
        format:'g:i A',
        validateOnBlur: false,
        minTime:'00:00 A',
        value:'00:00 A',
        // onShow:function(ct) {
        //     this.setOptions({
        //         maxTime:$("#time_out").val()
        //     })
        // }
    });
    $('#time_out').datetimepicker({
        timepicker:true,
        datepicker:false,
        validateOnBlur: false,
        format:'g:i A',
        value:'23:59',
        onShow:function(ct) {
            this.setOptions({
                minTime:$("#time_in").val()
            })
        }
    });

    $('#server_datemin').datetimepicker({
        timepicker:true,
        datepicker:true,
        validateOnBlur: false,
        format:'m-d-Y H:i A',
    });
    $('#server_datemax').datetimepicker({
        timepicker:true,
        datepicker:true,
        validateOnBlur: false,
        format:'m-d-Y H:i A',
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

