@extends('layouts.admin.app')
@section('content')
<section class="simple-validation">
    <div class="admin-post">
        @include('layouts.admin.partials.notice')
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <h3 class="card-title">Update Post</h3>
                </div>
            </div>
        </div>
        {{ Form::open(['method' => 'PUT', 'route' => ['admin.posts.update', $post], 'enctype' => 'multipart/form-data']) }}
            @include('admin.posts.form.form')
        {{ Form::close() }}
    </div>
</section>
@endsection
