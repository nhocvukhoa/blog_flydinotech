<div class="table-responsive">
    <table class="table invoice-data-table dt-responsive nowrap mt-1">
        <thead>
            <tr>
                <th>Image</th>
                <th>User</th>
                <th>Category</th>
                <th>Title</th>
                <th>View</th>
                <th>Create date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posts as $key => $post)
                <tr>
                    <td>
                        <img src="{{ asset('storage/' . $post->image) }}" width="100px">
                    </td>
                    <td>{{ $post->user->userProfile->full_name }}</td>
                    <td>{{ $post->category->title }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->viewed }}</td>
                    <td>{{ $post->getCreateDateFormatAttribute('created_at') }}</td>
                    <td>
                        {!! Form::open(['method' => 'PUT', 'route' => ['admin.posts.change_status', $post]]) !!}
                            @if ($post->status == \App\Enums\PostStatus::ACTIVE)
                                {!! Form::button('Active', ['class' => 'badge badge-light-success border-0', 'type' => 'submit']) !!}
                            @else
                                {!! Form::button('Unactive', ['class' => 'badge badge-light-danger border-0', 'type' => 'submit']) !!}
                            @endif
                        {!! Form::close() !!}
                    </td>
                    <td>
                        <div class="btn-group">
                            {!! Form::open(['method' => 'DELETE', 'route' => ['admin.posts.destroy', $post], 'onsubmit' => 'return confirm("Are you sure you want to delete this category ?")']) !!}
                                {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm rounded-0']) }}
                            {!! Form::close() !!}
                            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-info btn-sm rounded-0">Edit</a>
                            <a href="{{ route('admin.comment.detail', ['post' => $post]) }}" class="btn btn-primary btn-sm rounded-0">Comment</a>
                        </div>
                    </td>
                </tr>
            @empty
                <td colspan="9" class="text-center"><b>No data available</b></td>
            @endforelse
        </tbody>
    </table>    
</div>
