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

        $curriculums = Curriculum::select('id', 'title', 'thumbnail', 'grade_id','always_delivery_flg')
            ->with(['deliveryTimes' => function ($query) use ($year, $month) {
            $query->whereYear('delivery_from', $year)
                  ->whereMonth('delivery_from', $month);
        }])
        ->where('grade_id', $gradeId)
        ->where(function ($query) use ($year, $month) {
            $query->whereHas('deliveryTimes', function ($subQuery) use ($year, $month) {
                $subQuery->whereYear('delivery_from', $year)
                         ->whereMonth('delivery_from', $month);
            })
            ->orWhere('always_delivery_flg', 1);
        })
        ->get();

        if ($request->ajax()) {
            return response() -> json([
                'html' => view('user._curriculum_list_cards', compact('curriculums'))
                       -> render(),
                'curriculums' => $curriculums
            ]);
        }

        $grades = Grade::all();
        $initialGrade = $grades -> first();

        $initialGrade->background_color = $this->getGradeBackgroundColor($initialGrade);

        $initialData = [
            'year' => date('Y'),
            'month' => date('m'),
            'gradeId' => $gradeId ?? $initialGrade->id,
            'baseUrl' => url('/') // アプリケーションのベースURLを取得
        ];

        return view('user.curriculum_list', compact('curriculums','grades', 'initialGrade', 'initialData'));

        
    }
    
    private function getGradeBackgroundColor($grade)
        {
            $colors = '#89E5F5';
            return $colors;
        }
}

