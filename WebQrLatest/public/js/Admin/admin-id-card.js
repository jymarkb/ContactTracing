
$(document).ready(function(){

    $('#download').click(function(){
        window.scrollTo(0,0);
        $("html").addClass("hide-scrollbar");
        html2canvas(document.getElementById('person')).then(function (canvas){
            var link = document.createElement('a');
            document.body.appendChild(link);
            link.href = canvas.toDataURL("image/png");
            link.download = 'id.png';
            link.click();
            document.body.removeChild(link);
        });
        $("html").removeClass("hide-scrollbar");

        // domtoimage.toBlob(document.getElementById('person'))
        // .then(function (blob) {
        //     window.saveAs(blob, 'id.png');
        // });
    });



    $('#citizen_id_record').DataTable({
        select:true,
        select: {
            info: false
        },
        pagingType: "simple",
        fnDrawCallback: function(oSettings) {
            if($('#citizen_id_record').DataTable().page.info().recordsTotal > 10){
                $('.dataTables_paginate').show();

            }else{
                if($('#citizen_id_record').DataTable().page.info().end > 10){
                    $('.dataTables_paginate').show();
                }else{
                    $('.dataTables_paginate').hide();
                }
            }
        },
        "language": {
            "search": "Citizen Name: "
        },
        "columnDefs": [
            { "width": "6%", "targets": 0 }
        ]
    });

    var table = $('#citizen_id_record').DataTable();
    $('#citizen_id_record tbody').on('click', 'tr', function () {

        if(!$(table.row(this).node()).hasClass('selected') && table.row(this).id() > 0){
            selectedCitizen(table.row(this).id());

            $('#form-id-col1').removeClass('d-none');
        }else{
            $('#form-id-col1').addClass('d-none');
        }
    });


    function selectedCitizen(id){
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
                var fullAddress ='';
                var fullname;
                if(data.citizen_add_address != null){
                    fullAddress += data.citizen_add_address + ', ';
                }

                if(data.zones_id_current != null){
                    fullAddress += data.citizen_to_zone.zones_name + ', ';
                }

                if(data.barangays_id_current != null){
                    fullAddress += data.citizen_to_barangay.barangays_name + ', ';
                }

                if(data.municipalities_id_current != null){
                    fullAddress += data.citizen_to_municipality.municipalities_name + ', ';
                }

                if(data.province_id_current != null){
                    fullAddress += data.citizen_to_province.province_name;
                }

                document.getElementById("citizen-img").src = "/images/profileid/" + data.citizens_img_src ;
                document.getElementById("qr-src").src = "/images/" + data.citizens_qr_src ;

                fullname = data.citizens_fname + ' ' + data.citizens_mname.charAt(0)+ '. ' + data.citizens_lname;

                if(data.citizens_suffix != null){
                    fullname += ' ' + data.citizens_suffix;
                }

                $('#citi_name').text(fullname);
                $('#citi_address').text(fullAddress.toLowerCase());
                $('#citi_gender').text(data.citizens_gender);
                
            },
         });


    }


});