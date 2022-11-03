<div class="col-md-8">
    <div class="card">
        <div class="table-responsive">
            <table class="table invoice-data-table dt-responsive nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Parent category</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($listCategories as $key => $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->title }}</td>
                            <td>
                                @if ($category->parent_id)
                                    <b>{{ $category->parent->title }}</b>
                                @else
                                    <span>No parent category</span>
                                @endif
                            </td>
                            <td>
                                {!! Form::open(['method' => 'PUT', 'route' => ['admin.categories.change_status', $category]]) !!}
                                    @if ($category->status == \App\Enums\CategoryStatus::ACTIVE)
                                        {!! Form::button('Active', ['class' => 'badge badge-light-success', 'type' => 'submit', 'style' => 'border : none']) !!}
                                    @else
                                        {!! Form::button('Unactive', ['class' => 'badge badge-light-danger', 'type' => 'submit', 'style' => 'border : none']) !!}
                                    @endif
                                {!! Form::close() !!}
                            </td>
                            <td>
                                <div class="btn-group">
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['admin.categories.destroy', $category], 'onsubmit' => 'return confirm("Are you sure you want to delete this category ?")']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm rounded-0']) !!}
                                    {!! Form::close() !!}
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-info btn-sm rounded-0">Edit</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <td colspan="5" class="text-center"><b>{{ __('messages.no_record') }}</b></td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{ $listCategories->links() }}
    </div>
</div>
