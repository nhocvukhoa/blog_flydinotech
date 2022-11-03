@extends('layouts.admin.app')

@section('content')
<section id="widgets-Statistics">
    <div class="row">
        <div class="col-12 mt-1 mb-2">
            <h4>Welcome to Admin Dashboard</h4>
            <hr>
        </div>
    </div>
    <div class="col-md-12">
        @include('layouts.admin.partials.notice')
    </div>
    <div class="row">
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="badge-circle badge-circle-lg badge-circle-light-info mx-auto my-1">
                        <i class="bx bx-edit-alt font-medium-5"></i>
                    </div>
                    <h2 class="mb-0">{{ $countNewPosts }}</h2>
                    @if ($countNewPosts <= 1)
                        <p class="text-muted mb-0 line-ellipsis">New Post</p>
                    @else
                        <p class="text-muted mb-0 line-ellipsis">New Posts</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="badge-circle badge-circle-lg badge-circle-light-warning mx-auto my-1">
                        <i class="bx bx-file font-medium-5"></i>
                    </div>
                    <h2 class="mb-0">{{ $countPosts }} </h2>
                    @if ($countPosts <= 1)
                        <p class="text-muted mb-0 line-ellipsis">Post</p>
                    @else
                        <p class="text-muted mb-0 line-ellipsis">Posts</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto my-1">
                        <i class="bx bx-message font-medium-5"></i>
                    </div>
                    <h2 class="mb-0">{{ $countComments }}</h2>
                    @if ($countComments <= 1)
                        <p class="text-muted mb-0 line-ellipsis">Comment</p>
                    @else
                        <p class="text-muted mb-0 line-ellipsis">Comments</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="badge-circle badge-circle-lg badge-circle-light-primary mx-auto my-1">
                        <i class="bx bx-user-check font-medium-5"></i>
                    </div>
                    <h2 class="mb-0">{{ $countUsers }}</h2>
                    @if ($countUsers <= 1)
                        <p class="text-muted mb-0 line-ellipsis">User</p>
                    @else
                        <p class="text-muted mb-0 line-ellipsis">Users</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {!! Form::open(['method' => 'GET', 'route' => ['admin.dashboard.index'], 'class' => 'row mx-0'])!!}
        <div class="col-xl-5 col-md-12 d-flex align-items-center pl-0">
            {!! Form::text('titlePost', request()->titlePost, ['class' => 'form-control', 'name' => 'titlePost', 'placeholder' => 'Enter title post...']) !!}
        </div>
        <div class="col-xl-2 col-md-12 d-flex align-items-center pl-0">
            <select class="form-control selectCategory" name="selectCategory">
                <option value="">---Select category---</option>
                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ request()->selectCategory == $category->id ? 'selected' : '' }}
                    >{{ $category->title }}</option>
                        @foreach ($category->children as $key => $child)
                            <option
                                value="{{ $child->id }}"
                                {{ request()->selectCategory == $child->id ? 'selected' : '' }}
                            >&emsp;{{ $child->title }}</option>
                        @endforeach
                @endforeach
            </select>
        </div>
        <div class="col-xl-2 col-md-12 d-flex align-items-center pl-0 date datetimepicker6">
            {!! Form::text(
                'fromDate',
                request()->fromDate,
                ['class' => 'form-control', 'placeholder' => 'From Date', 'id' => 'fromDate', 'name' => 'fromDate', 'autocomplete' => 'off'])
            !!}
            <div class="form-control-position icon-calendar">
                <i class="bx bx-calendar text-dark"></i>
            </div>
        </div>
        <div class="col-xl-2 col-md-12 d-flex align-items-center pl-0 datetimepicker7">
            {!! Form::text(
                'toDate',
                request()->toDate,
                ['class' => 'form-control', 'placeholder' => 'To Date', 'id' => 'toDate', 'name' => 'toDate', 'autocomplete' => 'off'])
            !!}
            <div class="form-control-position icon-calendar">
                <i class="bx bx-calendar text-dark"></i>
            </div>
        </div>
        <div class="col-xl-1 col-md-12 d-flex align-items-center pl-0">
            {!! Form::submit('Search', ['type'=>'reset', 'class'=>'btn btn-dark find-post']) !!}
        </div>
    {!! Form::close() !!}
    @include('admin.dashboard.form')
    <div class="pagination justify-content-center">{{ $posts->appends(request()->all())->links() }}</div>
</section>
@endsection

@push('scripts')
<script type="text/javascript">
    $(function () {
        $("#fromDate").datepicker({ dateFormat: 'yy-mm-dd' });
        $("#toDate").datepicker({ dateFormat: 'yy-mm-dd' });
    });
</script>

<script>
    $(document).ready(function() {
        $('.selectCategory').select2({
            width: "resolve",
        });
    });
</script>
@endpush
