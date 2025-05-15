$(".nav-link").click(function () {
    $("a.active").removeClass('active');
    $(this).addClass('active');
    var active_section = $(this).attr('href');
    $('html, body').animate({
    scrollTop: $(active_section).offset().top
    }, 1000);
  });
  
  
  $(document).ready(function(){
    $(window).scroll(function (event) {
      var top = $(window).scrollTop();
        if(top < 500){
          $("a.active").removeClass('active');
          $("#nav-home").addClass('active');
        }else if(top < 1300){
          $("a.active").removeClass('active');
          $("#nav-transmission").addClass('active');
        }else if(top < 2000){
          $("a.active").removeClass('active');
          $("#nav-symptoms").addClass('active');
  
        }else if(top < 2700){
          $("a.active").removeClass('active');
          $("#nav-prevent").addClass('active');
        }else if(top < 3500){
          $("a.active").removeClass('active');
          $("#nav-contact").addClass('active');
  
        }else{
          $("a.active").removeClass('active');
        }
  
  
    });
  });