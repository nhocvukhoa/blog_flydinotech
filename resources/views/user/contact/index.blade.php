@extends('layouts.user.app')

@section('content')
<div class="contact-us">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <img class="image-contact" src="{{ asset('images/contact.JPG') }}" alt="Liên hệ với chúng tôi">
            </div>
            <div class="col-lg-5 text-contact">
                @include('layouts.user.partials.notice')
                {!! Form::open(['method' => 'post', 'route' => ['contact_us.store', 'vi'], 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    {!! Form::label('full_name', 'Họ và tên') !!}
                    {!! Form::text('full_name', '', ['class' => 'form-control', 'placeholder' => 'Họ và tên']) !!}
                    @error('full_name')
                        <span class="text-danger mt-5">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                    @error('email')
                        <span class="text-danger mt-5">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('phone', 'Số điện thoại') !!}
                    {!! Form::text('phone', '', ['class' => 'form-control', 'placeholder' => 'Số điện thoại']) !!}
                    @error('phone')
                        <span class="text-danger mt-5">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('content', 'Mô tả') !!}
                    {!! Form::textarea('content', '', ['class' => 'form-control', 'placeholder' => 'Hãy viết gì đó']) !!}
                    @error('content')
                        <span class="text-danger mt-5">{{ $message }}</span>
                    @enderror
                </div>
                    {!! Form::button('Gửi', ['class' => 'form-control btn btn-primary button-contact', 'type' => 'submit']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
