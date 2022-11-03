@extends('layouts.admin.app')
@section('content')
<h5 class="content-header-title pr-1 mb-2 ml-2">Add News</h5>
<div class="content-body">
    <div class="messages"></div>
    <section class="news-create">
        {!! Form::open(['id' => 'form-add-news', 'enctype' => 'multipart/form-data']) !!}
            @include('admin.news.form')
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('admin.news.index') }}" class="btn btn-info">Back</a>
                    {{ Form::submit('Create', ['class' => 'btn btn-dark btn-add']) }}
                </div>
            </div>
        {{ Form::close() }}
    </section>
</div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#form-add-news').submit(function (e) {
                e.preventDefault();
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement()
                }

                $.ajax({
                    url: "{{ route('admin.news.store') }}",
                    method: 'POST',
                    data: new FormData(this),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function () {
                        $(document).find('#form-add-news span.error-text').text('');
                    },
                    success: function(data) {
                        if (data.status == 200) {
                            $('#form-add-news').find('input:text, input:file, textarea').val('');
                            CKEDITOR.instances[instance].setData('');
                            $('#form-add-news').find('.previewImg').attr('src', "{{ asset('admin/images/noimg.png') }}");
                            $('.messages').html('');
                            $('.messages').append(
                                `<div class="alert alert-success">${data.message}</div>`
                            );
                            $('html, body').animate({ scrollTop: 0 }, 'slow');
                            $('.alert').delay(5000).slideUp(300);
                        } else {
                            $.each(data.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                            });
                        }
                    }  
                });
            });
        });
    </script>
@endpush
