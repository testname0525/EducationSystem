<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use App\Models\CurriculumProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        $user = Auth::user();
        $progress = CurriculumProgress::where('user_id', $user->id)
            ->where('curriculum_id', $curriculum->id)
            ->first();
        
        $now = Carbon::now();
        $isWithinPeriod = $now->between($curriculum->delivery_from, $curriculum->delivery_to);
        
        $canViewVideo = $curriculum->always_open || ($isWithinPeriod && !$progress);
        $canPressButton = ($curriculum->always_open || $isWithinPeriod) && !$progress;

        return view('user.delivery.show', compact('curriculum', 'canViewVideo', 'canPressButton'));
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