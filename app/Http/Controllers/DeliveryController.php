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
        $curriculum = Curriculum::with('grade')->findOrFail($id);
        return view('user.delivery.delivery_show', compact('curriculum'));
    }

    public function updateProgress(Request $request, $id)
    {
        CurriculumProgress::updateOrCreate(
            ['user_id' => Auth::id(), 'curriculum_id' => $id],
            ['clear_flg' => true]
        );
        return response()->json(['success' => true]);
    }
}