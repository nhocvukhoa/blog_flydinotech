<div class="search-post">
    {{ Form::open(['method' => 'GET', 'route' => ['admin.posts.index', $posts], 'class' => 'row search-post-form align-items-center']) }}
        <div class="col-md-12 col-xl-2 title-post mb-1 px-0">
            {!! Form::text('title', request()->title, ['class' => 'form-control', 'placeholder' => 'Enter post \'s title']) !!}
        </div>
        <div class="col-md-12 col-xl-2 user-post mb-1 pr-0">
            {!! Form::text('user', request()->user, ['class' => 'form-control', 'placeholder' => 'Enter username ']) !!}
        </div>
        <div class="col-md-12 col-xl-2 category-post mb-1 pr-0">
            {!! Form::select('category', ['' => '---Select category---', ' ' => $categories], request()->category, ['class' => 'select-category custom-select custom-select-lg']) !!}
        </div>
        <div class="col-md-12 col-xl-2 create-date-post mb-1 pr-0">
            <div class="d-flex align-items-center date datetimepicker6">
                {!! Form::text('createDate', request()->createDate, ['class' => 'form-control create-date', 'placeholder' => 'Create date', 'autocomplete' => 'off']) !!}
                <div class="form-control-position icon-calendar">
                    <i class="bx bx-calendar text-dark"></i>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-xl-2 status-post mb-1 pr-0">
            {!! Form::select('status', ['' => '--- Select status ---', '1' => 'Unactive', '2' => 'Active'], request()->status, ['class' => 'custom-select custom-select-lg']) !!}
        </div>
        <div class="col-md-12 col-xl-2 search-post mb-1 pr-0">
            {{ Form::button('Search', ['class' => 'btn btn-dark glow btn-search', 'type' => 'submit']) }}
        </div>
    {{ Form::close() }}
</div>
