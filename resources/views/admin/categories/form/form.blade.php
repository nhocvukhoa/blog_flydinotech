<div class="card-body">
    <div class="form-group">
        {!! Form::label('title', 'Title') !!}
        <span class="text-danger">*</span>
        {!! Form::text('title', isset($category->title) ? $category->title : old('title'), ['class' => 'form-control', 'id' => 'basic-default-name', 'placeholder' => 'Please enter title']) !!}
        @error('title')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        {!! Form::label('description', 'Description') !!}
        <span class="text-danger">*</span>
        {!! Form::textarea('description', isset($category->description) ? $category->description : old('description'), ['class' => 'form-control', 'id' => 'validationBio', 'placeholder' => 'Please enter description']) !!}
        @error('description')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        {!! Form::label('status', 'Status') !!}
        <span class="text-danger">*</span>
        {!! Form::select('status', \App\Enums\CategoryStatus::getKeys(), isset($category->status) ? $category->status : old('status'), ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('parent_id', 'Parent category') !!}
        {!! Form::select('parent_id', ['' => '--- Select parent category ---', ' ' => $categories], isset($category->parent_id) ? $category->parent_id : '', ['class' => 'form-control']) !!}
    </div>
    @if (Route::is('admin.categories.edit'))
        <label>ORDER BY</label>
        <select class="form-control" name="order_by">
            @foreach ($categoriesOrderBy as $item)
                @if ($item->order_by == $category->order_by)
                    <option selected value="{{ $item->order_by }}">{{ $item->order_by }}-{{ $item->title }}</option>
                @else
                    <option value="{{ $item->order_by }}">{{ $item->order_by }}-{{ $item->title }}</option>
                @endif
            @endforeach 
        </select>
    @endif
</div>
