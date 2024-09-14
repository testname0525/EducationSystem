<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurriculumController extends Controller
{
    public function showCurriculumList()
    {
        $grades = Grade::all();
        $initialGrade = $grades -> first();
        return view('user/curriculum_list', compact('grades', 'initialGrade'));
    }
}
