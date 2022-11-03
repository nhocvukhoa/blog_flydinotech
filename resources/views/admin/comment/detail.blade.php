@extends('layouts.admin.app')
@section('content')
  <div class="col-12">
    <div class="card invoice-print-area">
      <div class="card-body pb-0 mx-25">
        @include('layouts.admin.partials.notice')
        <!-- header section -->
        <div class="row">
          <div class="col-lg-4 col-md-12">
            <span class="invoice-number mr-50">{{ $post->id }}</span>
          </div>
          <div class="col-lg-8 col-md-12">
            <div class="d-flex align-items-center justify-content-lg-end flex-wrap justify-content-end">
              <div>
                <small class="text-muted">Published Date:</small>
                <span>{{ $post->getPublicationDateFormatAttribute('published_at') }}</span>
              </div>
            </div>
          </div>
        </div>
        <!-- logo and title -->
        <div class="row my-2 my-sm-3">
          <div class="col-sm-8 col-12 text-center text-sm-left order-2 order-sm-1">
            <h4 class="text-primary">{{ $post->title }}</h4>
            <span>{!! $post->description !!}</span>
          </div>
        </div>
      </div>
      <!-- product details table-->
      <div class="invoice-product-details table-responsive border-top">
        <table class="table table-borderless mb-0">
          <thead>
            <tr class="border-0">
              <th scope="col">User</th>
              <th scope="col">Content</th>
              <th scope="col">Time</th>
              <th scope="col" class="text-center">Status</th>
              <th scope="col" class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($comments as $comment)
              <tr class="border-top">             
                <td>{{ $comment->user->userProfile->getFullNameAttribute() }}</td>
                <td>{{ $comment->content }}</td>
                <td>{{ $comment->getDateFormatAttribute('created_at') }}</td>
                <td>
                  {!! Form::open(['method' => 'PUT', 'route' => ['admin.comment.detail.status', $comment->id]]) !!}
                    @if ($comment->status == \App\Enums\CommentStatus::ACTIVE)
                      {!! Form::button('SUCCESS', ['class' => 'badge badge-light-success border-0', 'type' => 'submit']) !!}
                    @else
                      {!! Form::button('BANNER', ['class' => 'badge badge-light-danger border-0', 'type' => 'submit']) !!}
                    @endif
                  {!! Form::close() !!}
                </td>
                <td>
                  {!! Form::open(['method' => 'DELETE', 'route' => ['admin.comment.detail.delete', $comment->id], 'onsubmit' => 'return confirm("Delete this comment?")']) !!}
                    {!! Form::button('DELETE', ['class' => 'btn btn-outline-danger btn-sm', 'type' => 'submit']) !!}
                  {!! Form::close() !!}
                </td>
              </tr>
            @empty
              <td colspan="9" class="border-top">
                <div class="text-center bg-danger text-white height-50 d-flex align-items-center justify-content-center mr-1 ml-50  my-1 shadow">
                  No data
                </div>
              </td>
            @endforelse
          </tbody>
        </table>
        <div class="col-md-12">
          {{ $comments->links('pagination::bootstrap-4') }}
        </div>
      </div>
    </div>
  </div>
@endsection
