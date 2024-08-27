<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use App\Models\CurriculumProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CurriculumController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $curriculums = Curriculum::where('grade_id', $user->grade_id)
            ->with(['grade', 'progress' => function($query) use ($user) {
                $query->where('users_id', $user->id);
            }])
            ->get();

        return view('curriculum.index', compact('curriculums'));
    }

    public function updateProgress(Request $request, Curriculum $curriculum)
    {
        $request->validate([
            'clear_flg' => 'required|boolean',
        ]);

        CurriculumProgress::updateOrCreate(
            ['users_id' => Auth::id(), 'curriculums_id' => $curriculum->id],
            ['clear_flg' => $request->clear_flg]
        );

        return redirect()->route('curriculum.index')->with('success', '進捗状況が更新されました。');
    }
}