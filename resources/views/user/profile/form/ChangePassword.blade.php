@extends('user.profile.index')

@section('user-profile-content')
<div class="user-change-password">
    <div class="container">
        <h2 class="title-form">Thay đổi mật khẩu</h2>
        <div class="messages"></div>
        {!! Form::open(['method' => 'POST', 'route' => 'change_password.save', 'class' => 'change-password-form']) !!}
            <div class="form-group">
                {!! Form::label('Old Password:', 'Mật khẩu cũ') !!}
                {!! Form::password('old_password', ['class' => 'form-control', 'placeholder' => 'Nhập mật khẩu cũ']) !!}
                <span class="text-danger error-text old_password_error"></span>
            </div> 
            <div class="form-group">
                {!! Form::label('New Password', 'Mật khẩu mới') !!}
                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Nhập mật khẩu mới']) !!}
                <span class="text-danger error-text password_error"></span>
            </div>
            <div class="form-group">
                {!! Form::label('confirm_password', 'Nhập lại mật khẩu mới') !!}
                {!! Form::password('confirm_password', ['class' => 'form-control', 'placeholder' => 'Nhập lại mật khẩu mới']) !!}
                <span class="text-danger error-text confirm_password_error"></span>
            </div>
            <div class="form-group d-grid">
                {!! Form::submit('Xác nhận', ['class' => 'btn btn-primary p-2 btn-change-password']) !!}
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.change-password-form').submit(function (e) {
                e.preventDefault();
                
                $.ajax({
                    url: "{{ route('change_password.save') }}",
                    method: 'POST',
                    data: new FormData(this),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function () {
                        $(document).find('.change-password-form span.error-text').text('');
                    },
                    success: function(data) {
                        if (data.status == 200) {
                            $('.change-password-form').find('input:password').val('');
                            $('.messages').html('');
                            $('.messages').append(
                                `<div class="alert alert-success">${data.message}</div>`
                            );
                            $('html, body').animate({ scrollTop: 0 }, 'slow');
                            $('.alert').delay(5000).slideUp(300);
                        } else {
                            $.each(data.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                            });
                        }
                    }  
                });
            });
        });
    </script>
@endpush
