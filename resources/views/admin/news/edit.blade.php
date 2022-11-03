@extends('layouts.admin.app')
@section('content')
<h5 class="content-header-title pr-1 mb-2 ml-2">Update News</h5>
<div class="content-body">
    @include('layouts.admin.partials.notice')
    <section class="news-update">
        {!! Form::open(['method' => 'PUT', 'route' => ['admin.news.update', $news], 'enctype' => 'multipart/form-data']) !!}
            @include('admin.news.form')
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('admin.news.index') }}" class="btn btn-info">Back</a>
                    {{ Form::submit('Update', ['class' => 'btn btn-dark btn-update']) }}
                </div>
            </div>
        {{ Form::close() }}
    </section>
</div>
@endsection
