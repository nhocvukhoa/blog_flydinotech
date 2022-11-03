@extends('layouts.admin.app')

@section('content')
<section class="users-edit">
    <div class="card">
        <div class="card-body">
            <div class="col-sm-6">
                <h1 class="m-0">Edit User</h1>
            </div>
            <br>
            <div class="tab-content">
                <div class="tab-pane active fade show" id="account" aria-labelledby="account-tab" role="tabpanel">
                    <div class="media mb-2">
                        @if ($user->userProfile->avatar != null)
                            <img width="100px" height="100px" src="{{ asset('/storage/images/avatar/'.$user->userProfile->avatar) }}">
                        @elseif ($user->userProfile->gender == \App\Enums\Genre::MALE)
                            <img width="100px" height="100px" src="/admin/app-assets/images/avatar-male.png">
                        @else
                            <img width="100px" height="100px" src="/admin/app-assets/images/avatar-female.png">
                        @endif
                        <h3>Hi, {{ $user->userProfile->first_name }}</h3>
                    </div>
                        {!! Form::open([
                            'method' => 'put',
                            'route' => ['admin.user.update', $user],
                            'enctype' => "multipart/form-data"
                        ]) !!}
                            <div class="form-group">
                                {!! Form::label('avatar', 'change avatar', []) !!}
                                {!! Form::file('avatar', ['name'=>'avatar']) !!}
                            </div>
                            <div class="tab-pane active" id="settings">
                                @include('admin.user.form')
                            </div>
                            <div class="form-group row">
                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                <a href="{{ route('admin.user.index') }}" class="btn btn-secondary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Cancel</a>
                                {!! Form::submit('Save', ['class'=> 'btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
