<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use App\Models\DeliveryTime;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $curriculums = Curriculum::where('grade_id', $user->grade_id)
            ->with(['deliveryTimes' => function($query) {
                $query->where('delivery_from', '<=', now())
                      ->where('delivery_to', '>=', now());
            }])
            ->get();

        return view('delivery.index', compact('curriculums'));
    }
}