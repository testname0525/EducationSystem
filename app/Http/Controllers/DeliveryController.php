<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use App\Models\CurriculumProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $curriculums = Curriculum::where('grade_id', $user->grade_id)->get();
        return view('user.delivery', compact('curriculums'));
    }

    public function show($id)
    {
        $curriculum = Curriculum::findOrFail($id);
        return view('user.delivery_show', compact('curriculum'));
    }

    public function updateProgress(Request $request, $id)
    {
        $curriculum = Curriculum::findOrFail($id);
        CurriculumProgress::updateOrCreate(
            ['user_id' => Auth::id(), 'curriculum_id' => $curriculum->id],
            ['clear_flg' => true]
        );
        return response()->json(['success' => true]);
    }
}