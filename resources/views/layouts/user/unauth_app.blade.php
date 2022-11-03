<!doctype html>

<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <title>Blog</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/notice.css') }}">
    @stack('styles')
</head>
<body>
    <main>
        <div class="auth-user">
            @yield('content-user')
        </div>
    </main>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="{{ asset('js/header/jquery.min.js') }}"></script>
    <script src="{{ asset('user/js/register/display-selected-image.js') }}"></script>
    <script src="{{ asset('app-assets/js/popper.js') }}"></script>
    <script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/fontawesome/brands.js') }}"></script>
    <script src="{{ asset('app-assets/js/fontawesome/solid.js') }}"></script>
    <script src="{{ asset('app-assets/js/fontawesome/fontawesome.js') }}"></script>
    <script src="{{ asset('js/admin/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/hide-alert.js') }}"></script>
    {!! Toastr::message() !!}
    @stack('scripts')
</body>
</html>
