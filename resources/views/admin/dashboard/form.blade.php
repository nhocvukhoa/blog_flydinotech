<table class="table invoice-data-table dt-responsive nowrap mt-1">
    <thead>
        <tr>
            <th>Image</th>
            <th>User Name</th>
            <th>Category</th>
            <th>Title</th>
            <th>View</th>
            <th>Create date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($posts as $key => $post)
            <tr>
                <td>
                    <img src="{{ asset('storage/'.$post->image) }}" width="100px">
                </td>
                <td>
                    <a class="text-secondary" href="{{ route('admin.user.index', ['keyword' => $post->user->email]) }}">
                        {{ $post->user->userProfile->full_name }}
                    </a>
                </td>
                <td>
                    <a class="text-secondary" href="{{ route('admin.categories.index', ['keyword' => $post->category->id]) }}">
                        {{ $post->category->title }}
                    </a>
                </td>
                <td>
                    <a class="text-secondary" href="{{ route('admin.posts.index', ['keyword' => $post->title]) }}">
                        {{ $post->title }}
                    </a>
                </td>
                <td>{{ $post->viewed }}</td>
                <td>{{ $post->getDateFormatAttribute('created_at') }}</td>
                <td>
                    {!! Form::open(['method' => 'PUT', 'route' => ['admin.posts.change_status', $post]]) !!}
                        @if ($post->status == \App\Enums\PostStatus::ACTIVE)
                            {!! Form::button('Active', ['class' => 'badge badge-light-success border-0', 'type' => 'submit']) !!}
                        @else
                            {!! Form::button('Unactive', ['class' => 'badge badge-light-danger border-0', 'type' => 'submit']) !!}
                        @endif
                    {!! Form::close() !!}
                </td>
            </tr>
        @empty
            <td colspan="9" class="text-center"><b>No data available</b></td>
        @endforelse
    </tbody>
</table>
