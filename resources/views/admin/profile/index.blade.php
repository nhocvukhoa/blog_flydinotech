@extends('layouts.admin.app')
@section('content')
<section class="simple-validation">
    <div class="profile-admin">
        @include('layouts.admin.partials.notice')
        <div class="alert alert-success" id="message-profile"></div>
        {!! Form::open(['id' => 'update-profile-admin', 'enctype' => 'multipart/form-data']) !!}
            @include('admin.profile.form')
        {!! Form::close() !!}
    </div>
</section>
@endsection
