<header class="section top-header" data-campaign="Header">
    <div class="container">
        <a href="javascript:;" class="all-menu all-menu-tablet">
            <span class="hamburger"></span>
        </a>
        <div class="left">
            <a href="/" data-medium="Logo" class="logo" onclick="trackingLogoHome('logo-header', this.href)">
                <img src="{{ asset('images/favicon.png') }}" alt=""/>
            </a>
            <span class="time-now">{{ \Carbon\Carbon::now()->translatedFormat('l, d/m/Y') }}</span>
        </div>
        <div class="right">
            <div class="search-icon-mobile">
                <i class="fas fa-search"></i>
            </div>
            <form class="search" action="{{ route('post.search') }}" method="GET">
                <input type="text" name="keyword" placeholder="Tìm kiếm"/>
                <button type="submit" title="Tìm kiếm" class="btn-search">
                    <i class="ic ic-search fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
            <div id="myvne_taskbar">
                @if (Auth::guard('user')->id() == null)
                    <div id="myvne" class="myvne_taskbar myvne_login_button"><a href="{{ route('login') }}"
                        class="log_txt" title="Đăng nhập">
                        <i class="ic ic-user fa-solid fa-user"></i>Đăng nhập</a>
                    </div>
                @elseif (Auth::guard('user')->id() !== null)
                    <div id="myvne" class="myvne_taskbar myvne_login_button">
                        <div class="dropdown log_txt">
                            <div class="btn-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ic ic-user fa-solid fa-user"></i>
                                <p class="user-name">{{ Auth::guard('user')->user()->userProfile->full_name }}</p>
                            </div>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('profile.info') }}" title="Cài đặt thông tin tài khoản">Cài đặt thông tin tài khoản</a>
                                <a class="dropdown-item" href="{{ route('change_password') }}" title="Đổi mật khẩu">Đổi mật khẩu</a>
                                <a class="dropdown-item" href="{{ route('post.create') }}" title="Đăng bài">Đăng bài</a>
                                <a class="dropdown-item" href="{{ route('profile') }}" title="Danh sách bài viết">Danh sách bài viết</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" title="Đăng xuất">Đăng xuất</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</header>
<!--end header-->
<section class="section wrap-main-nav" id="wrap-main-nav" data-campaign="Header">
    <div class="search-mobile">
        <div class="container">
            <form class="search-mobile-form" action="{{ route('post.search') }}" method="GET">
                <input type="text" name="keyword" placeholder="Tìm kiếm"/>
                <button type="submit" title="Tìm kiếm" class="btn-search-mobile">
                    <i class="ic ic-search fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
    </div>
    <nav class="main-nav">
        <ul class="parent">
            <li class="home">
                <a href="/" class="flexbox" title="Trang chủ" data-medium="Menu-Home"
                    onclick="trackingLogoHome('logo-header-menu', this.href)">
                    <i class="ic ic-home fa-solid fa-house"></i>
                </a>
            </li>
            @forelse ($categoriesHeader as $category)
                <li class="thoisu" data-id="1001005">
                    <a href="{{ route('post.index', $category) }}" data-medium="Menu">
                        {{ $category->title }}
                    </a>
                    @if ($category->children->count())
                        <ul class="sub">
                            @foreach ($category->children as $categoryChild)
                                <li>
                                    <a href="{{ route('post.index', $categoryChild) }}">{{ $categoryChild->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @empty
                <ul class="sub">
                    <li>
                        <a href="">No Data</a>
                    </li>
                </ul>
            @endforelse
            <li class="all-menu has_transition">
                <a href="javascript:;">Tất cả <span class="hamburger"></span></a>
            </li>
        </ul>
    </nav>
    <section id="myDropdown" class="wrap-all-menu">
        <div class="container">
            <div class="header-menu">
                <span class="name-header">Tất cả chuyên mục</span>
                <a href="javascript:;" class="close-menu" title="Đóng">Đóng <span class="icon-close"></span></a>
            </div>
            <div class="content-left">
                <div class="width_common scroll-menu-expand scrollbar-inner ss-container">
                    <div class="ss-wrapper">
                        <div class="ss-content">
                            <div class="row-menu">
                                @forelse ($categoriesHeaderAll as $categoryAll)
                                    <ul class="cat-menu fix-view-cate-0" data-cate="0">
                                        <li class="thoisu">
                                            <a href="{{ route('post.index', $categoryAll) }}">{{ $categoryAll->title }}</a>
                                        </li>
                                        @foreach ($categoryAll->children as $categoryChild)
                                            <li>
                                                <a href="{{ route('post.index', $categoryChild) }}">
                                                    {{ $categoryChild->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @empty
                                    <div class="container">
                                        <h1>No Data</h1>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="ss-scroll ss-hidden"></div>
                </div>
            </div>
        </div>
    </section>
</section>
