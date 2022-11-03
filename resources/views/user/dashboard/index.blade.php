@extends('layouts.user.app')

@section('content')
<div class="container-fluid">
    <div class="form-group row top-dashboard">
        <img class="image-top-dashboard" src="{{ asset('/images/banner-4.jpg') }}"/>
        <div class="container">
            <h2 class="text-news">Đang thịnh hành</h2>
            <div class="row home-news">
                @forelse ($lastedPosts as $key => $lastedPost)
                    <article class="grid-lasted-post col-sm">
                        <a href="{{ route('post.detail', $lastedPost) }}" title="{{ $lastedPost->title }}">
                            <div class="figure-last-news"
                                @if (isset($lastedPost->image))
                                    style="background-image: url('{{ asset('storage/'.$lastedPost->image) }}')"
                                @else
                                    style="background-image: url('{{ asset('user/images/no-image-available.png') }}')"
                                @endif
                            >
                                <p class="entry-title">{{ $lastedPost->title }}</p>
                                <p class="original-time">{{ $lastedPost->getTimeAttribute($lastedPost->created_at) }}</p>
                            </div>
                        </a>
                    </article>
                @empty
                    <div class="col-sm">
                        <p>Hãy thêm bài viết</p>
                    </div>
                @endforelse
                <div class="col-sm grid-post">
                    @forelse ($nextPosts as $key => $nextPost)
                        <article class="grid-next-post col-sm">
                            <a href="{{ route('post.detail', $nextPost) }}" title="{{ $nextPost->title }}">
                                <div class="figure-next-news"
                                    @if (isset($nextPost->image))
                                        style="background-image: url('{{ asset('storage/'.$nextPost->image) }}')"
                                    @else
                                        style="background-image: url('{{ asset('user/images/no-image-available.png') }}')"
                                    @endif
                                >
                                    <p class="entry-title">{{ $nextPost->title }}</p>
                                    <p class="original-time">{{ $nextPost->getTimeAttribute($nextPost->created_at) }}</p>
                                </div>
                            </a>
                        </article>
                    @empty
                        <div class="col-sm">
                            <p>Hãy thêm bài viết</p>
                        </div>
                    @endforelse
                    <div class="row grid-two-post">
                        @forelse ($twoNextPosts as $key => $twoNextPost)
                            <article class="grid-items col-sm-6 thumb">
                                <a href="{{ route('post.detail', $twoNextPost) }}" title="{{ $twoNextPost->title }}">
                                    <div class="figure-two-news"
                                        @if (isset($twoNextPost->image))
                                            style="background-image: url('{{ asset('storage/'.$twoNextPost->image) }}')"
                                        @else
                                            style="background-image: url('{{ asset('user/images/no-image-available.png') }}')"
                                        @endif
                                    >
                                        <p class="entry-title">{{ $twoNextPost->title }}</p>
                                        <p class="original-time">{{ $twoNextPost->getTimeAttribute($twoNextPost->created_at) }}</p>
                                    </div>
                                </a>
                            </article>
                        @empty
                            <div class="col-sm">
                                <p>Hãy thêm bài viết</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <h2 class="text-news">Bài viết mới nhất</h2>
            <div class="row home-middle">
                @forelse ($newPosts as $key => $newPost)
                    <article class="col-sm-6 thumb">
                        <div class="grid-post">
                            <a href="{{ route('post.detail', $newPost) }}" title="{{ $newPost->title }}">
                                <figure class="figure-posts row">
                                    <div class="container">
                                        <div class="container__image"
                                            @if (isset($newPost->image))
                                                style = "background-image : url('{{ asset('storage/'.$newPost->image) }}')"
                                            @else
                                                style="background-image: url('{{ asset('user/images/no-image-available.png') }}')"
                                            @endif
                                        >
                                            <div class="container__info container__author">{{ $newPost->user->userProfile->first_name }}</div>
                                            <div class="container__info container__location">{{ $newPost->category->title }}</div>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <p class="entry-title">{{ $newPost->title }}</p>
                                        <p class="original-time">{{ $newPost->getTimeAttribute($newPost->created_at) }}</p>
                                    </div>
                                </figure> 
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-sm-6">
                        Hãy thêm bài viết
                    </div>
                @endforelse
            </div>
        </div>
        <br>
        <div class="container">
            @foreach ($getParentCategories as $key => $getParentCategory)
                <div class="row">
                    <a class="text-news" href="{{ route('post.index', $getParentCategory) }}">Tin {{ $getParentCategory->title }}</a>
                    @forelse ($getParentCategories as $childCategory)
                        @if ($childCategory->children->count())
                            @foreach ($childCategory->children as $categoryChild)
                                @if ($categoryChild->parent_id == $getParentCategory->id)
                                    <a class="text-category-child" href="{{ route('post.index', $categoryChild) }}">{{ $categoryChild->title }}</a>
                                @endif 
                            @endforeach
                        @endif                    
                    @endforeach
                </div>
                <div class="row home-category">
                    @foreach ($getParentCategory->getPostDashboard as $key => $post)
                            <div class="col-sm-3 thumb">
                                <a href="{{ route('post.detail', $post) }}" title="{{ $post->title }}">
                                    <figure>
                                        <img class="lazy img-responsive"
                                            @if (isset($post->image))
                                                src="{{asset('storage/'.$post->image)}}"
                                            @else
                                                src="{{ asset('user/images/no-image-available.png') }}"
                                            @endif
                                            
                                            alt="{{ $post->title }}"
                                            title="{{ $post->title }}"
                                        >
                                        <p class="entry-title">{{ $post->title }}</p>
                                    </figure>
                                </a>
                            </div>
                    @endforeach
                    <a class="text-sm-right" href="{{ route('post.index', $getParentCategory) }}">Xem thêm>></a>
                    <hr class="hr">
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
