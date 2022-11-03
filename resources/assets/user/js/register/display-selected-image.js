$('.register-form input[name = "avatar"]').on('change', function () {
    var file = $('.register-form').find('.img-preview-user').get(0).files[0];

    if (file) {
        var reader = new FileReader();

        reader.onload = function () {
            $('.register-form').find('.preview-avatar-user').attr('src', reader.result);
        }
        
        reader.readAsDataURL(file);
    }
});
