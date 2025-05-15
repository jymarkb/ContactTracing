$(document).ready(function(){

    getRecord();
});

function getRecord() {
    $("#citizen_history_scan").DataTable({
        responsive:true,
        "language": {
            "search": "Search here : ",
            searchPlaceholder:  "Search Establishment",
            "processing": "Please wait processing ..."
        },
        pagingType: "simple",
        fnDrawCallback: function() {
            if($('#citizen_history_scan').DataTable().page.info().recordsTotal > 10){
                $('.dataTables_paginate').show();
            }else{
                if($('#citizen_history_scan').DataTable().page.info().end > 10){
                    $('.dataTables_paginate').show();
                }else{
                    $('.dataTables_paginate').hide();
                }
            }
        },
        bPaginate: false,
        destroy: true,
        stateSave: false,
        ajax:{
            url:"/citizens/tracking/history",
        },
        columns:[
            {data: "id",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data:"scan_to_establishment.establishments_name", name:"scan_to_establishment.establishments_name"},
            {data:"scans_timein", name:"scans_timein"},
            {data:"scans_timeout", name:"scans_timeout"},
            {data:"scans_timein", name:"scans_timein"},
        ],
        columnDefs:[
            { className: "dt-center" , "width": "3%", searchable:false, "targets": [ 0 ] },
            {
                targets: [1],
                "orderable": true, className: "dt-nowrap",
                render: function(data, type, row ){
                   return nameTable(data);
                   
                }
            },
            {
                targets: [2], className:"dt-nowrap","orderable": false,
                render:function(data, type, row) {
                    var time =  new Date(data).toLocaleTimeString().replace(/([\d+:[\d]{2})(:[\d]{2})(.*)/, "$1$3");
                    return time;
                }
            },
            {
                targets: [3], className:"dt-nowrap","orderable": false,
                render:function(data, type, row) {
                    var time =  new Date(data).toLocaleTimeString().replace(/([\d+:[\d]{2})(:[\d]{2})(.*)/, "$1$3");
                    return time;
                }
            },
            {
                targets:[4],className:"dt-nowrap","orderable": true,
                render:function(data, type, row) {
                    return  data.substr(0,10).replace(/(\d{4})\-(\d{2})\-(\d{2}).*/, '$2-$3-$1');
                }
            }

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