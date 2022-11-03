@extends('layouts.admin.app')
@section('content')
<section class="setting-create">
    <div class="content-body">
        <section class="setting-create-content">
            <div class="row admin-settings-form">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="content-header-title mb-1">Setting</h5>
                            <hr>
                            @include('layouts.admin.partials.notice')
                            {!! Form::open([
                                'method' => 'put',
                                'route' => ['admin.options.update_setting', $setting],
                                'class' => 'form-update-setting mt-2',
                                'enctype' => 'multipart/form-data']) 
                            !!}
                                <div class="form-group">
                                    {!! Form::label('title', 'Title') !!}
                                    <span class="text-danger">*</span>
                                    {!! Form::text(
                                        'title',
                                        isset($setting->title) ? $setting->title : old('title'),
                                        ['class' => 'form-control', 'placeholder' => 'Enter title']
                                    ) !!}
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    {!! Form::label('content', 'Content') !!}
                                    <span class="text-danger">*</span>
                                    {!! Form::textarea(
                                        'content',
                                        isset($setting->content) ? $setting->content : old('content'),
                                        ['class' => 'form-control', 'id' => 'setting-content', 'placeholder' => 'Enter content']
                                    ) !!}
                                    @error('content')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    {!! Form::label('type', 'Type') !!}
                                    @if ($setting->type == \App\Enums\OptionType::SETTING)
                                        {!! Form::text('type', trans('messages.type.setting'), ['class'=>'form-control col-sm-2 text-center', 'readonly']) !!}
                                    @endif
                                </div>
                                <div class="form-group">
                                    {!! Form::label('status', 'Status') !!}
                                    <span class="text-danger">*</span>
                                    {!! Form::select(
                                        'status',
                                        [\App\Enums\OptionStatus::ACTIVE => 'Active', \App\Enums\OptionStatus::UNACTIVE => 'UnActive'],
                                        isset($setting->status) ? $setting->status : old('status'),
                                        ['class' => 'form-control col-sm-2 text-center']
                                    ) !!}
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mt-2">
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end">
                                            <a href="{{ route('admin.dashboard.index') }}" class="btn btn-secondary glow mr-1">Cancel</a>
                                            {{ Form::submit('Save', ['class' => 'btn btn-primary btn-add']) }}
                                        </div>
                                    </div>
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
@endsection
@push('scripts')
    <script src="{{ asset('admin/ckeditor4/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('setting-content', {
            filebrowserUploadUrl: "{{ route('admin.options.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form',
            extraPlugins: 'editorplaceholder',
            editorplaceholder: 'Please enter content'
        }); 
    </script> 
@endpush
