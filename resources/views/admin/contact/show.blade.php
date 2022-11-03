@extends('layouts.admin.app')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-10 col-lg-11 d-flex align-items-center text-left">
                <h3 class="greeting-text">{{ $contact->full_name }}</h3>
            </div>
            
            <div class="col-12 col-sm-2 col-lg-1 d-flex align-items-center">
                <a class="btn btn-danger" href="{{ url()->previous() }}" title="Go back"><i
                    class="bx bx-undo"></i></a>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    {{ $contact->email }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Phone:</strong>
                    {{ $contact->phone }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Content:</strong>
                    {{ $contact->content }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Date Created:</strong>
                    {{ $contact->getDateFormatAttribute('created_at') }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group row">
                    <strong class="col-2 col-sm-2 col-lg-1 d-flex align-items-center">Status:</strong>
                    {!! Form::open(['method' => 'put', 'route' => ['admin.contact.change_status', $contact]]) !!}
                        @if ($contact->status == \App\Enums\ContactStatus::READ)
                            {!! Form::button(
                                'READ',
                                ['class' => 'badge badge-light-success border-0', 'type' => 'submit']
                            ) !!}
                        @else
                            {!! Form::button(
                                'UNREAD',
                                ['class' => 'badge badge-light-danger border-0', 'type' => 'submit']
                            ) !!}
                        @endif
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
