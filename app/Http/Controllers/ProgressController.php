<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $curriculums = Curriculum::where('grade_id', $user->grade_id)
            ->with(['progress' => function($query) use ($user) {
                $query->where('users_id', $user->id);
            }])
            ->get();

        return view('progress.index', compact('curriculums'));
    }
}