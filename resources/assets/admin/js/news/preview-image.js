$(document).ready(function () {
    $('.admin-news-form input[name="image"]').on('change', function () {
        var file = $('.admin-news-form').find('.img-preview-news').get(0).files[0];

        if (file) {
            var reader = new FileReader();

            reader.onload = function () {
                $('.admin-news-form').find('.previewImg').attr('src', reader.result);
            }

            reader.readAsDataURL(file);
        }
    });
});
