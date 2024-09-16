<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BannerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function(){
        Route::view('/login', 'admin.auth.login')->name('show.login');
        Route::post('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login'])->name('show.login.post');
        Route::view('/register', 'admin.auth.register')->name('show.register');
        Route::post('/register', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'register'])->name('show.register.post');
    });

    Route::middleware('auth:admin')->group(function(){
        Route::post('/logout', [App\Http\Controllers\Admin\Auth\LoginController::class,'logout'])->name('logout');
        Route::get('/top', [App\Http\Controllers\Admin\TopController::class,'showTop'])->name('show.top')->middleware('admin');
        Route::get('/article_list', [App\Http\Controllers\Admin\ArticleController::class,'showArticleList'])->name('show.article.list');
        Route::get('/curriculum_list', [App\Http\Controllers\Admin\CurriculumController::class,'showCurriculumList'])->name('show.curriculum.list');
        Route::get('/banner_edit', [App\Http\Controllers\Admin\BannerController::class,'showBannerEdit'])->name('show.banner.edit');
        Route::post('/banner_edit', [App\Http\Controllers\Admin\BannerController::class,'store'])->name('show.banner.store');
        Route::put('/banners/{banner}', [App\Http\Controllers\Admin\BannerController::class, 'update'])->name('show.banner.update');
        Route::delete('/banner_edit/{banner}', [App\Http\Controllers\Admin\BannerController::class,'destroy'])->name('show.banner.destroy');
    });
});

Route::prefix('user')->namespace('User')->name('user.')->group(function () {
    Route::get('/top', [App\Http\Controllers\User\TopController::class,'showTop'])->name('show.top');
    Route::get('/delivery', [App\Http\Controllers\User\DeliveryController::class,'showDelivery'])->name('show.delivery');
    Route::get('/curriculum_list', [App\Http\Controllers\User\CurriculumController::class,'showCurriculumList'])->name('show.curriculum.list');
});
