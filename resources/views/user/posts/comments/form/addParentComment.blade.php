{!! Form::open(['class' => 'parent-comment-form']) !!}
    {!! Form::hidden('post_id', $post->id) !!}
    {!! Form::hidden('parent_id', isset($comment) ? $comment->id : '') !!}
    {!! Form::textarea('content', '', ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Nhập bình luận ... ']) !!}
    <div class="text-right">
        {!! Form::submit('Gửi bình luận', ['class' => 'btn btn-primary my-2 add-parent-comment']) !!}
    </div>
{!! Form::close() !!}
