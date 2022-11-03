@extends('layouts.admin.app')

@section('content')
<section class="users-edit">
    <div class="card">
        <div class="card-body">
            <div class="col-sm-6">
                <h1 class="m-0">Create User</h1>
            </div>
            <br>
            <div class="tab-content">
                <div class="tab-pane active fade show" id="account" aria-labelledby="account-tab" role="tabpanel">
                    {!! Form::open([
                        'method' => 'post',
                        'route' => ['admin.user.store'],
                        'enctype' => "multipart/form-data"
                    ]) !!}
                        <div class="form-group">
                            {!! Form::label('avatar', 'Choose avatar', []) !!}
                            {!! Form::file('avatar', ['name'=>'avatar']) !!}
                        </div>
                        <div class="tab-pane active" id="settings">
                            @include('admin.user.form')
                        </div>
                        <div class="form-group row">
                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                            <a href="{{ route('admin.user.index') }}" class="btn btn-secondary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Cancel</a>
                            {!! Form::submit('Add User', ['class'=> 'btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
