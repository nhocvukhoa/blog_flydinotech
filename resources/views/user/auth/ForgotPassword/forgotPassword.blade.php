@extends('layouts.user.unauth_app')
@section('content-user')
<section class="login-validation">
    <div class="login-form m-2 py-4 px-5">
        <h4 class="mb-4">Quên mật khẩu ?</h4>
        <div class="d-flex justify-content-between flex-wrap">
            <a href="{{ route('login') }}" class="btn btn-outline-primary ms-0 my-1">Đăng nhập</a>
            <a href="{{ route('register') }}" class="btn btn-outline-primary me-0 my-1">Đăng ký</a>
        </div>
        <p class="my-4 text-center small">Nhập email hoặc số điện thoại bạn đã sử dụng khi đăng ký và chúng tôi sẽ gửi cho bạn mật khẩu tạm thời</p>
        {!! Form::open(['method' => 'POST', 'route' => ['forgot_password.find_email', 'vi']]) !!}
            <div class="form-group">
                {!! Form::label('email', 'Địa chỉ email của bạn', ['class' => 'text-uppercase small mb-1']) !!}
                {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Địa chỉ email của bạn']) !!}
                @error ('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group d-grid">
                <button type="submit" class="text-center btn btn-primary glow position-relative shadow">
                    <span>Gửi yêu cầu</span>
                    <i id="icon-arrow" class="bx bx-right-arrow-alt me-0"></i>
                </button>
            </div>
        {!! Form::close() !!}
        <div class="row form-group align-middle mt-4">
            <div class="col-3"><hr/></div>
            <div class="col-6 text-center">Hoặc đăng nhập với</div>
            <div class="col-3"><hr/></div>
        </div>
        @include('user.auth.AnotherLogin.anotherLogin')
    </div>
</section>
@endsection
