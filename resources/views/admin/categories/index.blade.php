@extends('layouts.admin.app')
@section('content')
<section class="simple-validation">
    <div class="admin-category">
        @include('layouts.admin.partials.notice')
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <h3 class="card-title">Add Category</h3>
                </div>
            </div>
            <div class="col-md-8 mb-1">
                {{ Form::open(['method' => 'GET', 'route' => ['admin.categories.index', $listCategories], 'class' => 'd-flex search-category-form']) }}
                    {!! Form::select('keyword', ['' => '--- Select category ---', ' ' => $categories], request()->keyword, ['class' => 'select-category custom-select custom-select-lg']) !!}
                    {!! Form::submit('Search', ['class' => 'btn btn-primary glow px-5 search']) !!}
                {{ Form::close() }}
            </div>
        </div>
        <div class="row">
            @include('admin.categories.form.create')
            @include('admin.categories.list')
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script>
    $('.select-category').select2();
</script>
@endpush
