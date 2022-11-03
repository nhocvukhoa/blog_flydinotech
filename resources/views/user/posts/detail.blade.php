@section('meta')
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $post->title }}" />
    <meta property="og:description" content="{{ $post->description }}" />
    <meta property="og:image" content="{{ asset('storage/' . $post->image) }}" />
@endsection

@extends('layouts.user.app')
@section('content')
<section class="detail-post-form mt-3">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 detail-post">
                <div class="pt-4">
                    <div class="row mb-4 info-user">
                        <div class="col-xs-12 col-sm-6 col-md-6 d-flex flex-row info-detail-user align-items-center">
                            <div class="col-xs-1 col-sm-2 col-md-2 p-0 image-user">
                                <a href="#">
                                    <img class="rounded-circle" src="{{ asset('/storage/images/avatar/'.$post->user->userProfile->avatar) }}">
                                </a>
                            </div>
                            <div class="col-xs-11 col-sm-10 col-md-10 detail-user d-flex flex-column justify-content-center">
                                <div class="d-flex flex-row username mb-2">
                                    <a href="#">
                                        <b class="text-primary">{{ $post->user->userProfile->full_name }}</b>
                                    </a>
                                    <a href="#" class="btn btn-outline-secondary py-1 rounded-1 ml-2">Theo dõi</a>
                                </div>
                                <input type="hidden" id="post-id-fetch" value="{{ $post->slug }}">
                                <div class="d-flex flex-row detail-username">
                                    <div class="me-3">
                                        <i class="fa-solid fa-star icon"></i>
                                    </div>
                                    <div class="me-3">
                                        <i class="fa-solid fa-user-plus icon"></i>
                                    </div>
                                    <div class="me-3">
                                        <i class="fa-solid fa-pencil icon"></i>
                                        <span>{{ count($postUser) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 d-flex flex-column justify-content-center info-detail-post">
                            <div class="mb-2">
                                <span>Đã đăng vào ngày {{ $post->getPublicationDateFormatAttribute('published_at')}}</span>
                            </div>
                            <div class="d-flex flex-row detail-post">
                                <div class="ms-3">
                                    <i class="fa-solid fa-eye icon"></i>
                                    <span>{{ $post->user->getViewed($post->viewed) }}</span>
                                </div>
                                <div class="ms-3">
                                    <a href="#comment-container">
                                        <i class="fa-solid fa-comments icon"></i>
                                        <span>{{ $countComment }}</span>
                                    </a>
                                </div>
                                <div class="ms-3">
                                    <i class="fa-solid fa-bookmark icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h2 class="mb-3 font-weight-bold">{{ $post->title }}</h2>
                    <div class="text-right my-1">
                        <i class="fa-solid fa-ellipsis"></i>
                    </div>
                    <div class="content-post my-3">
                        <div class="border border-1 rounded p-3">
                            <p class="mb-0">{!! $post->description !!}</p>
                        </div>
                        <div class="text-center">
                            <img src="{{ asset('storage/'.$post->image) }}" class="my-2 rounded">
                        </div>
                        <div class="border border-1 rounded p-3">
                            <p>{!! $post->content !!}</p>
                        </div>
                    </div>
                    <div class="share-icon">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ Request::url() }}" target="_blank">
                            <i class="fab fa-facebook" title="Share Facebook"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?text={{ $post->title }}&amp;url={{ Request::url() }}" target="_blank">
                            <i class="fab fa-twitter" title="Share Twitter"></i>
                        </a>
                        <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ Request::url() }}&amp;title={{ $post->title }}&amp;summary={{ $post->description }}"
                            target="_blank"
                            class="social-button"
                            id=""
                        >
                            <i class="fab fa-linkedin" title="Share LinkedIn"></i>
                        </a>
                        <a href="https://wa.me/?text={{ Request::url() }}"
                            class="social-button"
                            id=""
                        >
                            <i class="fab fa-whatsapp" title="Share WhatsApp"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 another-user">
                <div class="p-2 mt-3">
                    <div class="my-2 px-2 row align-items-center">
                        <div class="col-xs-3 col-sm-3 col-md-2 pe-0">
                            <hr>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-8 p-0 text-center">
                            <span class="text-uppercase">Người dùng được đề xuất</span>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-2 ps-0">
                            <hr>
                        </div>
                    </div>
                    <div class="d-flex flex-column detail-another-user">
                        @forelse ($users->take(5) as $key => $user)
                            <div class="row mx-2 my-1 py-2 justify-content-center">
                                <div class="col-xs-2 col-sm-2 col-md-3 px-1">
                                    <a href="#">
                                        <img class="rounded-circle" src="{{ asset('/storage/images/avatar/'.$user->userProfile->avatar) }}">
                                    </a>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-9 d-flex flex-column justify-content-center">
                                    <div class="d-flex flex-row username mb-2">
                                        <a href="#">
                                            <span class="text-primary">{{ $user->userProfile->full_name }}</span>
                                        </a>
                                    </div>
                                    <div class="d-flex flex-row detail-user mt-1">
                                        <div class="me-3">
                                            <i class="fa-solid fa-pencil icon"></i>
                                            <span>{{ count($user->post) }}</span>
                                        </div>
                                        <div class="me-3">
                                            <i class="fa-solid fa-star icon"></i>
                                        </div>
                                        <div class="me-3">
                                            <i class="fa-solid fa-user-plus icon"></i>
                                        </div>
                                        <div>
                                            <i class="fa-solid fa-eye icon"></i>
                                            <span>{{ $user->getViewed($user->getViewedUserAttribute($user->id)) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="row mx-2 my-1 border-top py-2">
                                <span class="text-center mt-1">Không có bài viết nào khác</span>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="related-post mb-4">
            <h5 class="font-weight-bold">Bài viết liên quan</h5>
            <div class="row related-slider-post">
                @forelse ($postCategory as $key => $postCategory)
                    <div class="col-md-3 my-2 content-post">
                        <div class="card py-2 px-1">
                            <div class="card-body">
                                <a href="{{ route('post.detail', $postCategory) }}">
                                    <h5 class="card-title">{{ $postCategory->title }}</h5>
                                </a>
                                <div class="card-subtitle mb-2 text-primary mt-3">
                                    <a href="#">
                                        <span>{{ $postCategory->user->userProfile->full_name }}</span>
                                    </a>
                                </div>
                                <div class="d-flex flex-row icon-detail">
                                    <div>
                                        <i class="fa-solid fa-eye icon"></i>
                                        <span>{{ $postCategory->user->getViewed($postCategory->viewed) }}</span>
                                    </div>
                                    <div class="ms-2">
                                        <i class="fa-solid fa-bookmark icon"></i>
                                    </div>
                                    <div class="ms-3">
                                        <i class="fa-solid fa-comments icon"></i>
                                        <span>{{ count($postCategory->comment) }}</span>
                                    </div>
                                    <div class="ms-3 d-flex flex-row">
                                        <div class="d-flex flex-column">
                                            <i class="fa-solid fa-caret-up"></i>
                                            <i class="fa-solid fa-caret-down"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-3 my-2 justify-content-center text-center">
                        <div class="card py-2 px-1">
                            <div class="card-body">
                                <span>Không có bài viết nào khác</span>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
        <div class="another-post-user">
            <h5 class="font-weight-bold">Bài viết khác từ {{ $post->user->userProfile->full_name }}</h5>
            <div class="row another-slider-post">
                @forelse ($postUser as $key => $postUser)
                    <div class="col-md-3 my-2 content-post">
                        <div class="card py-2">
                            <div class="card-body">
                                <a href="{{ route('post.detail', $postUser) }}">
                                    <h5 class="card-title">{{ $postUser->title }}</h5>
                                </a>
                                <div class="card-subtitle mb-2 text-primary mt-3">
                                    <a href="#">
                                        <span>{{ $postUser->user->userProfile->full_name }}</span>
                                    </a>
                                </div>
                                <div class="d-flex flex-row icon-detail">
                                    <div>
                                        <i class="fa-solid fa-eye icon"></i>
                                        <span>{{ $postUser->user->getViewed($postUser->viewed) }}</span>
                                    </div>
                                    <div class="ms-2">
                                        <i class="fa-solid fa-bookmark icon"></i>
                                    </div>
                                    <div class="ms-3">
                                        <i class="fa-solid fa-comments icon"></i>
                                        <span>{{ count($postUser->comment) }}</span>
                                    </div>
                                    <div class="ms-3 d-flex flex-row">
                                        <div class="d-flex flex-column">
                                            <i class="fa-solid fa-caret-up"></i>
                                            <i class="fa-solid fa-caret-down"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-3 my-2 justify-content-center text-center">
                        <div class="card py-2 px-1">
                            <div class="card-body">
                                <span>Không có bài viết nào khác</span>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
        <div class="comment-post my-3" id="comment-container">
            @include('user.posts.comments.comment')
        </div>
    </div>
</section>
@endsection
