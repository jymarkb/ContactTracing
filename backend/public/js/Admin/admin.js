$(document).ready(function(){
     ajaxMap();
     if($(window).width() <= 530){
          $('#accordionSidebar').addClass('toggled');
     }else{
          $('#accordionSidebar').removeClass('toggled');
     }
     if($(window).width() <= 992){
          $('.idrow').addClass('justify-content-center');
     }else{
          $('.idrow').removeClass('justify-content-center');
     }
     $(window).resize(function() {
          if($(window).width() <= 530){
               $('#accordionSidebar').addClass('toggled');
          }else{
               $('#accordionSidebar').removeClass('toggled');
          }
     
          if($(window).width() <= 992){
               $('.idrow').addClass('justify-content-center');
          }else{
               $('.idrow').removeClass('justify-content-center');
          }
     });

     $(function () {
          $('[data-toggle="popover"]').popover()
     })


     $(".pin-positive").hover(function(){
          var className = $(this).attr('class');

          $_token = $('meta[name="csrf-token"]').attr('content');
          var click = 'true';
          $.ajax({
               type:'POST',
               url: "/map/info",
               async:false,
               data: {_token: $_token,click:click, brgy:className.substr(4,4)},
               success: function(data){
                    $("."+ className.substr(0,8)).popover("dispose").popover({
                         title: data.name,
                         content: data.count + " confirmed case"
                    });
               }
          });



     }); 

});


function ajaxMap() {
     $_token = $('meta[name="csrf-token"]').attr('content');
     var map = 'true';
     $.ajax({
          type:'POST',
          url: "/map/sync",
          async:false,
          data: {_token: $_token,map:map},
          success: function(data){
               for(i = 0 ; i < data.length; i++){
                    $(".map-"+data[i].barangays_id_current).addClass('positive');

                    $(".pin-"+data[i].barangays_id_current).addClass('pin-positive');
               }
          }
     });
}


