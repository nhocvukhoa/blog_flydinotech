<section class="page-footer">
    <div id="footer" class="container">
        <div class="footer-wrapper">
            <div class="footer-top">
                <ul class="list-menu-footer">
                    <li class="item-menu">
                        <a href="#" title="Trang chủ">Trang chủ</a>
                    </li>
                    <li class="item-menu">
                        <a href="#" title="Video">Video</a>
                    </li>
                    <li class="item-menu">
                        <a href="#" title="Podcasts">Podcasts</a>
                    </li>
                    <li class="item-menu">
                        <a href="#" title="Ảnh">Ảnh</a>
                    </li>
                    <li class="item-menu">
                        <a href="#" title="Infographics">Infographics</a>
                    </li>
                    <li class="item-menu">
                        <a href="#" title="Mới nhất">Mới nhất</a>
                    </li>
                    <li class="item-menu">
                        <a href="#" title="Xem nhiều">Xem nhiều</a>
                    </li>
                    <li class="item-menu">
                        <a href="#" title="Tin nóng">Tin nóng</a>
                    </li>
                </ul>
                <ul class="list-menu-footer">
                    @forelse ($categoriesFooter as $category)
                        <li class="item-menu">
                            <a href="{{ route('post.index', $category) }}">{{ $category->title }}</a>
                        </li>
                    @empty
                        <h4 class="text-center">No data</h4>
                    @endforelse
                </ul>
                <div class="footer-contact">
                    <div class="contact-wrapper">
                        <div class="phone-application">
                            <p>Ứng dụng di động</p>
                            <div class="download-app">
                                <div class="link-download">
                                    <a href="#" title="App google">
                                        <img src="{{ asset('images/google-play.png') }}" class="app-google">
                                    </a>
                                    <a href="#" title="App apple">
                                        <img src="{{ asset('images/apple-store.png') }}" class="app-apple">
                                    </a>
                                </div>
                                <img src="{{ asset('images/qr-code.jpg') }}" class="qr-code">
                            </div>
                        </div>
                        <div class="social">
                            <p>Liên kết</p>
                            <div class="list-social">
                                <a href="#" title="Facebook">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>
                                <a href="#" title="Twitter">
                                    <i class="fa-brands fa-twitter"></i>
                                </a>
                                <a href="#" title="Youtube">
                                    <i class="fa-brands fa-youtube"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <a href="{{ route('dashboard') }}" class="logo">
                    <img src="{{ asset('images/favicon.png') }}" alt="Logo"/>
                </a>
                <div class="about-us">
                    <ul class="list-about-us">
                        <li class="item-menu">
                            <a href="#" title="Về chúng tôi">Về chúng tôi</a>
                        </li>
                        <li class="item-menu">
                            <a href="{{ route('contact_us') }}" title="Phản hồi">Phản hồi</a>
                        </li>
                        <li class="item-menu">
                            <a href="#" title="Giúp đỡ">Giúp đỡ</a>
                        </li>
                        <li class="item-menu">
                            <a href="#" title="FAQs">FAQs</a>
                        </li>
                        <li class="item-menu">
                            <a href="#" title="RSS">RSS</a>
                        </li>
                        <li class="item-menu">
                            <a href="#" title="Điều khoản">Điều khoản</a>
                        </li>
                        <li class="item-menu">
                            <img src="{{ asset('images/dmca-protected.png') }}" alt="dmca-protected" class="dmca-protected">
                        </li>
                        <li class="item-menu">
                            <p class="copy-right">©ABC 2022</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="footer-v2">
                <div class="menu-grid">
                    <label class="grid-title">Mục lục</label>
                    <div class="menu-grid-content">
                        @forelse ($categoriesFooter as $category)
                            <a href="{{ route('post.index', $category) }}" class="item-menu">{{ $category->title }}</a>
                        @empty
                            <h4 class="text-center">No data</h4>
                        @endforelse
                    </div>
                </div>
                <div class="app-info">
                    <label class="grid-title">Tải ứng dụng</label>
                    <div class="link">
                        <a href="#" title="App google">
                            <img src="{{ asset('images/google-play.png') }}" class="app-google">
                        </a>
                        <a href="#" title="App apple">
                            <img src="{{ asset('images/apple-store.png') }}" class="app-apple">
                        </a>
                    </div>
                </div>
                <div class="contact-info">
                    <label class="grid-title">Liên kết</label>
                    <div class="list-social">
                        <a href="#" title="Facebook">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="#" title="Twitter">
                            <i class="fa-brands fa-twitter"></i>
                        </a>
                        <a href="#" title="Youtube">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    </div>
                </div>
                <div class="copyright">
                    <p>©ABC 2022</p>
                </div>
            </div>
        </div>
    </div>
</section>