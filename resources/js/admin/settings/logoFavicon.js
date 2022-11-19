
function addEventRenderImageFromUpload(input, outputImage) {
    input.on('change', e => {
        let element = e.target;
        const reader = new FileReader();
        reader.onload = function() {
            var dataURL = reader.result;
            outputImage.attr("src", dataURL);
        }
        if (element.files.length > 0) {
            reader.readAsDataURL(element.files[0]);
        }

        e.preventDefault();
    });   
}

addEventRenderImageFromUpload(
    $('#logo'), 
    $('#imageLogo'),
);

addEventRenderImageFromUpload(
    $('#favicon'), 
    $('#imageFavicon'),
);