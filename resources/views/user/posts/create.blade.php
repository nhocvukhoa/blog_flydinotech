@extends('layouts.user.app')

@section('content')
<section class="simple-validation">
    <div class="user-post">
        @include('layouts.user.partials.notice')
        {{ Form::open(['id' => 'addPost', 'name' => 'addPost', 'enctype' => 'multipart/form-data']) }}
            @include('user.posts.form')
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
        
        $('#addPost').submit(function (e) {
            e.preventDefault();

            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement()
            }

            $.ajax({
                url: '{{ route('post.store', 'vi') }}',
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
                        $('#addPost').find('input:text, input:file, textarea').val('');

                        for (instance in CKEDITOR.instances) {
                            CKEDITOR.instances[instance].setData('');
                        }
                        
                        $('#addPost').find('#preview-image-post').attr('src', '{{ asset('admin/images/noimg.png') }}');
                        toastr.success(res.message);
                    }
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.category-select').select2({
            width: "resolve",
        });
    });
</script>
@endpush
