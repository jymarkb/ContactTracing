
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 1 || document.documentElement.scrollTop > 1) {
    document.getElementById("image-logo").style.width = "50px";
    document.getElementById("image-logo").style.height = "50px";
    document.getElementById("image-logo").style.transition="0.5s";
    var element = document.getElementById("navbar");
    element.classList.remove("bg-light");
    element.classList.add("scrolled-nav");
  } else {
    document.getElementById("image-logo").style.width = "70px";
    document.getElementById("image-logo").style.height = "70px";
    var element = document.getElementById("navbar");
    element.classList.add("bg-light");
    element.classList.remove("scrolled-nav");
  }
}



