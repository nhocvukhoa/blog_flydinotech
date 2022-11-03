@extends('user.profile.index')
@section('user-profile-content')
<div class="list-post">
    <div class="title">
        <p>Danh sách bài viết đã đăng</p>
        <a href="#" class="see-more" title="Xem tất cả">
            Xem tất cả
            <img src="{{ asset('images/arrow.svg') }}" class="arrow">
        </a>
    </div>
    <div class="list-post-content">
        @forelse ($posts as $post)
            <div class="post-item">
                <a href="{{ route('post.detail', $post) }}" class="post-image">
                    <img src="{{ asset('storage/'.$post->image) }}" alt="Post image">
                </a>
                <div class="post-info">
                    <a href="#" class="post-title">{{ $post->title }}</a>
                    <div class="post-desc">
                        <strong>{!! $post->description !!}</strong>
                    </div>
                    <div class="post-user">
                        <div class="thumb-avatar">
                            <img src="{{ asset('storage/images/avatar/' . $post->user->userProfile->avatar) }}" alt="Avatar" class="user-avatar">
                            <img src="{{ asset('images/tick-pro.png') }}" alt="Tick pro" class="tick-pro">
                        </div>
                        <p class="user-name">{{ $post->user->userProfile->full_name }}</p>
                    </div>
                </div>
            </div>
        @empty
            <h4 class="text-center">Không có dữ liệu</h4>
        @endforelse
    </div>
    <div class="d-flex justify-content-center">
        {{ $posts->appends(request()->all())->links() }}
    </div>
</div>
@endsection
