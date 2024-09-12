<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TopController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\ProfileController;

// 公開ルート
Route::get('/', [TopController::class, 'index'])->name('top');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

// 認証ルート
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ユーザー画面ルート
Route::prefix('user')->middleware(['auth'])->name('user.')->group(function () {
    Route::get('/curriculum', [CurriculumController::class, 'index'])->name('curriculum.index');
    Route::post('/curriculum/{curriculum}/progress', [CurriculumController::class, 'updateProgress'])->name('curriculum.updateProgress');
    Route::get('/delivery', [DeliveryController::class, 'index'])->name('delivery.index');
    Route::get('/progress', [ProgressController::class, 'index'])->name('progress.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// 管理画面ルート
Route::prefix('admin')->middleware(['auth:admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::resource('articles', App\Http\Controllers\Admin\ArticleController::class);
    Route::resource('curriculums', App\Http\Controllers\Admin\CurriculumController::class);
    Route::resource('grades', App\Http\Controllers\Admin\GradeController::class);
    Route::resource('banners', App\Http\Controllers\Admin\BannerController::class);
});