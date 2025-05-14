var selectedCTZ;
$(document).ready(function() {
    // tracenames();

    getTraceName();

    document.getElementById('search-list').addEventListener('keyup', e =>{
        var search = '';
        if(e.target.value != ''){
            search = e.target.value;
        }
        if(search != ''){
            getTraceName(search);
        }else{
            getTraceName();
        }
    });
});

function listCtz(id) {
    selectedCTZ = id;
    if($('.'+id).hasClass('active')){
        $('.'+id).removeClass('active');
        $('#trace-list-report').text('');
        $('#card-citizen-info').addClass('d-none');
        $('#trace-list-report').append('<li class="es-row text-side-info" ><h4>Please select citizen name on the list.</h4></li>');
    }else{
        $('.card-border').removeClass('active');
        $('.'+id).addClass('active');
        var selected_id = id.split('-')[1];
        $_token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "/misu/trace/select",
            type:"GET",
            async:false,
            data:{
                selected_id:selected_id,
                _token: $_token
            },
            success:function(data){
                setViewData(data);
            }
        });   
    }

    // console.log(id.split('-')[1]);

    
    
}

function setViewData(data) {
    $('#card-citizen-info').removeClass('d-none');

    var fullname = data.citizensData[0].citizens_fname + " " + data.citizensData[0].citizens_mname.substr(0,1) + '. ' +data.citizensData[0].citizens_lname;
    var month = ['January', 'February', 'March' , 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    if(data.citizensData[0].citizens_suffix != null){
        $('#trace-name').text(nameTable(fullname) + " " + data.citizensData[0].citizens_suffix);
    }else{
        $('#trace-name').text(nameTable(fullname));
    }

    $('#trace-gender').text(data.citizensData[0].citizens_gender);
    $('#trace-age').text((new Date()).getFullYear() - data.citizensData[0].citizens_bday.substr(0,4));
    $('#trace-bday').text(month[parseInt(data.citizensData[0].citizens_bday.substr(5,2))-1] + " " + data.citizensData[0].citizens_bday.substr(8,2)+ ", " +data.citizensData[0].citizens_bday.substr(0,4));
    $('#trace-mobile').text(data.citizensData[0].citizens_mobile);
    
    var address = data.citizensData[0].barangays_name + ", " + data.citizensData[0].municipalities_name + ", " +  data.citizensData[0].province_name;
    if(data.citizensData[0].zones_id_current != null){
        address = data.citizensData[0].zones_name + ", " + address;
    }
    if(data.citizensData[0].citizen_add_address_current != null){
        address = data.citizensData[0].citizen_add_address_current + ", " + address;
    }
    $('#trace-address').text(address);

    // $('#trace-status').text(data.tagData[0].tag_desc_name);
    // $('.es-row').text("");
    $('#trace-list-report').text('');
    var rowES = [];
    var rowESname = [];
    for(var i = 0; i < data.traceData.length ; i++){
        var rowID = data.traceData[i].establishments_id+'-'+parseInt(data.traceData[i].scans_timein.substr(6,2))+'-'+ data.traceData[i].scans_timein.substr(0,4) + '-'+ data.traceData[i].scans_timein.substr(8,2);

        if(!rowES.includes(rowID)){
            rowES.push(rowID);
            rowESname.push(data.traceData[i].establishments_name);
        }

        var getRow = document.getElementById('esrow-'+ rowID);

        if(!getRow){
            $('#trace-list-report').append('<li id="'+ 'esrow-'+ rowID +'"></li>');
        }
    }


    if(rowES.length > 0){
        for(var j = 0; j < rowES.length; j++){
            for(var k = 0; k < data.traceData.length; k++){
                if($('#esrow-'+rowES[j]).text() == ''){
                    $('#esrow-'+rowES[j]).append('<div class="row"><div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-8"><h4 class=" text-es-title font-weight-bold m-0 p-0 mt-3">'+ nameTable(rowESname[j]) +'</h4></div><div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-4 text-center text-white bg-es-title"> <h5 class="font-weight-bold m-0 mt-1">'+parseInt( rowES[j].split('-')[3]) +'</h5> <p class="small mb-2 p-0 font-weight-bold text-nowrap">'+ month[(rowES[j].split('-')[1])-1]+'</p></div></div> <div class="row border-top border-secondary text-side-info"> <p class="small font-weight-bold mt-1">Interacted with :</p> <div class="col-xl-12" id="int-'+rowES[j]+'"></div></div>');
                }
    
                if(data.traceData[k].establishments_id == rowES[j].split('-')[0]){
                    var interName = data.traceData[k].citizens_fname + " " + data.traceData[k].citizens_mname.substr(0,1) + ". " + data.traceData[k].citizens_lname;
                    if(data.traceData[k].citizens_suffix != null){
                        interName = nameTable(interName) + " " + data.traceData[k].citizens_suffix;
                    }else{
                        interName = nameTable(interName);
                    }
    
                    var interAdd = data.traceData[k].barangays_name + ", " + data.traceData[k].municipalities_name + ", " + data.traceData[k].province_name;
    
                    if(data.traceData[k].zones_id_current != null){
                        interAdd = data.traceData[k].zones_name + ", " + interAdd;
                    }
                    if(data.traceData[k].citizen_add_address_current != null){
                        interAdd = nameTable(data.traceData[k].citizen_add_address_current) + ", " + interAdd;
                    }
    
                    $('#int-'+rowES[j]).append('<div class="card border-0 rounded-0 pb-2"><div class="card-body p-0"><div class="row"><div class="col-sm-2 col-3 d-flex align-items-center"><img src="/images/profileid/'+data.traceData[k].citizens_img_src+'" alt="" class="rounded-circle w-100"> </div><dd class="col-sm-10 col-9 align-self-center"><p class="font-weight-bold p-0 m-0">'+  interName +' <span class="badge badge-light border border-primary text-primary ">10 min</span></p><p class="small p-0 m-0">' + interAdd + '</p></dd></div></div></div><hr class="sidebar-divider m-0 mt-1 mb-2">');
                }
            }   
        }
    }else{
        $('#trace-list-report').append('<li class="es-row text-side-info" ><h4>No Person Contacted</h4></li>');
    }
}

function getTraceName(search) {
    $_token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type:'get',
        url: "/misu/trace-name",
        async: false,
        data: {_token: $_token,search:search},
        success: function(data){
            $('#list-trace').text("");
            for(var i = 0; i < data.length ; i++){
                if(data[i].citizens_suffix != null){
                    $('#list-trace').append(' <div class="col-xl-12"> <div class="card rounded-0 border-0 card-border text-truncate ctz-'+data[i].citizens_id+'"> <div class="card-body p-2 px-3 trace-citizen" onclick="listCtz(this.id);" id="ctz-'+data[i].citizens_id+'">' + nameTable(data[i].citizens_fname) + ' ' + nameTable(data[i].citizens_mname.substr(0,1)) + '. ' + nameTable(data[i].citizens_lname) + ' '+ data[i].citizens_suffix + '</div></div> <hr class="sidebar-divider m-0 mt-1 mb-1"></div>');
                }else{
                    $('#list-trace').append(' <div class="col-xl-12"> <div class="card rounded-0 border-0 card-border text-truncate  ctz-'+data[i].citizens_id+'"> <div class="card-body p-2 px-3 trace-citizen" onclick="listCtz(this.id);" id="ctz-'+data[i].citizens_id+'">' + nameTable(data[i].citizens_fname) + ' ' + nameTable(data[i].citizens_mname.substr(0,1)) + '. ' + nameTable(data[i].citizens_lname) +'</div></div> <hr class="sidebar-divider m-0 mt-1 mb-1"></div>');
                }
                
            }
        }
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