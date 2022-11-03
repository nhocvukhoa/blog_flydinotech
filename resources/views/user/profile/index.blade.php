@extends('layouts.user.app')
@section('content')
<div class="user-profile">
    <div class="sub-menu-profile">
        <div class="container">
            <ul class="list-sub-menu">
                <li class="list-item {{ Route::is('profile') ? 'active' : '' }}">
                    <a class="link" href="{{ route('profile') }}" title="Danh sách bài viết đã đăng">Danh sách bài viết đã đăng</a>
                </li>
                <li class="list-item {{ Route::is('profile.post_viewed') ? 'active' : '' }}">
                    <a class="link" href="{{ route('profile.post_viewed') }}" title="Danh sách đã xem gần đây">Danh sách đã xem gần đây</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="profile-content">
        <div class="container">
            <div class="box-content">
                <div class="box-left">
                    <div class="box-info">
                        <div class="box-avatar">
                            @if ($user->userProfile->avatar)
                                <img src="{{ asset('storage/images/avatar/' . $user->userProfile->avatar) }}" class="avatar">
                                <span class="status">PRO</span>
                            @elseif ($user->userProfile->gender == \App\Enums\Genre::MALE)
                                <img src="/admin/app-assets/images/avatar-male.png" class="avatar">
                                <span class="status">PRO</span>
                            @else
                                <img class="avatar" src="/admin/app-assets/images/avatar-female.png" class="avatar" >
                                <span class="status">PRO</span>
                            @endif
                        </div>
                        <div class="user-name">
                            <h1>{{ $user->userProfile->full_name }}</h1>
                            <img src="{{ asset('images/tick-pro.png') }}" alt="Tick pro" class="tick-pro">
                        </div>
                        <div class="total-view">
                            <span class="number">{{ $postViewed}}</span>
                            <label>Lượt xem</label>
                        </div>
                        <div class="list-menu-action">
                            <div class="item-menu">
                                <img src="{{ asset('images/icon-user.svg') }}" alt="Icon user" class="icon-user">
                                <a href="{{ route('profile') }}" title="Danh sách bài viết đã đăng">Danh sách bài viết đã đăng</a>
                            </div>
                            <div class="item-menu">
                                <img src="{{ asset('images/icon-user.svg') }}" alt="Icon user" class="icon-user">
                                <a href="{{ route('profile.info') }}" title="Cập nhật thông tin">Cập nhật thông tin</a>
                            </div>
                            <div class="item-menu">
                                <img src="{{ asset('images/icon-user.svg') }}" alt="Icon user" class="icon-user">
                                <a href="{{ route('change_password') }}" title="Cập nhật mật khẩu">Cập nhật mật khẩu</a>
                            </div>
                            <div class="item-menu">
                                <img src="{{ asset('images/icon-user.svg') }}" alt="Icon user" class="icon-user">
                                <a href="{{ route('logout') }}" title="Đăng xuất">Đăng xuất</a>
                            </div>
                        </div>
                        <div class="user-introduce">
                            <p class="title">Giới thiệu</p>
                            <div class="introduce">
                                <p class="name"> Địa chỉ: {{ $user->userProfile->address }}</p>
                                <p class="another">Số điện thoại: {{ $user->userProfile->phone }}</p>
                                <p class="another">Email: {{ $user->email }}</p>
                                <p class="another">Ngày tham gia: {{ $user->getDateFormatAttribute('created_at') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-right">
                    @yield('user-profile-content')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
