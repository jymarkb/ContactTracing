$(document).ready(function() {
    dt();
});

function  dt(){
    $("#facility_info").DataTable({
        responsive:true,
        "language": {
            "search": "Search here : ",
            searchPlaceholder:  "Search for... (e.g Juan)",
            "processing": "Please wait processing ..."
        },
        pagingType: "simple",
        fnDrawCallback: function(oSettings) {
            if($('#facility_info').DataTable().page.info().recordsTotal > 10){
                $('.dataTables_paginate').show();
            }else{
                if($('#facility_info').DataTable().page.info().end > 10){
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
            url:"/ctc/facility-table",
        },
        columns:[
            {data: "id",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data:"facilities_desc", name:"facilities_desc"},
        ],
        columnDefs:[
            { className: "dt-center" , "width": "4%", searchable:false, "targets": [ 0 ] },
        ]
    });
} 