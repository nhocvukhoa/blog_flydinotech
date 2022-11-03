@extends('layouts.admin.app')

@section('content')
<section id="widgets-Statistics">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 mt-1 mb-2">
                    <h4>Setting About Us</h4>
                    <hr>
                </div>
            </div>
            <div class="col-md-12">
                @include('layouts.admin.partials.notice')
            </div>
            {!! Form::open([
                'method' => 'put',
                'route' => ['admin.options.update', $aboutUs],
                'enctype' => "multipart/form-data"
            ])!!}
                <div class="row">
                    <div class="col-12">           
                        <div class="form-group">
                            {!! Form::label('title', 'title') !!}
                            <span class="text text-danger">*</span>
                            {!! Form::text(
                                'title',
                                isset($aboutUs->title) ? $aboutUs->title : old('title'),
                                ['class'=>'form-control', 'placeholder'=>'Enter Title...'])
                            !!}
                            @error('title')
                                <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! Form::label('content', 'content') !!}
                            <span class="text text-danger">*</span>
                            {!! Form::textarea(
                                'content',
                                isset($aboutUs->content) ? $aboutUs->content : old('content'),
                                ['class'=>'form-control', 'id' => 'content-about-us', 'placeholder'=>'Enter Content...'])
                            !!}
                            @error('content')
                                <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! Form::label('type', 'type') !!}
                            @if ($aboutUs->type == \App\Enums\OptionType::ABOUT_US)
                                {!! Form::text('type', trans('messages.type.about_us'), ['class'=>'form-control col-sm-2 text-center', 'readonly']) !!}
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('status', 'status') !!}
                            <span class="text text-danger">*</span>
                            {!! Form::select(
                                'status',
                                [\App\Enums\OptionStatus::ACTIVE => 'Active', \App\Enums\OptionStatus::UNACTIVE => 'Unactive'],
                                isset($aboutUs->status) ? $aboutUs->status : old('status'),
                                ['class' => 'form-control col-sm-2 text-center']
                            ) !!}
                        </div>
                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                            <a href="{{ route('admin.dashboard.index') }}" class="btn btn-secondary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Cancel</a>
                            {!! Form::submit('Save', ['class'=> 'btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1']) !!}
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</section>
<script src="{{ asset('admin/ckeditor4/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('content-about-us', {
        filebrowserUploadUrl: "{{ route('admin.options.upload', ['_token' => csrf_token()]) }}",
        filebrowserUploadMethod: 'form',
        extraPlugins: 'editorplaceholder',
        editorplaceholder: 'Please enter content'
    }); 
</script>
@endsection
