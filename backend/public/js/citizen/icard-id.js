function profileLoad(){
    $('#generateState').addClass('d-none');
    $('#idGenerated').removeClass('d-none');
};

$(document).ready(function(){

    $('#download-d').click(function(){
        $('#downloadAlert').removeClass('d-none');
        window.scrollTo(0,0);
        $("html").addClass("hide-scrollbar");
        html2canvas(document.getElementById('person')).then(function (canvas){
            var link = document.createElement('a');
            document.body.appendChild(link);
            link.href = canvas.toDataURL("image/png");
            document.getElementById("redownload").href = canvas.toDataURL("image/png");
            document.getElementById("redownload").download = 'id.png';
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

});

