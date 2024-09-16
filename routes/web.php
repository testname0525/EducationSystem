<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\User\Auth\LoginController as UserLoginController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\User\Auth\RegisterController as UserRegisterController;
use App\Http\Controllers\Admin\Auth\RegisterController as AdminRegisterController;
use App\Http\Controllers\User\ArticleController as UserArticleController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\User\TopController as UserTopController;
use App\Http\Controllers\Admin\TopController as AdminTopController;
use App\Http\Controllers\User\ProgressController;
use App\Http\Controllers\User\ProfileController;

use App\Http\Controllers\TopController;

// 共通トップページ
Route::get('/', function(){ return view('home'); })->name('home');

// ユーザー用管理グループ
Route::prefix('user')->namespace('User')->name('user.')->group(function() {
    // ログイン画面
    Route::get('login', [UserLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [UserLoginController::class, 'login'])->name('login.submit');
    Route::post('logout', [UserLoginController::class, 'logout'])->name('logout');

    // トップページ
    Route::get('top', [UserTopController::class, 'index'])->name('top')->middleware('auth:user');

    // ユーザー新規登録
    Route::get('register', [UserRegisterController::class, 'showRegisterForm'])->name('show.register');
    Route::post('register', [UserRegisterController::class, 'register'])->name('register.submit');

    // お知らせ一覧取得
    Route::get('top', [UserArticleController::class, 'showArticleIndex'])->name('show.article.list')->middleware('auth:user');
    // お知らせ詳細画面表示
    Route::get('/article/{id}', [UserArticleController::class, 'showArticle'])->name('show.article')->middleware('auth:user');

    // 授業進捗画面表示
    Route::get('progress', [ProgressController::class, 'showProgress'])->name('show.progress')->middleware('auth:user');

    // プロフィール設定画面表示
    Route::get('profile', [ProfileController::class, 'showProfileForm'])->name('show.profile')->middleware('auth:user');
    // プロフィール設定更新
    Route::post('profile', [ProfileController::class, 'updateProfile'])->name('update.profile')->middleware('auth:user');

    // パスワード変更画面表示
    Route::get('password', [ProfileController::class, 'showPasswordForm'])->name('show.password.edit')->middleware('auth:user');
    // パスワード変更処理
    Route::post('password', [ProfileController::class, 'updatePassword'])->name('update.password')->middleware('auth:user');
});

// 管理者用ルートグループ
Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function() {
    // ログイン画面
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminLoginController::class, 'login'])->name('login.submit');
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');

    // トップページ
    Route::get('top', [AdminTopController::class, 'index'])->name('top')->middleware('auth:admin');

    // 管理者新規登録
    Route::get('register', [AdminRegisterController::class, 'showRegisterForm'])->name('show.register');
    Route::post('register', [AdminRegisterController::class, 'register'])->name('register.submit');

    // お知らせ一覧画面
    Route::get('/article_list', [AdminArticleController::class, 'showArticleList'])->name('show.article.list')->middleware('auth:admin');
    // お知らせ削除処理
    Route::post('/article_list/{id}', [AdminArticleController::class, 'deleteArticle'])->name('delete.article')->middleware('auth:admin');

    // お知らせ新規登録画面表示
    Route::get('/article_create', [AdminArticleController::class, 'showArticleCreate'])->name('show.article.create')->middleware('auth:admin');
    // お知らせ新規登録処理
    Route::post('/article_create', [AdminArticleController::class, 'showArticleStore'])->name('show.article.store')->middleware('auth:admin');

    // お知らせ編集画面
    Route::get('/article_edit/{id}', [AdminArticleController::class, 'showArticleEdit'])->name('show.article.edit')->middleware('auth:admin');
    // お知らせ更新処理
    Route::post('/article_edit/{id}', [AdminArticleController::class, 'updateArticle'])->name('update.article')->middleware('auth:admin');

});
