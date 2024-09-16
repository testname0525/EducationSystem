<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use App\Models\Grade;
use App\Models\DeliveryTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurriculumController extends Controller
{
    public function showCurriculumList(Request $request)
    {
        $year = $request->input('year', date('Y'));
        $month = $request->input('month', date('m'));
        $gradeId = $request->input('grade_id');

        $curriculums = Curriculum::select('id', 'title', 'thumbnail', 'grade_id')
            ->with(['deliveryTimes' => function ($query) use ($year, $month) {
            $query->whereYear('delivery_from', $year)
                  ->whereMonth('delivery_from', $month);
        }])
        ->where('grade_id', $gradeId)
        ->get();

        if ($request->ajax()) {
            return response() -> json([
                'html'
                    -> view('user._curriculum_list_cards', compact('curriculums'))
                    ->render(),
                'curriculums' => $ $curriculums
            ]);
        }

        $grades = Grade::all();
        $initialGrade = $grades -> first();
        return view('user/curriculum_list', compact('curriculums','grades', 'initialGrade'));
    }
}
