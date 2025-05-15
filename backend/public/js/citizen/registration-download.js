function profileLoad(){
    $('#generateState').addClass('d-none');
    $('#idGenerated').removeClass('d-none');
};

$(document).ready(function(){

    $('#download').click(function(){
        // $('#downloadAlert').removeClass('d-none');
        // window.scrollTo(0,0);
        // $("html body").addClass("hide-scrollbar");
        // html2canvas(document.getElementById('person')).then(function (canvas){
        //     var link = document.createElement('a');
        //     document.body.appendChild(link);
        //     link.href = canvas.toDataURL("image/png");
        //     document.getElementById("redownload").href = canvas.toDataURL("image/png");
        //     document.getElementById("redownload").download = 'id.png';
        //     link.download = 'id.png';
        //     link.click();
        //     document.body.removeChild(link);
        // });
        // $("html body").removeClass("hide-scrollbar");
        
        domtoimage.toJpeg(document.getElementById('person'))
        .then(function (blob) {
            console.log(blob);
            window.saveAs(blob, 'id.png');
        });

        

    });
});



