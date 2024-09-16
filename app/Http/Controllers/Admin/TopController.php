<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class TopController extends Controller
{
    public function index(){
        
        $admin = Auth::guard('admin')->user(); // ログインしている管理者情報を取得
        return view('admin.top', ['admin' => $admin]);
    }

}
