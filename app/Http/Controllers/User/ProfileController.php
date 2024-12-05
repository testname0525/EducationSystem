<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function showProfileForm()
    {
        $user = Auth::user(); // ログインしているユーザー情報を取得
        return view('user.profile_edit', compact('user'));

        // もしユーザーがログインしていない場合、適切な処理を追加する
        if (!$user) {
            return redirect()->route('user.login'); // ログイン画面にリダイレクト
        }
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::guard('user')->user(); // ログインしているユーザー情報を取得

        $request->validate([
            'name' => 'required|string|max:255',
            'name_kana' => 'required|string|max:255|regex:/^[ァ-ヶー]+$/u',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $request->name;
        $user->name_kana = $request->name_kana;
        $user->email = $request->email;

        // プロフィール画像の保存
        if ($request->hasFile('profile_image')) {
            // 古い画像の削除
            if ($user->profile_image && Storage::exists('public/images/profile/' . $user->profile_image)) {
                Storage::delete('public/images/profile/' . $user->profile_image);
            }
            // 新しい画像の保存
            $fileName = time() . '.' . $request->profile_image->extension();
            $request->profile_image->storeAs('public/images/profile', $fileName);
            $user->profile_image = $fileName;
        }

        $user->save();

        return redirect()->route('user.show.profile')->with('success', '登録しました');
    }

    public function showPasswordForm()
    {
        $user = Auth::user(); // ログインしているユーザー情報を取得
        return view('user.password_edit', compact('user'));

        // もしユーザーがログインしていない場合、適切な処理を追加する
        if (!$user) {
            return redirect()->route('user.login'); // ログイン画面にリダイレクト
        }
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::guard('user')->user(); // ログインしているユーザー情報を取得
        
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        // 現在のパスワードが正しいか確認
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return back()->withErrors(['current_password' => '現在のパスワードが正しくありません。']);
        }

        // パスワードを更新
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return redirect()->route('user.show.password.edit')->with('success', 'パスワードが更新されました。');
    }

}