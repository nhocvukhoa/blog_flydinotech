<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description"
        content="Frest admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Frest admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Ecommerce - Frest - Bootstrap HTML admin template</title>
    <link rel="apple-touch-icon" href="./admin/app-assets/images/ico/apple-icon-120.png.html">
    <link rel="shortcut icon" type="image/x-icon" href="./admin/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('admin/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/app-assets/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/app-assets/css/colors.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/app-assets/css/components.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/app-assets/css/core/menu/menu-types/vertical-menu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/posts/app.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/news/app.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/dashboard/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/user/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/dashboard/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/category/app.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/dashboard/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/dashboard/datepicker-arrow.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/profile/app.css') }}">
    @stack('styles')
</head>

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-sticky footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Header-->
    @include('layouts.admin.partials.header')
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    @include('layouts.admin.partials.sidebar')
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- BEGIN: Footer-->
    @include('layouts.admin.partials.footer')

    <!-- END: Footer-->

    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('admin/app-assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('admin/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.min.js') }}"></script>
    <script src="{{ asset('admin/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.min.js') }}"></script>
    <script src="{{ asset('admin/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('admin/app-assets/js/scripts/configs/vertical-menu-light.min.js') }}"></script>
    <script src="{{ asset('admin/app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('admin/app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('admin/app-assets/js/core/hide-alert.js') }}"></script>
    <script src="{{ asset('admin/js/news/preview-image.js') }}"></script>
    <script src="{{ asset('admin/js/posts/display-selected-image.js') }}"></script>
    <!-- END: Theme JS-->
    <script src="{{ asset('admin/js/dashboard/jquery.js') }}"></script>
    <script src="{{ asset('admin/js/dashboard/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/admin/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('js/admin/select2/select2.min.js') }}"></script>
    <script src="{{ asset('admin/js/profile/display-selected-image.js') }}"></script>
    <script src="{{ asset('admin/js/profile/update-profile-ajax.js') }}"></script>
    @stack('scripts')
</body>
<!-- END: Body-->

</html>
