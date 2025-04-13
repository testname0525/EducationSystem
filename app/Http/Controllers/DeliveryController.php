<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use App\Models\CurriculumProgress;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DeliveryController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();
            // ここを修正：grade_idによるフィルタリングを一時的に無効化
            // $curriculums = Curriculum::where('grade_id', $user->grade_id)->get();
            $curriculums = Curriculum::with('deliveryTimes')->get(); // すべての講座を取得
            return view('user.delivery', compact('curriculums'));
        } catch (\Exception $e) {
            Log::error('Error in DeliveryController@index: ' . $e->getMessage());
            return back()->with('error', 'エラーが発生しました。');
        }
    }

    public function show($id)
    {
        try {
            $curriculum = Curriculum::with(['grade', 'deliveryTimes'])->findOrFail($id);
            $user = Auth::user();
            
            $progress = CurriculumProgress::where('user_id', $user->id)
                ->where('curriculum_id', $id)
                ->first();

            $now = Carbon::now();
            $isWithinPeriod = false;

            if (!$curriculum->always_delivery_flg) {
                foreach ($curriculum->deliveryTimes as $deliveryTime) {
                    if ($now->between($deliveryTime->delivery_from, $deliveryTime->delivery_to)) {
                        $isWithinPeriod = true;
                        break;
                    }
                }
            }

            $canViewVideo = $curriculum->always_delivery_flg || $isWithinPeriod;
            $canPressButton = (!$progress) && ($curriculum->always_delivery_flg || $isWithinPeriod);

            return view('user.delivery.show', compact('curriculum', 'canViewVideo', 'canPressButton'));
        } catch (\Exception $e) {
            Log::error('Error in DeliveryController@show: ' . $e->getMessage());
            return back()->with('error', 'エラーが発生しました。');
        }
    }

    public function updateProgress(Request $request, $id)
    {
        try {
            CurriculumProgress::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'curriculum_id' => $id
                ],
                ['clear_flg' => true]
            );
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error in DeliveryController@updateProgress: ' . $e->getMessage());
            return response()->json(['success' => false], 500);
        }
    }
    
    /**
     * 画像表示用メソッド（テスト項目13用）
     */
    public function showImage($id)
    {
        try {
            $curriculum = Curriculum::findOrFail($id);
            // ビューファイルのパスを修正
            return view('user.show.image', compact('curriculum'));
        } catch (\Exception $e) {
            Log::error('Error in DeliveryController@showImage: ' . $e->getMessage());
            return back()->with('error', 'エラーが発生しました。');
        }
    }
}