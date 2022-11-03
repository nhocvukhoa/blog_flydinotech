const { js } = require('laravel-mix');
const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.webpackConfig({
    resolve: {
        extensions: ['.js', '.vue', '.json', '.scss', '.png'],
        alias: {
            '@': __dirname + '/resources/assets',
            '~': __dirname + 'node_modules/'
        },
    },
})

mix.js('resources/assets/base/js/app.js', 'public/js')
    .sass('resources/assets/base/scss/app.scss', 'public/css');

// admin
mix.js('resources/assets/admin/js/app.js', 'public/admin/js')
    .sass('resources/assets/admin/scss/app.scss', 'public/admin/css')
    .sass('resources/assets/admin/scss/posts/app.scss', 'public/admin/css/posts')
    .sass('resources/assets/admin/scss/news/app.scss', 'public/admin/css/news')
    .sass('resources/assets/admin/scss/dashboard/style.scss', 'public/admin/css/dashboard')
    .sass('resources/assets/admin/scss/user/styles.scss', 'public/admin/css/user')
    .copyDirectory('resources/assets/admin/js/posts', 'public/admin/js/posts')
    .copyDirectory('resources/assets/admin/images', 'public/admin/images')
    .copyDirectory('resources/assets/admin/app-assets', 'public/admin/app-assets')
    .copyDirectory('resources/assets/admin/app-assets/data', 'public/app-assets/data')
    .copyDirectory('resources/assets/admin/js/news', 'public/admin/js/news')
    .copyDirectory('node_modules/ckeditor4', 'public/admin/ckeditor4')
    .sass('resources/assets/admin/scss/category/app.scss', 'public/admin/css/category')
    .sass('resources/assets/admin/scss/profile/app.scss', 'public/admin/css/profile')
    .copyDirectory('resources/assets/admin/js/profile', 'public/admin/js/profile')

    //Datetime picker
    .copy('node_modules/jquery/dist/jquery.js', 'public/admin/js/dashboard')
    .copy('node_modules/jquery-ui/dist/jquery-ui.js', 'public/admin/js/dashboard')
    .copy('node_modules/jquery-ui/dist/themes/base/jquery-ui.css', 'public/admin/css/dashboard')
    .sass('node_modules/font-awesome/scss/font-awesome.scss', 'public/admin/css/dashboard')
    .copy('resources/assets/admin/scss/dashboard/datepicker-arrow.css', 'public/admin/css/dashboard')

mix.copy('node_modules/select2/dist/css/select2.min.css', 'public/css/admin/select2')
mix.copy('node_modules/select2/dist/js/select2.min.js', 'public/js/admin/select2')
mix.copy('node_modules/toastr/build/toastr.min.css', 'public/css/admin/toastr')
mix.copy('node_modules/toastr/build/toastr.min.js', 'public/js/admin/toastr')
mix.copy('node_modules/sweetalert2/dist/sweetalert2.min.css', 'public/css/sweetalert2')
mix.copy('node_modules/sweetalert2/dist/sweetalert2.min.js', 'public/js/sweetalert2')

// user
mix.js('resources/assets/user/js/app.js', 'public/js')
    .sass('resources/assets/user/scss/app.scss', 'public/css')
    .sass('resources/assets/user/scss/header/style.scss', 'public/css/header')
    .copyDirectory('resources/assets/user/js/header', 'public/js/header')
    .copyDirectory('resources/assets/user/images', 'public/images')
    .sass('resources/assets/user/scss/style.scss', 'public/css')
    .sass('resources/assets/user/scss/auth.scss', 'public/css/auth')
    .sass('resources/assets/user/scss/posts/app.scss', 'public/user/css/posts')
    .sass('resources/assets/user/scss/profile/profile.scss', 'public/css/profile')
    .sass('resources/assets/user/scss/posts/list.scss', 'public/user/css/posts')
    .copyDirectory('resources/assets/user/js/posts', 'public/user/js/posts')
    .copyDirectory('resources/assets/user/images', 'public/images')
    .copyDirectory('resources/assets/user/app-assets', 'public/app-assets')
    .copyDirectory('resources/assets/user/images', 'public/user/images')
    .sass('resources/assets/user/scss/dashboard/styles.scss', 'public/user/css/dashboard')
    .sass('resources/assets/user/scss/contact/style.scss', 'public/css/contact')
    .copyDirectory('node_modules/ckeditor4', 'public/user/ckeditor4')
    .copyDirectory('resources/assets/user/app-assets/images', 'public/storage/posts')
    .copyDirectory('resources/assets/user/js/register', 'public/user/js/register')
    .sass('resources/assets/user/scss/notice.scss', 'public/user/css')
    .copy('node_modules/select2/dist/css/select2.min.css', 'public/css/user/select2')
    .copy('node_modules/select2/dist/js/select2.min.js', 'public/js/user/select2')
    .copy('node_modules/toastr/build/toastr.min.css', 'public/css/user/toastr')
    .copy('node_modules/toastr/build/toastr.min.js', 'public/js/user/toastr')
