@extends('layouts.admin.app')

@section('content')
<section id="dashboard-ecommerce">
    <div class="row">
        <div class="col-xl-12 col-md-12 dashboard-greetings">
            <div class="card">
                <form action="{{ route('admin.user.index') }}" method="get">
                    <div class="card-header">
                        <h3 class="greeting-text">Account Management</h3>
                        <div class="col-12 col-sm-5 col-lg-2 d-flex align-items-center text-left">
                            <a href="{{ route('admin.user.create') }}" class="btn btn-outline-dark btn-block glow find-user mb-0">Create User</a>
                        </div>
                    </div>
                </form>
                <div class="users-list-filter px-1">
                    {!! Form::open([
                        'method' => 'GET',
                        'route' => ['admin.user.index']]
                    )!!}
                        <div class="row rounded py-2 mb-2">
                            <div class="col-12 col-sm-6 col-lg-7 d-flex">
                                {!! Form::text(
                                    'find-user',
                                    '',
                                    ['class' => 'form-control', 'placeholder' => 'Enter name or email address...', 'id' => 'keywords', 'name' => 'keyword']
                                ) !!}
                                <div id="search"></div>
                            </div>
                            <div class="col-12 col-sm-5 col-lg-2 d-flex align-items-center">
                                {!! Form::submit('Find', ['type'=>'reset', 'class'=>'btn btn-outline-dark btn-block glow find-user mb-0']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <div class="table-responsive">
                        @include('layouts.admin.partials.notice')
                        <table id="users-list-datatable" class="table">
                            <thead>
                                <tr>
                                    <th>Avatar</th>
                                    <th>Name</th>
                                    <th>Mail</th>
                                    <th>Created Date</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $key => $user)
                                    <tr>
                                        <td>
                                            @if ($user->userProfile->avatar != null)
                                                <img class="avatar" src="{{ asset('/storage/images/avatar/'.$user->userProfile->avatar) }}">
                                            @elseif ($user->userProfile->gender == \App\Enums\Genre::MALE)
                                                <img class="avatar" src="/admin/app-assets/images/avatar-male.png">
                                            @else
                                                <img class="avatar" src="/admin/app-assets/images/avatar-female.png">
                                            @endif
                                        </td>
                                        <td>{{ $user->userProfile->full_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        @if ($user->status == \App\Enums\UserStatus::ACTIVE)
                                            <td>
                                                <span class="badge badge-light-success">ACTIVE</span>
                                            </td>
                                        @else
                                            <td>
                                                <span class="badge badge-light-danger">BANNED</span>
                                            </td>
                                        @endif
                                        <td>
                                            <div class="btn-group">
                                                @if ($user->status == \App\Enums\UserStatus::ACTIVE)
                                                    {!! Form::open([
                                                        'method' => 'put',
                                                        'route' => ['admin.user.block-user', $user],
                                                        'onsubmit' => 'return confirm("Block this user?")'
                                                    ])!!}
                                                        {!! Form::submit('Block', ['class' => 'btn btn-warning btn-sm rounded-0']) !!}
                                                    {!! Form::close() !!}
                                                @else
                                                    {!! Form::open([
                                                        'method' => 'put',
                                                        'route' => ['admin.user.block-user', $user],
                                                        'onsubmit' => 'return confirm("UnBlock this user?")'
                                                    ])!!}
                                                        {!! Form::submit('UnBlock', ['class' => 'btn btn-warning btn-sm rounded-0']) !!}
                                                    {!! Form::close() !!}
                                                @endif
                                                {!! Form::open([
                                                    'method' => 'delete',
                                                    'route' => ['admin.user.destroy', $user],
                                                    'onsubmit' => 'return confirm("Delete this user?")'
                                                ])!!}
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm rounded-0']) !!}
                                                {!! Form::close() !!}
                                                {!! Form::open([
                                                    'method' => 'get',
                                                    'route' => ['admin.user.edit', $user],
                                                ])!!}
                                                    {!! Form::submit('Edit', ['class' => 'btn btn-info btn-sm rounded-0']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <td colspan="5" class="text-center">No data available</td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination justify-content-center">{{ $users->appends(request()->all())->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
