$('#info-admin-form input[name = "avatar"]').on('change', function () {
    var file = $('#info-admin-form').find('#avatar-file-admin').get(0).files[0];

    if (file) {
        var reader = new FileReader();

        reader.onload = function () {
            $('#info-admin-form').find('.preview-avatar-admin').attr('src', reader.result);
        }
        
        reader.readAsDataURL(file);
    }
});
