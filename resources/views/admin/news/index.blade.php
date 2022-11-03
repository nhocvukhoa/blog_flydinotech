@extends('layouts.admin.app')
@section('content')
<div class="content-body">
    <section class="news-view">
        <div class="d-flex justify-content-between align-items-center mb-2 news-header">
            <h5 class="content-header-title pr-1 mb-0">News Management</h5>
            <a href="{{ route('admin.news.create') }}" class="btn bg-warning text-white">Add</a>
        </div>
        @include('layouts.admin.partials.notice')
        <div class="card">
            <div class="card-body">
                <div class="col-md-12">
                    {{ Form::open(['method' => 'GET', 'route' => 'admin.news.index', 'class' => 'row form-search-news'])}}
                        {!! Form::text(
                            'title', 
                            request()->title, 
                            ['class' => 'form-control col-md-4 col-sm-12 title', 'placeholder' => 'Enter news title...']) 
                        !!}
                        {!! Form::select(
                            'status',
                            ['' => '--- Select status ---', \App\Enums\NewsStatus::ACTIVE => 'Active', \App\Enums\NewsStatus::NOT_ACTIVE => 'Unactive'],
                            request()->status,
                            ['class' => 'form-control col-md-3 col-sm-12 ml-md-1 ml-sm-0 status'])
                        !!}
                        {!! Form::submit('Search', ['class' => 'btn btn-sm btn-primary btn-search-news col-md-2 col-sm-12 ml-md-1 ml-sm-0']) !!}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Viewed</th>
                                        <th>User post</th>
                                        <th>Created date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($news as $new)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage/'.$new->image) }}" width="100px">
                                            </td>
                                            <td>{{ $new->title }}</td>
                                            <td>{{ $new->viewed }}</td>
                                            <td>{{ $new->user->userProfile->full_name }}</td>
                                            <td>{{ $new->getDateFormatAttribute('created_at') }}</td>
                                            <td>
                                                {!! Form::open(['method' => 'PUT', 'route' => ['admin.news.change_status', $new]]) !!}
                                                    @if ($new->status == \App\Enums\NewsStatus::NOT_ACTIVE)
                                                        {!! Form::button('Hide', ['class' => 'badge badge-light-danger border-0', 'type' => 'submit']) !!}
                                                    @else
                                                        {!! Form::button('Show', ['class' => 'badge badge-light-success border-0', 'type' => 'submit']) !!}
                                                    @endif
                                                {!! Form::close() !!}
                                            </td>
                                            <td>
                                                <div class="btn-group bx-pullet-left">
                                                    <a href="{{ route('admin.news.edit', $new) }}" class="btn btn-info btn-sm rounded-0">Edit</a>
                                                    {!! Form::open([
                                                        'method' => 'DELETE', 
                                                        'route' => ['admin.news.destroy', $new], 
                                                        'onsubmit' => 'return confirm("Are you sure you want to delete this new ?")'
                                                    ]) !!}
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger rounded-0']) !!}
                                                    {!! Form::close() !!}
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="7">No data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>              
                        </div>          
                    </div>                  
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="d-flex justify-content-center">
                {{ $news->appends(request()->all())->links() }}
            </div>
        </div>
    </section>
</div>
@endsection
