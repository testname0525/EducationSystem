<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function showRegistrationForm()
    {
        return view('user.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_kana' => 'required|string|max:255|regex:/^[ァ-ヶー]+$/u',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name_kana.regex' => 'カナはカタカナで入力してください。',
        ]);

        $defaultGrade = 1;

        $user = User::create([
            'name' => $request->name,
            'name_kana' => $request->name_kana,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'grade_id' => $defaultGrade,
        ]);

        Auth::login($user);

        return redirect()->route('user.top')->with('success', '登録が完了しました。');
    }

    public function showLoginForm()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        Log::info('Login attempt', ['email' => $request->email]);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            Log::info('User found', ['user_id' => $user->id, 'hashed_password' => $user->password]);
            if (Hash::check($request->password, $user->password)) {
                Log::info('Password is correct');
                if (Auth::attempt($credentials, $request->filled('remember'))) {
                    $request->session()->regenerate();
                    Log::info('User logged in successfully', ['user_id' => Auth::id(), 'email' => $request->email]);
                    return redirect()->intended(route('user.top'));
                }
            } else {
                Log::info('Password is incorrect');
            }
        } else {
            Log::info('User not found');
        }

        Log::warning('Login failed', ['email' => $request->email]);

        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが正しくありません。',
        ])->withInput($request->only('email', 'remember'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function timetable()
    {
        return view('user.timetable');
    }

    public function progress()
    {
        return view('user.progress');
    }

    public function profile()
    {
        return view('user.profile');
    }
}