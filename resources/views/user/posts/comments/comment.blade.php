<h5 class="font-weight-bold">Bình luận</h5>
@if (Auth::guard('user')->check())
    <div class="d-flex flex-row">
        <div class="justify-content-center pt-2 pe-2">
            <a href="#">
                <img width="60px" id="parent-comment-avatar" class="rounded-circle" src="{{ asset('/storage/images/avatar/'.Auth::guard('user')->user()->userProfile->avatar) }}">
            </a>
        </div>
        <input type="hidden" value="{{ Auth::guard('user')->user()->id }}" id="auth-user-id">
        @include('user.posts.comments.form.addParentComment')
    </div>
@else
    <div class="card shadow-none py-3 mb-3 d-flex flex-row justify-content-center align-items-center">
        <a href="{{ route('login') }}">
            <i class="fa-solid fa-comment me-1"></i>
            <span>Đăng nhập để bình luận</span>
        </a>
    </div>
@endif
<div class="content-comment mt-2" id="list-comment">
</div>
