@extends('layouts.admin.app')
@section('content')
<section class="simple-validation">
    <div class="admin-post">
        @include('layouts.admin.partials.notice')
        <div class="card">
            <div class="row p-2">
                <div class="col-md-8">
                    <h2>Post Management</h2>
                </div>
                <div class="col-md-4 text-right">
                    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary glow px-5" role="button" aria-pressed="true">Create</a>
                </div>
            </div>
        </div>
        @include('admin.posts.search')
        <div class="card">
            @include('admin.posts.list')
        </div>
        <div class="page-item pagination d-flex justify-content-center">
            {{ $posts->appends(request()->all())->links() }}
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script>
    $('.select-category').select2();
    $('.create-date').datepicker({ dateFormat: 'yy-mm-dd' });
</script>
@endpush
