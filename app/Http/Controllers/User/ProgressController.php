<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Grade;
use Illuminate\Support\Facades\Storage;

class ProgressController extends Controller
{
    public function showProgress(){
        $user = Auth::guard('user')->user(); // ログインしているユーザー情報を取得
        $grades = Grade::with('curriculums')->get(); // 学年と授業情報を取得
        
        return view('user.curriculum_progress', compact('user', 'grades'));

        // もしユーザーがログインしていない場合、適切な処理を追加する
        if (!$user) {
            return redirect()->route('user.login'); // ログイン画面にリダイレクト

        }

    }

       
}
