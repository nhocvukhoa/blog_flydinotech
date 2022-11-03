@extends('layouts.user.unauth_app')
@section('content-user')
<section class="register-validation">
    <div class="text-center m-2">
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('images/favicon.png') }}" width="20%" class="icon">
        </a>
    </div>
    <div class="register-form">
        <div class="m-2 p-3">
            <h4>Đăng ký tài khoản</h4>
            <p>Chào mừng bạn đến <b>Nền tảng chúng tôi!</b> Tham gia cùng chúng tôi để tìm kiếm thông tin hữu ích cần thiết để cải thiện kỹ năng IT của bạn. Vui lòng điền thông tin của bạn vào biểu mẫu bên dưới để tiếp tục.</p>
            {!! Form::open(['id' => 'registerForm', 'name' => 'registerForm', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    {!! Form::text('first_name', old('first_name'), ['class' => 'form-control', 'placeholder' => 'Tên của bạn']) !!}
                    <span class="text text-danger error-text first_name_error"></span>
                </div>
                <div class="form-group">
                    {!! Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Địa chỉ email của bạn']) !!}
                    <span class="text text-danger error-text email_error"></span>
                </div>
                <div class="form-group">
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Mật khẩu']) !!}
                    <span class="text text-danger error-text password_error"></span>
                </div>
                <div class="form-group">
                    {!! Form::password('confirm_password', ['class' => 'form-control', 'placeholder' => 'Xác nhận mật khẩu của bạn']) !!}
                    <span class="text text-danger error-text confirm_password_error"></span>
                </div>
                <div class="form-group mt-10">
                    <div class="d-flex flex-row">
                        {!! Form::checkbox('agree_terms', old('agree_terms'), false, ['class' => 'check-terms me-1']) !!}
                        {!! Html::decode(Form::label('agree_terms', 'Tôi đồng ý <b class="text-primary">Điều khoản dịch vụ của chúng tôi</b>')) !!}
                    </div>
                    <span class="text text-danger error-text agree_terms_error"></span>
                </div>
                <div class="form-group d-grid">
                    {!! Form::submit('Đăng ký', ['class' => 'btn btn-primary p-2']) !!}
                </div>
            {!! Form::close() !!}
            <div class="text-center mb-2">
                <span>Bạn đã có tài khoản?</span>
                <a href="{{ route('login') }}">Đăng nhập</a>
            </div>
            <div class="row form-group align-middle">
                <div class="col"><hr/></div>
                <div class="col text-center"><b>Đăng nhập với</b></div>
                <div class="col"><hr/></div>
            </div>
            <div class="form-group row another-login">
                <div class="col row">
                    <div class="col">
                        <a href="{{ url('login/facebook') }}" class="btn form-control d-flex my-1">
                            <i class="fa-brands fa-facebook-f icon-fa"></i>
                            <span>Facebook</span>
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{ url('login/google') }}" class="btn form-control d-flex my-1">
                            <i class="fa-brands fa-google icon-fa"></i>
                            <span>Google</span>
                        </a>
                    </div>
                </div>
                <div class="col row">
                    <div class="col">
                        <a href="{{ url('login/github') }}" class="btn form-control d-flex my-1">
                            <i class="fa-brands fa-github icon-fa"></i>
                            <span>Github</span>
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{ url('login/twitter') }}" class="btn form-control d-flex my-1">
                            <i class="fa-brands fa-twitter icon-fa"></i>
                            <span>Twitter</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function($){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $('#registerForm').submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: '/register/vi',
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
                            $('#registerForm').find('input:password').val('');
                        });
                    } else {
                        $('#registerForm').find('input:text, input:password, input:file, textarea, checkbox, select').val('');
                        toastr.success(res.message);
                    }
                }
            });
        });
    });
</script>
@endpush
