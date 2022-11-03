$('#post-form input[name = "image"]').on('change', function () {
    var file = $('#post-form').find('.img-preview-post').get(0).files[0];

    if (file) {
        var reader = new FileReader();

        reader.onload = function () {
            $('#post-form').find('#preview-image-post').attr('src', reader.result);
        }
        
        reader.readAsDataURL(file);
    }
});
