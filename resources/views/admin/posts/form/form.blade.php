<div class="row admin-post-add" id="post-form">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="form-group">
                    <h3 class="card-title">{{ Route::is('admin.posts.create') ? 'Add post' : 'Update post '.$post->title }}</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    {!! Form::label('title', 'Title') !!} 
                    <span class="text-danger">*</span>
                    {!! Form::text('title', isset($post->title) ? $post->title : old('title'), ['class' => 'form-control', 'id' => 'title-post', 'placeholder' => 'Please enter title']) !!}
                    <span class="text text-danger error-text title_error"></span>
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('description', 'Description') !!} 
                    <span class="text-danger">*</span>
                    {!! Form::textarea('description', isset($post->description) ? $post->description : old('description'), ['class' => 'form-control description', 'rows' => '3', 'placeholder' => 'Please enter description']) !!}
                    <span class="text text-danger error-text description_error"></span>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('content', 'Content') !!} 
                    <span class="text-danger">*</span>
                    {!! Form::textarea('content', isset($post->content) ? $post->content : old('content'), ['class' => 'form-control', 'id' => 'content-post', 'placeholder' => 'Please enter content']) !!}
                    <span class="text text-danger error-text content_error"></span>
                    @error('content')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('status', 'Status') !!} 
                    <span class="text-danger">*</span>
                    {!! Form::select('status', ['1' => 'Unactive', '2' => 'Active'], isset($post->status) ? $post->status : old('status'), ['class' => 'custom-select custom-select-lg']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                {!! Form::label('image', 'Image', ['class' => 'mb-1']) !!}
                <span class="text-danger">*</span>
                <div class="form-group image-upload">
                    {!! Form::file('image', ['class' => 'form-control img-preview-post', 'id' => 'image-post']) !!}
                    {!! Html::decode(Form::label('image-post', '<i class="bx bx-plus-circle mt-1"></i>Upload<b class="mt-1">Or upload files by drag and drop</b>', ['class' => 'text-muted'])) !!}
                    <div class="text-center m-2">
                        <img src="{{ isset($post->id) ? asset('storage/'.$post->image) : asset('admin/images/noimg.png') }}" id="preview-image-post" width="80%">
                    </div>
                    <span class="text text-danger error-text image_error"></span>
                </div>
                <div class="form-group">
                    {!! Form::label('category', 'Category', ['class' => 'mb-1']) !!}
                    <span class="text-danger">*</span>
                    {!! Form::select('category_id', $categories, isset($post->category_id) ? $post->category_id : '---', ['class' => 'custom-select custom-select-lg']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="card-footer">
        <div class="row">
            <div class="col-12 text-left">
                <a href="{{ route('admin.posts.index') }}" class="btn btn-primary px-4">Back</a>
                {{ Form::button(isset($post->id) ? 'Update' : 'Add', ['class' => 'btn btn-dark px-4', 'type' => 'submit']) }}
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('admin/ckeditor4/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('content-post', {
        filebrowserUploadUrl: "{{ route('admin.posts.upload', ['_token' => csrf_token()]) }}",
        filebrowserUploadMethod: 'form',
        extraPlugins: 'editorplaceholder',
        editorplaceholder: 'Please enter content'
    }); 
</script> 
