<div class="row admin-news-form">
    <div class="col-12 col-xl-8">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    {!! Form::label('title', 'Title') !!}
                    <span class="text-danger">*</span>
                    {!! Form::text(
                        'title',
                        isset($news->title) ? $news->title : old('title'),
                        ['class' => 'form-control', 'placeholder' => 'Enter title']
                    ) !!}
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <span class="text-danger error-text title_error"></span>
                </div>
                <div class="form-group">
                    {!! Form::label('description', 'Description') !!}
                    <span class="text-danger">*</span>
                    {!! Form::textarea(
                        'description',
                        isset($news->description) ? $news->description : old('description'),
                        ['class' => 'form-control', 'id' => 'new-description', 'placeholder' => 'Enter description']
                    ) !!}
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <span class="text-danger error-text description_error"></span>
                </div>
                <div class="form-group">
                    {!! Form::label('content', 'Content') !!}
                    <span class="text-danger">*</span>
                    {!! Form::textarea(
                        'content',
                        isset($news->content) ? $news->content : old('content'),
                        ['class' => 'form-control', 'id' => 'new-content','placeholder' => 'Enter content']
                    ) !!}
                    @error('content')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <span class="text-danger error-text content_error"></span>
                </div>
                <div class="form-group">
                    {!! Form::label('status', 'Status') !!}
                    <span class="text-danger">*</span>
                    {!! Form::select(
                        'status',
                        ['' => 'Please choose status', \App\Enums\NewsStatus::ACTIVE => 'Active', \App\Enums\NewsStatus::NOT_ACTIVE => 'Unactive'],
                        isset($news->status) ? $news->status : old('status'),
                        ['class' => 'form-control']
                    ) !!}
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <span class="text-danger error-text status_error"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-4">
        <div class="card">
            <div class="card-body">
                {!! Form::label('image', 'Image') !!}
                <span class="text-danger">*</span>
                <div class="form-group image-upload">
                    {!! Form::file('image', ['class' => 'form-control img-preview-news', 'id' => 'image']) !!}
                    {!! Html::decode(Form::label('image', '<i class="bx bx-plus-circle mt-1"></i>Upload<b class="mt-1">Or upload files by drag and drop</b>', ['class' => 'text-muted'])) !!}
                </div>
                <div class="text-center m-2">
                    <img src="{{ isset($news) ? asset('storage/' . $news->image) : asset('admin/images/noimg.png') }}" class="previewImg">
                </div>
                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror           
                <span class="text-danger error-text image_error"></span>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('admin/ckeditor4/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('new-content', {
        filebrowserUploadUrl: "{{ route('admin.news.upload', ['_token' => csrf_token()]) }}",
        filebrowserUploadMethod: 'form',
        extraPlugins: 'editorplaceholder',
        editorplaceholder: 'Enter content'
    }); 
</script> 
