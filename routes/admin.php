<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProfileController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great.
|
*/

Route::GET('login', [LoginController::class, 'showLoginForm'])->name('login_page');

Route::POST('login', [LoginController::class, 'login'])->name('login');

Route::group(['middleware' => ['auth.admin']], function () {
    Route::GET('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::GET('logout', [LoginController::class, 'logout'])->name('logout');

    // Route Comment
    Route::prefix('comment')->name('comment.')->group(function () {
        Route::GET('/post/{post}', [CommentController::class, 'show'])->name('detail');
        Route::PUT('/post/change/{comment}', [CommentController::class, 'statusComment'])->name('detail.status');
        Route::DELETE('/post/delete/{comment}', [CommentController::class, 'destroy'])->name('detail.delete');
    });

    //user
    Route::resource('user', UserController::class);
    Route::put('user/block-user/{user}', [UserController::class, 'blockUser'])->name('user.block-user');

    // Category management
    Route::resource('categories', CategoryController::class);
    Route::put('categories/change-status/{category}', [CategoryController::class, 'changeStatus'])->name('categories.change_status');

    //News management
    Route::resource('news', NewsController::class);
    Route::PUT('news/change-status/{new}', [NewsController::class, 'changeStatus'])->name('news.change_status');
    Route::POST('news/upload', [NewsController::class, 'upload'])->name('news.upload');
    
    // Post management
    Route::resource('posts', PostController::class);
    Route::put('posts/change-status/{post}', [PostController::class, 'changeStatus'])->name('posts.change_status');
    Route::post('posts/upload', [PostController::class, 'upload'])->name('posts.upload');

    // About us
    Route::get('options/setting', [OptionController::class, 'showSetting'])->name('options.setting');
    Route::put('options/setting/{option}', [OptionController::class, 'updateSetting'])->name('options.update_setting');
    Route::resource('options', OptionController::class);
    Route::post('options/upload', [OptionController::class, 'upload'])->name('options.upload');

    // contact management
    Route::resource('contact', ContactController::class);
    Route::put('contact/change-status/{contact}', [ContactController::class, 'changeStatus'])->name('contact.change_status');

    // Info admin
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::post('/update', [ProfileController::class, 'update'])->name('update');
    });
});
