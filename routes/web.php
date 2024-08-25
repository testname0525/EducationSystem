<?php

use Illuminate\Support\Facades\Route;

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
        Route::get('/banner_edit', [App\Http\Controllers\Admin\BannerController::class,'showBannerEdit'])->name('show.banner.edit');
    });
});
