<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TopController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\ProfileController;

// 公開ルート
Route::get('/', [TopController::class, 'index'])->name('user.top');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

// 認証ルート
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('user.register');
Route::post('/register', [UserController::class, 'register']);
Route::get('/login', [UserController::class, 'showLoginForm'])->name('user.login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// ユーザー画面ルート
Route::middleware(['auth'])->group(function () {
    Route::get('/curriculum', [CurriculumController::class, 'index'])->name('user.curriculum.index');
    Route::post('/curriculum/{curriculum}/progress', [CurriculumController::class, 'updateProgress'])->name('user.curriculum.updateProgress');
    Route::get('/delivery', [DeliveryController::class, 'index'])->name('user.delivery');
    Route::get('/delivery/{id}', [DeliveryController::class, 'show'])->name('user.delivery.show');
    Route::post('/delivery/{id}/progress', [DeliveryController::class, 'updateProgress'])->name('user.delivery.updateProgress');
    Route::get('/progress', [UserController::class, 'progress'])->name('user.progress');
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('user.profile.update');
    Route::get('/timetable', [UserController::class, 'timetable'])->name('user.timetable');
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