@extends('layouts.admin.app')
@section('content')
<section class="simple-validation">
    <div class="admin-post">
        @include('layouts.admin.partials.notice')
        <div class="alert alert-success" id="message-post"></div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <h3 class="card-title">Add Post</h3>
                </div>
            </div>
        </div>
        {{ Form::open(['id' => 'addPostForm', 'name' => 'addPostForm', 'enctype' => 'multipart/form-data']) }}
            @include('admin.posts.form.form')
        {{ Form::close() }}
    </div>
</section>
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function($){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $('#addPostForm').submit(function (e) {
            e.preventDefault();

            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement()
            }

            $.ajax({
                url: '{{ route('admin.posts.store') }}',
                method: 'POST',
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function () {
                    $(document).find('span.error-text').text('');
                },
                success: function (res) {
                    if (res.status == 400) {
                        $.each(res.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        $('#addPostForm').find('input:text, input:file, textarea').val('');

                        for (instance in CKEDITOR.instances) {
                            CKEDITOR.instances[instance].setData('');
                        }
                        
                        $('#addPostForm').find('#preview-image-post').attr('src', '{{ asset('admin/images/noimg.png') }}');
                        $('.admin-post').find('#message-post').text(res.message);
                        document.getElementById('message-post').style.display = 'block';
                        $('#message-post').delay(3000).slideUp(300);
                        window.scrollTo(0,0);
                    }
                }
            });
        });
    });
</script>
@endpush
