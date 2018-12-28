function sendDeleteImage(id) {
    xhrGet("back/images.php?del=" + id, function (ev) {
        if(ev && ev.srcElement.readyState === 4){
            if(ev.srcElement.status === 200){
                if(ev.srcElement.response === "1"){
                    $( "#img-"+id ).fadeOut( "slow", function() {});
                }else{
                    console.log("Error: id not found");
                }
            }else{
                console.log('Error: '+ev.srcElement.statusText + '\n'+ev.srcElement.response);
            }
        }
    });
}

function uploadImages() {
    let inp = $('#img');

    if(inp.prop('files')){
        const fd = new FormData();
        console.log(inp.prop('files'));
        Array.from(inp.prop('files')).forEach((file) => {
            fd.append(inp.attr("name"), file, file.name);
        });
        xhrPost('back/images.php?upload='+itemId, fd, function (ev) {
            if(ev && ev.srcElement.readyState === 4){
                if(ev.srcElement.status === 200){
                    if(ev.srcElement.response === "1"){
                        $("#imgs-uploaded-alert").css("display", "block");
                    }else{
                        console.log("Error uploading: "+ev.srcElement.response);
                    }
                }else{
                    console.log('Error: '+ev.srcElement.statusText + '\n'+ev.srcElement.response);
                }
                $('#images-upload').css('pointer-events','all');
                $('#img-loader').css('display', 'none');
            }
        });
        $('#images-upload').css('pointer-events','none');
        $('#img-loader').css('display', 'block');
        console.log('sending');
    }else{
        console.log('no files');
        console.log(inp);
    }
}

function xhrGet(url, callback) {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.onreadystatechange = callback;
    xhr.send();
}
function xhrPost(url, body, callback) {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.onreadystatechange = callback;
    xhr.send(body);
}

$(function () {
    $('#img').change(uploadImages);
});