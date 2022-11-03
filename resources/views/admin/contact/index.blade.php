@extends('layouts.admin.app')

@section('content')
<section id="dashboard-ecommerce">
    <div class="row">
        <div class="col-xl-12 col-md-12 dashboard-greetings">
            <div class="card">
                <form action="{{ route('admin.contact.index') }}" method="get">
                    <div class="card-header">
                        <h3 class="greeting-text">Contact Management</h3>
                    </div>
                </form>
                <div class="contacts-list-filter px-1">
                    {!! Form::open(['method' => 'GET', 'route' => ['admin.contact.index']])!!}
                        <div class="row rounded py-2 mb-2">
                            <div class="col-12 col-sm-3 col-lg-4 d-flex">
                                {!! Form::text('full_name', request()->full_name, ['class' => 'form-control', 'name' => 'full_name', 'placeholder' => 'Enter name...']) !!}
                                <div id="search"></div>
                            </div>
                            <div class="col-12 col-sm-3 col-lg-4 d-flex">
                                {!! Form::text('email', request()->email, ['class' => 'form-control', 'name' => 'email', 'placeholder' => 'Enter email...']) !!}
                                <div id="search"></div>
                            </div>
                            <div class="col-12 col-sm-2 col-lg-2 d-flex">
                                {!! Form::select(
                                    'status',
                                    ['' => 'Choose status',\App\Enums\ContactStatus::UNREAD => 'Unread', \App\Enums\ContactStatus::READ=> 'Read'],
                                    request()->status,
                                    ['class' => 'form-control', 'name' => 'status']
                                ) !!}
                            </div>
                            <div class="col-12 col-sm-5 col-lg-2 d-flex align-items-center">
                                {!! Form::submit('Find', ['type'=>'reset', 'class'=>'btn btn-outline-dark btn-block glow find-contact mb-0']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <div class="table-responsive">
                        @include('layouts.admin.partials.notice')
                        <table id="contacts-list-datatable" class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Content</th>
                                    <th>Created at</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($contacts as $key => $contact)
                                    <tr>
                                        <td>{{ $contact->full_name }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ $contact->phone }}</td>
                                        <td>{{ substr_replace($contact->content, "...", 50) }}</td>
                                        <td>{{ $contact->getDateFormatAttribute('created_at') }}</td>
                                        @if ($contact->status == \App\Enums\ContactStatus::READ)
                                            <td>
                                                <span class="badge badge-light-success">READ</span>
                                            </td>
                                        @else
                                            <td>
                                                <span class="badge badge-light-danger">UNREAD</span>
                                            </td>
                                        @endif
                                        <td>
                                            <div class="btn-group">
                                                {!! Form::open([
                                                    'method' => 'delete',
                                                    'route' => ['admin.contact.destroy', $contact],
                                                    'onsubmit' => 'return confirm("Delete this contact?")'
                                                ])!!}
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm rounded-0']) !!}
                                                {!! Form::close() !!}
                                                {!! Form::open([
                                                    'method' => 'get',
                                                    'route' => ['admin.contact.show', $contact],
                                                ])!!}
                                                    {!! Form::submit('Show', ['class' => 'btn btn-info btn-sm rounded-0']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <td colspan="6" class="text-center">No data available</td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination justify-content-center">{{ $contacts->appends(request()->all())->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
