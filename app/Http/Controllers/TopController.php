<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopController extends Controller
{
    public function index()
    {
        // ユーザーか管理者かを確認して適切なビューを返す
        if (Auth::guard('admin')->check()) {
            return view('admin.auth.top'); // 管理者用ビュー
        } elseif (Auth::check()) {
            return view('user.auth.top'); // ユーザー用ビュー
        } else {
            return view('home'); // ゲスト用ビュー、必要に応じて作成
        } 
    }
}
