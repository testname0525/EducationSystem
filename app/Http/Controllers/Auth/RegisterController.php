<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $grades = Grade::all();
        return view('auth.register', compact('grades'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_kana' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'grade_id' => ['required', 'exists:grades,id'],
            'profile_image' => ['nullable', 'image', 'max:2048'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'name_kana' => $request->name_kana,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'grade_id' => $request->grade_id,
        ]);

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $path;
            $user->save();
        }

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}