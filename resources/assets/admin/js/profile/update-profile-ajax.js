$(document).ready(function($) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#update-profile-admin').submit(function (e) {
        e.preventDefault();
        var url = '/admin/profile/update';

        $.ajax({
            url: url,
            method: 'POST',
            data: new FormData(this),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function () {
                $(document).find('span.error-text').text('');
            },
            success: function (res) {
                if (res.status == 400) {
                    $.each(res.error, function(prefix, val) {
                        $('span.' + prefix + '_error').text(val[0]);
                    });
                } else {
                    $('.profile-admin').find('#message-profile').text(res.message);
                    document.getElementById('message-profile').style.display = 'block';
                    $('#message-profile').delay(2000).slideUp(300);
                    window.scrollTo(0,0);
                    window.setTimeout(function(){
                        location.reload();
                    }, 3000);
                }
            }
        });
    });
});
