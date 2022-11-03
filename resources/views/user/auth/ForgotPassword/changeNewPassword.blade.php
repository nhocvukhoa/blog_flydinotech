@extends('layouts.user.unauth_app')
@section('content-user')
<section class="login-validation">
    <div class="login-form m-2 py-4 px-5">
        <h4 class="mb-4 text-center">Đổi mật khẩu ?</h4>
        <div class="d-flex justify-content-between flex-wrap mb-3">
            <a href="{{ route('login') }}" class="btn btn-outline-primary ms-0 my-1">Đăng nhập</a>
            <a href="{{ route('register') }}" class="btn btn-outline-primary me-0 my-1">Đăng ký</a>
        </div>
        {!! Form::open(['method' => 'POST', 'route' => ['forgot_password.save_password', 'vi']]) !!}
            {!! Form::hidden('email', $email) !!}    
            <div class="form-group">
                {!! Form::label('password', 'Mật khẩu mới', ['class' => 'text-uppercase small mb-1']) !!}
                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Nhập mật khẩu mới']) !!}
                @error ('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                {!! Form::label('confirm_password', 'Nhập lại mật khẩu mới', ['class' => 'text-uppercase small mb-1']) !!}
                {!! Form::password('confirm_password', ['class' => 'form-control', 'placeholder' => 'Nhập lại mật khẩu mới']) !!}
                @error ('confirm_password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group d-grid">
                {!! Form::submit('Xác nhận', ['class' => 'btn btn-primary p-2']) !!}
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
