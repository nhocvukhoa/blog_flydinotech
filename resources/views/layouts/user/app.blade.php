<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description"
        content="Frest user is super flexible, powerful, clean &amp; modern responsive bootstrap 4 user template with unlimited possibilities.">
    <meta name="keywords"
        content="user template, Frest user template, dashboard template, flat user template, responsive user template, web app">
    <meta name="author" content="PIXINVENT">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    <title>Blog</title>
    <link rel="apple-touch-icon" href="{{ asset('user/app-assets/images/icon/puma.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('user/app-assets/images/icon/nike.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/posts/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/posts/app.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header/style.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/posts/list.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/dashboard/styles.css') }}">
    <link href="{{ asset('app-assets/css/fontawesome/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ asset('app-assets/css/fontawesome/brands.css') }}" rel="stylesheet">
    <link href="{{ asset('app-assets/css/fontawesome/solid.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('user/css/dashboard/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/tiny-slider/tiny-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact/style.css') }}">
    <script src="{{ asset('user/js/posts/tiny-slider/tiny-slider.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('user/css/notice.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/select2/select2.min.css') }}">
    @stack('styles')
</head>
<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern 2-columns  navbar-sticky footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Header-->
    @include('layouts.user.partials.header')
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    @include('layouts.user.partials.sidebar')
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content flexbox-container">
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>
    <!-- END: Content-->
    
    <!-- BEGIN: Footer-->
    @include('layouts.user.partials.footer')
    <!-- END: Footer-->

    <!-- BEGIN: JS-->
    <script src="{{ asset('js/header/jquery.min.js') }}"></script>
    <script src="{{ asset('js/header/app.min.js') }}"></script>
    <script src="{{ asset('js/header/sub-header.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('user/js/posts/ckeditor.js') }}"></script>
    <script src="{{ asset('user/js/posts/classic-editor.js') }}"></script>
    <script src="{{ asset('user/js/posts/reply-comment.js') }}"></script>
    <script src="{{ asset('user/js/posts/display-selected-image.js') }}"></script>
    <script src="{{ asset('app-assets/js/fontawesome/brands.js') }}"></script>
    <script src="{{ asset('app-assets/js/fontawesome/solid.js') }}"></script>
    <script src="{{ asset('app-assets/js/fontawesome/fontawesome.js') }}"></script>
    <script src="{{ asset('app-assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('user/js/posts/tiny-slider/control-slider.js') }}"></script>
    <script src="{{ asset('js/share.js') }}"></script>
    <script src="{{ asset('js/admin/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('user/js/posts/comment-management.js') }}"></script>
    <script src="{{ asset('js/admin/select2/select2.min.js') }}"></script>
    {!! Toastr::message() !!}
    <!-- END: Theme JS-->
    @stack('scripts')
</body>
<!-- END: Body-->
</html>
