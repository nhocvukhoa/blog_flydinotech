@extends('layouts.admin.app')
@section('content')
<section class="simple-validation">
    <div class="admin-category">
        @include('layouts.admin.partials.notice')
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <h3 class="card-title">Update Category <b>{{ $category->title }}</b></h3>
                </div>
                <div class="card">
                    {!! Form::open(['method' => 'PUT', 'route' => ['admin.categories.update', $category]]) !!}
                        @include('admin.categories.form.form')
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-12">
                                    <a href="{{ route('admin.categories.index') }}" class="btn btn-primary px-4">Back</a>
                                    {!! Form::button('Update', ['class' => 'btn btn-dark px-4', 'type' => 'submit']) !!}
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
